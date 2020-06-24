<?php
/**
 * vim:ft=php et ts=4 sts=4
 * @author z14 <z@arcz.ee>
 * @version
 * @todo
 */

namespace App;

use App\Db;
use App\Twig;

require 'vendor/autoload.php';

class Xlsx2db{
  function showTables(){
    $sql = 'show tables';
    $rows = (new Db)->query($sql);

    echo Twig::render('xlsx2db.html.twig', 
      [ 'title' => 'xlsx2db',
      'rows' => $rows ]
    );
  }

  function descTable($table){
    // $table = $_POST['table'];
    $table = 'projects';
    $sql = "desc $table";
    $rows = (new Db)->query($sql);

    $col = [];
    foreach($rows as $v){
      $col[] = $v['Field'];
    }
    echo json_encode($col, JSON_UNESCAPED_UNICODE);
  }
}
