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

#
#
#### pid add 191000 for online projects, 191 means 2019 1st modification
a=$(mysql -h$host -u$user -p$pw fgw -N -e 'select pid from projects where pid<200')
#
for i in $a
do
	mysql -h$host -u$user -p$pw fgw -e "update projects set pid = $((i+191000)) where pid = $i"
	mysql -h$host -u$user -p$pw fgw -e "update progress set pid = $((i+191000)) where pid = $i"
	mysql -h$host -u$user -p$pw fgw -e "update path set pid = $((i+191000)) where pid = $i"
	mysql -h$host -u$user -p$pw fgw -e "update pproc set pid = $((i+191000)) where pid = $i"
done
#
#
#### add more organizations
mysql -h$host -u$user -p$pw fgw -N -e "\
insert into organization values
(65,'区科学技术和经济信息化局'),
(66,'区市场监督管理局'),
(67,'区卫生健康局'),
(68,'区委宣传部'),
(69,'区医疗保障局'),
(70,'区应急管理局'),
(71,'区委统战部'),
(72,'区委组织部'),
(73,'百二河水资源配置工程建设协调服务领导小组'),
(74,'区水利湖泊局'),
(75,'区城市管理执法局'),
(76,'自然资源和规划局茅箭分局'),
(77,'南水北调水源区保护中心'),
(78,'十堰市东方伊顿学校建设项目协调指挥部'),
(79,'茅箭区电力基础设施项目建设指挥部'),
(80,'区农业农村局'),
(81,'区文化旅游局'),
(82,'区水利湖泊局');
"
#### now projects in $a go offline
mysql -h$host -u$user -p$pw fgw -N -e 'update projects set online = 0'
