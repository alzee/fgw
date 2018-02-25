truncate users;
insert into users (uname, passwd, oid, rid) values
	('zhong',		'202cb962ac59075b964b07152d234b70',1,3),
	('gong',		'202cb962ac59075b964b07152d234b70',1,3),
	('tou',			'202cb962ac59075b964b07152d234b70',1,3),
	('lingdao',		'202cb962ac59075b964b07152d234b70',1,2),
	('nong',		'202cb962ac59075b964b07152d234b70',1,3),
	('ban',			'202cb962ac59075b964b07152d234b70',1,3),
	('jiao',		'202cb962ac59075b964b07152d234b70',1,3),
	('she',			'202cb962ac59075b964b07152d234b70',1,3),
	('diqu',		'202cb962ac59075b964b07152d234b70',1,3),
	('caizheng',	'202cb962ac59075b964b07152d234b70',2,1),
	('jiaoyu',		'202cb962ac59075b964b07152d234b70',3,1),
	('nongye',		'202cb962ac59075b964b07152d234b70',4,1),
	('jiaotong',	'202cb962ac59075b964b07152d234b70',5,1),
	('wujia',		'202cb962ac59075b964b07152d234b70',6,1),
	('zhaoshang',	'202cb962ac59075b964b07152d234b70',7,1),
	('jingxin',		'202cb962ac59075b964b07152d234b70',8,1),
	('keji',		'202cb962ac59075b964b07152d234b70',9,1),
	('shangwu',		'202cb962ac59075b964b07152d234b70',10,1),
	('ludeng',		'202cb962ac59075b964b07152d234b70',11,1),
	('tongji',		'202cb962ac59075b964b07152d234b70',12,1);

truncate organization;
insert into organization (uid,oname) values
	(1, '东城开发区'),
	(2, '二堰街办'),
	(3, '五堰街办'),
	(4, '区交通局'),
	(5, '区人社局'),
	(6, '区住建局'),
	(7, '区农业局'),
	(8, '区南调办'),
	(9, '区卫计局'),
	(10, '区发改局'),
	(11, '区司法局'),
	(12, '区商务局'),
	(13, '区城投公司'),
	(14, '区安监局'),
	(15, '区审计局'),
	(16, '区扶贫办'),
	(17, '区教育局'),
	(18, '区文体新广局'),
	(19, '区旅游局'),
	(20, '区林业局'),
	(21, '区民政局'),
	(22, '区水利局'),
	(23, '区物价局'),
	(24, '区科技局'),
	(25, '区经信局'),
	(26, '区统计局'),
	(27, '区行政审批局'),
	(28, '区财政局'),
	(29, '区食品药品监督局'),
	(30, '大川镇'),
	(31, '朝北沟生态国土综合治理示范项目指挥部'),
	(32, '林荫大道二号线建设工程指挥部'),
	(33, '武当路复线等市政道路PPP项目建设拆迁协调服务领导小组'),
	(34, '武当路街办'),
	(35, '武汉至十堰城际铁路茅箭段项目建设协调服务指挥部'),
	(36, '滨江新区至武当山玄岳门一级公路建设茅箭段协调指挥部'),
	(37, '火车站北广场项目协调服务指挥部'),
	(38, '环保茅箭分局'),
	(39, '百强世纪城项目协调服务指挥部'),
	(40, '茅塔乡'),
	(41, '许白路沿线环境整治指挥部'),
	(42, '赛曼控股集团（茅箭）投资项目协调服务指挥部'),
	(43, '赛管局');

truncate projects;
--
-- table `projects` inserted by uploading spreadsheet
--
source /home/dot/w/it/fgw/sql/projects.sql; -- or source this
update projects SET type='工业' WHERE pid BETWEEN 1 and 42;
update projects SET type='商贸' WHERE pid BETWEEN 43 and 55;
update projects SET type='基建' WHERE pid BETWEEN 56 and 83;
update projects SET type='美丽乡村' WHERE pid BETWEEN 84 and 100;
--update projects set oid=8 where o_incharge like "%经信局%";
--update projects set oid=9 where o_incharge like "%科技局%";
--update projects set oid=10 where o_incharge like "%商务局%";
--update projects set oid=1 where o_incharge like "%东城%";
--update projects set oid=2 where o_incharge like "%%";

truncate progress;
insert into progress (pid) select pid from projects;
update progress set fill_state="abc", phase="开工", fillby="一八年一月", phone="13920180001", progress="2018年1月进度进度进度进度进度进度进度", problem="2018年1月问题问题问题问题问题问题问题问题", invest_mon="50000", limit_start="2017-2", limit_end="2019-8";
insert into progress (pid,date,fillby,phone,progress,problem,invest_mon) values('33', '2017-1-25', 	'一七年一月', 	'13920170001', '2017年1月进度进度进度进度','2017.1问题问题问题问题问题问题',1000);
insert into progress (pid,date,fillby,phone,progress,problem,invest_mon) values('33', '2017-2-25', 	'一七年二月', 	'13920170002', '2017年2月进度进度进度进度','2017.2问题问题问题问题问题问题',2000);
insert into progress (pid,date,fillby,phone,progress,problem,invest_mon) values('33', '2017-3-25', 	'一七年三月', 	'13920170003', '2017年3月进度进度进度进度','2017.3问题问题问题问题问题问题',3000);
insert into progress (pid,date,fillby,phone,progress,problem,invest_mon) values('33', '2017-4-25', 	'一七年四月', 	'13920170004', '2017年4月进度进度进度进度','2017.4问题问题问题问题问题问题',4000);
insert into progress (pid,date,fillby,phone,progress,problem,invest_mon) values('33', '2017-5-25', 	'一七年五月', 	'13920170005', '2017年5月进度进度进度进度','2017.5问题问题问题问题问题问题',5000);
insert into progress (pid,date,fillby,phone,progress,problem,invest_mon) values('33', '2017-6-25', 	'一七年六月', 	'13920170006', '2017年6月进度进度进度进度','2017.6问题问题问题问题问题问题',6000);
insert into progress (pid,date,fillby,phone,progress,problem,invest_mon) values('33', '2017-7-25', 	'一七年七月', 	'13920170007', '2017年7月进度进度进度进度','2017.7问题问题问题问题问题问题',7000);
insert into progress (pid,date,fillby,phone,progress,problem,invest_mon) values('33', '2017-8-25', 	'一七年八月', 	'13920170008', '2017年8月进度进度进度进度','2017.8问题问题问题问题问题问题',8000);
insert into progress (pid,date,fillby,phone,progress,problem,invest_mon) values('33', '2017-9-25', 	'一七年九月', 	'13920170009', '2017年9月进度进度进度进度','2017.9问题问题问题问题问题问题',9000);
insert into progress (pid,date,fillby,phone,progress,problem,invest_mon) values('33', '2017-10-25', 	'一七年十月', 	'13920170010', '2017年10月进度进度进度进度','2017.10问题问题问题问题问题问题',10000);
insert into progress (pid,date,fillby,phone,progress,problem,invest_mon) values('33', '2017-11-25', 	'一七年十一月', '13920170011', '2017年11月进度进度进度进度','2017.11问题问题问题问题问题问题',11000);
insert into progress (pid,date,fillby,phone,progress,problem,invest_mon) values('33', '2017-12-25', 	'一七年十二月', '13920170012', '2017年12月进度进度进度进度','2017.12问题问题问题问题问题问题',12000);

truncate setting;
INSERT INTO `setting` (`sid`, `s_key`, `value`, `sname`) VALUES
(1, 'lockday', '25', '锁定日期'),
(2, 'sitename', '茅箭区投资项目直报平台', '网站名称'),
(3, 'remind_days', '5', '提醒天数'),
(4, 'pics', '5', '图片张数'),
(5, 'index', 'project', '默认首页');

truncate role;
INSERT INTO `role` (`rid`, `role`, `rname`) VALUES
(1, 'user', '填报'),
(2, 'admin', '检阅'),
(3, 'super', '管理');
