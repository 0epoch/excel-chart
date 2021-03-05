<?php

require "../vendor/autoload.php";

use PhpOffice\PhpSpreadsheet\Chart\DataSeries;

use Lafeng\ExcelChart\ExcelData;
use Lafeng\ExcelChart\DataCharts\SimpleChart;
use Lafeng\ExcelChart\ExportChart;

$data = [
    [10,36,50,83]
];

$header = [2010, 2011, 2012, 2013];

$excelData = new ExcelData($data, $header);
$dataChart = new SimpleChart($excelData, DataSeries::TYPE_LINECHART);
$e = new ExportChart($excelData, $dataChart->createChart());
$filepath = './simple-line';
$e->store($filepath);