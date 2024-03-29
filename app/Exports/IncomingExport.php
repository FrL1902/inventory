<?php

namespace App\Exports;

use App\Models\Incoming;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Shared\Drawing;
use PhpOffice\PhpSpreadsheet\Style\ConditionalFormatting\Wizard;

class IncomingExport implements FromCollection, WithHeadings, ShouldAutoSize, WithMapping, WithEvents

{
    /**
     * @return \Illuminate\Support\Collection
     */

    // public function __construct($data)
    // {
    //     $this->incomingData = $data;
    // }

    public function __construct($data)
    {
        $this->incomingData = $data;
        // $this->valueSortedBy = $value;
    }

    use Exportable;

    public function headings(): array
    {
        return [
            // 'ID', 'Customer Name', 'Brand Name', 'Item Name', 'Date Arrived', 'Stock Before', 'Stock Added', 'Stock After', 'description', 'picture link'
            'Nama Customer', 'Nama Brand', 'ID Barang', 'Nama Barang', 'Tanggal Datang', 'Stok Datang', 'Supplier', 'deskripsi', 'link gambar'
        ];
    }

    // use Exportable;

    public function collection()
    {
        // return Incoming::all();
        // dd($this->incomingData);
        return $this->incomingData;
    }

    public function map($item): array
    {
        return [
            (is_null($item->customer_name)) ? $item->customer->customer_name : $item->customer_name,
            (is_null($item->brand_name)) ? $item->brand->brand_name : $item->brand_name,
            $item->item_id,
            (is_null($item->item_name)) ? $item->item->item_name : $item->item_name,
            date_format(date_create($item->arrive_date), 'd-m-Y'),
            $item->stock_added,
            $item->supplier,
            $item->description,
            "http://wms.intanutama.co.id/storage/" . $item->item_pictures,
        ];
    }

    public function registerEvents(): array
    {

        // dd($lastData);

        return [
            AfterSheet::class    => function (AfterSheet $event) {
                $event->sheet->getStyle('A1:I1')->applyFromArray([
                    'font' => ['bold' => true]
                ]);
                $styleArrayHeading = [
                    'borders' => [
                        'allBorders' => [ //ni piliannya bukan 'allBorders' doang, ada left, right, outline, inside, dll, cek disini https://phpspreadsheet.readthedocs.io/en/latest/topics/recipes/#styling-cell-borders
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                            'color' => ['rgb' => '000000'], //ini lgsg pake hex aja, terus value di arraynya diganti ke rgb, bisa cari online pake color picker
                            // 'color' => ['argb' => 'ff000000'], //ini argb, jadi value rgb di convert ke argb, bisa pake ini https://www.myfixguide.com/color-converter/
                        ],
                    ],
                ];

                // if ($this->valueSortedBy  != ) {
                //     if ($this->valueSortedBy == 1) {
                //         dd('customer');
                //     } elseif (condition) {
                //         dd('brand');
                //     } elseif (condition) {
                //         dd('item');
                //     }
                // }

                // dd('all');


                $styleArrayContent = [
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['rgb' => '000000'],
                        ],
                    ],
                ];

                $frontTolastData = 'A2:I' . strval(count($this->incomingData) + 1);
                $event->sheet->getStyle('A1:I1')->applyFromArray($styleArrayHeading);
                $event->sheet->getStyle($frontTolastData)->applyFromArray($styleArrayContent);
                // $event->sheet->getStyle('A1:J1')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getStyle('A1:I1')->getAlignment()->setHorizontal('center'); //set heading horizontal alignment to center
                $event->sheet->getStyle($frontTolastData)->getAlignment()->setHorizontal('left'); //set data below heading alignment to left


                // tes hyperlink
                // $frontTolastDataHyperlink = 'K2:K' . strval(count($this->incomingData) + 1);
                // $cellRange = $frontTolastDataHyperlink;
                // $conditionalStyles = [];
                // $wizardFactory = new Wizard($cellRange);
                // /** @var Wizard\CellValue $cellWizard */
                // $cellWizard = $wizardFactory->newRule(Wizard::CELL_VALUE);
                // $cellWizard->equals('HYPERLINK(I1)', Wizard::VALUE_TYPE_FORMULA);
                // $conditionalStyles[] = $cellWizard->getConditional();

                // $event->sheet->getStyle($cellWizard->getCellRange())->setConditionalStyles($conditionalStyles);

                // $event->sheet->setCellValue($frontTolastDataHyperlink, '=HYPERLINK(I2)');
            },

        ];
    }
}
