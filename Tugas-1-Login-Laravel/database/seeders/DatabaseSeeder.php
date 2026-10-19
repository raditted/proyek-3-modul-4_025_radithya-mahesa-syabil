<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $admin = new User();
        $admin->username = 'admin';
        $admin->nama_lengkap = 'Administrator';
        $admin->password = bcrypt('password123');
        $admin->role = 'admin';
        $admin->save();

        $budi = new User();
        $budi->username = 'budi';
        $budi->nama_lengkap = 'Budi Santoso';
        $budi->password = bcrypt('password123');
        $budi->role = 'customer';
        $budi->save();

        $ani = new User();
        $ani->username = 'ani';
        $ani->nama_lengkap = 'Ani Wijaya';
        $ani->password = bcrypt('password123');
        $ani->role = 'staff';
        $ani->save();
    }
}
