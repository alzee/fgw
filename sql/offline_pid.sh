#!/bin/bash
#
# vim:ft=sh
# pid add 1000 for offline projects
############### Variables ###############

############### Functions ###############

############### Main Part ###############

pw=dot

a=$(mysql -uroot -p$pw fgw -N -e 'select pid from projects where online=0')

for i in $a
do
	echo $i
	#mysql -uroot -p$pw fgw -e "update projects set pid = 10$i where pid = $i"
	#mysql -uroot -p$pw fgw -e "update progress set pid = 10$i where pid = $i"
done
