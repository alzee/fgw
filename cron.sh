#!/bin/bash
# 0 0 * * * /home/dot/w/itove/fgw/cron.sh

d=~/w/itove/fgw/sql/backup
cd $d

i=$(cat db_passwd)
h=${i%%:*}
c=${i#*:}
u=${c%:*}
p=${c#*:}
date=$(date +%d)

if [ "$date" -eq 20 ]; then
	mysql -u$u -p$p -h $h fgw -e "update projects set alert=2"
fi

mysqldump --skip-extended-insert -u$u -p$p -h $h fgw > sql/backup/fgw.sql
git add .
git commit -m "mysqldump"
