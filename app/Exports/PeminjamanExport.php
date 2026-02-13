<?php

namespace App\Exports;

use App\Models\Peminjaman;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PeminjamanExport implements 
    FromCollection,
    WithHeadings,
    WithStyles,
    ShouldAutoSize
{
    public function collection()
    {
        return Peminjaman::with(['anggota', 'bukuItem.buku'])->get()->map(function ($p) {
            return [
                'Nama Anggota' => $p->anggota->nama_anggota ?? '-',
                'Judul Buku'   => $p->bukuItem->buku->judul ?? '-',
                'Kode Buku'   => $p->bukuItem->kode_buku ?? '-',
                'Tgl Pinjam'  => $p->tanggal_pinjam,
                'Jatuh Tempo' => $p->tanggal_jatuh_tempo,
                'Tgl Kembali' => $p->tanggal_kembali ?? '-',
                'Status'      => ucfirst($p->status),
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Nama Anggota',
            'Judul Buku',
            'Kode Buku',
            'Tanggal Pinjam',
            'Jatuh Tempo',
            'Tanggal Kembali',
            'Status',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // HEADER
            1 => [
                'font' => [
                    'bold' => true,
                    'size' => 12,
                ],
                'alignment' => [
                    'horizontal' => 'center',
                ],
                'fill' => [
                    'fillType' => 'solid',
                    'startColor' => [
                        'rgb' => 'D9E1F2'
                    ]
                ],
            ],
        ];
    }
}
