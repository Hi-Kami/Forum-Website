<meta name="Websitename" content="" />

<title></title>
<head>
	<?php
 		require("navbar.html");
 	?>
</head>

	<?php
			if($_SESSION["status"]=="owner")
			{
				if ( $_GET["op"] == "preveiw" )
				{
					echo'<table><div class = "main"><center><p>';
					echo $_POST[title];
					echo ' - ';
					echo date("d/m/y");
					echo '</br>';
					echo $_POST[detail];
					echo '</p></form></div></td></tr></table>';

					echo'<table><div class = "main"><center><p>';
					echo '<b>Add News</b></br>';
					echo 'You have to preveiw once before you can submit! </br>';
					echo '<form action="addnews.php?op=submit" method="POST"></br>';
					echo 'Title: <input name="title" value="';
					echo $_POST[title];
					echo '"></br>';
					echo 'Detail: <textarea name="detail" cols="90" rows="15" id="detail">';
					echo $_POST[detail];
					echo '</textarea></br>';
					echo '<input type="checkbox" name="checkednews" value="submitnews" /></br>';
					echo '<input type="submit"></br>';
					echo '</p></form></div></td></tr></table>';
				}
				else if ( $_GET["op"] == "submit" )
				{
					if( $_POST[checkednews] == false )
					{
						echo'<table><div class = "main"><center><p>';
						echo 'You need to check the box to confirm you want to submit.';
						echo '</p></form></div></td></tr></table>';

						echo'<table><div class = "main"><center><p>';
						echo $_POST[title];
						echo ' - ';
						echo date("d/m/y H:i:s");
						echo '</br>';
						echo $_POST[detail];
						echo '</p></form></div></td></tr></table>';


						echo'<table><div class = "main"><center><p>';
						echo '<b>Add News</b></br>';
						echo 'You have to preveiw once before you can submit! </br>';
						echo '<form action="addnews.php?op=submit" method="POST"></br>';
						echo 'Title: <input name="title" value="';
						echo $_POST[title];
						echo '"></br>';
						echo 'Detail: <textarea name="detail" cols="90" rows="15" id="detail">';
						echo $_POST[detail];
						echo '</textarea></br>';
						echo '<input type="checkbox" name="checkednews" value="submitnews" /></br>';
						echo '<input type="submit"></br>';
						echo '</p></form></div></td></tr></table>';
					}
					else
					{
						include "dbstuff.php";
						$tbl_name="news"; 
						$datetime=date("d/m/y H:i:s");
						$detail = $_POST[detail];
						$title = $_POST[title];
						$sql="INSERT INTO $tbl_name(title, content, datetime)VALUES('$title', '$detail', '$datetime' )";
						$result=mysql_query($sql);

						if($result)
						{
							echo "<a href='default.php>View News</a>";
						}
					}
				}
				else
				{
					echo'<table><div class = "main"><center><p>';
					echo '<b>Add News</b></br>';
					echo 'You have to preveiw once before you can submit! </br>';
					echo '<form action="addnews.php?op=preveiw" method="POST"></br>';
					echo 'Title: <input name="title"></br>';
					echo 'Detail: <textarea name="detail" cols="90" rows="15" id="detail"></textarea></br>';
					echo '<input type="submit"></br>';
					echo '</p></form></div></td></tr></table>';
				}
			}
			else
			{
				Header("Location: default.php");
			}

	?>
</center>

</html>