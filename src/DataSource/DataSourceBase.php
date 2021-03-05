<?php

namespace Lafeng\ExcelChart\DataSource;

use Lafeng\ExcelChart\IDataSource;
use Lafeng\ExcelChart\Traits\ExcelColumn;
use Lafeng\ExcelChart\ExcelData;
class DataSourceBase implements IDataSource {
    use ExcelColumn;

    const PREFIX = 'Worksheet!$';

    const DATA_SOURCE_LABELS = 1;
    const DATA_SOURCE_VALUES = 2;
    const DATA_SOURCE_TICKS = 3;

    /**
     * @var ExcelData
     */
    protected $excelData;

    public function __construct(ExcelData $excelData)
    {
        $this->excelData = $excelData;
    }

    public function create(int $dataSourceType, string $column=''): string
    {
        throw new \Exception('dataSource类型错误！');
    }

    protected function labels($column)
    {
        return self::PREFIX. $column.'$'.$this->excelData->getHeaderStartRow();
    }
}