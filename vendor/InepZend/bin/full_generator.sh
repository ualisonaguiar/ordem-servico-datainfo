#!/usr/bin/env sh
cd ../../zendframework/zendframework/bin/
BIN_TARGET="`pwd`/classmap_generator.php"
cd ../../../InepZend/bin
php "$BIN_TARGET" -ls ../library
php "$BIN_TARGET" -ls ../module
php "$BIN_TARGET" -ls ../theme
cd ../../zendframework/zendframework/bin/
BIN_TARGET="`pwd`/templatemap_generator.php"
cd ../../../InepZend/bin
cd ..
cd module/Application
php "$BIN_TARGET"
cd ..
cd Sqi
php "$BIN_TARGET"
cd ..
cd ..
cd theme
php "$BIN_TARGET" --view "`pwd`/Administrative/view"
php "$BIN_TARGET" -a --view "`pwd`/ConsultaPublica/view"
php "$BIN_TARGET" -a --view "`pwd`/PortalBackgroundCinza2014/view"
php "$BIN_TARGET" -a --view "`pwd`/PortalBackgroundVermelho2013/view"
php "$BIN_TARGET" -a --view "`pwd`/ZendSkeleton/view"
cd ..
cd bin
cd ..
cd ..
cd ..
php composer.phar dumpautoload -o
cd vendor/InepZend/bin
