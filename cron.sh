#!/bin/bash
# 5 5 * * * /home/al/w/fgw/cron.sh

d=~/w/fgw/sql/backup
cd $d

. ../../.env
date=$(date +%d)

if [ "$date" -eq 20 ]; then
	mysql -u$user -p$pw -h $host $db -e "update projects set alert=2"
fi

mysqldump --skip-extended-insert -u$user -p$pw -h $host $db > fgw.sql
git add .
git commit -m "mysqldump" --no-gpg-sign
git push &> /dev/null
