<?php
  require_once('initialize.php');

  function isPostRequest(){
    return $_SERVER['REQUEST_METHOD'] == 'POST';
  }

  function redirect_to($page){
    header("Location: $page");
    exit;
  }

  function hanlde_potential_connection_failure(){
    if(mysqli_connect_errno()) {
      $error_message = mysqli_connect_error();
      exit($error_message);
    }
  }

  function is_valid($content){
    return strlen($content) <= 140;
  }

  function is_present($content){
    return strlen($content) > 0;
  }
?>
