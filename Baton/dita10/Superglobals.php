<p>$GLOBALS</p>

<?php
  $a = 50;
  $b = 20;
?>

<?php
  $x = 65;
  $y = 25;

  function vlere()
  {
    //$z = $x + $y;  //klo metod nuk funksionon
    //$GLOBALS['z'] = 10 + 20;
    $GLOBALS['z'] = $GLOBALS['a'] + $GLOBALS['b'];
  }
  vlere();
  echo $z;
  ?>

 
<p>$_SERVER</p>

<?php


?>

<p>$_REQUEST</p>

<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
    Username: <input type="text" name="Username">
    <input type="submit" value="Log in">
</form>

<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $x = $_REQUEST['Username'];
        if (empty($x)) {
            echo "<script>window.alert('Username is empty');</script>";
        }
        else {
            echo "Username is: " . $x;
        }

    }else {
        echo "<script>window.alert('Username is get');</script>";
    }
?>