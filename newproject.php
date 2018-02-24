<?php
?>

	  <div class="container" id="progress">
		  <nav aria-label="breadcrumb" class="position-relative">
				  <ol class="breadcrumb">
				  <li class="breadcrumb-item"><a href="<?= $root ?>">首 页</a></li>
				  <li class="breadcrumb-item"><a href="<?= $root . "/project" ?>">重点项目</a></li>
					  <li class="breadcrumb-item active" aria-current="page">新增项目</li>
				  </ol>
		  </nav>
		  <main>

		  <form method="post">
			  <table class="table table-bordered">
				  <tbody>
<!-- data write to table projects start-->
					  <tr>
						  <th scope="row">建设内容</th>
						  <td colspan="6">
						  <textarea class="form-control" name="intro" rows="5"></textarea>
						  </td>
					  </tr>
					  <tr>
						  <th scope="row">编 号</th>
						  <td>
						  <input id="pid" type="text" class="form-control" name="pid" placeholder="55">
						  </td>
						  <th scope="row">项目名称</th>
						  <td>
						  <input type="text" class="form-control" name="pname">
						  </td>
						  <th scope="row">建设性质</th>
						  <td>
							<select class="custom-select" name="property">
								<option value="">新建</option>
								<option value="">续建</option>
							</select>
						  </td>
					  </tr>
					  <tr>
						  <th scope="row">实际开工时间</th>
						  <td>
							  <input type="text" class="form-control" name="start">
						  </td>
						  <th scope="row">拟竣工时间</th>
						  <td>
							  <input type="text" class="form-control" name="finish">
						  </td>
						  <th scope="row">总投资</th>
						  <td>
							  <input type="text" class="form-control" name="investment">
						  </td>
					  </tr>
					  <tr>
						  <th scope="row">投资主体</th>
						  <td>
						  <select class="custom-select" name="investby">
								<option value="1">市级政府</option>
								<option value="2">区级政府</option>
								<option value="3">企业</option>
							</select>
						  </td>
						  <th scope="row">今年计划投资</th>
						  <td>
							  <input type="text" class="form-control" name="invest_plan">
						  </td>
						  <th scope="row">今年累计完成投资</th>
						  <td>
							  <input type="text" class="form-control" name="">
						  </td>
					  </tr>
					  <tr>
						  <th scope="row">责任单位</th>
						  <td>
							  <input type="text" class="form-control" name="oname">
						  </td>
						  <th scope="row">实施单位</th>
						  <td>
							  <input type="text" class="form-control" name="implementor">
						  </td>
						  <th scope="row">包联领导</th>
						  <td>
							  <input type="text" class="form-control" name="p_incharge">
						  </td>
					  </tr> 
					  <tr>
						  <th scope="row">项目类型</th>
						  <td>
						  <select class="custom-select" name="">
								<option value="">基建</option>
								<option value="">工业</option>
								<option value="">商业</option>
							</select>
						  </td>
						  <th scope="row">施工照片</th>
						  <td>
							<i class="fa fa-2x fa-plus-circle float-left text-muted addpic" aria-hidden="true"></i>
						  </td>
						  <th class="" colspan="4" scope="row"></th>
					  </tr> 
<!-- data write to table projects end-->

<!-- data write to table progress start-->
					  <tr>
						  <th scope="row">建设阶段</th>
						  <td>
						  <select class="custom-select" name="phase">
								<option value="">开工</option>
								<option value="">前期准备</option>
								<option value="">完工</option>
							</select>
						  </td>
						  <th scope="row">实际建设期限</th>
						  <td>
						  <input name="" type="text" class="form-control pickmonth" name="limit_start">
						  </td>
						  <th scope="row">至</th>
						  <td>
							  <input name="" type="text" class="form-control pickmonth" name="limit_end">
						  </td>
					  </tr> 
<!-- data write to table progress end-->
				  </tbody>
			  </table>
			  <button type="submit" class="btn btn-success" name="submit">提 交</button>
		  </form>
		  </main>

<!-- click and popup image start-->
			<div id="layer" class="d-none position-fixed w-100 h-100 fade show">
			</div>

			<div id="popimg" class="w-75 position-fixed d-none fade show">
			  <img src="" class="rounded">
			  <button type="button" class="close position-absolute" id="popimgclose" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
			  </button>
			</div>
<!-- click and popup image end-->
