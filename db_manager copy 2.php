<?php
function connectDB() {
  $host = 'p06es.myd.infomaniak.com';
  $user = 'p06es_admin';
  $db = 'p06es_test';
  $pwd = 'Oxymore6!';

  try {
    $bdd = new PDO('mysql:host='.$host.';dbname='.$db.';'.'charset=utf8', $user,$pwd);
    return $bdd;
  }catch (Exception $e) {
    exit('Erreur : '.$e->getMessage());
  }
}

$bdd = connectDB();

?>