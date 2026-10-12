<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width= , initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    

<?php

  echo strlen(" Prizren ");

  ?>

  <br>


<?php

   echo str_word_count(' Shkolla Digjitale Prizren t');

   ?>

   <br>


<?php

   echo strrev('Baton');

   ?>

  <br>


<?php

   $pozicioni= strpos('Shkolla digjitale prizren','shkolla');
   $pozicioni2= strpos('Shkolla digjitale prizren','prizren');
   echo $pozicioni."<br>";
   echo $pozicioni2;

   ?>

   <br>


<?php

   $emri= 'Shkolla Digjitale Prizren'.'<br>';
   $ndrroje= str_replace('Prizren', 'Suhareka',$emri);

   echo $emri;
   echo $ndrroje;

   ?>

</body>
</html>