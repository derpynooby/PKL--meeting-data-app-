<?php

namespace App\Exports;

// Import required classes from maatwebsite/excel package
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

/**
 * ParticipantExport class for exporting participant data to Excel
 * Implements FromCollection interface to get data from collection
 * and WithHeadings to add column headers
 */
class ParticipantExport implements FromCollection, WithHeadings
{
    /**
     * Property to store participant data
     * @var \Illuminate\Support\Collection
     */
    protected $participants;

    /**
     * Constructor to initialize participant data
     * @param mixed $participants Participant data to be exported
     */
    public function __construct($participants)
    {
        $this->participants = $participants;
    }

    /**
     * Method to retrieve and format data for export
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return $this->participants->map(function ($item) {
            return [
                'nama' => $item->user->name, // Get user's name
                'jabatan' => $item->user->role->role, // Get user's role/position
                'dibuat' => $item->created_at, // Get creation timestamp
            ];
        });
    }

    /**
     * Method to define column headers in Excel file
     * @return array
     */
    public function headings(): array
    {
        return ['Nama', 'Jabatan', 'Dibuat'];
    }
}
