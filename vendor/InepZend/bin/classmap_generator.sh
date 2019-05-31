#!/usr/bin/env sh
cd ../../zendframework/zendframework/bin/
BIN_TARGET="`pwd`/classmap_generator.php"
cd ../../../InepZend/bin
php "$BIN_TARGET" -ls ../library
php "$BIN_TARGET" -ls ../module
php "$BIN_TARGET" -ls ../theme