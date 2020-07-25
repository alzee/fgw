-- 44 号项目总投资改为 7800 万
update projects set invest_plan = 7800 where pid = 44;

-- 66 号项目总投资改为 37500 万
update projects set invest_plan = 37500 where pid = 66;

-- 70 茅塔乡廖家村百花沟通组路改扩建工程，全长2.6公里；东沟红色教育基地环形公路改扩建工程，全长1.2公里，路面宽5.5米；阳坡村三组何家院安置点危桥改造，长50米宽6米；全区通组入户道路建设“以奖代补”，全长约10公里。
-- 总投资 1890 万
update projects set invest_plan = 1890 where pid = 70;
update projects set intro = '茅塔乡廖家村百花沟通组路改扩建工程，全长2.6公里；东沟红色教育基地环形公路改扩建工程，全长1.2公里，路面宽5.5米；阳坡村三组何家院安置点危桥改造，长50米宽6米；全区通组入户道路建设“以奖代补”，全长约10公里。' where pid = 70;
