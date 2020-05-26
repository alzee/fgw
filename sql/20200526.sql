alter table projects add oid_1 int(11) after oid;
alter table projects add oid_serve_1 int(11) after oid_serve;

-- 7号项目代办单位增加 东城开发区(1)
update projects set oid_serve_1 = 1 where pid = 7;

-- 24号项目代办单位增加 百强世纪城项目协调服务指挥部(39)
update projects set oid_serve_1 = 39 where pid = 24;
-- 25号项目责任单位增加 五堰街办(3)
update projects set oid_1 = 3 where pid = 25;

-- 33号项目代办单位由原 区民政局(21) 更换成 区建设投资管理办公室(74)
update projects set oid_serve = 74 where pid = 33;

-- 53号项目代办单位增加 区城区改造更新中心(84)
update projects set oid_serve_1 = 84 where pid = 53;

-- 54号项目代办单位增加 区住建局(6)
update projects set oid_serve_1 = 6 where pid = 54;
-- 55号项目代办单位增加 区交通局(4)
update projects set oid_serve_1 = 4 where pid = 55;
-- 56号项目代办单位增加 区住建局(6)
update projects set oid_serve_1 = 6 where pid = 56;
-- 57号项目代办单位增加 区住建局(6)
update projects set oid_serve_1 = 6 where pid = 57;
-- 58号项目代办单位增加 区住建局(6)
update projects set oid_serve_1 = 6 where pid = 58;
-- 59号项目代办单位增加 区住建局(6)
update projects set oid_serve_1 = 6 where pid = 59;

-- 63号项目代办单位由原 区住建局(6) 更换成 区建设投资管理办公室(74)
update projects set oid_serve = 74 where pid = 63;

-- 71号项目代办单位增加 区住建局(6)
update projects set oid_serve_1 = 6 where pid = 71;

-- 72号项目代办单位由原 林荫大道二号线建设工程指挥部(32) 更换成 区建设投资管理办公室(74)
update projects set oid_serve = 74 where pid = 72;

-- 73号项目代办单位增加 东城开发区(1)
update projects set oid_serve_1 = 1 where pid = 73;

-- 74-77号项目代办单位由原  许白路沿线拆迁安置区及土地归集整理项目指挥部(62) 更换成 区城区改造更新中心(84)
update projects set oid_serve = 84 where pid between 74 and 77;

-- 86号项目代办单位增加 区教育局(17)
update projects set oid_serve_1 = 17 where pid = 86;

-- 95号项目责任单位、代办单位由原 自然资源和规划局茅箭分局(76) 更换成 区城区改造更新中心(84)
update projects set oid = 84, oid_serve = 84 where pid = 95;

-- 96号项目代办单位由原 自然资源和规划局茅箭分局(76) 更换成 区城区改造更新中心(84)
update projects set oid_serve = 84 where pid = 96;


-- 7号项目 手续办理情况 增加填报权限: 东城开发区
-- 24号项目 手续办理情况 增加填报权限: 百强世纪城项目协调服务指挥部
-- 25号项目 项目实施情况 增加填报权限: 五堰街办
-- 33号项目 代办单位 由原 区民政局 更换成 区建设投资管理办公室
-- 53号项目 手续办理情况 增加填报权限: 区城区改造更新中心
-- 54号项目 手续办理情况 增加填报权限: 区住建局
-- 55号项目 手续办理情况 增加填报权限: 区交通局
-- 56号项目 手续办理情况 增加填报权限: 区住建局
-- 57号项目 手续办理情况 增加填报权限: 区住建局
-- 58号项目 手续办理情况 增加填报权限: 区住建局
-- 59号项目 手续办理情况 增加填报权限: 区住建局
-- 63号项目 代办单位 由原 区住建局 更换成 区建设投资管理办公室
-- 71号项目 手续办理情况 增加填报权限: 区住建局
-- 72号项目 代办单位 由原 林荫大道二号线建设工程指挥部 更换成 区建设投资管理办公室
-- 73号项目 手续办理情况 增加填报权限: 东城开发区
-- 74-77号项目 代办单位 由原 许白路沿线拆迁安置区及土地归集整理项目指挥部 更换成 区城区改造更新中心
-- 86号项目 手续办理情况 增加填报权限: 区教育局
-- 95号项目 责任单位、代办单位 由原 自然资源和规划局茅箭分局 更换成 区城区改造更新中心
-- 96号项目 代办单位 由原 自然资源和规划局茅箭分局 更换成 区城区改造更新中心
