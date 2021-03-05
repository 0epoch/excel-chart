# excel-chart 导出Excel图表

## 快速开始

```
use Lafeng\ExcelChart\ExcelData;
use Lafeng\ExcelChart\DataCharts\SimpleChart;
use PhpOffice\PhpSpreadsheet\Chart\DataSeries;

$data = [
    [56, 73, 86, 100]
];
$header = [2010, 2011, 2012, 2013];

$excelData = new ExcelData($data,$header);
//设置表格数据的开始列，默认为A
$excelData->setDataStartColumn('A');

//简单模式，支持折线图，柱状图
$dataChart = new SimpleDataChart($excelData, DataSeries::TYPE_LINECHART);
$chart = $dataChart->createChart();
$export = new ExportChart($excelData, $chart);

//不带后缀的完整文件路径
$filepath = './test'; 
//导出图表到文件
$export->store($filepath);

//返回图表的字符串值
$export->string();
```
- excelData设置   
simple与pie模式可不设置，使用默认值即可，除非表头有多行。  
__dataset模式必须设置data与header的开始列__

``` 
setDataStartRow(2); 数据在表格的开始行号
setDataStartColumn('A'); 数据在表格开始的列
setHeaderStartRow(1); 表头开始的行号
setHeaderStartColumn('A'); 表头开始的列
```
#### 在 $dataChart->createChart 前的一些自定义设置
- colors 设置  
  ```
  通过 $chartSeries =  $dataChart->getChartSeries(); 获取chartSeries实例。
  //设置图表项颜色，不带#号的16进制颜色值。
  $chartSeries->setColors(['33CCFF', '0099CC', 'CC3399', 'FF9900']);
  ```
- layout设置  
  ```
  $dataChart->setLayout(function($layout) {
      $layout->setShowVal(true);
      ......
      //更多layout设置请参考phpspreadsheet
  }); 
  ```
- 其他设置
  ```
  legend(new Legend(Legend::POSITION_BOTTOM, null, false)), //图表项显示位置， dataset模式默认为该值，其他模式默认为null
  title('图表X轴标题'), 
  subtitle('图表Y轴标题'), 
  chartName('图表名称')
  ```
#### createChart 之后可对 chart 进行自定义设置，具体考 phpspreadsheet

## 支持的图表类型
仅支持折线图，柱状图，饼状图三种类型。其中折线图，柱状图分为两种模式
simple与dataset，两种模式的区别在data与header的结构上，饼状图使用simple模式的结构。  
- simple模式：  
```
$data = [
    [10, 36, 50, 83]
];

$header = [2010, 2011, 2012, 2013];
```

- dataset模式：

```
$data = [
    ['Q1', 12, 15, 21, 33],
    ['Q2', 56, 73, 86, 21],
    ['Q3', 52, 61, 69, 19],
    ['Q4', 30, 32, "0", 80],
];

$header = ['', 2010, 2011, 2012, 2013]
```

## 图表类型扩充  
需要实现3个部分，dataSource, chartSeries, dataCharts

1. dataSource用于设置生成图表项数据的位置
2. chartSeries用于生成不同图表类型的series，依赖dataSource 
3. dataCharts用于生成具体图表，依赖chartSeries

