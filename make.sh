#!/bin/bash

if [ "$1" == "report" ]; then
    php ./vendor/bin/phpcov merge --html="./html" ./data -vvv
    exit 0
fi

if [ "$1" == "clean" ]; then
    rm -f ./data/*
    rm -rf ./html
    echo "done!"
    exit 0
fi

echo "Usage: $0 [report|clean]"
echo "report   -- 生成HTML报告."
echo "clean    -- 清除数据."
