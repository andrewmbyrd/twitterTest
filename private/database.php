<?php
  require_once('db_credentials.php');

  function dbConnect(){
    $connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
    return $connection;
  }

  function dbDisconnect($connection){
    if (isset($connection)) {
      mysqli_close($connection);
    }
  }
?>
