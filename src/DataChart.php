<?php
namespace Lafeng\ExcelChart;

use PhpOffice\PhpSpreadsheet\Chart\Chart;
use PhpOffice\PhpSpreadsheet\Chart\DataSeries;
use PhpOffice\PhpSpreadsheet\Chart\Layout;
use PhpOffice\PhpSpreadsheet\Chart\Legend;
use PhpOffice\PhpSpreadsheet\Chart\PlotArea;
use PhpOffice\PhpSpreadsheet\Chart\Title;

use Lafeng\ExcelChart\ExcelData;
use Lafeng\ExcelChart\Traits\ExcelColumn;

class DataChart {

    use ExcelColumn;

    /**
     * @var DataSeries
     */
    protected $series;

    /**
     * @var Chart
     */
    protected $chart;

    /**
     * @var Layout 控制图表数据显示
     */
    protected $layout;

    /**
     * @var ExcelData
     */
    protected $excelData;

    /**
     * @var IChartSeries
     */
    protected $chartSeries;

    protected $legend;

    //图表名称
    protected $chartName;

    protected $title;

    protected $subtitle;

    public function __construct(ExcelData $excelData)
    {
        $this->excelData = $excelData;

        $this->layout = new Layout();
        $this->layout->setShowVal(true);
    }

    public function buildChart()
    {
        $this->chartSeries->build();
        $this->series = $this->chartSeries->getSeries();

        $plotArea = new PlotArea($this->layout, [$this->series]);

        $title = new Title($this->title);
        $yAxisLabel = new Title($this->subtitle);

        $chart = new Chart(
            $this->chartName,
            $title,
            $this->legend,
            $plotArea,
            true, // plotVisibleOnly
            DataSeries::EMPTY_AS_GAP, // displayBlanksAs
            null, // xAxisLabel
            $yAxisLabel  //TODO: 饼状图没有Y轴标题
        );

        $totalRow = $this->excelData->getTotalRow();
        $totalColumn = $this->excelData->getTotalColumn();

        $column = $this->numberToLetter($totalColumn + 5);
        $chart->setTopLeftPosition('A'.($totalRow + 5));
        $chart->setBottomRightPosition($column.($totalRow + 5 + 21));  

        $this->chart = $chart;
    }

    public function setLayout(\Closure $layoutCallback)
    {
        $layoutCallback($this->layout);
        return $this;
    }

    public function setLegend(?Legend $legend)
    {
        $this->legend = $legend;
        return $this;
    }

    public function setTitile($title) {
        $this->title = $title;
        return $this;
    }   

    public function setSubtitile($subtitle) {
        $this->subtitle = $subtitle;
        return $this;
    }

    public function getChartSeries(): IChartSeries
    {
        return $this->chartSeries;
    }

}