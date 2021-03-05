<?php

namespace Lafeng\ExcelChart\DataSource;
class DatasetDataSource extends DataSourceBase {

    public function create (int $dataSourceType, string $column=''): string
    {
        switch ($dataSourceType) {
            case self::DATA_SOURCE_LABELS:
                return $this->labels($column);
                break;
            case self::DATA_SOURCE_VALUES:
                return $this->values($column);
                break;
            case self::DATA_SOURCE_TICKS:
                return $this->ticks();
            default:
                throw new \Exception('dataSource类型错误！');
        }
        return '';
    }

    protected function values($column)
    {
        $totalRow = $this->excelData->getTotalRow();

        $startRow = $this->excelData->getDataStartRow();
        $endRow = $totalRow + $this->excelData->getHeaderStartRow();
        return self::PREFIX.$column.'$'.$startRow.':'.'$'.$column.'$'.$endRow;
    }

    protected function ticks()
    {
        $startRow = $this->excelData->getDataStartRow();
        $endRow = $this->excelData->getTotalRow() + $this->excelData->getHeaderStartRow();
        $startColumn = $this->excelData->getHeaderStartColumn();

        return self::PREFIX.$startColumn.'$'.$startRow.':$'.$startColumn.'$'.$endRow;
    }
}