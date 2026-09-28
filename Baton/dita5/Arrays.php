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


<h3>asort()</h3>
    <?php
		//Associative Arrays - mund te renditen edhe nga fillimi edhe nga fundi.
		//asort()-mundeson renditjen e elementeve ne baze te vleres.
			
            $mosha = array("Arianit"=>"26", "Florian"=>"27", "Roni"=>"26");
        
			asort($mosha);
        
			foreach($mosha as $x => $x_value)
			{
				echo $x ." - ". $x_value;
				echo "<br>";
			}
		?>


    <h3>ksort()</h3>
    <?php
		//ksort()-mundeson renditjen e ementeve ne baze te qelesit. 
			$mosha = array("Arianit"=>"26", "Florian"=>"27", "Roni"=>"26");
			ksort($mosha);
        
			$mosha1 = array("Arianit"=>"26", "Florian"=>"27", "Roni"=>"26");
        
			foreach($mosha as $x => $x_value)
			{
				echo $x ." ". $x_value;
				echo "<br>";
			}
		?>
    <h3>arsort()</h3>
    <?php
		//Associative Arrays - mund te renditen edhe nga fillimi edhe nga fundi.
		//arsort()-mundeson renditjen e ementeve ne baze te vleres nga fundi ne fillim.
			$mosha = array("Arianit"=>"26", "Florian"=>"27", "Roni"=>"26");
			arsort($mosha);
			foreach($mosha as $x => $x_value)
			{
				echo $x ." ". $x_value;
				echo "<br>";
			}
		?>
    <h3>krsort()</h3>
    <?php
		//Associative Arrays - mund te renditen edhe nga fillimi edhe nga fundi.
		//krsort()-mundeson renditjen e ementeve ne baze te qelesit nga fundi ne fillim. 
			$mosha = array("Arianit"=>"26", "Florian"=>"27", "Roni"=>"26");
			krsort($mosha);
			foreach($mosha as $x => $x_value)
			{
				echo $x ." ". $x_value;
				echo "<br>";
			}
		?>

    <h3>pop()</h3>
    <?php
		//pop()fshin nje elementet nga fundi i array.
			$text = array("Shkolla","Digjitale","Prizren");
			//print_r($text);
			array_pop($text);
			print_r($text);
		?>
    <h3>push()</h3>
    <?php
		//push()shton nje elementet nga fundi i array.
			$text = array("Shkolla","Digjitale","Prizren");
			array_push($text,"Prishtine");
			print_r($text);
		?>
    <h3>shift()</h3>
    <?php
		//shift()fshin nje elementet nga fillmi i array.
			$text = array("Shkolla","Digjitale","Prizren");
			array_shift($text);
			print_r($text);
		?>
    <h3>unshft()</h3>
    <?php
		//unshift()shton nje elementet ne fillim te array.
			$text = array("Shkolla","Digjitale","Prizren");
			array_unshift($text,"Prishtine");
			print_r($text);
		?>

    <h3>splice()</h3>
    <?php
		//splice()na mundeson qe njekosisht te shtojem dhe te fshijme elementet brenda array.
			$text = array("Shkolla","Digjitale","Prizren");
			array_splice($text, 2, 2, "Prishtine");
			print_r($text);
		?>


    </body>
</html>