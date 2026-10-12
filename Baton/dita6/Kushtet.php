<?php 
       $x = 1;

       if($x <= 10)
       {
        echo "$x eshte me i vogel se 10";
       }
     else
       {
        echo "$x eshte me i madh se 10";
       }
    ?>

    <br>


<?php 
   $y = 16;

    if($y <= 10)
       {
        echo "$y eshte me i vogel se 10";
       }
     else if($y >= 20)
       {
        echo "$y eshte me i madh ose i barabarte me 20";
       }
     else
     {
        echo "eshte ne mes te 10 dhe 20";
    
     }
   
?>

  <br>
  <br>
  <br>

  <?php
    $x = 16;
    $y = 26;
    $z = 10;


    if($x > $y and $x > $z){
        echo "$x X eshte me e madhe";
    }
    else if($y > $x and $y > $z){
        echo "$y Y eshte me e madhe";
    }
    else {
        echo "$z Z eshte me e madhe";
    }
        
   ?>

   <br>
   <br>
   

<?php
$a = 100; $b = 130; $c = 180;
if($a > $b){
    if ($a > $c){
        echo "A eshte me e madhe";
    }
    else{
        echo "C eshte me e madhe";
      }
    }
else{
    if ($b > $c){
        echo "B eshte me e madhe";
    }
    else{
        echo "C eshe me e madhe";
        }
    }
?>


<?php 
            //Shembulli 5
			$z = 19;
			
			switch($z)
			{
				case 1:
					echo 'Janar';
					break;
				case 2:
					echo 'Shkurt';
					break;
				case 3:
					echo 'Mars';
					break;
				case 4:
					echo 'Prill';
					break;
				case 5:
					echo 'Maj';
					break;
				case 6:
					echo 'Qershor';
					break;
				case 7:
					echo 'Korrik';
					break;
				case 8:
					echo 'Gushte';
					break;
				case 9:
					echo 'Shtator';
					break;
				case 10:
					echo 'Tetor';
					break;
				
				case 11:
					echo 'Nentor';
					break;
				
				case 12:
					echo 'Dhjetor';
					break;
				
				default:
					echo 'Ky muaj nuk egziston!';
			}
		?>
    <br>

    <?php
    
    $ditet = 'E hene';
    
    switch($ditet)
 {
    case 'E hene':
        
      echo 'E hene eshte dita e pare e javes';
    break;

    case 'E marte':
      echo 'E marte eshte dita e dyte e javes';
    break;

    case 'E merkure':
      echo 'E merkure eshte dita e trete e javes';
    break;

    case 'E enjte':
      echo 'E enjte eshte dita e katert e javes';
    break;

    case 'E premte':
      echo 'E premte eshte dita e peste e javes';
    break;

    case 'E shtune':
      echo 'E shtune eshte dita e gjashte e javes';
    break;

    case 'E diell':
      echo 'E diell eshte dita e shtate e javes';
    break;

     default:
       echo 'Kjo dite nuk egziston';
    
    }
    ?>
<br><br>

<?php

 $a = 7;
 
 if($a % 2 == 0){
     echo 'Vlera e variables eshte qift';
 }
 else{
    echo 'Vlera e variables eshte tek';
 }
   
?>

