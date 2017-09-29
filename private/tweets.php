
<?php
  //import helper functions
  require_once('functions.php');

  /*description: Given the information in the URL, inserts a record into
    our tweets database with the content of the tweet.
   *input: none
   *return: none
  */
  function addTweet(){

    global $db;

    //helper to ensure that if this page is reached, it was because of form submission,
    //not direct navigation
    if(isPostRequest()){

      //stores the text of the tweet
      $tweet = $_POST['tweet-content'];

      //helpers to ensure text exists, and is less than 140 chars. If it is, create the record
      if(is_valid($tweet) && is_present($tweet)){

        $sql = "INSERT INTO tweets (content) ";
        //using single quotes here to prevent SQL injection
        $sql .= "VALUES (" . "'" . $_POST['tweet-content'] . "'" . ")";

        mysqli_query($db, $sql);

        hanlde_potential_connection_failure();

      }
      //navigate back to the refreshed index.php page
      redirect_to('../public/index.php' );
    }
  }

  /*description: Returns a collection of (up to) the 15 most recent tweets in the datbase.
    They are sorted in descending order, with the most recent tweet on top. This works
    because after a form for a new tweet is submitted, the page is refreshed so the
    newest tweet appears on top as soon as a tweet is submitted
   *input: none
   *return: none
  */
  function getTweets(){

    global $db;
    //need to prevent injection here
    $tweets_query = "SELECT * FROM tweets ";
    $tweets_query .= "ORDER BY time_stamp DESC LIMIT 15 ";
    $tweets = mysqli_query($db, $tweets_query);

    hanlde_potential_connection_failure();

    return $tweets;
  }

  /*description: Returns the number of tweets in the database
   *input: none
   *return: String containing an integer
  */
  function num_tweets(){
    global $db;
    $sql = "SELECT count(*) FROM tweets";
    $result = mysqli_query($db, $sql);
    hanlde_potential_connection_failure();
    $num = mysqli_fetch_assoc($result)['count(*)'];

    //can release the data here because the only value needed is stored
    //in $num
    mysqli_free_result($result);

    return $num;

  }
  addTweet();
?>
