#!/usr/bin/env sh
php list-module.php > module.txt
while read strModule
do
    if [ "$strModule" != "" ]; then
        ls ../../../module/$strModule > namespace.txt
        while read strNamespace
        do
            sh phpunit.sh $strModule/$strNamespace;
            echo -e ""
        done < namespace.txt
    fi
done < module.txt
rm module.txt
rm namespace.txt