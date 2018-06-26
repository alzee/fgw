	  <div class="container">
		  <nav>
			  <div>
				  <ol class="breadcrumb">
				  <li class="breadcrumb-item"><a href="<?= "$root/home" ?>">首 页</a></li>
				  <li class="breadcrumb-item"><a href="<?= "$root/project" ?>">重点项目</a></li>
				  <li class="breadcrumb-item active">统计报表</li>
				  </ol>
			  </div>
		  </nav>

		  <div class="row">
		  <div class="btn-group btn-group-sm col col-sm-auto" id="reportbtn">
<?php if($rid ==3): ?>
			<a role="button" class="btn btn-info text-white <?= $a_stat ?>" href="<?= "$root/$controller/$method/stat" ?>">统计汇总</a>
<?php endif ?>
		    <a role="button" class="btn btn-info text-white <?= $a_allp ?>" href="<?= "$root/$controller/$method/allprog" ?>">进度月报</a>
		    <a role="button" class="btn btn-info text-white <?= $a_ppro ?>" href="<?= "$root/$controller/$method/pproc" ?>">手续代办</a>
		  </div>
