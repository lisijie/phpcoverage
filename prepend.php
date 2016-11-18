<?php
require_once __DIR__ . '/vendor/autoload.php';

$filter = new PHP_CodeCoverage_Filter;
// $filter->addDirectoryToWhitelist('xxx');#添加文件夹白名单
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
