<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class HistoryExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */


    /**
     * Property to store participant data
     * @var \Illuminate\Support\Collection
     */
    protected $histories;

    /**
     * Constructor to initialize participant data
     * @param mixed $histories Participant data to be exported
     */
    public function __construct($histories)
    {
        $this->histories = $histories;
    }

    /**
     * Method to retrieve and format data for export
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return $this->histories->map(function ($item) {
            return [
                'meeting' => $item->zoom->title, // Get user's name
                'tanggal' => $item->zoom->datetime, // Get user's role/position
                'join time' => $item->created_at, // Get creation timestamp
            ];
        });
    }

    /**
     * Method to define column headers in Excel file
     * @return array
     */
    public function headings(): array
    {
        return ['Meeting', 'Tanggal', 'Join Time'];
    }
}
