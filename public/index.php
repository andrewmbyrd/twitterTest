
<?php
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
      <h1 class="title">Tweeter</h1>
    </div>

    <?php
    ?>

    <div class="centered main-content">
      <div class="feed">

        <h3 class="neat-contained">What's happening?</h3>
        <h3 id="char-count">140</h3>
        <form action="../private/tweets.php" method="post" class="neat-contained tweet-field">
          <input type="textarea" name="tweet-content"  id="textbox" placeholder="What's on your mind?" />
          <input type="submit" value="tweet" class="tweet-button">
        </form>
        <?php
          $tweets = getTweets();
          while($tweet = mysqli_fetch_assoc($tweets)){
            echo "{$tweet['content']} - {$tweet['time_stamp']}<br />";
          }
        ?>
      </div>
      <?php
        mysqli_free_result($tweets);
      ?>
      <div class="info">
        <h3 class="neat-contained">User Info</h3>
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


  <footer class="centered">
    <h3>&copy; <?php echo date('Y'); ?> Tweeter<h3>
  </footer>
</html>

<?php
  //finished with the database after all content has been displayed
  dbDisconnect($db);
?>
