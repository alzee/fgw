#!/bin/bash
# 0 0 20 * * /home/dot/w/itove/fgw/cron.sh

i=$(cat db_passwd)
h=${i%%:*}
c=${i#*:}
u=${c%:*}
p=${c#*:}
d=~/w/itove/fgw/

mysql-u$u -p$p -h $h fgw -e "update projects set alert=2"

cd $d
mysqldump -u$u -p$p -h $h fgw > sql/fgw.sql
git add .
git commit -m "mysqldump"
