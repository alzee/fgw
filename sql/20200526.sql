-- 增加第二责任单位、第二代办单位
alter table projects add oid_1 int(11) after oid;
alter table projects add oid_serve_1 int(11) after oid_serve;

-- 7号项目代办单位增加 东城开发区(1)
---- 7号项目 手续办理情况 增加填报权限: 东城开发区
update projects set oid_serve_1 = 1 where pid = 7;
-- 24号项目代办单位增加 百强世纪城项目协调服务指挥部(39)
---- 24号项目 手续办理情况 增加填报权限: 百强世纪城项目协调服务指挥部
update projects set oid_serve_1 = 39 where pid = 24;
-- 25号项目责任单位增加 五堰街办(3)
---- 25号项目 项目实施情况 增加填报权限: 五堰街办
update projects set oid_1 = 3 where pid = 25;
-- 33号项目代办单位由原 区民政局(21) 更换成 区建设投资管理办公室(74)
---- 33号项目 代办单位 由原 区民政局 更换成 区建设投资管理办公室
update projects set oid_serve = 74 where pid = 33;
-- 53号项目代办单位增加 区城区改造更新中心(84)
---- 53号项目 手续办理情况 增加填报权限: 区城区改造更新中心
update projects set oid_serve_1 = 84 where pid = 53;
-- 54号项目代办单位增加 区住建局(6)
---- 54号项目 手续办理情况 增加填报权限: 区住建局
update projects set oid_serve_1 = 6 where pid = 54;
-- 55号项目代办单位增加 区交通局(4)
---- 55号项目 手续办理情况 增加填报权限: 区交通局
update projects set oid_serve_1 = 4 where pid = 55;
-- 56号项目代办单位增加 区住建局(6)
---- 56号项目 手续办理情况 增加填报权限: 区住建局
update projects set oid_serve_1 = 6 where pid = 56;
-- 57号项目代办单位增加 区住建局(6)
---- 57号项目 手续办理情况 增加填报权限: 区住建局
update projects set oid_serve_1 = 6 where pid = 57;
-- 58号项目代办单位增加 区住建局(6)
---- 58号项目 手续办理情况 增加填报权限: 区住建局
update projects set oid_serve_1 = 6 where pid = 58;
-- 59号项目代办单位增加 区住建局(6)
---- 59号项目 手续办理情况 增加填报权限: 区住建局
update projects set oid_serve_1 = 6 where pid = 59;
-- 63号项目代办单位由原 区住建局(6) 更换成 区建设投资管理办公室(74)
---- 63号项目 代办单位 由原 区住建局 更换成 区建设投资管理办公室
update projects set oid_serve = 74 where pid = 63;
-- 71号项目代办单位增加 区住建局(6)
---- 71号项目 手续办理情况 增加填报权限: 区住建局
update projects set oid_serve_1 = 6 where pid = 71;
-- 72号项目代办单位由原 林荫大道二号线建设工程指挥部(32) 更换成 区建设投资管理办公室(74)
---- 72号项目 代办单位 由原 林荫大道二号线建设工程指挥部 更换成 区建设投资管理办公室
update projects set oid_serve = 74 where pid = 72;
-- 73号项目代办单位增加 东城开发区(1)
---- 73号项目 手续办理情况 增加填报权限: 东城开发区
update projects set oid_serve_1 = 1 where pid = 73;
-- 74-77号项目代办单位由原  许白路沿线拆迁安置区及土地归集整理项目指挥部(62) 更换成 区城区改造更新中心(84)
---- 74-77号项目 代办单位 由原 许白路沿线拆迁安置区及土地归集整理项目指挥部 更换成 区城区改造更新中心
update projects set oid_serve = 84 where pid between 74 and 77;
-- 86号项目代办单位增加 区教育局(17)
---- 86号项目 手续办理情况 增加填报权限: 区教育局
update projects set oid_serve_1 = 17 where pid = 86;
-- 95号项目责任单位、代办单位由原 自然资源和规划局茅箭分局(76) 更换成 区城区改造更新中心(84)
---- 95号项目 责任单位、代办单位 由原 自然资源和规划局茅箭分局 更换成 区城区改造更新中心
update projects set oid = 84, oid_serve = 84 where pid = 95;
-- 96号项目代办单位由原 自然资源和规划局茅箭分局(76) 更换成 区城区改造更新中心(84)
---- 96号项目 代办单位 由原 自然资源和规划局茅箭分局 更换成 区城区改造更新中心
update projects set oid_serve = 84 where pid = 96;

-- 刘局修改
-- 60号项目代办单位增加 二堰街办(2)
---- 60号项目 手续办理情况 增加填报权限: 二堰街办
update projects set oid_serve_1 = 2 where pid = 60;
-- 66号项目代办单位增加 区交通局(4)
---- 66号项目 手续办理情况 增加填报权限: 区交通局
update projects set oid_serve_1 = 4 where pid = 66;

-- 区卫计局(9) 更名为 区卫健局; 账号 weiji 修改成 weijian
update organization set oname = '区卫健局' where oid = 9;
update users set uname = 'weijian' where uname = 'weiji';
-- 区文体新广局(18) 更名为 区文化和旅游局
update organization set oname = '区文化和旅游局' where oid = 18;
-- 删除 区水利局(22) (已更名为区水利湖泊局(82)); 原账号 shuili oid 改为 82
update organization set oname = '000' where oid = 22;
update users set oid = 82 where uname = 'shuili';
-- 区科技局(24) 更名为 区科经局; 账号 keji 修改成 kejing
update organization set oname = '区科经局' where oid = 24;
update users set uname = 'kejing' where uname = 'keji';

-- 增加账号
-- tongzhan(区委统战部71)
-- yingji(区应急管理局70)
-- shichang(区市场监督管理局66)
-- shuiziyuan(百二河水资源配置工程建设协调服务领导小组73)
-- dfyd(东方伊顿学校建设项目协调指挥部78)
-- zigui(自然资源和规划局茅箭分局76)
insert into users (uname, passwd, oid, rid) values
('tongzhan', md5(123), 71, 1),
('yingji', md5(123), 70, 1),
('shichang', md5(123), 66, 1),
('shuiziyuan', md5(123), 73, 1),
('dfyd', md5(123), 78, 1),
('zigui', md5(123), 76, 1);

-- 删除项目名称中换行
update projects set pname = replace(pname, '\n' , '');
-- 删除包联领导中空格
update projects set p_incharge = replace(p_incharge, ' ' , '');
-- 将包联领导中逗号替换为空格
update projects set p_incharge = replace(p_incharge, '\,' , ' ');
