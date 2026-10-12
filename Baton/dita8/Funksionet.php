<?php
  function x()
  {
    echo "Baton Bytyqi";
  }
  x();
?>

<br><br>

<?php

function text($emri)
{
    echo $emri."<br>";
}
text("Arianit");
text("Baton");
text("Ari");



function text1($emri1,$mbiemri)
{
    echo $emri1.$mbiemri . "<br>";
}
text1("Baton","Bytyqi");
text1("Baton","Bytyqi");
text1("Baton","Bytyqi");
?>

<br><br>

<?php
function vlera($x,$y)
{
    echo $x + $y;
    echo "<br>";
    echo "$x" * "$y";
}
vlera(5,5)
?>

<br>

<?php

function number(int $a, int $b)
{
  return $a . $b;
}
echo number(5, "5");
//echo number(5, "Hello"); 
?>

<br>

<?php
function ari($a, $b)
{
  return $a . $b;
}
echo ari(5, "5days");
?>

<br>
       <?php
			function numeri()
			{
				$x = "10"; //Mund te i caktojme edhe variabla brenda funksionit.
				$y = 5;
				return $x * $y;
				
			}
			echo numeri();
			//echo $x;
		?>
    <br>
    <br>
    <?php
			function fiks ($x = 20) //Parametrave mund te ju caktojme edhe vlera fikse.
			{
				echo "Vlera eshte: $x";
			}
			fiks();
		?>
    <br>
    <?php
		//Nese deshirojme te caktojme parametra me te dhena "float" por si rez. te nxjerrim "int".
			function mePresje(float $a, float  $b)//:int
			{
				return($a + $b);
			}
			echo mePresje(1.5,3.6);
		?>
    <br>
    <?php 
		//Nese e shenojme keshtu atehere si rezultat na nxjerr numer me presje(float).
			function mePres($a, $b) 
			{
				return($a + $b);
			}
			echo mePres(1.5, 3.4);
		
		?>
	<br>
  <br><br>
  <p>detyra 1</p>
  <?php
  $n = 20;
  $sum = 0;
  for($i=1;$i<=$n;$i++)
    {
      $sum = $sum + $i;
    }
    echo $sum;
  ?>

<br>
<br>

  <?php
  $n = 10;
  $pro = 1;
  for($i=1;$i<=$n;$i++)
    {
      $pro = $pro * $i;
    }
    echo $pro;
  ?>
<br><br>  <?php

  function prodhimi($n)
  {
    $pro = 1;
    for($i = 1;$i <= 20; $i++)
      {
        $pro *= $i;
      }
      return $pro;
  }
  echo prodhimi(5);
  ?>
   <br><br>
    <?php
  

  function shuma($n)
  {
    $sum = 0;
    for($i = 1;$i <= 20; $i++)
      {
        $sum += $i;
      }
      return $sum;
  }
  echo shuma(5);
  ?>