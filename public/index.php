<?php require_once('../private/initialize.php' );
  $tweets=array();
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
      <h1>Tweeter</h1>
    </div>
    <div class="centered main-content">
      <div class="feed">
        <h3 class="neat-contained">What's happening?</h3>
        <form action="index.php" method="post" class="neat-contained tweet-field">
          <input type="textarea" name="tweet-content" class="textbox" placeholder="What's on your mind?" />
          <input type="submit" value="tweet" class="tweet-button">
        </form>
        <?php
          if (isPostRequest()){
            $tweets[]= $_POST['tweet-content'];
            foreach ($tweets as $tweet) {
              echo "$tweet <br />";
            }
          }
        ?>
      </div>
      <div class="info">
        <h3 class="neat-contained">User Info</h3>
      </div>
    </div>
  </body>
  <footer class="centered">
    <h3>&copy; <?php echo date('Y'); ?> Tweeter<h3>
  </footer>
</html>
