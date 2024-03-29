<?php
require $inc . 'header.php';
use App\Db;
/*
$sql = "select pid, p.oid, pname, investment, o.oname, p_incharge, o_s.oname oname_serve, alert, type
    from projects p left join (organization o, organization o_s, organization o_1, organization o_2, organization o_s_1)
    on (p.oid = o.oid and p.oid_serve = o_s.oid and p.oid_1 = o_1.oid and p.oid_2 = o_2.oid and p.oid_serve_1 = o_s_1.oid)
    where p.online=1 order by pid";
 */
$sql = "select pid, p.oid, oid_1, pname, investment, o.oname, p_incharge, o_s.oname oname_serve, alert, type
    from projects p join (organization o, organization o_s)
    on (p.oid = o.oid and p.oid_serve = o_s.oid)
    where p.online=1 order by pid";
$p_rows = (new Db)->query($sql);

$sql = "select type,count(*) as count from projects group by type;";
$types = (new Db)->query($sql);

$oid = $_SESSION['oid'];

$myproj_btn = 'btn-outline-info';
?>

	  <div class="container" id="projects">
		  <nav aria-label="breadcrumb" class="">
			  <div class="">
				  <ol class="breadcrumb">
				  <li class="breadcrumb-item"><a href="/home">首 页</a></li>
					  <li class="breadcrumb-item active" aria-current="page">重点项目</li>
				  </ol>
			  </div>
		  </nav>
		<section class="row">
			<aside class="col-md-auto">
				<div class="list-group">
				  <a href="#" class="list-group-item list-group-item-action">公告通知</a>
				  <a href="/invest" class="list-group-item list-group-item-action">固定资产投资</a>
				  <a href="/project" class="list-group-item list-group-item-action active">重点项目进展</a>
				  <a href="/admin" class="list-group-item list-group-item-action">设置</a>
				</div>
			</aside>

		  <main class="col-md mt-2">
		  <div class="row mb-2">
			  <div class="col-sm">
				  <!--
				  <span class="badge badge-success">已完成</span>
				  -->
				  <span class="badge badge-warning">数据与上月雷同</span>
				  <span class="badge badge-danger">本月尚未提交</span>
			  </div>
<?php if ($rid == 0): ?>
			  <div class="col-auto col-sm-auto pr-0 mt-1 mt-sm-0">
				  <a id="newproject" class="btn btn-sm btn-info" href="/newproject">新增项目</a>
			  </div>
<?php endif ?>
			  <div class="col-auto col-sm-auto pr-0 mt-1 mt-sm-0">
				  <a class="btn btn-sm btn-info" href="/stat">统计报表</a>
			  </div>

			  <div class="col-auto col-sm-auto pr-0 mt-1 mt-sm-0">
				  <button id="myproject" type="button" class="btn btn-sm <?= $myproj_btn ?>" data-oid="<?= $oid ?>">
					我的项目 <span class="badge badge-danger" id="count_my"></span>
				  </button>
			  </div>

			<div class="col-auto pr-0 dropdown mt-1 mt-sm-0">
			  <button class="btn btn-info btn-sm dropdown-toggle" id="type_btn" type="button">所有类型 <span class="badge badge-danger count_all">0</span>
			  </button>
			  <div class="dropdown-menu" id="type_menu">
				<a class="dropdown-item active" href="#">所有类型 <span class="badge badge-danger count_all">0</span></a>
<?php foreach ($types as $type): ?>
                <a class="dropdown-item" href="#"><?= $type['type'] ?> <span class="badge badge-danger count">0</span></a>
<?php endforeach; ?>
			  </div>
			</div>
			  <div class="col-sm-3 mt-1 mt-sm-0">
				  <input class="form-control form-control-sm" id="search" type="text" placeholder="搜索项目" aria-label="Search">
				  <span class="position-absolute d-none" id="clearsearch">×</span>
			  </div>
		  </div>
		  <table class="table table-hover table-responsive-sm">
			  <thead>
				  <tr>
					  <th scope="col">#</th>
					  <th scope="col">项目名称</th>
					  <th scope="col">总投资</th>
					  <th scope="col">责任单位</th>
					  <th scope="col">包联领导</th>
					  <th scope="col">代办单位</th>
				  </tr>
			  </thead>
			  <tbody>

<?php foreach ($p_rows as $row): ?>
<?php
$class="searchable";

switch ($row['alert']) {
    case 1:
        $class .=' bg-warning';
        break;
    case 2:
        $class .=' bg-danger';
        break;
}
?>
	<tr class="<?= $class ?>" data-oid="<?= $row['oid'] ?>" data-type="<?= $row['type'] ?>">
				  <th scope="row"><?= $row['pid'] ?></th>
					  <td class="pname"><?= $row['pname'] ?></td>
					  <td><?= $row['investment'] ?></td>
					  <td><?= $row['oname'] ?></td>
					  <td class="p_incharge"><?= $row['p_incharge'] ?></td>
					  <td><?= $row['oname_serve'] ?></td>
				  </tr>
<?php endforeach; ?>
			  </tbody>
		  </table>
		  </main>
		</section>
		</div>
<?php
require $inc . 'footer.php';
