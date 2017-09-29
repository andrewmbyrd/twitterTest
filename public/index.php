
<?php
  require_once('../private/initialize.php' );
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Tweeter</title>
    <meta charset="utf-8">
    <link rel='stylesheet' type='text/css' href='stylesheets/ind.css'>

  </head>

  <body>
    <div class="centered nav">
      <h1 class="title">tweeter<img src="images/logo.png" class="logo"></h1>
    </div>

    <div class="centered main-content">
      <div class="feed">

        <p class="neat-contained greeting">What's happening?</p>
        <p id="char-count" class="chars">140</p>
        <form action="../private/tweets.php" method="post" class="neat-contained tweet-field">
          <input type="textarea" name="tweet-content" id="textbox" placeholder="What's on your mind?" />
          <input type="submit" value="Tweet" class="tweet-button">
        </form>
        <br />
        <br />
        <?php
          $tweets = getTweets();
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
        mysqli_free_result($tweets);
      ?>
      <div class="info">
        <h3 class="neat-contained">App Info</h3>
        <img src='images/avatar.png' height="30">
        <p>Tweets from anonymous (all tweets!): </p>
        <?php
          echo num_tweets();
        ?>
      </div>
    </div>
    <script>
      var chars_remaining = document.getElementById('char-count');
      var box = document.getElementById('textbox');

      box.addEventListener("keyup", function(event){
        var space_left = 140 - box.value.length;
        if(space_left >=0) {
          chars_remaining.innerText = space_left;
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
