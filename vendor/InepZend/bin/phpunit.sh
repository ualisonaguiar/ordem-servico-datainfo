#!/usr/bin/env sh
SRC_DIR="`pwd`"
strIpMachineEmec="172.30.7.157"
strIp=$(ip route get 8.8.8.8 | awk '/8.8.8.8/ {print $NF}')
cd "`dirname "$0"`"
cd "../../phpunit/phpunit"
BIN_TARGET="`pwd`/phpunit"
cd "$SRC_DIR"
cd ../../../
if [ "$1" != '' ]; then
    if [[ "$strIp" != "$strIpMachineEmec" ]] && [[ $1 == "Emec/Emec" ]]
    then
        exit 0;
    else
        if [[ -d module/$@/test/ ]] && [[ -e module/$@/test/phpunit.xml ]]
        then
            echo -e [$@]: inicio do teste unitario;
            echo .
            cd module/$@/test/
            php "$BIN_TARGET" --debug --colors
        else
            echo -e [$@]: nao possui teste unitario;
            echo F
        fi        
    fi
    exit 1;
fi
php "$BIN_TARGET" --debug --colors
cd module/InepSkeleton/Publicacao/test/
php "$BIN_TARGET" --debug --colors
if [ "$strIp" == "$strIpMachineEmec" ];
then
    cd ../../../
    cd Emec/Emec/test/
    php "$BIN_TARGET" --debug --colors
fi
cd ../../../../
cd vendor/InepZend/module/UnitTest/test/
php "$BIN_TARGET" --debug --colors
cd ../../../bin