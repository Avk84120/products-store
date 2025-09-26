<?php


namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;


class AdminUserSeeder extends Seeder
{
public function run()
{
DB::table('users')->insert([
'name' => 'User',
'email' => 'User@example.com',
// password: password
'password' => '$2y$10$eWqEkB8Pn8qgBXr9lInNn.shixSs66IOe4x8B9wnkH5ahQFjyI1AS',
'is_admin' => 0,
'created_at' => now(),
'updated_at' => now(),
]);
}
}