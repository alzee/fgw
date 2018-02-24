<?php
$uname=$_SESSION['uname'];
?>
    <div class="container" id="index">
      <header class="header clearfix">
		  <nav>
		  <ul class="nav float-right">
            <li class="nav-item">
				<a class="nav-link">你好，<?= $uname ?></a>
            </li>
            <li class="nav-item">
				<a class="nav-link text-muted" href="logout">退 出</a>
            </li>
          </ul>
		  </nav>
		  <h3 class="text-muted"><?= $sitename ?></h3>
      </header>

	  <main role="main">
	  <div class="row">
		  <div class="col-sm-6">
			  <div class="card text-white bg-info mb-3">
				  <div class="card-header"><i class="fa fa-bell-o" aria-hidden="true"></i></div>
				  <div class="card-body">
					  <h5 class="card-title">公告通知</h5>
					  <p class="card-text intro">默认显示前一次提交的数据，以供参考。内容与上月相同的单元格以黄色背景提醒。</p>
				  </div>
				  <div class="card-footer"><a class="btn btn-outline-light btn-block" href="">查看通知</a></div>
			  </div>
		  </div>
		  <div class="col-sm-6">
			  <div class="card text-white bg-success mb-3">
				  <div class="card-header"><i class="fa fa-sun-o" aria-hidden="true"></i></div>
				  <div class="card-body">
					  <h5 class="card-title">固定资产投资</h5>
					  <p class="card-text intro">默认显示前一次提交的数据，以供参考。内容与上月相同的单元格以黄色背景提醒。</p>
				  </div>
				  <div class="card-footer"><a class="btn btn-outline-light btn-block" href="">查看进展</a></div>
			  </div>
		  </div>
	  </div>

	  <div class="row">
		  <div class="col-sm-6">
			  <div class="card text-white bg-danger mb-3">
				  <div class="card-header"><i class="fa fa-cubes" aria-hidden="true"></i></div>
				  <div class="card-body">
					  <h5 class="card-title">重点项目进度</h5>
					  <p class="card-text intro">默认显示前一次提交的数据，以供参考。内容与上月相同的单元格以黄色背景提醒。</p>
				  </div>
				  <div class="card-footer"><a class="btn btn-outline-light btn-block" href="project">去更新进度</a></div>
			  </div>
		  </div>
		  <div class="col-sm-6">
			  <div class="card text-white bg-secondary mb-3">
				  <div class="card-header"><i class="fa fa-cube" aria-hidden="true"></i></div>
				  <div class="card-body">
					  <h5 class="card-title">项目两库建设</h5>
					  <p class="card-text intro">默认显示前一次提交的数据，以供参考。内容与上月相同的单元格以黄色背景提醒。</p>
				  </div>
				  <div class="card-footer"><a class="btn btn-outline-light btn-block" href="">去更新进度</a></div>
			  </div>
		  </div>
	  </div>
	  <div class="row">
		  <div class="col-sm-6">
			  <div class="card bg-warning mb-3">
				  <div class="card-header"><i class="fa fa-cog" aria-hidden="true"></i></div>
				  <div class="card-body">
					  <h5 class="card-title">设 置</h5>
<div>
					  <p class="card-text intro">修改密码、添加用户、统计报表、网站相关设置...</p>
</div>
				  </div>
				  <div class="card-footer"><a class="btn btn-outline-dark btn-block" href="<?= $root ?>/setting/chpwd">修改设置</a></div>
			  </div>
		  </div>
	  </div>
<!--
	  <div class="row">
		  <div class="col-lg-6">
			  <h4>Subheading</h4>
			  <p>Donec id elit non mi porta gravida at eget metus. Maecenas faucibus mollis interdum.</p>

			  <h4>Subheading</h4>
			  <p>Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Cras mattis consectetur purus sit amet fermentum.</p>

			  <h4>Subheading</h4>
			  <p>Maecenas sed diam eget risus varius blandit sit amet non magna.</p>
		  </div>

		  <div class="col-lg-6">
			  <h4>Subheading</h4>
			  <p>Donec id elit non mi porta gravida at eget metus. Maecenas faucibus mollis interdum.</p>

			  <h4>Subheading</h4>
			  <p>Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Cras mattis consectetur purus sit amet fermentum.</p>

			  <h4>Subheading</h4>
			  <p>Maecenas sed diam eget risus varius blandit sit amet non magna.</p>
		  </div>
	  </div>
-->
	  </main>
	</div>

	  <footer class="footer container">
		  <p>&copy; 团团网络 2018</p>
	  </footer>
