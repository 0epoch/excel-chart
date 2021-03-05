<?php

require "../vendor/autoload.php";

use Lafeng\ExcelChart\ExcelData;
use Lafeng\ExcelChart\DataCharts\PieChart;
use Lafeng\ExcelChart\ExportChart;

$data = [
    [10,36,50,83]
];

$header = [2010, 2011, 2012, 2013];

$excelData = new ExcelData($data, $header);
$dataChart = new PieChart($excelData);
$e = new ExportChart($excelData, $dataChart->createChart());
$filepath = './pie-simple';
$e->store($filepath);