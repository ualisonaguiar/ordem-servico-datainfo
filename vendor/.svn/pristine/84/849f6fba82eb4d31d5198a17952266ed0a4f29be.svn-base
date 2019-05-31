@ECHO OFF
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