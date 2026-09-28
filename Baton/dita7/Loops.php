<?php

$x = 0;

while($x <= 10)
    {
        echo $x."<br>";
        $x++;
        if($x==6)
            {
                break;
            }
    }
?>


<br>


<p>Do While Loops</p>

<?php

$y = 0;

   do{

    echo $y."<br>";
    $y++;
    if($y==6)
        {
            break;
        }
   }
   while($y <= 10)

?>

<?php

for($z=0;$z<=10;$z++)
    {
        echo 'Numeri eshte: ' . $z . '<br>';
        if($z==6)
            {
                continue;
            }
    }
?>

<br>

<p>For Each Loop</p>
<?php

$txt = array(1,58,3,4,5,6,7,90);
sort($txt);
foreach($txt as $x)
    {
        echo " $x <br>";
    }
?>

 <?php
            $text = array(2,3,5,22,11,6,3,5);
           	sort($text);
		
            $txt = count($text);    
                for($x=0; $x<$txt; $x++)
                {
				    echo $text[$x].'<br>';  
                }
		?>

    <br>
    <br>

    <?php
    for($x=1;$x<=5;$x++){
         for($y=1;$y<=5;$y++){
            echo $y." ";
         }
         echo "<br>";
    }
    ?>