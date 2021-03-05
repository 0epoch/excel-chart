<?php

require "../vendor/autoload.php";

use PhpOffice\PhpSpreadsheet\Chart\DataSeries;

use Lafeng\ExcelChart\ExcelData;
use Lafeng\ExcelChart\DataCharts\DatasetChart;
use Lafeng\ExcelChart\ExportChart;

$data = [
    ['Q1', 12, 15, 21, 33],
    ['Q2', 56, 73, 86, 21],
    ['Q3', 52, 61, 69, 19],
    ['Q4', 30, 32, "0", 80],
];

$header = ['', 2010, 2011, 2012, 2013];

$excelData = new ExcelData($data, $header);
$excelData->setDataStartColumn('B');
$excelData->setHeaderStartColumn('B');

$dataChart = new DatasetChart($excelData, DataSeries::TYPE_BARCHART);
$e = new ExportChart($excelData, $dataChart->createChart());
$filepath = './dataset-bar';
$e->store($filepath);