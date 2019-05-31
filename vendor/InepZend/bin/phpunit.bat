@ECHO OFF
SET BIN_TARGET=%~dp0/../../phpunit/phpunit/phpunit
cd..
cd..
cd..
php "%BIN_TARGET%"  --debug
cd module/InepSkeleton/Publicacao/test/
php "%BIN_TARGET%"  --debug
cd..
cd..
cd..
cd Emec/Emec/test/
REM php "%BIN_TARGET%"  --debug
cd..
cd..
cd..
cd..
cd vendor/InepZend/module/UnitTest/test/
php "%BIN_TARGET%"  --debug
cd..
cd..
cd..
cd bin