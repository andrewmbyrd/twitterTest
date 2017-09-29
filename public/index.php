
<?php
  //sets up all required files and connects to the database
  require_once('../private/initialize.php' );
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Tweeter</title>
    <meta charset="utf-8">
    <link rel='stylesheet' type='text/css' href='stylesheets/index.css'>

  </head>

  <body>
    <div class="centered nav">
      <h1 class="title">tweeter<img src="images/logo.png" class="logo"></h1>
    </div>

    <div class="centered main-content">
      <div class="feed">

        <p class="neat-contained greeting">What's happening?</p>
        <p id="char-count" class="chars">140</p>
        <!-- Upon submitting the form, a post request is sent to private/tweets.php
        Will be redirected here when the record is created
      -->
        <form action="../private/tweets.php" method="post" class="neat-contained tweet-field">
          <input type="textarea" name="tweet-content" id="textbox" placeholder="What's on your mind?" />
          <input type="submit" value="Tweet" class="tweet-button">
        </form>
        <br />
        <br />
        <?php
          //get the 15 most recent tweets
          $tweets = getTweets();
          //as long as there is a record, create a component
          //for the tweet div and output that HTML
          while($tweet = mysqli_fetch_assoc($tweets)){
            echo
            "<div class='tweet neat-contained'>
              <div class='content'>
                <img src='images/avatar.png' class='avatar'>
                <p class='message'>{$tweet['content']}</p>
              </div>
              <br />
              <p class='time'>{$tweet['time_stamp']}</p>
             </div>";
          }
        ?>
      </div>
      <?php
        //when finished listing the tweets, no longer need to allocate
        //resources from the database query
        mysqli_free_result($tweets);
      ?>
      <div class="info">
        <h3 class="neat-contained">App Info</h3>
        <img src='images/avatar.png' height="30">
        <p>Tweets posted to the feed </p>
        <?php
          echo "<p>" . num_tweets() . "</p>";
        ?>
      </div>
    </div>
    <script>
      /*
      *This bit of javascript code is used to update the remaining characters
      *as the user types
      */

      //get the DOM element where the character remaining count is
      var chars_remaining = document.getElementById('char-count');
      //get the DOM element where the user types
      var box = document.getElementById('textbox');

      //whenever a key is released in the textbox area, do the callback
      box.addEventListener("keyup", function(event){
        //box.value.length is the amount of chacters in the box upon event firing
        var space_left = 140 - box.value.length;
        //update the text as long as there are remaining characters
        if(space_left >=0) {
          chars_remaining.innerText = space_left;
        //if the user puts more than 140 chars, send an alert and set remaining
        //character text to 0
        } else{
          chars_remaining.innerText = 0;
          alert("Tweet is too long!");
        }
      });
    </script>
  </body>

</html>

<?php
  //finished with the database after all content has been displayed
  dbDisconnect($db);
?>
