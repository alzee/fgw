-- 50号项目 代办单位 由原 区住建局(6) 更换成 区城市管理执法局(75)
update projects set oid_serve = 75 where pid = 50;

-- 92号项目 计划开工时间 由原 2019 改为 2020， 计划竣工时间 由原 2020 改为 2021
--update projects set start = '2020', finish = '2021' where pid = 92;

-- 92号项目 计划开工时间 由原 2020 改为 2019， 计划竣工时间 由原 2021 改为 2020 by 贺晓斌
update projects set start = '2019', finish = '2020' where pid = 92;
