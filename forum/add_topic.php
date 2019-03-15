<meta name="Websitename" content="" />

<?php
	require("navbar.html");
?>

<table>
	<div class = "main">
	<center>
		<?php
			$db_name="a7071081_user"; // Database name
			$tbl_name="forum_question"; // Table name

			// set the default timezone to use
			date_default_timezone_set('GMT');
	
			session_start();
			include "dbstuff.php";
	
			$id=$_POST['id'];

			// get data that sent from form
			$topic=$_POST['topic'];
			$detail=$_POST['detail'];
			$userid=$_SESSION["valid_id"];

			$datetime=date("d/m/y H:i:s"); //create date time

			$sql="INSERT INTO $tbl_name(topic, detail, datetime, catid, userid)VALUES('$topic', '$detail', '$datetime', '$id', '$userid' )";
			$result=mysql_query($sql);

			if($result)
			{
				$tbl_name2="forum_categories";

				$sql2="SELECT * FROM $tbl_name2 WHERE id='$id'";
				$result2=mysql_query($sql2);
				$rows=mysql_fetch_array($result2);
				$thread = $rows['threads'];
				$thread = $thread + 1;

				$sql3="UPDATE $tbl_name2 SET threads='$thread' WHERE id='$id'";
				$result3=mysql_query($sql3);

				echo '<table><div class = "main"><center><p>';
				echo "Successful<BR>";
				echo "<a href=default.php>View your topic</a>";
				echo '</p></center></div></td></tr></table>';
			}
			else 
			{
				echo '<table><div class = "main"><center><p>';
				echo "ERROR";
				echo '</p></center></div></td></tr></table>';
			}
			mysql_close();
		?>
	</center>

</html>