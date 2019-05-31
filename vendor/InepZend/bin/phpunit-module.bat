@ECHO OFF
SET BIN_TARGET=%~dp0/../../phpunit/phpunit/phpunit
SET strIpMachineEmec=172.30.7.157
FOR /f "tokens=1-2 delims=:" %%a IN ('ipconfig^|find "IPv4"') DO SET strIp=%%b
SET strIp=%ip:~1%
cd../../../module
FOR /f "tokens=*" %%M IN ('dir /b') DO (
	FOR /f "tokens=*" %%N IN ('dir /b %%M') DO (
        cd %%M/%%N
		IF %%M/%%N == Emec/Emec (
			IF "%strIpMachineEmec%" == "%strIp%" (
				cd test
				php "%BIN_TARGET%" --debug
				cd ../
			)
		) else (
			IF NOT EXIST test (
				echo [%%M/%%N]: nao possui teste unitario
                echo F
			) else (
				IF NOT EXIST test/phpunit.xml (
					echo [%%M/%%N]: nao possui teste unitario
                    echo F
				) else (
					echo [%%M/%%N]: inicio do teste unitario 
                    echo .
					cd test
					php "%BIN_TARGET%" --debug
					cd ../
				)
			)
		)
		cd ../../
	)
)
cd ../vendor/InepZend/bin