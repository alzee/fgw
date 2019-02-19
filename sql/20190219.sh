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
