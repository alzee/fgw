alter table progress add progress_from_jan varchar(1000) default null after progress;

update projects set oid_1 = 3 where pid = 29;
update projects set oid_serve_1 = 3 where pid = 29;
update projects set oid_serve_1 = 84 where pid between 84 and 87;
