#!/bin/bash

cd ../

if [ -d "public" ]; then
    rm -rf public/vendor
fi

if [ -d "vendor" ]; then
    rm -rf vendor
fi

if [ -e "composer.phar" ]; then
    rm composer.lock
    php composer.phar update --no-autoloader
fi

if [ -d "config" ]; then
    cd config
    # autoload
    if [ -d "autoload" ]; then
        for nameFile in ../inepvendor-config-tmp/autoload/*; do
            nameFile=`echo $nameFile | sed -e "s/..\/inepvendor-config-tmp\///g"`
            if [ ! -e "config/$nameFile" ]; then
                `cp ../inepvendor-config-tmp/$nameFile $nameFile`
            fi
        done
    fi

    # complement
    if [ -d "complement" ]; then
        for nameFile in ../inepvendor-config-tmp/complement/*; do
            nameFile=`echo $nameFile | sed -e "s/..\/inepvendor-config-tmp\///g"`
            if [ ! -e "$nameFile" ]; then
                `cp ../inepvendor-config-tmp/$nameFile $nameFile`
            fi
        done
    fi

    if [ ! -e "application.config.php" ]; then
        `cp ../inepvendor-config-tmp/application.config.php application.config.php`
    fi
    rm -rf ../inepvendor-config-tmp/
fi
cd ../bin
