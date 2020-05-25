-- 区卫生健康局 更名为 区卫健局
update organization set oname = '区卫健局' where oid = 67;

-- 新增两个单位 区城区改造更新中心 和 区建设投资管理办公室
-- 原 74 是 区水利湖泊局 ，与 82 重复
update organization set oname = '区建设投资管理办公室' where oid = 74;
insert into organization (oname) values ('区城区改造更新中心');


-- 为两个新增单位创建账号
insert into users (uname, passwd, oid, rid) values ('jianshetouzi', md5(123), 74, 1), ('gaizao', md5(123), 84, 1);

