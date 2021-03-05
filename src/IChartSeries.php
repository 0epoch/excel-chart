<?php

namespace Lafeng\ExcelChart;

use PhpOffice\PhpSpreadsheet\Chart\DataSeries;
interface IChartSeries {

    public function build();

    public function getSeries() : DataSeries;

    public function setColors(array $colors);
}