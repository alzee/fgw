#!/bin/bash
#
# vim:ft=sh
#
############### Variables ###############

############### Functions ###############

############### Main Part ###############
i=$(cat db_passwd)
host=${i%%:*}
c=${i#*:}
user=${c%:*}
pw=${c#*:}

### pid add 1000 for offline projects
a=$(mysql -h$host -u$user -p$pw fgw -N -e 'select pid from projects where online=0')

for i in $a
do
	mysql -h$host -u$user -p$pw fgw -e "update projects set pid = $((i+1000)) where pid = $i"
	mysql -h$host -u$user -p$pw fgw -e "update progress set pid = $((i+1000)) where pid = $i"
done

### re-sort pid
a=$(mysql -h$host -u$user -p$pw fgw -N -e "select pid from projects where online = 1")

for i in $a
do
	let j++
	mysql -h$host -u$user -p$pw fgw -e "update projects set pid = $j where pid = $i"
done

### change pid and temporarily set to 500+ to avoid duplication

# 73-87 to 86-100
a=$(mysql -h$host -u$user -p$pw fgw -N -e "select pid from projects where pid between 73 and 87")
for i in $a
do
	mysql -h$host -u$user -p$pw fgw -e "update projects set pid = $((500+i+13)) where pid = $i"
	mysql -h$host -u$user -p$pw fgw -e "update progress set pid = $((500+i+13)) where pid = $i"
done

# 47-72 to 60-85
a=$(mysql -h$host -u$user -p$pw fgw -N -e "select pid from projects where pid between 47 and 72")
for i in $a
do
	mysql -h$host -u$user -p$pw fgw -e "update projects set pid = $((500+i+13)) where pid = $i"
	mysql -h$host -u$user -p$pw fgw -e "update progress set pid = $((500+i+13)) where pid = $i"
done

# 36-46 to 48-58
a=$(mysql -h$host -u$user -p$pw fgw -N -e "select pid from projects where pid between 36 and 46")
for i in $a
do
	mysql -h$host -u$user -p$pw fgw -e "update projects set pid = $((500+i+12)) where pid = $i"
	mysql -h$host -u$user -p$pw fgw -e "update progress set pid = $((500+i+12)) where pid = $i"
done

# 88-99 to 36-47
a=$(mysql -h$host -u$user -p$pw fgw -N -e "select pid from projects where pid between 88 and 99")
for i in $a
do
	mysql -h$host -u$user -p$pw fgw -e "update projects set pid = $((500+i-52)) where pid = $i"
	mysql -h$host -u$user -p$pw fgw -e "update progress set pid = $((500+i-52)) where pid = $i"
done

mysql -h$host -u$user -p$pw fgw -e "update projects set pid = 559 where pid = 100"
mysql -h$host -u$user -p$pw fgw -e "update progress set pid = 559 where pid = 100"


### minus 500

a=$(mysql -h$host -u$user -p$pw fgw -N -e "select pid from projects where pid between 500 and 699")
for i in $a
do
	mysql -h$host -u$user -p$pw fgw -e "update projects set pid = $((i-500)) where pid = $i"
done

