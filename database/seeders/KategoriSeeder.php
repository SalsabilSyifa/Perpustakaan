<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kategori;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            'Pelajaran',
            'Novel',
            'Komik',
            'Majalah',
            'Referensi',
            'Ensiklopedi',
            'Karya Ilmiah'
        ];

        foreach ($data as $item) {
            Kategori::create([
                'nama_kategori' => $item
            ]);
        }
    }
}
