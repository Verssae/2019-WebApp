<!DOCTYPE html>
<html lang="en">

<head>
	<title>Grade Store</title>
	<link href="https://selab.hanyang.ac.kr/courses/cse326/2019/labs/labResources/gradestore.css" type="text/css" rel="stylesheet" />
</head>

<body>

	<?php

	$flag = false;
	$names = array($_POST["Name"], $_POST["ID"], $_POST["CreditCard"], $_POST["creditCard"]);
	foreach ($names as $name) {
		if (!isset($name) || $name === '') {
			$flag = true;
			break;
		}
	}

	if (!isset($_POST["CSE326"]) && !isset($_POST["CSE107"]) && !isset($_POST["CSE603"]) && !isset($_POST["CIN870"])) {
		$flag = true;
	}
	if ($flag) { ?>
		<h1>Sorry</h1>
		<p>You didn't fill out the form completely. <a href="gradestore.html">Try again?</a></p>



	<?php
		# Ex 5 : 
		# Check if the name is composed of alphabets, dash(-), ora single white space.
	} elseif (!preg_match("/^[a-zA-Z\- ]*$/", $_POST["Name"])) {
		?>


		<h1>Sorry</h1>
		<p>You didn't provide a valid name. <a href="gradestore.html">Try again?</a></p>


	<?php
		# Ex 5 : 
		# Check if the credit card number is composed of exactly 16 digits.
		# Check if the Visa card starts with 4 and MasterCard starts with 5. 
	} elseif (!preg_match("/^[0-9]{16}$/", $_POST["CreditCard"]) || $_POST["creditCard"] === "Visa" && !preg_match("/^4[0-9]{15}$/", $_POST["CreditCard"]) || $_POST["creditCard"] === "MasterCard" && !preg_match("/^5[0-9]{15}$/", $_POST["CreditCard"])) {
		?>



		<h1>Sorry</h1>
		<p>You didn't provide a credit card number. <a href="gradestore.html">Try again?</a></p>


	<?php
		# if all the validation and check are passed 
	} else {
		?>

		<h1>Thanks, looser!</h1>
		<p>Your information has been recorded.</p>

		<!-- Ex 2: display submitted data -->
		<ul>
			<li>Name: <?= $_POST["Name"] ?></li>
			<li>ID: <?= $_POST["ID"] ?></li>
			<!-- use the 'processCheckbox' function to display selected courses -->
			<li>Course: <?= processCheckbox(array("CSE326", "CSE107", "CSE603", "CIN870")) ?></li>
			<li>Grade: <?= $_POST["Grade"] ?></li>
			<li>Credit Card: <?= $_POST['CreditCard'] . ' (' . $_POST['creditCard'] . ')' ?></li>
		</ul>

		<!-- Ex 3 : -->
		<p>Here are all the loosers who have submitted here:</p>
		<?php
			$filename = "loosers.txt";
			$names = array($_POST["Name"], $_POST["ID"], $_POST["CreditCard"], $_POST["creditCard"]);
			$content = implode(";", $names);
			file_put_contents($filename, "\n$content", FILE_APPEND);
			/* Ex 3: 
			 * Save the submitted data to the file 'loosers.txt' in the format of : "name;id;cardnumber;cardtype".
			 * For example, "Scott Lee;20110115238;4300523877775238;visa"
			 */
			?>

		<!-- Ex 3: Show the complete contents of "loosers.txt".
			 Place the file contents into an HTML <pre> element to preserve whitespace -->
		<pre>
			<?= file_get_contents($filename) ?>
		</pre>


	<?php
	}
	?>

	<?php
	/* Ex 2: 
			 * Assume that the argument to this function is array of names for the checkboxes ("cse326", "cse107", "cse603", "cin870")
			 * 
			 * The function checks whether the checkbox is selected or not and 
			 * collects all the selected checkboxes into a single string with comma separation.
			 * For example, "cse326, cse603, cin870"
			 */
	function processCheckbox($names)
	{
		$values = array();
		foreach ($names as $name) {
			if (isset($_POST[$name])) {
				$values[] = $_POST[$name];
			}
		}
		return implode(", ", $values);
	}
	?>

</body>

</html>