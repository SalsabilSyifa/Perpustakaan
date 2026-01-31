<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StatusBuku;

class StatusBukuSeeder extends Seeder
{
    public function run(): void
    {
        $statuses = [
            'Tersedia',
            'Dipinjam',
            'Rusak',
            'Hilang'
        ];

        foreach ($statuses as $status) {
            StatusBuku::firstOrCreate([
                'nama_status' => $status
            ]);
        }
    }
}
