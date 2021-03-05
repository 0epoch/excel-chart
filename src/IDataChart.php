<?php

namespace Lafeng\ExcelChart;

use PhpOffice\PhpSpreadsheet\Chart\Chart;

interface IDataChart {

    public function createChart(): Chart;
}