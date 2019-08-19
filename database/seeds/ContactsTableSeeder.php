<?php

use Illuminate\Database\Seeder;

class ContactsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('contacts')->insert([
            [
                'First_name' => 'James',
                'surname' => 'Moka',
                'country_code' => '+234',
                'phone' => 234354646,
                'user_key' => 1        
            ],
            [
                'First_name' => 'Kane',
                'surname' => 'Moeka',
                'country_code' => '+274',
                'phone' => 8765434567,
                'user_key' => 1      
                
            ],
            [
                'First_name' => 'Green',
                'surname' => 'Man',
                'country_code' => '+284',
                'phone' => 867564533 ,
                'user_key' => 1     
                
            ]
        ]);
    }
}
