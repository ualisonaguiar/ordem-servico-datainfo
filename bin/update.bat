@echo off
set HTTPS_PROXY=http://proxy.inep.gov.br:8080
set HTTP_PROXY=http://proxy.inep.gov.br:8080
cd ..
IF EXIST public (
    cd public
    IF EXIST vendor (
        rd vendor /s /q
    )
    cd ..
)
IF EXIST vendor (
    rd vendor /s /q
)
IF EXIST composer.phar (
    php composer.phar update --no-autoloader
)
IF EXIST config (	
	IF EXIST inepvendor-config-tmp (
		::raiz
		cd inepvendor-config-tmp
		IF NOT EXIST ../config/application.config.php (
			copy "application.config.php" "../config/application.config.php" >nul
		)
		::autoload
		IF EXIST ../config/autoload (
			cd autoload
			for /f "tokens=*" %%G in ('dir /b') do (
				IF NOT EXIST ../../config/autoload/%%G (
					copy %%G "../../config/autoload/%%G" >nul
				)
			)
			cd ..
		)		
		::complement
		IF EXIST ../config/complement (
			cd complement
			for /f "tokens=*" %%G in ('dir /b') do (
				IF NOT EXIST ../../config/complement/%%G (				
					copy %%G "../../config/complement/%%G" >nul
				)
			)
			cd ..
		)		
		cd ..
	)
	rd inepvendor-config-tmp /s /q
)
cd bin