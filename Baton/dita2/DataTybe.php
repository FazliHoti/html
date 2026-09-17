<!DOCTYPE html>    
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-widthdevice-widthdevice-widthdevice-widthdevice-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
     
  <h3>String</h3>

  <?php
   //Tipi i the dhenave string.
   $x = "Shkolla Digjitale";
   $y = "Prizren";

   echo $x . $y;
   echo "<br>";
   var_dump($x);
   ?>

  <h3>Integer</h3>

  <?php 
    //Tipi i te dhenave Integer.
    //Me Integer mund te shenojme te dhena number , mirepo vetem numra te plote.

    $x = 2323;

    echo $x;
    echo "<br>";
    var_dump($x);

    ?>

    <br>

    <?php
       
       $x = 123;
       $y = "abc";


       echo is_int($x);
       echo "<br>";
       echo is_int($y);
       var_dump(is_int($y));
       var_dump(is_int($x));


    ?>

  <h3>Boolean</h3>
   
     <?php

      $x = true;
      $y = false;

      echo $x."<br>";
      echo "asd<br>";
      echo $y;

      ?>

  <h3>Array</h3>

    

    <?php

      $arr = array(10,20,30);
      $text = array('shkolla','digjitale','prizren');
      echo $arr;
      echo "<br>";
      print_r($arr);
      echo "<br>";
      var_dump($arr);
      echo "<br>";
      var_dump($text);

      ?>

  
  <h3>null</h3>

   
   <?php

    
    $x = NULL;
    var_dump($x);
    echo "<br>";
    $y = "Hello PHP";
    $Y = NULL;
    var_dump($y);

    ?>

  <h3>recourse</h3>

    <?php


  $conn = ftp_connect("127.0.0.1") or die("could not connect");

   
    ?>

<br>
<br>
<br>

   
  



</body>
</html>