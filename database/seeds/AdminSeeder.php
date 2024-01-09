<?php

use App\Admin;
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
        $data = [
            'name' => 'Admin', 'email' => 'admin@gmail.com', 'password' => '123', 'mobile' => "0123456789"
        ];
        $checkExist = Admin::where('email', $data['email'])->get();
        if (count($checkExist) == 0) {
            Admin::create($data);
        }
    }
}
