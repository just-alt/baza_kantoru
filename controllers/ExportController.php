<?php

namespace app\controllers;


use app\models\Export;
use PHPExcel;
use PHPExcel_Style_Alignment;
use PHPExcel_Style_Border;
use PHPExcel_Style_Fill;
use PHPExcel_Writer_Excel5;
use Yii;
use yii\web\Controller;

class ExportController extends Controller
{
    /**
     * Shows categories list for export
     * If submit button pressed generates .xls price based on selected categories
     * @return string
     */
    public function actionIndex()
    {
        $model = new Export();
        $categories = $model->getCategories();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $products = $model->getProductsByCategory($model->categories);

            $dateTime = new \DateTime();
            $dateTime = $dateTime->format('d-m-Y H:i');
            $this->generatePrice($products, "Anycomp price - {$dateTime}");
        }

        return $this->render('index', ['categories' => $categories, 'model' => $model]);
    }

    /**
     * Generates .xls price with array of products
     *
     * @param array $products product array
     * @param string $name price name
     */
    private function generatePrice($products, $name)
    {
        $phpExcel = new PHPexcel();

        $style = [
            'alignment' => [
                'wrap' => true,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_TOP,
            ]
        ];
        $phpExcel->getDefaultStyle()->applyFromArray($style);
        $sheetIndex = 0;

        foreach ($products as $key => $product) {
            $row = 1;

//            Skip creating empty categories
            if (count($product) === 0) {
                continue;
            }
//            Creating new table sheet
            if (count($product) > 0 && $sheetIndex <> 0) {
                $phpExcel->createSheet();
            }

//            Select new sheet and set its title
            $phpExcel->setActiveSheetIndex($sheetIndex);
            $sheet = $phpExcel->getActiveSheet();
            $title = str_replace("/", "|", $key);
            $sheet->setTitle($title);

//            Filling headers
            $headers = [
                'id',
                'Виробник',
                'Модель'
            ];
            if ($key == 'Ноутбук') {
                array_push($headers, 'Атрибути', 'Поломки', 'Відсутнє');
            }

            $this->fillCells($sheet, $row, $headers);
            $cols = $sheet->getHighestColumn();
            $this->formatHeaders($sheet, $cols);
            $row++;
//            Filling table with products
            foreach ($product as $p) {
                $data = [
                    $p->id,
                    $p['manuf'],
                    $p->name,
                ];

                if ($key == "Ноутбук") {
                    array_push($data, $p['attribute'], $p['problem'], $p['equipment']);
                }

                $this->fillCells($sheet, $row, $data);
//                Change fill color every second row
                if ($row % 2 === 0) {
                    $this->formatRow($sheet, $row, $cols);
                }
                $row++;
            }

            $sheetIndex++;
            $this->autoWidthSheet($sheet, $cols);
        }
        $this->downloadPrice($phpExcel, $name);
    }


    /**
     * Fills table cells with data
     *
     * @param \PHPExcel_Worksheet $sheet
     * @param $row
     * @param array $items
     */
    private function fillCells($sheet, $row, $items)
    {
        foreach ($items as $index => $item) {
            $sheet->setCellValueByColumnAndRow($index, $row, $item);
        }

    }

    /**
     * Download generated price
     *
     * @param PHPExcel $xls generated price
     * @param string $name price name
     */
    private function downloadPrice($xls, $name)
    {
        header("Expires: Mon, 1 Apr 1974 05:00:00 GMT");
        header("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
        header("Cache-Control: no-cache, must-revalidate");
        header("Pragma: no-cache");
        header("Content-type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename={$name}.xls");
        $xls->setActiveSheetIndex(0);
        $objWriter = new PHPExcel_Writer_Excel5($xls);
        $objWriter->save('php://output');
    }

    /**
     * Sets the automatic width for each column
     *
     * @param \PHPExcel_Worksheet $sheet working sheet
     * @param string $cols last used column
     */
    private function autoWidthSheet($sheet, $cols)
    {
        for ($i = "A"; $i <= $cols; $i++) {
            $sheet->getColumnDimension($i)->setAutoSize(true);
        }
    }

    /**
     * Changes headers fill color + font color + bold + adding autoFilter
     *
     * @param \PHPExcel_Worksheet $sheet working sheet
     * @param string $cols last used column
     */
    private function formatHeaders($sheet, $cols)
    {
        $style = [
            'fill'=>[
                'type'=>PHPExcel_Style_Fill::FILL_SOLID,
                'color'=>['rgb'=>'5B9BD5']
            ],
           'font'=>[
               'bold'=>true,
               'color'=>['rgb'=>'FFFFFF']
           ]
        ];
        $cellCoordinate = "A1:{$cols}1";
        $sheet->setAutoFilter($cellCoordinate);
        $sheet->getStyle($cellCoordinate)->applyFromArray($style);
    }

    /**
     * Changes row fill and border color
     *
     * @param \PHPExcel_Worksheet $sheet
     * @param $row
     * @param $cols
     */
    private function formatRow($sheet, $row, $cols)
    {
        $cellCoordinate = "A{$row}:{$cols}{$row}";
        $style = [
            'borders' => [
                'allborders' => [
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => ['rgb' => '9BC2E6'],
                ],
            ],
            'fill' => [
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => ['rgb' => 'DDEBF7']
            ]
        ];
        $sheet->getStyle($cellCoordinate)->applyFromArray($style);
    }
}