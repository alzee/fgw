-- 区科经局(24) 和 区科学技术和经济信息化局(65) 重复
-- 均无责任项目，只有(65)有代办项目，将 (65) 的代办项目转至 (24)
-- 清除 (65)，保留 (24)
update projects set oid_serve = 24 where oid_serve = 65;
update organization set oname = '001' where oid = 65;

-- 108 号项目 责任单位 和 代办单位 由原 区民政局(21) 变更为 区卫健局(9)
update projects set oid = 9 , oid_serve = 9 where pid = 108;

-- 78 和 79 号项目 代办单位 增加 区卫健局(9)
update projects set oid_serve_1 = 9 where pid in (78, 79);

-- 区文化和旅游局(18) 和 区文化旅游局(81) 重复
-- 清除 (18)，保留 (81)
-- 原单位为 (18) 的账号 单位变更为 (81)
update organization set oname = '002' where oid = 18;
update users set oid = 81 where oid = 18;
