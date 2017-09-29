<?php
  //yields the $db global to files which require this file
  require_once('initialize.php');

  //deciphers if a call to a page used the POST HTTP verb
  function isPostRequest(){
    return $_SERVER['REQUEST_METHOD'] == 'POST';
  }

  //immediately redirects to location specified
  function redirect_to($page){
    header("Location: $page");
    exit;
  }

  //if the database cannot be accessed, an error is given
  function hanlde_potential_connection_failure(){
    if(mysqli_connect_errno()) {
      $error_message = mysqli_connect_error();
      exit($error_message);
    }
  }

  //helper method to check if tweet is less than 140 chars
  function is_valid($content){
    return strlen($content) <= 140;
  }

  //helper method to make sure tweet isn't empty on submission
  function is_present($content){
    return strlen($content) > 0;
  }
?>
