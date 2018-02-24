		  <main id="upload">
			<form enctype="multipart/form-data" action="" method="POST">
			  <div class="custom-file mb-3 col-sm-5 d-block mx-auto">
				  <input type="file" class="custom-file-input" id="customFile" name="file" required>
				  <label class="custom-file-label" for="customFile">点击选择文件上传</label>
			  </div>
			  <button type="submit" class="btn btn-success d-block mx-auto">上 传</button>
			</form>

<?php
//var_dump($_FILES['file']['tmp_name']);
$file=$_FILES['file']['tmp_name'];
//echo $file;
if($file) require 'r.php';
?>

		  </main>
		</div>
