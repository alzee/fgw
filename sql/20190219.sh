#!/bin/bash
#
# vim:ft=sh

############### Variables ###############

############### Functions ###############

############### Main Part ###############
i=$(cat db_passwd)
host=${i%%:*}
c=${i#*:}
user=${c%:*}
pw=${c#*:}

### all projects offline
mysql -h$host -u$user -p$pw fgw -N -e 'update projects set online = 0'

### pid add 180000 for offline projects, 18 means 2018
a=$(mysql -h$host -u$user -p$pw fgw -N -e 'select pid from projects')

for i in $a
do
	mysql -h$host -u$user -p$pw fgw -e "update projects set pid = $((i+180000)) where pid = $i"
	mysql -h$host -u$user -p$pw fgw -e "update progress set pid = $((i+180000)) where pid = $i"
done
