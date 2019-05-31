@ECHO OFF
SET BIN_TARGET=%~dp0/../../zendframework/zendframework/bin/classmap_generator.php
php "%BIN_TARGET%" -l "%~dp0/../library"
php "%BIN_TARGET%" -l "%~dp0/../module"
php "%BIN_TARGET%" -l "%~dp0/../theme"
SET BIN_TARGET=%~dp0/../../zendframework/zendframework/bin/templatemap_generator.php
cd..
cd module/Application
php "%BIN_TARGET%"
cd..
cd Sqi
php "%BIN_TARGET%"
cd..
cd..
cd theme
REM ["%~dp0/../Administrative/view"]
php "%BIN_TARGET%" --view "%~dp0/../theme/Administrative/view"
php "%BIN_TARGET%" -a --view "%~dp0/../theme/ConsultaPublica/view"
php "%BIN_TARGET%" -a --view "%~dp0/../theme/PortalBackgroundCinza2014/view"
php "%BIN_TARGET%" -a --view "%~dp0/../theme/PortalBackgroundVermelho2013/view"
php "%BIN_TARGET%" -a --view "%~dp0/../theme/ZendSkeleton/view"
cd..
cd bin
cd..
cd..
cd..
php composer.phar dumpautoload -o
cd vendor/InepZend/bin