<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'id_user'      => 'USR001',
                'nama_lengkap' => 'Budi Santoso',
                'email'        => 'budi@mail.com',
                'username'     => 'budi',
                'password'     => Hash::make('password123'),
                'no_hp'        => '081234567890',
                'alamat'       => 'Jl. Mawar No. 1, Jakarta',
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'id_user'      => 'USR002',
                'nama_lengkap' => 'Ani Wijaya',
                'email'        => 'ani@mail.com',
                'username'     => 'ani',
                'password'     => Hash::make('password123'),
                'no_hp'        => '089876543210',
                'alamat'       => 'Jl. Melati No. 5, Bandung',
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
        ]);

        $products = [
            ['id_barang'=>'BRG001','nama_barang'=>'Kemeja Pria Polos','deskripsi'=>'Kemeja kasual bahan katun','harga'=>120000,'stok'=>30,'gambar'=>null],
            ['id_barang'=>'BRG002','nama_barang'=>'Kaos Polos','deskripsi'=>'Kaos bahan cotton combed 30s','harga'=>65000,'stok'=>50,'gambar'=>null],
            ['id_barang'=>'BRG003','nama_barang'=>'Celana Jeans','deskripsi'=>'Celana jeans slim fit','harga'=>185000,'stok'=>20,'gambar'=>null],
            ['id_barang'=>'BRG004','nama_barang'=>'Jaket Hoodie','deskripsi'=>'Hoodie bahan fleece tebal','harga'=>220000,'stok'=>15,'gambar'=>null],
            ['id_barang'=>'BRG005','nama_barang'=>'Topi Baseball','deskripsi'=>'Topi snapback adjustable','harga'=>55000,'stok'=>40,'gambar'=>null],
            ['id_barang'=>'BRG006','nama_barang'=>'Sepatu Sneakers','deskripsi'=>'Sepatu casual sehari-hari','harga'=>350000,'stok'=>10,'gambar'=>null],
            ['id_barang'=>'BRG007','nama_barang'=>'Tas Ransel','deskripsi'=>'Ransel laptop kapasitas 30L','harga'=>280000,'stok'=>8,'gambar'=>null],
            ['id_barang'=>'BRG008','nama_barang'=>'Dompet Kulit','deskripsi'=>'Dompet slim bahan kulit sintetis','harga'=>95000,'stok'=>25,'gambar'=>null],
            ['id_barang'=>'BRG009','nama_barang'=>'Ikat Pinggang','deskripsi'=>'Belt kulit dengan gesper klasik','harga'=>75000,'stok'=>0,'gambar'=>null],
            ['id_barang'=>'BRG010','nama_barang'=>'Kacamata Hitam','deskripsi'=>'Kacamata UV400 protection','harga'=>110000,'stok'=>18,'gambar'=>null],
            ['id_barang'=>'BRG011','nama_barang'=>'Jam Tangan Kasual','deskripsi'=>'Jam tangan analog simpel','harga'=>175000,'stok'=>12,'gambar'=>null],
            ['id_barang'=>'BRG012','nama_barang'=>'Kaos Kaki 3 Pack','deskripsi'=>'Kaos kaki katun isi 3 pasang','harga'=>35000,'stok'=>60,'gambar'=>null],
        ];

        foreach ($products as $p) {
            DB::table('products')->insert(array_merge($p, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
}
