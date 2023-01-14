<?php

namespace App\Http\Controllers\FE\v1;

use App\Constants\PaymentType;
use App\Contracts\PaymentGateway;
use App\Exceptions\PayPalResponseException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Validations\FE\v1\TransactionRequest;
use App\Jobs\MonitorTransaction;
use App\Models\Transaction;
use App\Repositories\Price\PriceRepository;
use App\Repositories\Transaction\TransactionRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    private $_paymentService;
    private $_priceRepository;
    private $_transactionRepo;

    public function __construct(
        PaymentGateway $paymentGateway,
        PriceRepository $priceRepository,
        TransactionRepository $transactionRepository
    ) {
        $this->_paymentService = $paymentGateway;
        $this->_priceRepository = $priceRepository;
        $this->_transactionRepo = $transactionRepository;
    }

    public function createPayment(TransactionRequest $request)
    {
        $account = $request->user();

        try {
            $price = $this->_priceRepository->find($request->price_id);

            if(!$price)
                return $this->jsonMessage("Price not found", true, 404);

            $transaction_id = $this->_transactionRepo->generateTransactionId();

            $item = [
                'name' => $price->gold,
                'quantity' => 1,
                'price' => $price->price,
                'transaction' => $transaction_id
            ];

            $returnUrl = $this->_paymentService
                ->setCurrency('USD')
                ->setReturnUrl(config('paypal.return_url'))
                ->setCancelUrl(config('paypal.cancel_url'))
                ->setItems([ $item ])
                ->createPayment('Buy ' . $price->gold . ' gold');

            $request->request->add([
                'transaction_id' => $transaction_id,
                'payment_type' => PaymentType::CARD,
                'price_id' => $price->id,
                'price_num' => $price->price,
                'account_id' => $account->id,
                'status' => Transaction::PENDING,
            ]);

            $transaction = $this->_transactionRepo->store($request);

            MonitorTransaction::dispatch($transaction)
                ->delay(now()->addMinute(config('constants.minutes_decline_transaction')));

//            return redirect($returnUrl);
            return $this->jsonData($returnUrl);
        } catch (\Exception $ex) {
            return $this->jsonError($ex->getMessage());
        }
    }

    public function status(Request $request): JsonResponse
    {
        try {
            if (!$request->has('paymentId') || !$request->has('token')) {
                throw new PayPalResponseException('PaymentId or Token invalid');
            }

            $status = $this->_paymentService->getPaymentStatus($request->input('paymentId'));

            return $this->jsonData($status);
        } catch (\Exception $ex) {
            return $this->jsonError($ex->getMessage());
        }
    }


    public function success(Request $request): JsonResponse
    {
        try {
            if (!$request->has('paymentId') || !$request->has('token')) {
                throw new PayPalResponseException('Payment Id or Token invalid');
            }

            $detail = $this->_paymentService->getPaymentDetail($request->input('paymentId'));

            if(isset($detail[0])) {
                $itemList = $detail[0]->getItemList();
                $firstItem = count($itemList->getItems()) > 0 ? $itemList->getItems()[0] : null;

                if($firstItem) {
                    $transaction_id = $firstItem->getSku();
                    $transaction = $this->_transactionRepo->findBy('transaction_id', $transaction_id);

                    if(!$transaction)
                        throw new \Exception('Transaction not found');

                    $transaction->markSuccess();
                }
            }

            return $this->jsonData($detail);
        } catch (\Exception $ex) {
            return $this->jsonError($ex->getMessage());
        }
    }
}
