<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
    Username: <input type="text" name="Username">
    <br>
    Password: <input type="password" name="Password">
    <input type="submit" value="Log in">
    <input type="submit" value="Cancel">
</form>

<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $x = $_REQUEST['Username'];
        $y= $_REQUEST['Password'];
        if (empty($x) or empty($y)) {
            echo "<script>window.alert('Username is empty');</script>";
        }
        else if($x === 'baton' && $y === 'bytyqi') 
        {
            //echo "<script>alert('Welcome!')</script>";
            echo "<script>window.open('admin.php','_self')</script>";
        }
        else
        {
            echo "<script>alert('Username or password is incorrect!')</script>";
        }

    }else {
        echo "<script>alert('Metoda nuk eshte POST!');</script>";
    }

?>
   