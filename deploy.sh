#!/bin/bash

$ERRORSTRING="Error. Please make sure you've indicated correct parameters"
if [ $# -eq 0 ]
    then
        echo $ERRORSTRING;
elif [ $1 == "live" ]
    then
        if [[ -z $2 ]]
            then
                echo "Running dry-run"
                rsync --dry-run -az --force --delete --progress --exclude-from=rsync_exclude.txt -e "ssh -p22" ./wordpress/* root@159.65.240.158:/var/www/html
        elif [ $2 == "go" ]
            then
                echo "Running actual deploy"
                rsync -az --force --delete --progress --exclude-from=rsync_exclude.txt -e "ssh -p22" ./wordpress/* root@159.65.240.158:/var/www/html
				ssh root@159.65.240.158 "chown -R www-data:www-data /var/www/html && chmod -R 0755 /var/www/html"

        else
            echo $ERRORSTRING;
        fi
fi
