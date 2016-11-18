# PHP代码覆盖率的统计

主要用来统计自动化测试脚本对项目接口的代码覆盖率。结合Jenkins做自动化测试。

## 依赖组件

依赖以下组件，安装方法请参考官方文档。

- xdebug
- phpunit
- phpcov
- composer

## 使用说明

使用composer安装依赖库。
```shell
$ composer install
```

修改nginx的server配置，增加fastcgi参数，为项目自动加载预处理文件。
```
fastcgi_param  PHP_VALUE 'auto_prepend_file=/data/htdocs/phpcoverage/prepend.php';
```

重启nginx。
```shell
$ nginx -s reload
```

安装完成后，每次访问将在 `data` 目录生成分析数据。使用 `./make.sh report` 命令可生成HTML报告。
