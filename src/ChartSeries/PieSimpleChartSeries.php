<?php

namespace Lafeng\ExcelChart\ChartSeries;

use PhpOffice\PhpSpreadsheet\Chart\DataSeries;
use PhpOffice\PhpSpreadsheet\Chart\DataSeriesValues;

use Lafeng\ExcelChart\AbstractChartSeries;
use Lafeng\ExcelChart\DataSource\DataSourceBase;

class PieSimpleChartSeries extends AbstractChartSeries {

    protected $acceptChartTypes = [
        DataSeries::TYPE_PIECHART,
    ];

    public function build()
    {
        $this->buildLabels();
        $this->buildValues();
        $this->buildTicks();

        $this->series = new DataSeries(
            $this->chartType, // plotType
            null, // plotGrouping (Pie charts don't have any grouping)
            range(0, count($this->values) - 1), // plotOrder
            $this->labels, // plotLabel
            $this->ticks, // plotCategory
            $this->values // plotValues
        );
    }

    public function getSeries() : DataSeries
    {
        return $this->series;
    }

    protected function buildLabels()
    {
        $column = $this->excelData->getHeaderStartColumn();
        $dataSource = $this->dataSource->create(DataSourceBase::DATA_SOURCE_LABELS, $column);
        $labels = [
            new DataSeriesValues(DataSeriesValues::DATASERIES_TYPE_STRING, $dataSource, null, 1),
        ];
        $this->labels = $labels;
    }

    /**
     * 图表数据取值范围
     */
    protected function buildValues()
    {
        $pointCount = $this->excelData->getTotalColumn();      

        $dataSource = $this->dataSource->create(DataSourceBase::DATA_SOURCE_VALUES);
        $values = [
            new DataSeriesValues(DataSeriesValues::DATASERIES_TYPE_NUMBER, $dataSource, null, $pointCount, [], null, $this->getColors()),
        ];
        $this->values = $values;
    }

    /**
     * 图表项取值范围 - 按横向表头生成
     */
    protected function buildTicks()
    {
        $pointCount = $this->excelData->getTotalColumn();

        $dataSource = $this->dataSource->create(DataSourceBase::DATA_SOURCE_TICKS);
        $ticks = [
            new DataSeriesValues(DataSeriesValues::DATASERIES_TYPE_STRING, $dataSource, null, $pointCount),
        ];
        $this->ticks = $ticks;
    }

}