<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("products")->insert([
            [
                "name" => "Mouse",
                "price" => "250",
                "description" => "mouse",
                "created_at"=>date("d-m-y"),
                "updated_at"=>date("d-m-y")
            ],
            [
                "name" => "Keyboard",
                "price" => "500",
                "description" => "keyboard",
                "created_at"=>date("d-m-y"),
                "updated_at"=>date("d-m-y")
            ],
            [
                "name" => "Pendrive",
                "price" => "300",
                "description" => "pen drive",
                "created_at"=>date("d-m-y"),
                "updated_at"=>date("d-m-y")
            ],
            [
                "name" => "Usb Cable",
                "price" => "100",
                "description" => "usb cable",
                "created_at"=>date("d-m-y"),
                "updated_at"=>date("d-m-y")
            ],
            
        ]);
    }
}
