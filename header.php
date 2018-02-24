<?php
$sql="select value from setting where s_key='sitename'";
$s_row=(new Db)->query($sql);
$sitename = $s_row['value'];
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="">

	<title><?= $sitename ?></title>

    <!-- Bootstrap core CSS -->
	<link type="text/css" href="<?= $root ?>/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="<?= $root ?>/vendor/fortawesome/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="<?= $root ?>/css/bootstrap-datepicker3.css">

    <!-- Custom styles for this template -->
	<link type="text/css" href="<?= $root ?>/css/dot.css" rel="stylesheet">
  </head>
  <body>
