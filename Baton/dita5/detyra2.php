<?php  
    $numbers = [2,3,4,5,8,9,12,54];

    foreach ($numbers as $number) {
        echo $number . "<br>";
    }
?>
<br>
<?php  

$x = array(2,3,4,5,8,9,12,54);
rsort($x);

  $y = count($x);
  for ($z = 0; $z < $y; $z++)
    {
        echo $x[$z];
        echo "<br>";
    }
  ?>