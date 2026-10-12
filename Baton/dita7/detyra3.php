 <?php
    for($x=1;$x<=5;$x++){
         for($y=1;$y<=5;$y++){
            echo $x." ";
         }
         echo "<br>";
    }
    ?>

<br><br>


 <?php
    for($x=1;$x<=5;$x++){
         for($y=1;$y<=5;$y++){
            echo ($x + $y -1);
         }
         echo "<br>";
    }
    ?>

<br><br>


 <?php
    for($x=1;$x<=5;$x++){
         for($y=1;$y<=5;$y++){
            echo "X" ." ";
         }
         echo "<br>";
    }
    ?>


<br><br>

 <?php
    for($x=5;$x>=1;$x--){
         for($y=1;$y<=$x;$y++){
            echo "*"." ";
         }
         echo "<br>";
    }
    ?>


<?php

for($x=1;$x<=5;$x--){
     for($y=1;$y<=5;$y++){
            if($x == $y  || $x + $y == 6){
               echo "X" . " ";
            }
            else{
                 echo "0" . " ";
         }
        
      }
         echo "<br>";
}

?>

    