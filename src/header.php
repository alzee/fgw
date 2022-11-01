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

	<link type="text/css" href="css/main.css" rel="stylesheet">
  </head>
  <body>
