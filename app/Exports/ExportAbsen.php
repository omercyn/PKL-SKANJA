<?php
namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Collection;
use App\Models\Absensi;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportAbsen implements FromCollection, WithCustomStartCell, WithHeadings
{
    protected $data;

    public function __construct(Collection $data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        return $this->data;
    }

    public function headings(): array
    {
        return [
            ['Nomor', 'Nama', 'NISN', 'Kelas', 'Pembimbing', 'Tanggal', 'Waktu', 'Status'],
        ];
    }

    public function startCell(): string
    {
        return 'B2';
    }
}
