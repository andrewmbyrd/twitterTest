<?php
  //pull in  log in info for the database
  require_once('db_credentials.php');

  //connect to the database (this is called on initialization)
  function dbConnect(){
    $connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
    return $connection;
  }

  //relieve database resources (this is done at end of HTML file)
  function dbDisconnect($connection){
    if (isset($connection)) {
      mysqli_close($connection);
    }
  }
?>
