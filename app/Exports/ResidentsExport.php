<?php

namespace App\Exports;

use App\Models\Resident;


class ResidentsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Resident::all(['name', 'room_number', 'status']);
    }

    public function headings(): array
    {
        return ['Name', 'Room', 'Status'];
    }
}
