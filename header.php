<?php
use App\Db;
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

<!-- blueimp Gallery styles -->
<link rel="stylesheet" href="https://blueimp.github.io/Gallery/css/blueimp-gallery.min.css">
<!-- CSS to style the file input field as button and adjust the Bootstrap progress bars -->
<link rel="stylesheet" href="<?= $root ?>/css/jquery.fileupload.css">
<link rel="stylesheet" href="<?= $root ?>/css/jquery.fileupload-ui.css">
<!-- CSS adjustments for browsers with JavaScript disabled -->
<noscript><link rel="stylesheet" href="<?= $root ?>/css/jquery.fileupload-noscript.css"></noscript>
<noscript><link rel="stylesheet" href="<?= $root ?>/css/jquery.fileupload-ui-noscript.css"></noscript>
  </head>
  <body>
