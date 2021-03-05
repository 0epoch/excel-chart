<?php

namespace Lafeng\ExcelChart\DataCharts;

use PhpOffice\PhpSpreadsheet\Chart\Chart;
use PhpOffice\PhpSpreadsheet\Chart\Legend;

use Lafeng\ExcelChart\ChartSeries\DatasetChartSeries;
use Lafeng\ExcelChart\DataChart;
use Lafeng\ExcelChart\DataSource\DatasetDataSource;
use Lafeng\ExcelChart\ExcelData;
use Lafeng\ExcelChart\IDataChart;

class DatasetChart extends DataChart implements IDataChart {

    public function __construct(ExcelData $excelData, $chartType)
    {
        $dataSource = new DatasetDataSource($excelData);
        $this->chartSeries = new DatasetChartSeries($excelData, $dataSource, $chartType);
        
        parent::__construct($excelData);
    }

    public function createChart(): Chart
    {
        $this->setLegend(new Legend(Legend::POSITION_BOTTOM, null, false));
        $this->buildChart();

        return $this->chart;
    }
}