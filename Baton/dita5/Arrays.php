<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
  <?php 

    $x = array("Shkolla","Digjitale","Prizren");

    echo $x[0]."<br>".$x[1]."<br>".$x[2];
    echo $x;
    echo "<br>";
    var_dump($x);
    echo "<br>";
    print_r($x);

    ?>
<br>

 <?php 
 
      $x = array("Shkolla","Digjitale","Prizren");

      echo count($x);
    
     ?>
<br>

 <?php 
      $z = array( "id=>1", "username" =>"Arianit", "password" => "12121212");

      echo $z["username"];
      echo '<br>';
      echo "Username eshte ". $z['username'];
   ?>

   <h2>Sorting Array</h2>
   <h3>sort()</h3>

   <?php 
     $x = array(3,54,12,2,3,4,9,8,5);
     sort($x);
     print_r($x);
     echo "<br>";

      ?>


    </body>
</html>