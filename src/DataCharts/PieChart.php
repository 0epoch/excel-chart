<?php

namespace Lafeng\ExcelChart\DataCharts;

use PhpOffice\PhpSpreadsheet\Chart\DataSeries;
use PhpOffice\PhpSpreadsheet\Chart\Chart;
use PhpOffice\PhpSpreadsheet\Chart\Legend;

use Lafeng\ExcelChart\ChartSeries\PieSimpleChartSeries;
use Lafeng\ExcelChart\DataSource\SimpleDataSource;
use Lafeng\ExcelChart\DataChart;
use Lafeng\ExcelChart\ExcelData;
use Lafeng\ExcelChart\IDataChart;

class PieChart extends DataChart implements IDataChart {

    public function __construct(ExcelData $excelData, $chartType=DataSeries::TYPE_PIECHART)
    {
        $dataSource = new SimpleDataSource($excelData);
        $this->chartSeries = new PieSimpleChartSeries($excelData, $dataSource, $chartType);

        parent::__construct($excelData);
    }


    public function createChart(): Chart
    {
        $this->setLegend(new Legend(Legend::POSITION_BOTTOM, null, false));
        $this->setLayout(function($layout) {
            $layout->setShowPercent(true);
        });
        
        $this->buildChart();
        return $this->chart;
    }
}