<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CompanyInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('company_info')->insert([
            'company_name'           => 'Company Name',
            'web_address'            => 'Web Address',
            'company_address'        => '152/Address',
            'company_email'          => 'company@gmail.com',
            'company_phone'          => '01700000000',
            'company_logo'           => 'logo.jpg',
            'company_icon'           => 'icon.jpg',
            'fb_page_link'           => 'hhtp://facebook.com/company',
        ]);
    }
}
