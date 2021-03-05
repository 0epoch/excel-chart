<?php

namespace Lafeng\ExcelChart;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Chart\Chart;

use Lafeng\ExcelChart\ExcelData;
class ExportChart
{
    protected $excelData;

    protected $chart;

    protected $spreadsheet;

    protected $writer;

    protected $ext = 'xlsx';

    public function __construct(ExcelData $excelData, Chart $chart)
    {
        $this->excelData = $excelData;
        
        $this->chart = $chart;

        $this->spreadsheet = new Spreadsheet();
        
        $writer = IOFactory::createWriter($this->spreadsheet, 'Xlsx');
        $writer->setIncludeCharts(true);
        $worksheet = $this->spreadsheet->getActiveSheet();
        $worksheet->fromArray($this->excelData->getExcelData());
        $worksheet->addChart($this->chart);

        $this->writer = $writer;
    }

    public function string()
    {
        ob_start();
        $this->writer->save('php://output');
        return ob_get_clean();
    }

    public function store($filepath)
    {
        $file = $filepath . '.'.$this->ext;
        $this->writer->save($file);
        return $file;
    }
}
