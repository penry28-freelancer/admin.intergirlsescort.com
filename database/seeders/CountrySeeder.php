<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $countries_1 = [
            [
                'name' => 'Albania',
                'flag_image' => 'https://www.eurogirlsescort.com/dist/flags/4x3/al.svg?v=1.1',
            ],
            [
                'name' => 'Armenia',
                'flag_image' => 'https://www.eurogirlsescort.com/dist/flags/4x3/am.svg?v=1.1'
            ],
            [
                'name' => 'Austria',
                'flag_image' => 'https://www.eurogirlsescort.com/dist/flags/4x3/at.svg?v=1.1'
            ],
            [
                'name' => 'Belarus',
                'flag_image' => 'https://www.eurogirlsescort.com/dist/flags/4x3/by.svg?v=1.1'
            ],
            [
                'name' => 'Belgium',
                'flag_image' => 'https://www.eurogirlsescort.com/dist/flags/4x3/be.svg?v=1.1'
            ],
            [
                'name' => 'Bosnia Herzegovina',
                'flag_image' => 'https://www.eurogirlsescort.com/dist/flags/4x3/ba.svg?v=1.1'
            ],
            [
                'name' => 'Bulgaria',
                'flag_image' => 'https://www.eurogirlsescort.com/dist/flags/4x3/bg.svg?v=1.1'
            ],
            [
                'name' => 'Croatia',
                'flag_image' => 'https://www.eurogirlsescort.com/dist/flags/4x3/hr.svg?v=1.1'
            ],
            [
                'name' => 'Cyprus',
                'flag_image' => 'https://www.eurogirlsescort.com/dist/flags/4x3/cy.svg?v=1.1'
            ],
            [
                'name' => 'Czech Republic',
                'flag_image' => 'https://www.eurogirlsescort.com/dist/flags/4x3/cz.svg?v=1.1'
            ],
            [
                'name' => 'Denmark',
                'flag_image' => 'https://www.eurogirlsescort.com/dist/flags/4x3/dk.svg?v=1.1'
            ],
            [
                'name' => 'Estonia',
                'flag_image' => 'https://www.eurogirlsescort.com/dist/flags/4x3/ee.svg?v=1.1'
            ],
            [
                'name' => 'Finland',
                'flag_image' => 'https://www.eurogirlsescort.com/dist/flags/4x3/fi.svg?v=1.1'
            ],
            [
                'name' => 'France',
                'flag_image' => 'https://www.eurogirlsescort.com/dist/flags/4x3/fr.svg?v=1.1'
            ],
            [
                'name' => 'Germany',
                'flag_image' => 'https://www.eurogirlsescort.com/dist/flags/4x3/de.svg?v=1.1'
            ],
            [
                'name' => 'Greece',
                'flag_image' => 'https://www.eurogirlsescort.com/dist/flags/4x3/gr.svg?v=1.1'
            ],
            [
                'name' => 'Hungary',
                'flag_image' => 'https://www.eurogirlsescort.com/dist/flags/4x3/hu.svg?v=1.1'
            ],
            [
                'name' => 'Iceland',
                'flag_image' => 'https://www.eurogirlsescort.com/dist/flags/4x3/is.svg?v=1.1'
            ],
            [
                'name' => 'Ireland',
                'flag_image' => 'https://www.eurogirlsescort.com/dist/flags/4x3/ie.svg?v=1.1'
            ],
            [
                'name' => 'Italy',
                'flag_image' => 'https://www.eurogirlsescort.com/dist/flags/4x3/it.svg?v=1.1'
            ],
            [
                'name' => 'Kosovo',
                'flag_image' => 'https://www.eurogirlsescort.com/dist/flags/4x3/xk.svg?v=1.1'
            ],
            [
                'name' => 'Latvia',
                'flag_image' => 'https://www.eurogirlsescort.com/dist/flags/4x3/lv.svg?v=1.1'
            ],
            [
                'name' => 'Liechtenstein',
                'flag_image' => 'https://www.eurogirlsescort.com/dist/flags/4x3/li.svg?v=1.1'
            ],
            [
                'name' => 'Lithuania',
                'flag_image' => 'https://www.eurogirlsescort.com/dist/flags/4x3/lt.svg?v=1.1'
            ],
            [
                'name' => 'Luxembourg',
                'flag_image' => 'https://www.eurogirlsescort.com/dist/flags/4x3/lu.svg?v=1.1'
            ],
            [
                'name' => 'Malta',
                'flag_image' => 'https://www.eurogirlsescort.com/dist/flags/4x3/mt.svg?v=1.1'
            ],
            [
                'name' => 'Moldova',
                'flag_image' => 'https://www.eurogirlsescort.com/dist/flags/4x3/md.svg?v=1.1'
            ],
            [
                'name' => 'Monaco',
                'flag_image' => 'https://www.eurogirlsescort.com/dist/flags/4x3/mc.svg?v=1.1'
            ],
            [
                'name' => 'Montenegro',
                'flag_image' => 'https://www.eurogirlsescort.com/dist/flags/4x3/me.svg?v=1.1'
            ],
            [
                'name' => 'Netherlands',
                'flag_image' => 'https://www.eurogirlsescort.com/dist/flags/4x3/nl.svg?v=1.1'
            ],
            [
                'name' => 'North Macedonia',
                'flag_image' => 'https://www.eurogirlsescort.com/dist/flags/4x3/mk.svg?v=1.1'
            ],
            [
                'name' => 'Norway',
                'flag_image' => 'https://www.eurogirlsescort.com/dist/flags/4x3/no.svg?v=1.1'
            ],
            [
                'name' => 'Poland',
                'flag_image' => 'https://www.eurogirlsescort.com/dist/flags/4x3/pl.svg?v=1.1'
            ],
            [
                'name' => 'Portugal',
                'flag_image' => 'https://www.eurogirlsescort.com/dist/flags/4x3/pt.svg?v=1.1'
            ],
            [
                'name' => 'Romania',
                'flag_image' => 'https://www.eurogirlsescort.com/dist/flags/4x3/ro.svg?v=1.1'
            ],
            [
                'name' => 'Russia',
                'flag_image' => 'https://www.eurogirlsescort.com/dist/flags/4x3/ru.svg?v=1.1'
            ],
            [
                'name' => 'Serbia',
                'flag_image' => 'https://www.eurogirlsescort.com/dist/flags/4x3/rs.svg?v=1.1'
            ],
            [
                'name' => 'Slovakia',
                'flag_image' => 'https://www.eurogirlsescort.com/dist/flags/4x3/sk.svg?v=1.1'
            ],
            [
                'name' => 'Slovenia',
                'flag_image' => 'https://www.eurogirlsescort.com/dist/flags/4x3/si.svg?v=1.1'
            ],
            [
                'name' => 'Spain',
                'flag_image' => 'https://www.eurogirlsescort.com/dist/flags/4x3/es.svg?v=1.1'
            ],
            [
                'name' => 'Sweden',
                'flag_image' => 'https://www.eurogirlsescort.com/dist/flags/4x3/se.svg?v=1.1'
            ],
            [
                'name' => 'Switzerland',
                'flag_image' => 'https://www.eurogirlsescort.com/dist/flags/4x3/ch.svg?v=1.1'
            ],
            [
                'name' => 'Turkey',
                'flag_image' => 'https://www.eurogirlsescort.com/dist/flags/4x3/tr.svg?v=1.1'
            ],
            [
                'name' => 'UK',
                'flag_image' => '	https://www.eurogirlsescort.com/dist/flags/4x3/gb.svg?v=1.1'
            ],
            [
                'name' => 'Ukraine',
                'flag_image' => '	https://www.eurogirlsescort.com/dist/flags/4x3/ua.svg?v=1.1'
            ],
        ];

        $countries_2 = [
            [
                'name' => 'Algeria',
                'flag_image' => 'https://www.eurogirlsescort.com/dist/flags/4x3/dz.svg?v=1.1'
            ],
            [
                'name' => 'Argentina',
                'flag_image' => 'https://www.eurogirlsescort.com/dist/flags/4x3/ar.svg?v=1.1'
            ],
            [
                'name' => 'Australia',
                'flag_image' => 'https://www.eurogirlsescort.com/dist/flags/4x3/au.svg?v=1.1'
            ],
            [
                'name' => 'Azerbaijan',
                'flag_image' => 'https://www.eurogirlsescort.com/dist/flags/4x3/az.svg?v=1.1'
            ],
            [
                'name' => 'Bahrain',
                'flag_image' => 'https://www.eurogirlsescort.com/dist/flags/4x3/bh.svg?v=1.1'
            ],
            [
                'name' => 'Benin',
                'flag_image' => 'https://www.eurogirlsescort.com/dist/flags/4x3/bj.svg?v=1.1'
            ],
            [
                'name' => 'Brazil',
                'flag_image' => 'https://www.eurogirlsescort.com/dist/flags/4x3/br.svg?v=1.1'
            ],
            [
                'name' => 'Burkina Faso',
                'flag_image' => 'https://www.eurogirlsescort.com/dist/flags/4x3/bf.svg?v=1.1'
            ],
            [
                'name' => 'Cambodia',
                'flag_image' => 'https://www.eurogirlsescort.com/dist/flags/4x3/kh.svg?v=1.1'
            ],
            [
                'name' => 'Cameroon',
                'flag_image' => 'https://www.eurogirlsescort.com/dist/flags/4x3/cm.svg?v=1.1'
            ],
            [
                'name' => 'Canada',
                'flag_image' => 'https://www.eurogirlsescort.com/dist/flags/4x3/ca.svg?v=1.1'
            ],
            [
                'name' => 'Caribbean',
                'flag_image' => '	https://www.eurogirlsescort.com/dist/flags-custom/carribean.svg?v=1.1'
            ],
            [
                'name' => 'Chile',
                'flag_image' => 'https://www.eurogirlsescort.com/dist/flags/4x3/cl.svg?v=1.1'
            ],
            [
                'name' => 'China',
                'flag_image' => 'https://www.eurogirlsescort.com/dist/flags/4x3/cn.svg?v=1.1'
            ],
            [
                'name' => 'Colombia',
                'flag_image' => 'https://www.eurogirlsescort.com/dist/flags/4x3/co.svg?v=1.1'
            ],
            [
                'name' => 'Costarica',
                'flag_image' => 'https://www.eurogirlsescort.com/dist/flags/4x3/cr.svg?v=1.1'
            ],
            [
                'name' => 'DR Congo',
                'flag_image' => 'https://www.eurogirlsescort.com/dist/flags/4x3/cd.svg?v=1.1'
            ],
            [
                'name' => 'Ecuador',
                'flag_image' => 'https://www.eurogirlsescort.com/dist/flags/4x3/ec.svg?v=1.1'
            ],
            [
                'name' => 'Egypt',
                'flag_image' => 'https://www.eurogirlsescort.com/dist/flags/4x3/eg.svg?v=1.1'
            ],
            [
                'name' => 'French Polynesia',
                'flag_image' => 'https://www.eurogirlsescort.com/dist/flags/4x3/pf.svg?v=1.1'
            ],
            [
                'name' => 'Georgia',
                'flag_image' => 'https://www.eurogirlsescort.com/dist/flags/4x3/ge.svg?v=1.1'
            ],
            [
                'name' => 'Ghana',
                'flag_image' => 'https://www.eurogirlsescort.com/dist/flags/4x3/gh.svg?v=1.1'
            ],
            [
                'name' => 'Guatemala',
                'flag_image' => 'https://www.eurogirlsescort.com/dist/flags/4x3/gt.svg?v=1.1'
            ],
            [
                'name' => 'India',
                'flag_image' => 'https://www.eurogirlsescort.com/dist/flags/4x3/in.svg?v=1.1'
            ],
            [
                'name' => 'Indonesia',
                'flag_image' => 'https://www.eurogirlsescort.com/dist/flags/4x3/id.svg?v=1.1'
            ],
            [
                'name' => 'Iran',
                'flag_image' => 'https://www.eurogirlsescort.com/dist/flags/4x3/ir.svg?v=1.1'
            ],
            [
                'name' => 'Israel',
                'flag_image' => 'https://www.eurogirlsescort.com/dist/flags/4x3/il.svg?v=1.1'
            ],
            [
                'name' => 'Ivory Coast',
                'flag_image' => 'https://www.eurogirlsescort.com/dist/flags/4x3/ci.svg?v=1.1'
            ],
            [
                'name' => 'Jamaica',
                'flag_image' => 'https://www.eurogirlsescort.com/dist/flags/4x3/jm.svg?v=1.1'
            ],
            [
                'name' => 'Japan',
                'flag_image' => 'https://www.eurogirlsescort.com/dist/flags/4x3/jp.svg?v=1.1'
            ],
            [
                'name' => 'Jordan',
                'flag_image' => 'https://www.eurogirlsescort.com/dist/flags/4x3/jo.svg?v=1.1'
            ],
            [
                'name' => 'Kazakhstan',
                'flag_image' => 'https://www.eurogirlsescort.com/dist/flags/4x3/kz.svg?v=1.1'
            ],
            [
                'name' => 'Kenya',
                'flag_image' => 'https://www.eurogirlsescort.com/dist/flags/4x3/ke.svg?v=1.1'
            ],
            [
                'name' => 'Kuwait',
                'flag_image' => 'https://www.eurogirlsescort.com/dist/flags/4x3/kw.svg?v=1.1'
            ],
            [
                'name' => 'Laos',
                'flag_image' => 'https://www.eurogirlsescort.com/dist/flags/4x3/la.svg?v=1.1'
            ],
            [
                'name' => 'Lebanon',
                'flag_image' => 'https://www.eurogirlsescort.com/dist/flags/4x3/lb.svg?v=1.1'
            ],
            [
                'name' => 'Malaysia',
                'flag_image' => 'https://www.eurogirlsescort.com/dist/flags/4x3/my.svg?v=1.1'
            ],
            [
                'name' => 'Mali',
                'flag_image' => 'https://www.eurogirlsescort.com/dist/flags/4x3/ml.svg?v=1.1'
            ],
            [
                'name' => 'Mexico',
                'flag_image' => 'https://www.eurogirlsescort.com/dist/flags/4x3/mx.svg?v=1.1'
            ],
            [
                'name' => 'Mongolia',
                'flag_image' => 'https://www.eurogirlsescort.com/dist/flags/4x3/mn.svg?v=1.1'
            ],
            [
                'name' => 'Morocco',
                'flag_image' => 'https://www.eurogirlsescort.com/dist/flags/4x3/ma.svg?v=1.1'
            ],
            [
                'name' => 'Nepal',
                'flag_image' => 'https://www.eurogirlsescort.com/dist/flags/4x3/np.svg?v=1.1'
            ],
            [
                'name' => 'New Zealand',
                'flag_image' => 'https://www.eurogirlsescort.com/dist/flags/4x3/nz.svg?v=1.1'
            ],
            [
                'name' => 'Nicaragua',
                'flag_image' => 'https://www.eurogirlsescort.com/dist/flags/4x3/ni.svg?v=1.1'
            ],
            [
                'name' => 'Nigeria',
                'flag_image' => 'https://www.eurogirlsescort.com/dist/flags/4x3/ng.svg?v=1.1'
            ],
            [
                'name' => 'Oman',
                'flag_image' => 'https://www.eurogirlsescort.com/dist/flags/4x3/om.svg?v=1.1'
            ],
            [
                'name' => 'Pakistan',
                'flag_image' => 'https://www.eurogirlsescort.com/dist/flags/4x3/pk.svg?v=1.1'
            ],
            [
                'name' => 'Panama',
                'flag_image' => 'https://www.eurogirlsescort.com/dist/flags/4x3/pa.svg?v=1.1'
            ],
            [
                'name' => 'Paraguay',
                'flag_image' => 'https://www.eurogirlsescort.com/dist/flags/4x3/py.svg?v=1.1'
            ],
            [
                'name' => 'Peru',
                'flag_image' => 'https://www.eurogirlsescort.com/dist/flags/4x3/pe.svg?v=1.1'
            ],
            [
                'name' => 'Philippines',
                'flag_image' => '	https://www.eurogirlsescort.com/dist/flags/4x3/ph.svg?v=1.1'
            ],
            [
                'name' => 'Qatar',
                'flag_image' => '	https://www.eurogirlsescort.com/dist/flags/4x3/qa.svg?v=1.1'
            ],
            [
                'name' => 'Saudi Arabia',
                'flag_image' => 'https://www.eurogirlsescort.com/dist/flags/4x3/sa.svg?v=1.1'
            ],
            [
                'name' => 'Senegal',
                'flag_image' => 'https://www.eurogirlsescort.com/dist/flags/4x3/sn.svg?v=1.1'
            ],
            [
                'name' => 'Singapore',
                'flag_image' => 'https://www.eurogirlsescort.com/dist/flags/4x3/sg.svg?v=1.1'
            ],
            [
                'name' => 'South Africa',
                'flag_image' => 'https://www.eurogirlsescort.com/dist/flags/4x3/za.svg?v=1.1'
            ],
            [
                'name' => 'South Korea',
                'flag_image' => 'https://www.eurogirlsescort.com/dist/flags/4x3/kr.svg?v=1.1'
            ],
            [
                'name' => 'Sri Lanka',
                'flag_image' => 'https://www.eurogirlsescort.com/dist/flags/4x3/lk.svg?v=1.1'
            ],
            [
                'name' => 'Taiwan',
                'flag_image' => 'https://www.eurogirlsescort.com/dist/flags/4x3/tw.svg?v=1.1'
            ],
            [
                'name' => 'Tanzania',
                'flag_image' => 'https://www.eurogirlsescort.com/dist/flags/4x3/tz.svg?v=1.1'
            ],
            [
                'name' => 'Thailand',
                'flag_image' => 'https://www.eurogirlsescort.com/dist/flags/4x3/th.svg?v=1.1'
            ],
            [
                'name' => 'Tunisia',
                'flag_image' => 'https://www.eurogirlsescort.com/dist/flags/4x3/tn.svg?v=1.1'
            ],
            [
                'name' => 'UAE',
                'flag_image' => 'https://www.eurogirlsescort.com/dist/flags/4x3/ae.svg?v=1.1'
            ],
            [
                'name' => 'Uganda',
                'flag_image' => 'https://www.eurogirlsescort.com/dist/flags/4x3/ug.svg?v=1.1'
            ],
            [
                'name' => 'Uruguay',
                'flag_image' => 'https://www.eurogirlsescort.com/dist/flags/4x3/uy.svg?v=1.1'
            ],
            [
                'name' => 'USA',
                'flag_image' => 'https://www.eurogirlsescort.com/dist/flags/4x3/us.svg?v=1.1'
            ],
            [
                'name' => 'Uzbekistan',
                'flag_image' => '	https://www.eurogirlsescort.com/dist/flags/4x3/uz.svg?v=1.1'
            ],
            [
                'name' => 'Venezuela',
                'flag_image' => 'https://www.eurogirlsescort.com/dist/flags/4x3/ve.svg?v=1.1'
            ],
            [
                'name' => 'Vietnam',
                'flag_image' => 'https://www.eurogirlsescort.com/dist/flags/4x3/vn.svg?v=1.1'
            ],
            [
                'name' => 'Zambia',
                'flag_image' => 'https://www.eurogirlsescort.com/dist/flags/4x3/zm.svg?v=1.1'
            ],
        ];

        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \DB::table('countries')->truncate();
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        foreach($countries_1 as $country) {
            \DB::table('countries')->insert([
                'name' => $country['name'],
                'flag_image' => $country['flag_image'],
                'group_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }

        foreach($countries_2 as $country) {
            \DB::table('countries')->insert([
                'name' => $country['name'],
                'flag_image' => $country['flag_image'],
                'group_id' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
