-- 招商服务中心的只需要手续代办情况   只用打点就行了

-- 19和21 责任单位改成武当路街办
update projects set oid = 34 where pid = 19;
update projects set oid = 34 where pid = 21;

-- 36 责任单位改 二堰街办
update projects set oid = 2 where pid = 36;

-- 45 竣工时间 2020
update projects set finish = '2020' where pid = 45;

-- 60 竣工时间 2020
update projects set finish = '2020' where pid = 60;
