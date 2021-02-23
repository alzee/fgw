-- 区卫健局重复
update projects set oid_serve = 9 where oid_serve = 67;
update organization set oname = '003' where oid = 67;

update organization set oname = '东城经济开发区税务分局' where oid = 22;
update projects set oid_serve_1 = 22 where pid = 18;
