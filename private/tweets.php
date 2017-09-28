
<?php
  require_once('functions.php');

  function addTweet(){

    global $db;
    global $error;

    if(isPostRequest()){

      $tweet = $_POST['tweet-content'];


      if(is_valid($tweet) && is_present($tweet)){

        $sql = "INSERT INTO tweets (content) ";
        //using single quotes here to prevent SQL injection
        $sql .= "VALUES (" . "'" . $_POST['tweet-content'] . "'" . ")";

        mysqli_query($db, $sql);

        hanlde_potential_connection_failure();

      }

      redirect_to('../public/index.php' );
    }
  }

  function getTweets(){

    global $db;
    //need to prevent injection here
    $tweets_query = "SELECT * FROM tweets ";
    $tweets_query .= "ORDER BY time_stamp DESC ";
    $tweets = mysqli_query($db, $tweets_query);

    hanlde_potential_connection_failure();

    return $tweets;
  }

  addTweet();
?>
