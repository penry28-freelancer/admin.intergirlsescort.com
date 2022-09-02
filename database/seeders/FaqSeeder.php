<?php

namespace Database\Seeders;

use Carbon\Carbon;

class FaqSeeder extends BaseSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \DB::table('faqs')->truncate();
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $date_now = Carbon::now();

        $escort_faqs = [
            [
                'question' => 'Who can advertise in our directory?',
                'answer' => '<p>Only independent escort providers, escort agencies and strip clubs can can create an account. Is not allowed to create account for WebCams, escort directories, pornsites or dating sites. For such a websites we can offer a paid banner place.</p>'
            ],
            [
                'question' => 'I am an independent escort provider. How can I register an Ad?',
                'answer' => '<p>- to start advertising, please, create "independent escort" account via <a href="https://www.eurogirlsescort.com/user/create-account/?type=girl" target="_blank">www.eurogirlsescort.com/user/create-account/?type=girl</a><br>
                Please, log in to your account, fill required information about yourself and upload your photos. Once your account is approved, you will be notified and you can start to advertise.<br>
                <br>
                - if you have website url address is necessary to place our banner on your website home page to visible positions. If you would have problem to manage this, please ask our support for help</p>'
            ],
            [
                'question' => 'I have an agency. How can we register an Ad?',
                'answer' => '<p>- to start advertising, please, create “Escort agency” account via <a href="https://www.eurogirlsescort.com/user/create-account/?type=agency" target="_blank">https://www.eurogirlsescort.com/user/create-account/?type=agency</a><br>
                Please, log in to your account, first fill in information about your agency and then you can add profiles of your escorts. Each profile represents only 1 person. Profiles with photos of different people or duplicate profiles are not allowed. Once your account is approved, you will be notified and you can start to advertise.<br>
                <br>
                - if you have website url address is necessary to place our banner on your website home page to visible positions. If you would have problem to manage this, please ask our support for help</p>'
            ],
            [
                'question' => 'I have a strip club/cabaret. How can we register an Ad?',
                'answer' => '- to start advertising, please, create “Strip club/cabaret” account via https://www.eurogirlsescort.com/user/create-account/?type=club
                Please, log in to your account, first fill in information about your club/cabaret and then you can add profiles of your escorts. Each profile represents only 1 person. Profiles with photos of different people or duplicate profiles are not allowed. Once your account is approved, you will be notified and you can start to advertise.

                - if you have website url address is necessary to place our banner on your website home page to visible positions. If you would have problem to manage this, please ask our support for help'
            ],
            [
                'question' => 'Is advertising for free?',
                'answer' => '<p>Yes, you can advertise for free on our directory. To reach better visibility you can activate premium advertising any time you want.</p>'
            ],
            [
                'question' => 'How do I make a great profile?',
                'answer' => '<p>&nbsp;If you provide a complete profile with accurate information, you will increase the number and quality of the results you get from it.</p>
                <ul>
                <li>Put real photos, at least 3 photos in gallery are required</li>
                <li>Take time to provide a good description</li>
                <li>List only the services you provide</li>
                <li>Add rates</li>
                <li>Make sure your phone number is correct</li>
                <li>Verify your profile - herewith you will increase visibility of your Ad</li>
                </ul>
                <p>Please don\'t!</p>
                <ul>
                <li>Post fake listings or fake photos - such a profiles will be deactivated</li>
                <li>Use ALL CAPS, it looks CHEAP</li>
                <li>Use names, which are not related with regular names (Delhi Escort, Escorts India, Call me, Hyderabad hot girl, Sex66, A1, etc…). Use a regular names as an escort name (Sara, Rebecca, Tina, etc...)</li>
                <li>Upload hardcore pictures</li>
                </ul>'
            ],
            [
                'question' => 'How are Ads sorted?',
                'answer' => '<p>Ads at each location except home page are published in this order:<br>
                <br>
                1. Ads TOP VERIFIED - Ads rotates in 10min interval<br>
                2. Ads TOP UNVERIFIED - Ads rotates in 10min interval<br>
                3. Ads NEW VERIFIED<br>
                4. Ads VERIFIED which logged within last 30 days<br>
                5. Ads VERIFIED<br>
                6. Ads NEW UNVERIFIED<br>
                7. Ads UNVERIFIED which logged within last 30 days<br>
                8. Ads UNVERIFIED<br>
                9. Ads AD OLDER THAN 10 MONTHS</p>
                <p>On home page are Ads with VIP status only and they change randomly with each page refresh.</p>'
            ],
            [
                'question' => 'Ad approval with your website URL address',
                'answer' => '<p>To approve your account with your own website URL address, we require you to place our banner on your home page. If you would have difficulties to add our banner, please contact our support.<br>
                <br>
                You can find the banner codes on <a href="https://www.eurogirlsescort.com/free-advertising/" target="_blank">https://www.eurogirlsescort.com/free-advertising/</a></p>'
            ],
            [
                'question' => 'Do I need to have my own website to advertise?',
                'answer' => '<p>Independent escort providers do not have to have their own website to advertise on our directory. Agency should provide an agency website. Agency without URL website looks untrusted and in this case, we require at least 3 verified girls to activate such an account.</p>'
            ],
            [
                'question' => 'It says that my account is active (green mark), but I cannot see it online. Why?',
                'answer' => '<p>If you have a green mark on your profile it always means your Ad is online and visible. If you still don´t see your profile, kindly check following:</p>
                <ul>
                <li>if you block the country in your settings, it means that your Ad isn’t visible in this country or for customers with its IP address. You can change the settings in "edit profile" section.</li>
                <li>If you have active tour, then your profile does not appear in home location</li>
                <li>If you have set Gender male or trans, then profile does not appear on the left side menu with countries, however in boys / trans category</li>
                </ul>'
            ],
            [
                'question' => 'What does Verified sign mean?',
                'answer' => '<p>You can verify your Ad by sending us the verification photo with all requirements. Verified Ad reaches better visibility (it is always published before unverified Ads). Verification also increases the credibility of your Ad too.<br>
                <br>
                To verify your profile, please log in and click on a blue button "Verify me" and follow the instructions. Verification is reviewed within max 48 hours.</p>'
            ],
            [
                'question' => 'What does Unverified sign mean?',
                'answer' => '<p>It means that we are not able to confirm the authenticity of the Ad because verification was not provided. Unverified Ads are less popular and appear under verified Ads.</p>'
            ],
            [
                'question' => 'What does TOP status mean?',
                'answer' => '<p>- If you want to be on the TOP positions in the city, country, tours, pornstar, video pages, etc you have to activate TOP status (40 Gold). Please, be aware that verified profiles with active TOP status are published above unverified profiles with TOP status. We recommend this option if you mainly provide services in your city and country.<br>
                <br>
                - TOP status costs 40 GOLD coins/month, which is approximately 8€. Payment is one time, we do not have recurring payments.<br>
                The minimum amount to recharge your account is with 20€ = 100 GOLD coins.</p>'
            ],
            [
                'question' => 'What does VIP status mean?',
                'answer' => '<p>- With VIP status your profile appears on the homepage (the most visited page) www.eurogirlsescort.com + your location but not on the TOP positions. We recommend this option if you are an international companion and you travel abroad.<br>
                <br>
                - VIP status costs 250 GOLD coins / month, which is approximately 50€. Payment is one time, we do not have recurring payments.<br>
                <br>
                - VIP status will bring you at least 10 times bigger traffic
                <br><br>
                - When visitors use any filters on home page, VIP profiles are ranked as first based on their requirements
                </p>'
            ],
            [
                'question' => 'How can I charge my account with GOLD coins?',
                'answer' => '<p>- you can charge it with your payment card. That is the easiest and quickest way. Please, log in to your account and click on a yellow button TOP or red button VIP and follow instructions. In case you do not have or cannot use your payment card, you can also recharge your account via bank transfer. In this case please, contact us via email <a href="mailto:info@eurogirlsescort.com">info@eurogirlsescort.com</a> and let us know your country of residence.<br>
                <br>
                - accepted payment methods are online with a payment card (recharged immediately) and via bank transfer (recharged within approx 2 - 5 working days)</p>'
            ],
            [
                'question' => 'Can I pause premium advertising (TOP / VIP status)?',
                'answer' => '<p>- TOP and VIP status is always paid for a minimum of 30 days. You can pause it only in case you unpublish your Ad with the Deactivate button on your account.</p>
                <p>- It is also paused in case your account is deactivated by administrator or Ad is in approval mode.</p>'
            ],
            [
                'question' => 'What to do if the payment is declined?',
                'answer' => '<p>- please, first check out, why the payment was declined. You will find this information in your account - Account settings/payment overview. There is a question mark, which shows you the declined problem. If you have any further questions or need help, please contact our helpdesk on <a href="mailto:info@eurogirlsescort.com">info@eurogirlsescort.com</a>.</p>
                <p>- sometimes also helps, if you try different browser. Especially if you have any plugin installed in your browser, which automatically deletes cookies, then payment will be declined</p>'
            ],
            [
                'question' => 'How can I buy a paid banner on your directory?',
                'answer' => '<p>- if you are interested in any of the paid banners in our directory, please, contact our helpdesk on <a href="mailto:info@eurogirlsescort.com">info@eurogirlsescort.com</a>. Banners can be purchased for a minimum of 1 month and longer. Accepted payment method is online with your payment card or via bank transfer.</p>'
            ],
            [
                'question' => 'Can I have Ad published in two or more cities?',
                'answer' => '<p>- 1 Ad is published only at 1 location at a time. We can make an exception and approve more Ads in case all Ads have active premium advertising (TOP or VIP status).<br>
                <br>
                - if you are an independent escort provider and you want to have more than 1 Ad published, you need to register a new account with a unique email address. If you decide on this solution please, activate premium advertising on both accounts and then contact us via <a href="mailto:info@eurogirlsescort.com">info@eurogirlsescort.com</a> to approve them.<br>
                <br>
                - if you are an agency/club and you want to have duplicate Ads on your account, you have to activate TOP or VIP status on them. There is no need to register a new agency/club account. If you decide on this solution please, please, activate premium advertising on both profiles straight after you upload them, so they both are approved.</p>'
            ],
            [
                'question' => 'I forgot password. How can I reset my password?',
                'answer' => '<p>- you can reset your password any time via <a href="https://www.eurogirlsescort.com/user/remind-password/" target="_blank">https://www.eurogirlsescort.com/user/remind-password/</a></p>'
            ],
            [
                'question' => 'How can clients contact me?',
                'answer' => '<p>- clients can contact you via a Contact form on your Ad (the message goes directly to your registered email) or they can contact you on the phone nr you published on your Ad.</p>'
            ],
            [
                'question' => 'I made some changes, why is my profile not active now?',
                'answer' => '<p>- if you make any changes in your account (photos, description, services, etc...) your listing goes to the pending mode and has to be approved by our administrator. Usually, it takes a few hours before your profile is reviewed but a maximum of 48 hours.</p>'
            ],
            [
                'question' => 'Can I disable reviews on my Ad?',
                'answer' => '<p>- it is not possible to disable this function, it is always enabled. You can always post a reply to each review.</p>'
            ],
            [
                'question' => 'We are escort directory only, not an agency',
                'answer' => '<p>- we are an escort directory (an advertising platform), not an escort agency. We do not arrange meetings between the Advertisers and clients!<br>
                <br>
                - if you want to work as an independent escort and manage your clients yourself, please register an account as "Independent escort" and start to advertise.</p>'
            ],
            [
                'question' => 'Can I use fake photos in my Ad (I do not want to show myself)?',
                'answer' => '<p>- it is not allowed for users to upload fake pictures. If we find such Ad, the whole account will be deactivated immediately. If this account has "GOLD", active TOP or VIP status money will not be refunded. Users can provide verification photos to prove that profile is real. Verification photo requirements are stated in each user account. Verification photo is for internal use only and it will never be published.<br>
                <br>
                - to keep your privacy, you can blur face or crop head on your profile photos, however, it is required that it is you on the photos</p>'
            ],
            [
                'question' => 'Do you travel to different cities? When should I set a city tour?',
                'answer' => '<p>- in this case, you can simply change the location of your Ad at the Edit profile section. We recommend this in case you change the location for a longer time.<br>
                <br>
                - if you travel somewhere for a shorter period (days or weeks), then we recommend setting a tour. Tours can be easily set in your account. You choose dates and location.<br>
                <br>
                - 2 weeks prior the tour your Ad is published at your original location and your Tour location at the same time.<br>
                <br>
                - during the tour dates your Ad is published only at your Tour location and once your Tour is finished, it is automatically published again at your original location.</p>'
            ],
            [
                'question' => 'Untrusted agency / club',
                'answer' => '<p>- in case the agency does not have its own agency website or we receive many fake reports, we always ask to verify 3 to 5 profiles to activate such an account.</p>'
            ],
            [
                'question' => 'Phishing attacks',
                'answer' => '<p>- please, be aware that there are many hackers online who can try to get your data. Please, never log in via unknown or weird links you receive in SMS, Whatsapp or any other way. Hackers usually use our logo and similar urls and pretend to be from our team. It´s called phishing attack. All big companies todays face such an attacks from time to time. We always communicate with our clients ONLY via email <a href="mailto:info@eurogirlsescort.com">info@eurogirlsescort.com</a>. In case you receive any suspicious message, please, contact us first to make sure if it is real or it is some scam.</p>'
            ],
        ];

        $members_and_visitor_faqs = [
            [
                'question' => 'Why create a Member account?',
                'answer' => '<p>With a Member account you will be able to:</p>
                <ul>
                <li>manage favourite Ads</li>
                <li>add reviews</li>
                <li>add agency and independent profiles to a blacklist</li>
                <li>receive a regular newsletter with new Ads in your city</li>
                </ul>
                <p>To register Member account is free. We don\'t charge any fees.</p>'
            ],
            [
                'question' => 'What does “Verified” sign mean?',
                'answer' => '<p>We as the administrator do verify profiles. Each advertiser on our website has a "verification" option in the account. To get verification they need to send a verification photo based on our requirements. Verification status on profile confirms the authenticity of the pictures. We recommend book verified escorts.<br>
                <br>
                However, please be aware that the Euro Girls Escort directory cannot and does not make any guarantees or warranties that the advertiser in the photos on any particular ad will be the same individual who shows up for any date arranged between an advertiser and a customer.</p>'
            ],
            [
                'question' => 'What does “Unverified” sign mean?',
                'answer' => '<p>Unverified sign means that the Advertiser did not provide the verification and we cannot confirm the authenticity of this Ad. It could be a real girl, however also fake or scam Ad. In case of fake or scam kindly contact us and provide url of the Ad on <a href="mailto:info@eurogirlsescort.com">info@eurogirlsescort.com</a> or report Ad as fake.</p>'
            ],
            [
                'question' => 'What does “New” sign mean?',
                'answer' => '<p>Sign New is on Ad which was created within the last 30 days.</p>'
            ],
            [
                'question' => 'What does “Ad older than 10 months” sign mean?',
                'answer' => '<p>This means that the Ad was not updated within the last 10 months. It is very likely, that Advert is not actual.</p>'
            ],
            [
                'question' => 'What does VIP and TOP sign means?',
                'answer' => '<p>This means that the Ad has active premium advertising.</p>'
            ],
            [
                'question' => 'What does "Independent" sign mean?',
                'answer' => '<p>This means that this Advertiser works alone, not under any agency.</p>'
            ],
            [
                'question' => 'Who is published on Porn stars page?',
                'answer' => '<p>Only porn actresses and actors from the porn industry or models experienced in erotic clips are published on this page. This is your chance to make your dreams come true and meet your favorite pornstar!</p>'
            ],
            [
                'question' => 'How can I contact an escort?',
                'answer' => '<p>- on each Ad, you can find “Contact this escort”. After clicking on this button you fill up your name, email address and your message. This message will be delivered directly to the advertiser\'s email address and they will reply to your email.</p>
                <p>- on Ads, you can also find telephone nr and website via which you can also contact the advertiser.</p>'
            ],
            [
                'question' => 'Do you arrange meetings with Escorts?',
                'answer' => '<p>We are an escort directory (an advertising platform), not an escort agency. If you want to book the girl, it is necessary to contact her directly. You can find a contact form on her or escort agency profiles.</p>
                <p>We don\'t arrange meetings between the girls and clients! We are the escort directory website only.</p>'
            ],
            [
                'question' => 'Who can advertise in our directory?',
                'answer' => '<p>Only independent escort providers, agencies and clubs can advertise on our directory. You can find here Ads of female escort providers but we also have a special section for male and trans escort providers.</p>'
            ],
            [
                'question' => 'Why is my city / country not listed in your menu?',
                'answer' => '<p>If you cannot find your city or country listed in our menu, it is because there are no active Ads at this moment.</p>'
            ],
            [
                'question' => 'What if I find out that the Ad is scam / fake?',
                'answer' => '<p>In this case, please go to the Ad, click on “Report fake” button and send a message explaining why this Ad is fake / scam.</p>'
            ],
            [
                'question' => 'How do I recognise SCAM?',
                'answer' => '<p>On our website, there are more than 80 000 Ads. We have many control systems, however to reveal scams is always a difficult task, because the Ads look like a regular Ads. All huge escort websites struggle with scams. In the most problematic countries, we require verification before we publish the Ad.<br>
                <br>
                Generally, we recommend to never send money in advance especially if the advertisers ask to pay with any kind of gift card such as Bing card, NEOSURF coupons, PCS coupons, Google play card, Western Union etc. You can find scammers everywhere. If you will send money in advance, it is always your risk and nobody can guarantee the service. We do recommend paying directly by cash at the beginning of the meeting.<br>
                <br>
                If you already made a payment and the Advertiser does not respond, please, send a fake report from the profile, so we can delete and block this user. In case you paid with your payment card, please do chargeback or complaint to the bank. We are an advertising platform and we are not able to help further with this issue.<br>
                <br>
                We do recommend booking verified escorts because the chance to be a scam is very minimal.</p>'
            ],
        ];

        foreach ($escort_faqs as $faq) {
            \DB::table('faqs')->insert([
                'question' => $faq['question'],
                'answer' => $faq['answer'],
                'type' => config('constants.faq_type.key.escort'),
                'created_at' => $date_now,
                'updated_at' => $date_now,
            ]);
        }

        foreach ($members_and_visitor_faqs as $faq) {
            \DB::table('faqs')->insert([
                'question' => $faq['question'],
                'answer' => $faq['answer'],
                'type' => config('constants.faq_type.key.members'),
                'created_at' => $date_now,
                'updated_at' => $date_now,
            ]);
        }
    }
}
