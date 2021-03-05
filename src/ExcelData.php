<?php

namespace Lafeng\ExcelChart;

use Exception;

class ExcelData {

    protected $data;

    protected $header;

    protected $totalRow;

    protected $totalColumn;

    /**
     * @var int
     */
    protected $dataStartRow = 2;

    /**
     * @var string
     */
    protected $dataStartColumn = 'A';

    /**
     * @var int
     */
    protected $headerStartRow = 1;

    /**
     * @var string
     */
    protected $headerStartColumn = 'A';


    public function __construct(array $data, array $header)
    {
        if(empty($data) || empty($header)) {
            throw new Exception('Excel表头和表数据不能为空！');
        }

        $this->data = $data;
        $this->header = $header;

        $this->totalRow = count($this->data);
        $this->totalColumn = count($this->header);
    }

    public function getExcelData()
    {
        $excelData = $this->data;
        array_unshift($excelData, $this->header);
        return $excelData;
    }

    public function getData()
    {
        return $this->data;
    }

    public function getHeader()
    {
        return $this->header;
    }

    public function getTotalRow()
    {
        return $this->totalRow;
    }

    public function getTotalColumn()
    {
        return $this->totalColumn;
    }

    public function setDataStartRow(int $dataStartRow)
    {
        $this->dataStartRow = $dataStartRow;
        return $this;
    }
    
    public function setDataStartColumn(string $dataStartColumn)
    {
        $this->dataStartColumn = strtoupper($dataStartColumn);
        return $this;
    }

    public function setHeaderStartRow(int $headerStartRow)
    {
        $this->headerStartRow = $headerStartRow;
        return $this;
    }

    public function setHeaderStartColumn(string $headerStartColumn)
    {
        $this->headerStartColumn = strtoupper($headerStartColumn);
        return $this;
    }
    
    public function getDataStartRow()
    {
        return $this->dataStartRow;
    }

    public function getDataStartColumn()
    {
        return $this->dataStartColumn;
    }
    
    public function getHeaderStartRow()
    {
        return $this->headerStartRow;
    }

    public function getHeaderStartColumn()
    {
        return $this->headerStartColumn;
    }

}