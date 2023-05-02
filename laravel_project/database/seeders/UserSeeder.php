<?php

namespace Database\Seeders;

use DateTime;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * ユーザーテーブルに対するデータ設定の実行
     *
     * @return void
     */
    public function run()
    {
        DB::table("users")->insert([
            [
                "name" => Str::random(10),
                "email" => Str::random(10) . "@gmail.com",
                "email_verified_at" => now(),
                "password" => Hash::make("password"),
            ],
            [
                "name" => Str::random(10),
                "email" => Str::random(10) . "@gmail.com",
                "email_verified_at" => now(),
                "password" => Hash::make("password"),
            ],
            [
                "name" => Str::random(10),
                "email" => Str::random(10) . "@gmail.com",
                "email_verified_at" => now(),
                "password" => Hash::make("password"),
            ]
        ]);
    }
}
