<?php
require_once dirname(__FILE__).'/vendor/autoload.php';

$filter=new PHP_CodeCoverage_Filter; #初始化筛选器
//$filter->addDirectoryToWhitelist('/data/wwwroot/net/phpfw/script/classes/Mob/Adn');#添加文件夹白名单
$coverage = new PHP_CodeCoverage(new PHP_CodeCoverage_Driver_Xdebug,$filter);#初始化覆盖率工具
$coverage->start('Site coverage');#开始统计
register_shutdown_function('__coverage_stop',$coverage);#注册关闭方法

function __coverage_stop(PHP_CodeCoverage $coverage){
    $coverage->stop();#停止统计
    $savePath = dirname(__FILE__) . '/data/cov';
    mkdir($savePath, 0755, true);
    $cov = '<?php return unserialize(' . var_export(serialize($coverage), true) . ');';#获取覆盖结果，注意使用了反序列化
    file_put_contents($savePath.'/site.' . date('U') .'.'.uniqid(). '.cov', $cov);#将结果写入到文件中
}

