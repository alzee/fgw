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


### add more organizations
mysql -h$host -u$user -p$pw fgw -N -e "\
insert into organization values
(44,'茅箭区重资产建设工作领导小组'),
(45,'区委办'),
(46,'区政府办'),
(47,'区工商联'),
(48,'区政协办'),
(49,'区经管局'),
(50,'区编办'),
(51,'区畜牧局'),
(52,'区机关事务管理局'),
(53,'区综合执法局'),
(54,'区人大办'),
(55,'区直机关工委'),
(56,'区社保局'),
(57,'区总工会'),
(58,'区妇联'),
(59,'区委党校'),
(60,'区棚改办'),
(61,'G209十堰城区垭子至大川段改扩建工程征迁协调指挥部'),
(62,'许白路沿线拆迁安置区及土地归集整理项目指挥部'),
(63,'区就业局'),
(64,'区六边办');
"
