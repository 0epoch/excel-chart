<?php

namespace Lafeng\ExcelChart\ChartSeries;

use PhpOffice\PhpSpreadsheet\Chart\DataSeries;
use PhpOffice\PhpSpreadsheet\Chart\DataSeriesValues;

use Lafeng\ExcelChart\AbstractChartSeries;
use Lafeng\ExcelChart\DataSource\DataSourceBase;
use Lafeng\ExcelChart\IChartSeries;

class DatasetChartSeries extends AbstractChartSeries implements IChartSeries{
    
    protected $acceptChartTypes = [
        DataSeries::TYPE_BARCHART,
        DataSeries::TYPE_LINECHART,
    ];
    
    public function build()
    {        
        $this->buildLabels();
        $this->buildValues();
        $this->buildTicks();

        $this->series = new DataSeries(
            $this->chartType, // plotType
            DataSeries::GROUPING_STANDARD, // plotGrouping 折线和柱状图都用标准，不带堆积的
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
        $totalColumn = $this->excelData->getTotalColumn();
        $labels = [];
        $start = $this->letterToNum($this->excelData->getHeaderStartColumn());
        for($i=$start; $i<=$totalColumn; $i++) {
            $column = $this->numberToLetter($i);
            $dataSource = $this->dataSource->create(DataSourceBase::DATA_SOURCE_LABELS, $column);
            $labels[] = new DataSeriesValues(DataSeriesValues::DATASERIES_TYPE_STRING, $dataSource, null, 1);
        }
        $this->labels = $labels;
    }

    protected function buildValues()
    {
        $totalColumn = $this->excelData->getTotalColumn();

        $pointCount = $totalColumn - 1;
        $values = [];
        $start = $this->letterToNum($this->excelData->getDataStartColumn());
        for($i=$start; $i<=$totalColumn; $i++) {
            $column = $this->numberToLetter($i);
            $dataSource = $this->dataSource->create(DataSourceBase::DATA_SOURCE_VALUES, $column);
            $values[] = new DataSeriesValues(DataSeriesValues::DATASERIES_TYPE_NUMBER, $dataSource, null, $pointCount);
        }
        $this->values = $values;
    }

    protected function buildTicks()
    {
        $dataSource = $this->dataSource->create(DataSourceBase::DATA_SOURCE_TICKS);
        $pointCount = $this->excelData->getTotalColumn() - ($this->letterToNum($this->excelData->getHeaderStartColumn()) - 1);
        $ticks = [
            new DataSeriesValues(DataSeriesValues::DATASERIES_TYPE_STRING, $dataSource, null, $pointCount),
        ];
        $this->ticks = $ticks;
    }
}