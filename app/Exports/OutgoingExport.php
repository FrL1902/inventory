<?php

namespace App\Exports;

use App\Models\Outgoing;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;

class OutgoingExport implements FromCollection, WithHeadings, ShouldAutoSize, WithMapping, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function __construct($data)
    {
        $this->outgoingData = $data;
    }

    use Exportable;

    public function headings(): array
    {
        return [
            'ID', 'Customer Name', 'Brand Name', 'Item Name', 'Stock Before', 'Stock Taken', 'Stock Now', 'description', 'picture link', 'time (WIB)'
        ];
    }

    public function collection()
    {
        return $this->outgoingData;
    }

    public function map($item): array
    {
        return [
            $item->id,
            $item->customer->customer_name,
            $item->brand->brand_name,
            $item->item_name,
            $item->stock_before,
            $item->stock_taken,
            $item->stock_now,
            $item->description,
            $item->picture_link,
            date_format($item->created_at, "D/d/m/y H:i:s"),
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function (AfterSheet $event) {
                $event->sheet->getStyle('A1:J1')->applyFromArray([
                    'font' => ['bold' => true]
                ]);
                $styleArrayHeading = [
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                            'color' => ['rgb' => '000000'],
                        ],
                    ],
                ];
                $styleArrayContent = [
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['rgb' => '000000'],
                        ],
                    ],
                ];

                $frontTolastData = 'A2:J' . strval(count($this->outgoingData) + 1);
                $event->sheet->getStyle('A1:J1')->applyFromArray($styleArrayHeading);
                $event->sheet->getStyle($frontTolastData)->applyFromArray($styleArrayContent);
                $event->sheet->getStyle('A1:J1')->getAlignment()->setHorizontal('center');
                $event->sheet->getStyle($frontTolastData)->getAlignment()->setHorizontal('left');
            },

        ];
    }
}
