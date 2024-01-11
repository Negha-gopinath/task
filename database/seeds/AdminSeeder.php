<?php

use App\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datas = [
            ['name' => 'Admin', 'email' => 'admin@gmail.com', 'password' => 123456, 'mobile' => "0123456789"],
            ['name' => 'Admin1', 'email' => 'admin1@gmail.com', 'password' => 123456, 'mobile' => "1234567890"],
        ];

        foreach ($datas as $data) {
            $checkExist = Admin::where('email', $data['email'])->get();
            if (count($checkExist) == 0) {
                Admin::firstOrCreate($data);
            }
        }
    }
}
