<!DOCTYPE HTML>
<html>
<head>
<title></title>
<meta name="" content="">

<!-- PLEASE ENTER YOUR NAME BELOW 

CSIS 3280: Web-based Scription
Assignment 2

Student Name: Diego Costa
Completed on:
 ===========================-->

<style>
table, th, td {
	
	border: 1px black solid;
	padding: 5px;
	border-collapse: collapse;
}	
	
	div {
		
		margin-left: 50px;
	}
</style>

</head>
<body style="background-color: lightblue">
<div>
<h1>Function with Variable Arguments</h1>

<h2>Lunch Order</h2>
<h3>(A sales tax rate of 12% applies to all orders)</h3>
<form action="CSIS3280-AS2-Question2.php" method="POST">
	<input type="checkbox" name="soup" value ="Soup of the Day" <?php if(isset($_POST['submit'])) {if(isset($_POST['soup'])){ echo "checked='checked'";}} ?>/>Soup of the Day ($5.95) <br />

	<input type="checkbox" name="chicken" value ="Grilled Chicken" <?php if(isset($_POST['submit'])) {if(isset($_POST['chicken'])){ echo "checked='checked'";}} ?>/>Grilled Chicken ($10.95) <br />

	<input type="checkbox" name="salmon" value ="Grilled Salmon" <?php if(isset($_POST['submit'])) {if(isset($_POST['salmon'])){ echo "checked='checked'";}} ?>/>Grilled Salmon($15.95) <br />

	<input type="checkbox" name="beef" value ="Beef Steak" <?php if(isset($_POST['submit'])) {if(isset($_POST['beef'])){ echo "checked='checked'";}} ?>/>Beef Steak ($19.95) <br />

	<input type="checkbox" name="salad" value ="Salad" <?php if(isset($_POST['submit'])) {if(isset($_POST['salad'])){ echo "checked='checked'";}} ?>/>Salad ($7.95) <br />
	<p>
		<input type="reset" name="reset" value="Reset" /> &nbsp;
		<input type="submit" name="submit" value="Process Order" />
	</p>
	
</form>

<h3>Lunch Order Summary:</h3>

<!-- INSERT YOUR PHP SCRIPT BELOW 
 ================================-->
<?php
if(isset($_POST['submit'])){
	extract($_REQUEST);

	//print table header
	print "<table><tr><th>Item</th><th>Cost</th></tr>";

	//array to hold selected items
	$order = array();
	
	//prices variables
	$soupPrice = 5.95;
	$chickenPrice = 10.95;
	$salmonPrice = 15.95;
	$beefPrice = 19.95;
	$saladPrice = 7.95;

	function ProcessLunchOrder($items){
		//variables to hold cost and tax
		define("TAX", 0.12);
		$totalItemCost = 0;

		//check which food was selected
		foreach ($items as $food) {
			if($food == 'soup'){
				$totalItemCost += $GLOBALS['soupPrice'];
			}
			else if($food == 'chicken'){
				$totalItemCost += $GLOBALS['chickenPrice'];
			}
			else if($food == 'salmon'){
				$totalItemCost += $GLOBALS['salmonPrice'];
			}
			else if($food == 'beef'){
				$totalItemCost += $GLOBALS['beefPrice'];
			}
			else if($food == 'salad'){
				$totalItemCost += $GLOBALS['saladPrice'];
			}
		}

		//print total item cost
		print "<tr><td>Total item cost</td><td>$" . number_format($totalItemCost,2). "</td></tr>";

		//calculate and print total tax charge
		$totalTax = TAX * $totalItemCost;
		print "<tr><td>Tax charge</td><td>$" . number_format($totalTax,2). "</td></tr>";

		//calculate and print total lunch cost
		$totalLunchCost = $totalItemCost + $totalTax;
		print "<tr><td><strong>Total lunch cost</strong></td><td><strong>$" . number_format($totalLunchCost,2) . "</strong></td></tr>";	
	}

	//if soup was selected
	if(isset($_POST['soup'])){
		array_push($order,"soup");
		print "<tr><td>". $soup . "</td><td>$" . number_format($soupPrice,2). "</td></tr>";
	}

	//if chicken was selected
	if(isset($_POST['chicken'])){
		array_push($order,"chicken");
		print "<tr><td>". $chicken . "</td><td>$" . number_format($chickenPrice,2). "</td></tr>";
	}
	
	//if salmon was selected
	if(isset($_POST['salmon'])){
		array_push($order,"salmon");
		print "<tr><td>". $salmon . "</td><td>$" . number_format($salmonPrice,2). "</td></tr>";
	}

	//if beef was selected
	if(isset($_POST['beef'])){
		array_push($order,"beef");
		print "<tr><td>". $beef . "</td><td>$" . number_format($beefPrice,2). "</td></tr>";
	}

	//if salad was selected
	if(isset($_POST['salad'])){
		array_push($order,"salad");
		print "<tr><td>". $salad . "</td><td>$" . number_format($saladPrice,2). "</td></tr>";
	}

	//call function passing the order array with all items selected
	ProcessLunchOrder($order);

	//print end table
	print "</table>";

}

?>



</div>
</body>
</html>