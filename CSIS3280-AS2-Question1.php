<!DOCTYPE HTML>
<html>
<head>
<title></title>
<meta name="" content="">

<style type="text/css">
body {
	
	background-color: #99ffcc;
}

fieldset, legend, label, p, input {
	
	font-weight: bold;
}

</style>

<!-- PLEASE ENTER YOUR NAME BELOW 

CSIS 3280: Web-based Scription
Assignment 2

Student Name: Diego Costa
Completed on:
 ===========================-->


</head>
<body>

<h1>Investment Options Application</h1>

<form action="CSIS3280-AS2-Question1.php" method="POST">
	<fieldset>
		<legend id="Investment Strategy">Investment Strategy:</legend>
		<input type="radio" name="investmentStrategy" value="lumpsum" <?php if(isset($_POST['submit'])) {if(isset($_POST['investmentStrategy'])){if($_POST['investmentStrategy'] == "lumpsum"){echo "checked='checked'";}}} ?> />Lumpsum Investment ($)<br />
	
		<input type="radio" name="investmentStrategy" value="monthly" <?php if(isset($_POST['submit'])) {if(isset($_POST['investmentStrategy'])){if($_POST['investmentStrategy'] == "monthly"){echo "checked='checked'";}}} ?> />Monthly Investment ($)<br />
	
	</fieldset>
	 <br />
	<fieldset>
	
		<legend id="Investment Goal">Investment Goal:</legend>

		<p><label>Desired futute amount ($):</label> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
		<input type="text" name="futureamount" value="<?php if(isset($_POST['submit'])) {echo $_POST['futureamount'];} ?>" /> </p>
	
		<p><label>Investment term/period (years):</label>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;
		<input type="text" name="term" value="<?php if(isset($_POST['submit'])) {echo $_POST['term'];} ?>" /></p>
		
		<p><label>Desired rate of return/interest (%/year):</label>
		<input type="text" name="interest" value="<?php if(isset($_POST['submit'])) {echo $_POST['interest'];} ?>" /></p>
	</fieldset>
	
		<p>
		<input type="reset" name="reset" value="Reset" /> &nbsp;
		<input type="submit" name="submit" value="Calculate Amount to Invest" />
		</p>
</form>
<br />

<h2>Amount to Invest</h2>

<!-- INSERT YOUR PHP SCRIPT BELOW 
 ================================-->


<?php

if(isset($_POST['submit'])){
	extract($_REQUEST);

	//Variables
	$F_desiredAmount = $futureamount;
	$n_investmentTerm = $term;
	$r_desireRate = $interest;

	//LumpSum function
	function ComputeLumpsumPayment($F_amount,$n_term,$r_rate){
		$n_termMonthly = $n_term * 12; //convert year to months
		$r_rateMonthly = ($r_rate / 100) / 12; //convert year rate to monthly rate
		$P_lumpsumInvestment = $F_amount / ((1 + $r_rateMonthly) ** $n_termMonthly);
		return $P_lumpsumInvestment;
	}

	//Monthly function
	function ComputeMonthlyPayment($F_amount,$n_term,$r_rate){
		$n_termMonthly = $n_term * 12; //convert year to months
		$r_rateMonthly = ($r_rate / 100) / 12; //convert year rate to monthly rate
		$P_monthlyInvestment = $F_amount / ((1 + $r_rateMonthly) ** $n_termMonthly) - 1;
		$MonthlyPayment = ($P_monthlyInvestment / $n_termMonthly); //divide the total amount by number of months
		return $MonthlyPayment;
		//test
	}

	//Check if any of the radio buttons were selected
	if(isset($_POST['investmentStrategy'])){
		//If lumpsum selected
		if($_POST['investmentStrategy'] == "lumpsum"){
			$lumpResults = ComputeLumpsumPayment($F_desiredAmount,$n_investmentTerm,$r_desireRate);
			print "<h2>To have $".number_format($F_desiredAmount)." after ".$n_investmentTerm." years in an account earning ".$r_desireRate."% rate of interest compounded monthly, you will need to investment a lumpsum amount of $".number_format($lumpResults,2)." now.</h2>";
		}

		//else, monthly selected
		else {
			$monthlyResults = ComputeMonthlyPayment($F_desiredAmount,$n_investmentTerm,$r_desireRate);
			print "<h2>To have $".number_format($F_desiredAmount)." after ".$n_investmentTerm." years in an account earning ".$r_desireRate."% rate of interest compounded monthly, you will need to investment a monthly amount of $".number_format($monthlyResults,2).".</h2>";
		}
	}
	//Message if user not select one of the Investment Strategy radios
	else {
		echo '<script language="javascript">';
		echo 'alert("You must select one type of Investiment Strategy to proceed with the application.")';
		echo '</script>';
	}
	
}








?>



<br />
<br />
</body>
</html>