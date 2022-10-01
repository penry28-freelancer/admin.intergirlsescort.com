<?php

namespace Database\Seeders;

use App\Models\Transaction;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersSeeder::class);
        $this->call(CountryGroupSeeder::class);
        $this->call(LanguageSeeder::class);
        $this->call(DaySeeder::class);
        $this->call(ServiceSeeder::class);
        $this->call(TourSeeder::class);
        $this->call(FaqSeeder::class);
        $this->call(CurrencySeeder::class);
        $this->call(AgencySeeder::class);
        $this->call(EscortSeeder::class);
        $this->call(EscortReviewSeeder::class);
        $this->call(AgencyReviewSeeder::class);
        $this->call(PageContentSeeder::class);
        $this->call(ContactSeeder::class);
        $this->call(MemberSeeder::class);
        $this->call(ClubSeeder::class);
        $this->call(AdvertiseSeeder::class);
        $this->call(AffilateSeeder::class);
        $this->call(ClientReportSeeder::class);
        $this->call(EscostReportSeeder::class);
        $this->call(AgencyReportSeeder::class);
        $this->call(ReportSeeder::class);
        $this->call(ClubBannerSeeder::class);
        $this->call(PriceSeeder::class);
        $this->call(BillSeeder::class);
        $this->call(TransactionSeeder::class);
    }
}
