<?php

namespace App\Exports;

use App\Models\Arsip_surat;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;


class EksporSurat implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */


    
     /**
     * Mengambil data surat untuk diexport.
     */
    public function collection()
    {
        return Arsip_surat::select('title', 'description', 'date')->get(); // Kolom yang ingin diexport
    }

    /**
     * Menambahkan heading untuk file Excel.
     */
    public function headings(): array
    {
        return ['Judul Surat', 'Deskripsi', 'Tanggal Surat']; // Header file Excel
    }
    private $userId;

    /**
     * Constructor untuk menerima user_id
     */
    public function __construct($userId)
    {
        $this->userId = $userId;
    }
}
