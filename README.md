# PHP代码覆盖率的统计

主要用来统计自动化测试脚本对项目接口的代码覆盖率。结合Jenkins做自动化测试。

## 依赖组件

* xdebug

统计代码覆盖率依赖`xdebug`扩展，可以直接使用 `pecl` 安装

	$ pecl install xdebug

然后根据提示编辑 php.ini，开启扩展
	
	zend_extension=xdebug.so

* composer

安装方式有多种，可以参考官网 https://getcomposer.org/download/，项目的 tools 目录已经提供了，可以使用以下方式自行安装。
	
	$ wget https://getcomposer.org/composer.phar
	$ chmod +x composer.phar
	$ mv composer.phar /usr/local/bin/composer

## 使用说明

使用composer安装依赖库，假设clone到 `/data/htdocs/phpcoverage` 目录。

	$ cd /data/htdocs
	$ git clone git@gitlab.mobvista.com:sijie.li/phpcoverage.git
	$ cd phpcoverage
	$ composer install

修改nginx的server配置，增加fastcgi参数，为项目自动加载预处理文件。

	fastcgi_param  PHP_VALUE 'auto_prepend_file=/data/htdocs/phpcoverage/prepend.php';

重启nginx。

	$ nginx -s reload

安装完成后，每次访问将在 `data` 目录生成分析数据。使用 `./make.sh report` 命令可生成HTML报告。

## phpcov

phpcov是PHP_CodeCoverage的命令行工具，用来将记录文件生成统计结果报告。composer 安装完依赖包后，phpcov 位于 vendor/bin/phpcov。

使用方法：

生成XML的覆盖率报告

	$ /data/htdocs/phpcoverage/vendor/bin/phpcov merge --clover clover.xml /data/htdocs/phpcoverage/data -vvv

生成HTML格式的详细报告

	$ /data/htdocs/phpcoverage/vendor/bin/phpcov merge --html="./html" /data/htdocs/phpcoverage/data -vvv

## 目录说明

* data

用来存放每次方式生成的代码覆盖率记录文件。后面可以使用 `phpcov` 根据记录文件生成代码覆盖率报告。需要确保 php-fpm 进程对该目录有写入权限。

* vendor 

使用composer安装会把第三方依赖库都下载到这个目录。

* tools

提供了要用到的工具 composer 和 phpcov，可以直接使用，没有可执行权限的话使用 `chmod +x *` 加上。

