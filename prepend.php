<?php
require_once __DIR__ . '/vendor/autoload.php';

$filter = new PHP_CodeCoverage_Filter;
// 添加文件夹白名单，一般设为应用的业务代码目录，不设置则统计所有文件
$filter->addDirectoryToWhitelist('application/controllers');
$filter->addDirectoryToWhitelist('application/services');
$filter->addDirectoryToWhitelist('application/models');
// 初始化覆盖率工具
$coverage = new PHP_CodeCoverage(new PHP_CodeCoverage_Driver_Xdebug, $filter);
// 开始统计
$coverage->start('Site coverage');
// 注册处理函数
register_shutdown_function(function (PHP_CodeCoverage $coverage) {
	$coverage->stop();
    $savePath = __DIR__ . '/data';
    $cov = '<?php return unserialize(' . var_export(serialize($coverage), true) . ');';
    file_put_contents(__DIR__ . '/data/site.' . date('U') .'.'.uniqid(). '.cov', $cov);
}, $coverage);
