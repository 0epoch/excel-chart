<?php

namespace LaFeng\ExcelChart;

interface IDataSource {
    public function create(int $dataSourceType, string $column=''): string;
}
