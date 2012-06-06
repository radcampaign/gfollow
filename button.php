<?php

include '../krumo/class.krumo.php';
include 'googleCard-Wordpress/googleCardClass.php';
$error = '';

$id = $_GET['id'];

if ($id == '') {
  // no id entered
  $error = 'You didn\'t enter a Google+ id!';
}
elseif (!is_numeric($id)) {
  // not a number
  $error = 'The Google+ id you entered (' . $id . ') is not a number!';
}
elseif (strlen($id) != 21) {
  // wrong size number
  $error = 'The Google+ id you entered (' . $id . ') has the wrong number of digits.';
}
else {
  // get data from google
  $scraper = new googleCard($id);
  $gplus = $scraper->googleCard();

  // make name into array so we can get the first name easily
  $name = explode(' ', $gplus['name']);

  // show follower count and XX.XK if more than 3 digits
  $count = $gplus['count'];
  if ($count > 999) {
    $count = sprintf('%.1fK', ($count / 1000));
  }
}

?>
<!DOCTYPE html>
<html>
  <head>
    <title>gfollow</title>
    <link rel="stylesheet" type="text/css" href="buttonstyle.css" />
  </head>
  <body>
    <div id="gfollow">
      <? if ($error!=''): ?>
        <div id="error"><span class="bold">ERROR</span>: <? print $error; ?></div>
      <? else: ?>
        <div id="button">
          <a href="<? print $gplus['url']; ?>" target="_blank"><img src="button.gif" alt="Click to see <? print $name[0]; ?>'s Google+ profile" /></a>
        </div>
        <div id="add" class="bold">Add <a href="<? print $gplus['url']; ?>" target="_blank"><? print $name[0]; ?></a> to your Circles.</div>
        <div id="count"><? print $count; ?> people following.</div>
      <? endif; ?>
    </div>
    <script type="text/javascript">

      var _gaq = _gaq || [];
      _gaq.push(['_setAccount', 'UA-19853221-2']);
      _gaq.push(['_trackPageview']);

      (function() {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
      })();

    </script>
</html>
