insert into organization (id,oname) values
(102,'区农村经济管理局'),
(104,'茅箭区城市文明创建中心'),
(104,'区畜牧兽医服务中心'),
(105,'区残联'),
(106,'区蔬菜办'),
(107,'区劳动保障监察局');

insert into users (uname, passwd, oid, rid) values
('ncjj', md5(123), 102, 1),
('cswm', md5(123), 103, 1),
('xmj', md5(123), 104, 1),
('canlian', md5(123), 105, 1),
('shucai', md5(123), 106, 1),
('ldbz', md5(123), 107, 1);
