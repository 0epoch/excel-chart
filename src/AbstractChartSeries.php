<?php
namespace Lafeng\ExcelChart;

use PhpOffice\PhpSpreadsheet\Chart\DataSeries;

use Lafeng\ExcelChart\Traits\ExcelColumn;
use Lafeng\ExcelChart\IDataSource;

abstract class AbstractChartSeries implements IChartSeries {

    use ExcelColumn;

    /**
     * @var DataSeries
     */
    protected $series;

    /**
     * @var ExcelData
     */
    protected $excelData;

    /**
     * @var IDataSource
     */
    protected $dataSource;

    protected $chartType;

    protected $labels;

    protected $values;

    protected $ticks;

    protected $colors;

    protected $acceptChartTypes = [];

    public function __construct(ExcelData $excelData, IDataSource $dataSource, string $chartType)
    {
        $this->excelData = $excelData;
        $this->dataSource = $dataSource;
        $this->chartType = $chartType;

        $this->verifyChartType($chartType);
    }

    abstract protected function buildLabels();

    /**
     * 图表数据取值
     */
    abstract protected function buildValues();

    /**
     * 图表每项名称取值
     */
    abstract protected function buildTicks();

    public function setColors(array $colors)
    {
        if(empty($colors)) {
            throw new \Exception('颜色不能为空!');
        }
        $this->colors = $this->colors;
    }
    
    protected function getColors()
    {
        return $this->colors;
    }

    protected function verifyChartType($chartType)
    {
        if(! in_array($chartType, $this->acceptChartTypes)) {
            throw new \Exception('不支持该图表类型！');
        }
    }

}