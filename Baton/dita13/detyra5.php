<html>

<head>
    <style>
    .empty {
        color: red;
    }
    </style>
</head>
<body>
    <?php

    $empUsername = "";
    $empPassword = "";
    $empEmail = "";
    $empConfirmPassword = "";
    
    if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $username = secure($_POST['Username']);
            $password = secure($_POST['Password']);
            $confirmPassword = secure($_POST['ConfirmPassword']);
            $email = secure($_POST['Email']);

            if(empty($username))
                {
                $empUsername = "Username is required";
                
                }
            else if (!preg_match("/^[a-zA-Z-' ]*$/",$username)) {
                $empUsername = "Only letters and white space allowed";
            }
            if(empty($password))
                {
                $empPassword = "Password is required";
                
                }
            else if (strlen($password) < 8) {
                $empPassword = "Password must be at least 8 characters long";
            }
            if(empty($confirmPassword))
                {
                $empConfirmPassword = "Please confirm your password";
                }
            else if ($password !== $confirmPassword) {
                $empConfirmPassword = "Passwords do not match";
            }
            if(empty($email))
                {
                $empEmail = "Email is required";
                
                }
            else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $empEmail = "Invalid email format";
            }
            if(empty($username) && empty($password) && empty($email))
            {
                $empUsername = "Username is required";
                $empPassword = "Password is required";
                $empEmail = "Email is required";
                $empConfirmPassword = "Please confirm your password";

            }
            else if ($username !="" and $password !="" and $email !="" and $confirmPassword !="" and 
            preg_match("/^[a-zA-Z-' ]*$/",$username) and strlen($password) >= 8 and filter_var($email, FILTER_VALIDATE_EMAIL) 
            and $password === $confirmPassword)
            {
                    echo "<script>alert('register Succesfully!')</script>";
            }

        }


        function secure($x) {
            $x = htmlspecialchars($x);
            $x = trim($x);
            $x = stripslashes($x);
            return $x;
        }

	?>
    <p><span class="empty">* Required</span></p>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
        Email: <input type="email" name="Email">
        <span class="empty">*<?php echo $empEmail;?></span><br><br>
        Username: <input type="text" name="Username">
        <span class="empty">*<?php echo $empUsername;?></span><br><br>
        Password: <input type="password" name="Password">
        <span class="empty">*<?php echo $empPassword;?></span><br><br>
        Confirm Password: <input type="password" name="ConfirmPassword">
        <span class="empty">*<?php echo $empConfirmPassword;?></span><br>-

        <input type="submit" value="Sign Up">
        <input type="reset" value="Cancel">
    </form>

</body>

</html>