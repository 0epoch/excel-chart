<?php

namespace Lafeng\ExcelChart\DataCharts;

use Lafeng\ExcelChart\ChartSeries\SimpleChartSeries;
use Lafeng\ExcelChart\DataChart;
use Lafeng\ExcelChart\DataSource\SimpleDataSource;
use Lafeng\ExcelChart\IDataChart;
use PhpOffice\PhpSpreadsheet\Chart\Chart;

class SimpleChart extends DataChart implements IDataChart{


    public function __construct($excelData, $chartType)
    {
        $dataSource = new SimpleDataSource($excelData);
        $this->chartSeries = new SimpleChartSeries($excelData, $dataSource, $chartType);

        parent::__construct($excelData);
    }

    public function createChart(): Chart
    {
        $this->buildChart();
        return $this->chart;
    }
}