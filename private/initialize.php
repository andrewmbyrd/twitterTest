<?php
  //many dependencies are listed here so that in index.php only this file needs
  // to be referenceed
  require_once('functions.php');
  require_once('database.php');
  require_once('tweets.php');


  //connect to the database
  $db = dbConnect();
?>
