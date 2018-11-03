#!/bin/bash
#
# vim:ft=sh
# re-sort pid
############### Variables ###############

############### Functions ###############

############### Main Part ###############
pw=dot

a=$(mysql -uroot -p$pw fgw -N -e "select pid from projects where online = 1")

#echo $a

for i in $a
do
	let j++
	mysql -uroot -p$pw fgw -e "update projects set pid = $j where pid = $i"
done
