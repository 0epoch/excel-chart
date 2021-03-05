<?php

namespace Lafeng\ExcelChart\DataSource;
class SimpleDataSource extends DataSourceBase {

    public function create(int $dataSourceType, string $column=''): string
    {
        switch ($dataSourceType) {
            case self::DATA_SOURCE_LABELS:
                return $this->labels($column);
                break;
            case self::DATA_SOURCE_VALUES:
                return $this->values();
                break;
            case self::DATA_SOURCE_TICKS:
                return $this->ticks();
                break;
            default:
                throw new \Exception('dataSource类型错误！');
                break;
        }
    }

    protected function values()
    {
        $totalColumn = $this->excelData->getTotalColumn();

        $endColumn = $this->numberToLetter($totalColumn);
        $endColumn = $this->numberToLetter($this->excelData->getTotalColumn());

        $dataStartRow = $this->excelData->getDataStartRow();
        return self::PREFIX.$this->excelData->getHeaderStartColumn().'$'.$dataStartRow.':$'.$endColumn.'$'.$dataStartRow;
    }

    protected function ticks()
    {
        $totalColumn = $this->excelData->getTotalColumn();
        $endColumn = $this->numberToLetter($totalColumn);

        $headerStartRow = $this->excelData->getHeaderStartRow();
        return self::PREFIX.$this->excelData->getHeaderStartColumn().'$'.$headerStartRow.':$'.$endColumn.'$'.$headerStartRow;
    }
}