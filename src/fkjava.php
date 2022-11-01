<?php
$path=explode('/', $_SERVER['PATH_INFO']);
?>
<!DOCTYPE html>
<html lang="">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title></title>
<style>
iframe{
	border:0;
	height:1920px;
	width:100%;
}
</style>
</head>
<body>
<iframe src="https://it/fgw/<?= $path[1] ?>/<?= $path[2] ?>"></iframe>
	<script>
	window.addEventListener('message', function(event){
		console.log(event.data);
		location.pathname=event.data;
	});
	</script>
	<noscript></noscript>
</body>
</html>
