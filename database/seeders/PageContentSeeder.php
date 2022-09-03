<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PageContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \DB::table('page_contents')->truncate();
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        \DB::table('page_contents')->insert([
            [
                'id' => config('constants.pages_content_key.about'),
                'title' => 'ABOUT',
                'content' => '<p>Euro Girls Escort is the most trusted European escort directory and one of the biggest escort directories in Europe. Our catalogue features luxury companions, girl, boy and trans (shemale) sex escorts, <a href="/independent/">independent escort</a> services, elite <a href="/agency/">escort agencies directory</a>, brothels, cabarets and <a href="/clubs/">strip clubs</a> – they all are checked on regular basis and updated with real photos (no fake photos!). The escort service Reviews page summarizes our clients‘ experience with individual escorts and therefore might help you choose the best match for you. Find the best girl according to <a href="/escort-reviews">escort review</a> page! Problematic girls or customers are listed in the <a href="/black-list/">Black List</a> section. Euro Girls Escort is a girls‘ escort directory and Europe escort index. There are a large number of models in our escort list to choose from.</p>
                <p>Our goal is to become one of the biggest and most trusted worldwide escort directories regarding escort listings. Euro Girls Escort is popular escort directory in general due to regular updates of new escort ladies and 100% genuine photos.This catalogue features <a href="/girl/">luxury companions</a> providing escort services all over Europe. Most high class ladies travel worldwide. You may also want to use call girl services – these girls can either work incall or outcall. Such elite escorts may be invited to a hotel room or you can visit them in their place. There are many escort girls in our catalogue ranging from blondes and gingers to brunettes. You can choose busty blonde escorts or offering a wide range of sex services (french kissing, oral without condom, cum in mounth, cum in face, GFE girlfriend experience, classic sex, anal, etc). Bbw escort London belongs between of the favorite adult escort services.</p>
                <p>Should you prefer independent high class ladies for escort, you can easily choose from the <a href="/independent/">independent section</a> of the escort index. One of the most popular services is the full service that offers anal+cim. Are you an adult movie lover? Do you like asian pornstars or do you prefere to choose from <a href="http://www.eurogirlsescort.com/escort-pornstar/">pornstar escorts</a> section? Well this is the right place for you! The catalogue also features <a href="/escort-pornstar/">adult film star escorts</a> with both big and small boobs and nice tight asses. Most of these escorting pornstars have silicon breasts. If you prefer natural beauty, you are advised to search among model escorts. The VIP companions are gorgeous and sophisticated ladies who know exactly how to please particular clients. These hottest girls can be booked worldwide. You can choose from the top escort galleries.</p>
                <p>The most popular escort hire destinations are the biggest europe cities. For a shorter adult meeting there is a very popular service arranged – <a href="escort-tours/">escort tours</a>. The escort girls come from different countries to one city where hotel for incall is arranged. This way you can meet your favorite pornstar in your home city. The choice is endless – you may want to hire a female escort or a male escort for massages or for a dinner date. You can also get erotic models, strippers, erotic dancers and other adult entertainers. Dating escort services are here for you. Cute incall and outcall babes are looking forward to meeting you. It´s that simple – just find your preferred and sexiest escort in the Euro Girls Escort directory.</p>
                <p>Are you looking for escort service jobs? You are on the right place! Do you know how to register and advertise as an escort or as an independent subject? How to advertise as an escort agency or a strip club/cabaret? It´s very simple. If you´d like to <a href="http://www.eurogirlsescort.com/free-advertising/">advertise</a> in Euro Girls Escort directory just select Your Account and <a href="/free-advertising/">register</a>. Then enter all required data and upload escort photos and you´re done! We will check your entry and if everything is ok, your escort Ads will be approved. Of course there are many international escort directories listing adult entertainment. The important question is also how and where can I be listed as an escort or a companion? Being one of the most comprehensive escort directories worldwide with lots of experience, we do recommend you to register at the <a href="http://www.worldescortindex.com">escort directory</a> with lots of traffic. Only then you can attract prospective customers. Euro Girls Escort directory is very popular in countries all over Europe, particularly in Germany, Sweden, France, Great Britain, Italy, Switzerland, Spain and Netherlands - many clients from these locations prefer to use our high class escort service website to search adult content.</p>
                <p>We welcome you to try the recent safest closest thing to real-life sex with an escort by using our <a class="link js-stt-click" data-type="banner" data-id="1950" target="_blank" href="https://www.vrcams.io/">VR chat cams</a> and VR strip webcams. At vrcams.io we have live girls in virtual reality on-camera streaming and chatting now - real-life porn straight to your virtual reality headset. It\'s an amazingly clear picture as if you are at the scene. Try our live VR cam girls today free.</p>
                <p>Because we offer a quality selection, we present the best companions around the world, including verified <a class="link js-stt-click" data-type="banner" data-id="415" target="_blank" href="https://fantasyescortsbirmingham.co.uk/">escorts from the UK</a> ( Birmingham, Leicester, Nottingham or other cities) and other territories. With our help, you are sure to enjoy the most memorable moments and the most professional companions. No matter if you want great fun in the Great Britain or another country, many of these VIP girls are ready for booking 24 hours a day, 7 days a week, to fulfill your fantasy. It is a certainty that when you need an experienced agency or a high-class escort, here is the right place to find what you are looking for.</p>
                <p>Escorts in Amsterdam are already very popular because is an apart Escort Service Amsterdam that provides more than just pretty faces and quick regular service! With this agency, you will experience what true Premium Escort Service means! Model-style girls are both beautiful and intelligent, allowing clients to make a deep connection with them that intensifies their pleasurable experience through a v.i.p hotel escort service Amsterdam. <a class="link js-stt-click" data-type="banner" data-id="807" target="_blank" href="https://www.beautyescortsamsterdam.com/">Escorts Amsterdam</a> offers one in a lifetime kind of experience for gentlemen and couples and you will always come back for more!</p>
                <p>Everything in this world is supply and demand as <a class="link js-stt-click" data-type="banner" data-id="2965" target="_blank" href="https://www.divasamsterdam.com/">Divas Escorts Amsterdam</a> knows well. Whoever would like to enlist the services of an Escort Amsterdam would be wise to give us a call, seeing that our escort agency has some of the best pussies in The Netherlands. Clients love the pussy Escorts Amsterdam offer but also fall head over heels over the premium escort service they get as standard with our call girls escort. We especially cater to connoisseurs and sex fiends who just cannot get enough pussy from stunning escort girls. Divas Agency offers the best escort service in Amsterdam 24/7.</p>',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => config('constants.pages_content_key.policy_conditions'),
                'title' => 'TERMS & PRIVACY',
                'content' => '<h2>Terms &amp; Conditions - GENERAL</h2>
                <p>Please read these terms and conditions carefully before using this website. Accepting these conditions signifies that you have read, and understand these conditions, without reservation If you do not agree to these terms or do not understand what this means, leave now. These terms and conditions are applicable to all pages of www.eurogirlsescort.com</p>
                <h3>Introduction</h3>
                <p>We are not an escort agency, but an escorts advertising platform dedicated to both escort agencies and independent models. By accessing or using the Site in any manner, including, but not limited to, visiting or browsing the Site or contributing content or other materials to the Site, you agree to be bound by these Terms and Conditions. Capitalized terms are defined in this Agreement.</p>
                <p><strong>By accepting Terms &amp; Conditions you also confirm that:</strong></p>
                <p>You are at least 18 years old (or of legal age in the jurisdiction in which you are currently located), have the legal right to possess and/or read adult material in your community and will not permit any minor to see any materials you find here. You agree, and confirm, that your use of this website is in full compliance with the laws of the jurisdiction(s) to which you are subject, and that you are not prohibited from using this website due to any restriction, including any age restriction.</p>
                <ul>
                <li>You are aware www.eurogirlsescort.com is an adult website that may contain sexually explicit photographs, video, audio, language, and other material</li>
                <li>It is not illegal to view adult nudity or adult sexual materials in the community/locale in which you reside or your are currently located. You understand the standards and laws regarding access and use of this site and your solely responsible for your actions.</li>
                <li>You understand if you use these services in violation of this agreement, you understand that you may be in violation of local and federal laws.</li>
                <li>You discharge www.eurogirlsescort.com, its owner, and its moderators from any and all liability which might arise from your use of this site.</li>
                <li>You agree not to download, copy, save, cut and paste, sell, license, rent, lease, modify, distribute, copy, reproduce, transmit, publicly display, publicly perform, publish, adapt, edit, or create derivative works from materials, code or content on or from this site without the prior consent of the actual owner(s) of the materials.</li>
                <li>You understand that this website provides information about and links to adult entertainment providers. All personal and classified ads presented on this website are solely for informational purposes. www.eurogirlsescort.com does not evaluate, sponsor or endorse any of the services and services providers that appear in this directory, nore is www.eurogirlsescort.com affiliated with them. www.eurogirlsescort.com therefore accepts no responsibility and does not condone or participate in any form of immoral or illegal activities. If you find that any site listed in our directory does not provide healthy, safe or lawful services, please notify us immediate via email at info@eurogirlsescort.com</li>
                <li>You will not attempt to bypass any security of www.eurogirlsescort.com. Accessing the site constitute an implicit acceptance of the foregoing terms of use.</li>
                <li>www.eurogirlsescort.com can revise these terms and conditions at any time. Please read these Terms &amp; Conditions any time you visit our website, since the terms and conditions are subject to change and are binding to you.</li>
                <li>You confirm you have carefully read all of the above terms and conditions.</li>
                </ul>
                <h3>TERMS AND CONDITIONS - CREDIT CARD PAYMENTS</h3>
                <ol>
                <li>General:
                <ol>
                <li>These terms and conditions apply to all credit card payments made to www.eurogirlsescort.com.</li>
                <li>By making a credit card payment to www.eurogirlsescort.com, or by requesting Electronic Communications, you accept these terms and conditions.</li>
                <li>www.eurogirlsescort.com may amend these terms and conditions at any time by posting the amendment on its website at least 30 days prior to the effective date of change.</li>
                </ol>
                </li>
                <li>Authorization<br>
                By entering your credit card information:
                <ol>
                <li>You are stating that you are an authorized user of the credit card and that the associated information entered (account holder name, account number, billing address, etc.) is accurate.</li>
                <li>You authorize www.eurogirlsescort.com to charge the amount you have requested to your credit card.</li>
                </ol>
                </li>
                <li>Confirmation of Payment:
                <ol>
                <li>By clicking “Submit,” you are consenting to receive a one-time confirmation of this payment electronically to the email address you have provided to us.</li>
                </ol>
                </li>
                </ol>
                <h3>Acceptable use</h3>
                <p>You must not use our Website in any way that causes, or may cause, damage to the Website or impairment of the availability or accessibility of the Website; or in any way which is unlawful, illegal, fraudulent or harmful, or in connection with any unlawful, illegal, fraudulent or harmful purpose or activity.</p>
                <p>You must not use our Website to copy, store, host, transmit, send, use, publish or distribute any material which consists of (or is linked to) any spyware, computer virus, Trojan horse, worm, keystroke logger, rootkit or other malicious computer software.</p>
                <p>You must not conduct any systematic or automated data collection activities (including, without limitation, scraping, data mining, data extraction and data harvesting) on or in relation to our Website without our express written consent.</p>
                <p>You must not use our Website to transmit or send unsolicited commercial communications.</p>
                <p>You must not use our Website for any purposes related to marketing without our express written consent.</p>
                <h3>Users / Escorts</h3>
                <p>The photos and text of advertisers (“users”, “models”) published at Euro Girls Escort are provided by the users who are registered members of the Website, and who are responsible for the content of the advertisement, including the photos and the text.</p>
                <p>Is not allowed to the users upload fake pictures. If we find such a profiles the whole account will be deleted immediately. If such an account has "Gold", active TOP or VIP status the amount won´t be refunded. Users can provide verification picture to proof that profile is real. Verification photo requirements are stated in each user account. The verification photo is for internal use only and it will never be published. For untrusted agencies / clubs, we have require at least 5 profiles to be verified to activate the account. If gold coins are purchased and this condition is not met, the user is not entitled to a refund.</p>
                <p>Is not allowed to users of www.eurogirlsescort.com upload any content showing genitals. Such a pictures will be immediatelly deleted or blurred.</p>
                <p>All models on this Website are over the age of +18 years.</p>
                <p>We accept only members, independent escort providers, escort agencies and strip clubs on the Website. Escort directories are not allowed to register any kind of profiles. If we find profiles that link to such sites, we delete them without any notification. We also don´t accept registration of porn sites, cam sites, dating sites or any similar adult sites.</p>
                <p>Our company will manually review each post and pictures before it goes LIVE online. If we determine that age of the model/escort is in question, we may ask for ID and age verification and we reserve the right to refuse to post if image does not fall into good business practices.&nbsp;All fraudulent ads will be deleted without notice.</p>
                <p>To delete and upload the same girls, create duplicated profiles or delete whole account and create new one for reason to reach TOP positions on the site is strictly prohibited. If we find such a advertisers doing this we delete them from our directory. The allowed way how to move profiles to the TOP of sections is to use "TOP 40 Gold" service in the account of advertisers.</p>
                <p>Agency or Club can upload unlimited amount of escorts but escorts must be unique. Is not allowed to upload one girl more times. Such a profiles will be immediately deleted and if the user won´t respect our rules will be blocked.</p>
                <p>Takedown policy - each advert has "report fake" button. If you think profile use fake photos, advert is fraudlent, content infrigments copyright, etc then use this button. We deal with each report within 7 business days, however usually it is much sooner.</p>
                <h3>Verified escorts</h3>
                <p>We as the administrator do verify profiles. These profiles have VERIFIED status (in blue). Each girl who advertise on our site has "verification" option in the account. We require verification pictures or face + ID picture as proof that profile is real. If the girl sends required verification pictures we give "verified" status.</p>
                <p>However, please be aware that the Euro Girls Escort cannot and does not make any guarantees or warranties that either the advertiser in the pictures on any particular ad will be the same individual who shows up for any date arranged between an advertiser and yourself.</p>
                <p><strong>2257 US</strong><br>
                Please read our <a href="https://www.eurogirlsescort.com/18-u-s-c-2257/">2257 Compliance Statement here</a>.<br>
                <br>
                <br>
                <strong>Report Trafficking</strong><br>
                <br>
                Euro Girls Escort is wholly committed to raising awareness on the issue of human trafficking and engages in best practices and advocacy. In the event we become aware of any incident of trafficking, we cooperate enthusiastically with law enforcement and agencies involved in combating the abuse of human rights.&nbsp;Euro Girls Escort has a zero tolerance policy for child pornography or minors advertising or utilizing our site.&nbsp;<br>
                <br>
                Please report any suspected sexual exploitation of minors and/or human trafficking to the appropriate authorities.<br>
                <br>
                United States:<br>
                National Center for Missing &amp; Exploited Children (NCMEC)<br>
                CyberTipline - report child exploitation<br>
                24-Hour Hotline: 1-800-843-5678<br>
                <br>
                Polaris Project - Report Human Trafficking: 888-373-7888<br>
                Dept. of Health &amp; Human Services: 888-373-7888<br>
                Children of the Night: 800-551-1300<br>
                ACE National: 202-220-3019<br>
                Homeland Security Investigations Tip Line: 866-DHS-2-ICE<br>
                Dept. of Justice: 888-428-7581<br>
                FBI Office: http://www.fbi.gov/contact-us/field<br>
                <br>
                Germany:<br>
                YPA Agent - Jugendschutzbeauftragter: Rechtsanwalt Dr. Daniel Kötz<br>
                <br>
                United Kingdom -&nbsp;Modern Slavery Helpline:<br>
                Anyone who is concerned that someone may be a victim of trafficking or has information about trafficking should report it to their local police on 101 or confidentially to the Modern Slavery Helpline on 08000&nbsp;121&nbsp;700 or Crime stoppers. In an emergency, always call 999.</p>
                <p><strong>WARNING SIGNS OF POSSIBLE HUMAN TRAFFICKING:</strong></p>
                <ul>
                <li>Does an entertainer arrive accompanied by another individual?</li>
                <li>Does that individual speak for or appear to maintain control over the entertainer?</li>
                <li>Does the entertainer seem fearful of that individual?</li>
                <li>Does the entertainer have difficulty communicating, whether resulting from a language barrier or fear of interaction?</li>
                </ul>
                <p>While one of these signs, on its own, may not present a trafficking concern, multiple signs indicate a potential red flag. Use common sense, and contact the appropriate authorities if you suspect that someone is being trafficked.</p>
                <h3>User content</h3>
                <p>In these terms of use, "your content" means material (including, without limitation, text, images, audio material, video material and audio-visual material) that you submit to our Website, for whatever purpose.</p>
                <p>You grant to us a worldwide, irrevocable, non-exclusive, royalty-free license to use, reproduce, adapt, publish, translate and distribute your content in any existing or future media. You also grant to us the right to sub-license these rights and the right to bring an action for infringement of these rights.</p>
                <p>You warrant and represent that your content will comply with these terms of use.</p>
                <p>Your content must not be illegal or unlawful, must not infringe any third party\'s legal rights and must not be capable of giving rise to legal action whether against you or us or a third party (in each case under any applicable law).</p>
                <p>You must not submit any content to the Website that is or has ever been the subject of any threatened or actual legal proceedings or other similar complaint.</p>
                <p>You must not submit any photos to the Website that have text links, logos, phone numbers or e-mails on them. We remove such images without notification.</p>
                <p>We reserve the right to edit or remove any material submitted to our Website, or stored on our servers, or hosted or published upon our Website.</p>
                <p>Content monitoring - All content submitted by users is reviewed&nbsp;by our content management team within 48 hours.&nbsp;&nbsp;</p>
                <h3>Free Advertisement</h3>
                <p>To approve listing at Euro Girls Escort directory we require to place Euro Girls Escort banner or text link at your home page on visible position. We usually accept first 3 positions. Backlink has to be with "do follow" atribut. If we find out that Euro Girls Escort backlink was removed we will automatically deactivate your account. Please take care that we have a banner detection system which regularly check whether our backlink is still on your site.</p>
                <h3>Paid Advertisement</h3>
                <p>The users may purchase banner or VIP and TOP ads for advertising purposes. The cost of purchasing can vary according to the product, country, banner size and period of time. Payment options can be found on the advertising page. We need up to 48 hours to active any advertisement after we’ve received the payment.</p>
                <p>Because external links are not owned and controlled by www.eurogirlsescort.com, we strongly advise you to read the terms and conditions and privacy policy of any third-party Site that you visit.</p>
                <p>Amount of Gold coins which can be purchased. All payments below are one time payment (no recurring):<br>
                20€ = 100 Gold coins<br>
                50€ = 250 Gold coins<br>
                90€ = 500 Gold coins<br>
                140€ = 750 Gold coins<br>
                170€ = 1000 Gold coins<br>
                320€ = 2000 Gold coins</p>
                <h3>Refund policy</h3>
                <p>We want to keep our users satisfied by providing the best service, so we created a special refund policy in this area. The users may ask for a refund in 72 hours after the purchase was done. We can only reward a refund if they provide us a valid reason why the purchase was fraudulent or unauthorized, or for any other reason that we’ve found appropriate. If the payment was made with cryptocurrencies, a refund is only possible by bank transfer in FIAT currencies. Contact us at info@eurogirlsescort.com</p>
                <h3>Termination</h3>
                <p>We may terminate your access to the Site, without cause or notice, which may result in the forfeiture and destruction of all information associated with you. All provisions of this Agreement that by their nature should survive termination shall survive termination, including, without limitation, ownership provisions, warranty disclaimers, indemnity, and limitations of liability.</p>
                <h3>Merchant</h3>
                <p>Eurogirlsescort.com is the registered merchant based in Czech Republic.<br>
                Web No Limit s.r.o., Korunní 588/4, Prague, CZ, 12000.</p>
                <p>Governing Law. These terms shall be governed by, and interpreted in accordance with, the laws of the Czech Republic.</p>
                <h3>Liability</h3>
                <p>The operators of the website do not control, supervise, verify, investigate or authenticate any of the content, communications or representations by any third party Sites, so we strongly advise you to read the terms and conditions and privacy policy of any third-party Site that you visit. We do monitor and verify all the user’s and advertiser’s posts, however we are not liable for the content, communications or representations posted by users or advertisers of the Website.</p>
                <h3>Privacy Policy</h3>
                <p>Your privacy is very important for us. We offer maximal discretion to all our clients and users. We do not collect personal information to trade, sell or give away in any way.</p>
                <p>We have committed ourselves to protecting your privacy. We use the information gathered to enable your account and to enhance your online experience. Please read on for more details about our privacy policy. www.eurogirlsescort.com will not sell its database of customer details or details about customers to a third party. Any and all the information collected on this website will be kept strictly confidential and will not be sold, reused, rented, disclosed, or loaned! We respect the right of users to remain anonymous and will endeavour not to knowingly disclose user identities unless directed by a court of law.</p>
                <p>When you place an order through this website, we need to know your name, e-mail, phone number, address and credit card details if paying by credit card. This allows us to process and fulfil your order</p>
                <p>When you place orders, we use a secure server. The secure server software (SSL) encrypts all information you input before it is sent to us. Furthermore, several layers of encryption and several layers of security to prevent unauthorised access protect all of the sensitive customer data we collect.</p>
                <p>All credit card payments are processed securely through <em>payment providers</em>. Payment by credit card is the fastest way to receive your order, as there is not clearance delay. www.eurogirlsescort.com does not store any credit card information on our servers.</p>
                <p>By using our website, you consent to the collection and use of this information by www.eurogirlsescort.com . If we decide to change our privacy policy, we will post those changes on this page so that you are always aware of what information we collect, how we use it, and under what circumstances we disclose it.</p>
                <h3>Changes To This Agreement</h3>
                <p>We reserve the right, at our sole discretion, to modify or replace these Terms and Conditions by posting the updated terms on the Site. Your continued use of the Site after any such changes constitutes your acceptance of the new Terms and Conditions.<br>
                Please review this Agreement periodically for changes. If you do not agree to any of this Agreement or any changes to this Agreement, do not use, access or continue to access the Site or discontinue any use of the Site immediately.</p>
                <h3>Affiliate program Agreement</h3>
                <p>In this agreement (the "Agreement"), the terms "Participant", "you" and "your" refer to you (the applicant), and the "Sponsoring Website" refers to the website from which users will link to Euro Girls Escort pursuant to the Affiliate Program which has been disclosed to and approved by us. Participant herein shall refer to the Participant and any of its affiliates, publishers, or members of it network. You shall be fully responsible and liable for the actions of your affiliates, publishers, and members of your network, and any services or actions provided through an affiliate, publisher, or member of your network shall be subject to and governed as if provided directly by You. In this regard, We can enforce all remedial measures available under this Agreement, and at law, for breaches of the Agreement by Participant or its affiliates/publishers directly against the Participant.</p>
                <p>We use 75 percent - The Affiliate Program which has following conditions:</p>
                <ul>
                <li>75% commission - for every sale you refer: paid memberships and advertising</li>
                <li>360 days cookies - 75 percent commission even if a free member you have referred to us buys a paid membership or advertising several months later</li>
                <li>75 percent - for all membership renewals and consecutive advertising sales within 360 days</li>
                <li>Monthly Payout - via Bank wire transfer - last Wednesday in the month</li>
                </ul>
                <p>You need to have a bank account. Payout via Bank wire transfer is fully automated every last Wednesday in the month with minimum balance 200€.</p>
                <p>Chargebacks and fees - if Advertiser of Euro Girls Escort make chargeback and has been brought to Euro Girls Escort by our affiliate then affiliate´s payout for next month will be reduced with this chargeback amount. Payout ammount is also reduced with Bank wire transfer fee.</p>
                <p>Each affiliate must provide an URL address which they are sending the traffic from. The URL address is subject to approval. We don’t accept websites which are not related to the adult business or websites which violate laws of our country. Independent escort providers, escort agencies and clubs are not allowed to create an affiliate account.</p>
                <h3>Cookies</h3>
                <p><strong>What are "cookies"</strong></p>
                <p>When the visitors land on the webpages of our Company, a small file, a so-called „cookie” (hereinafter as: „cookie”) is downloaded on their PC which might serve different purposes.</p>
                <p>Certain "cookies" that we use are indispensable for the appropriate operation of the webpage („process cookies”), others collect information related to the use of the webpage (statistics) to make the webpage more comfortable and useful. Some "cookies" are just temporary and disappear when you close the browser while there are durable versions which stay on the computer for a longer period of time.</p>
                <p><strong>The purpose of cookies</strong></p>
                <p>Collecting statistics whose analysis helps understand how visitors use further online services besides the website which we can thus further develop.</p>
                <p><strong>Cookies ensuring performance</strong></p>
                <p>The cookies ensuring performance make it possible for us to collect information concerning how visitors are using our webpage (such as which pages the visitors have viewed, how many pages they have visited, which part of the page they have clicked, how long each of the work processes were, what sort of error messages appeared, etc).</p>
                <p>This is done in order that we can further develop our webpage (available services, functions, etc) in line with our visitors’ needs and to provide a high quality, user friendly experience for them.</p>
                <p>In order to measure performance, our webpage uses third party cookies in case of each visit. By way of using the cookies we can track how many visitors are landing on the webpage and what content they are interested in. We store each piece of information anonymously so that we can guarantee high quality experience for our users.</p>
                <p>The webpage uses the analytical cookies of the following provider:</p>
                <p>Google Analytics the detailed information concerning the service is available at the following link: https://www.google.com/analytics/terms/us.html</p>
                <p><strong>Controlling cookie settings, disabling cookies</strong></p>
                <p>Modern browsers allow the modification of cookie settings. Some browsers automatically accept cookies as default setting but this setting can also be changed in order that the visitor prevents automatic acceptance for the future. In case of resetting the browser is going to offer the option of choosing the use of cookies in the future.</p>
                <p>&nbsp;</p>
                <ul>
                </ul>',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
