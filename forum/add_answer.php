<meta name="Websitename" content="" />

<?php
	require("navbar.html");
?>

<table>
	<div class = "main">
	<center>

		<?php
		$db_name="a7071081_user"; // Database name
		$tbl_name="forum_answer"; // Table name

		// set the default timezone to use
		date_default_timezone_set('GMT');
	
		session_start();
		include "dbstuff.php";
	
		// Get value of id that sent from hidden field
		$id=$_POST['id'];
	
		// Find highest answer number.
		$sql="SELECT MAX(a_id) AS Maxa_id FROM $tbl_name WHERE question_id='$id'";
		$result=mysql_query($sql);
		$rows=mysql_fetch_array($result);

		// add + 1 to highest answer number and keep it in variable name "$Max_id". if there no answer yet set it = 1
		if ($rows) 
		{
			$Max_id = $rows['Maxa_id']+1;
		}
		else 
		{
			$Max_id = 1;
		}

		// get values that sent from form
		$userid=$_SESSION["valid_id"];
		$a_answer=$_POST['a_answer'];

		$datetime=date("d/m/y H:i:s"); // create date and time

		// Insert answer
		$sql2="INSERT INTO $tbl_name(question_id, a_id, a_answer, a_datetime, userid)VALUES('$id', '$Max_id', '$a_answer', '$datetime', '$userid')";
		$result2=mysql_query($sql2);

		if($result2)
		{
			echo "Successful<BR>";
			echo "<a href='view_topic.php?id=".$id."'>View your answer</a>";

			// If added new answer, add value +1 in reply column
			$tbl_name2="forum_question";
			$sql3="UPDATE $tbl_name2 SET reply='$Max_id' WHERE id='$id'";
			$result3=mysql_query($sql3);

		}
		else 
		{
			echo "ERROR";
			echo $a_name;
		}

		mysql_close();
	?>
</center>

</html>