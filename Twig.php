<?php
/**
 * vim:ft=php et ts=4 sts=4
 * @author z14 <z@arcz.ee>
 * @version
 * @todo
 */

namespace App;

require_once 'vendor/autoload.php';

class Twig{
  function render($template, $data){
    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader, [
      'cache' => 'var/cache',
      'auto_reload' => true,
    ]);
    // print_r($data);
    return $twig->render($template, $data);
  }
}


