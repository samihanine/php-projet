<?php
function connectDB() {
  $host = 'localhost';
  $user = 'root';
  $db = 'cours_php';
  $pwd = 'root';
  $port = 8889;

  try {
    $bdd = new PDO('mysql:host='.$host.';dbname='.$db.'; port='.$port.'charset=utf8', $user,$pwd);
    return $bdd;
  }catch (Exception $e) {
    exit('Erreur : '.$e->getMessage());
  }
}

$bdd = connectDB();

?>