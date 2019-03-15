<meta name="Websitename" content="" />

	<?php
		session_start();
		include "dbstuff.php";
		$user_tbl="members";

		$mid = $_SESSION["valid_id"];
		$membersql="SELECT * FROM $user_tbl WHERE id='$mid'";
		$memberresult=mysql_query($membersql);
		$memberrows=@mysql_fetch_array($memberresult);

		if ( !($_SESSION["valid_user"])  ){ header("default.php"); }

		if ( $_GET["op"] == "cupw" )
		{
			$cleanpw = crypt(md5($_POST[password]),md5($_SESSION["valid_user"]));
			$sql5 = "UPDATE $user_tbl SET password='$cleanpw' WHERE id='$mid'";
			$result = mysql_query($sql5);
			if ( !$result  ){ echo'<table><div class = "main"><center><p>'; echo "Try Again!"; echo '</div></td></tr></table>';}
			else { header("userdetails.php"); }
		}
		else if ( $_GET["op"] == "cuem" )
		{
			$tmp = $_POST[email];
			$sql5 = "UPDATE $user_tbl SET email='$tmp' WHERE id='$mid'";
			$result = mysql_query($sql5);
			if ( !$result  ){ echo'<table><div class = "main"><center><p>'; echo "Try Again!"; echo '</div></td></tr></table>';}
			else { header("userdetails.php"); }
		}
		else if ( $_GET["op"] == "cua" )
		{
			$tmp = $_POST[avatar];
			$sql5 = "UPDATE $user_tbl SET avatar='$tmp' WHERE id='$mid'";
			$result = mysql_query($sql5);
			if ( !$result  ){ echo'<table><div class = "main"><center><p>'; echo "Try Again!"; echo '</div></td></tr></table>';}
			else { header("userdetails.php"); }	
		}
		else if ( $_GET["op"] == "cut" )
		{
			$tmp = $_POST[title];
			$sql5 = "UPDATE $user_tbl SET Title='$tmp' WHERE id='$mid'";
			$result = mysql_query($sql5);
			if ( !$result  ){ echo'<table><div class = "main"><center><p>'; echo "Try Again!"; echo '</div></td></tr></table>';}
			else { header("userdetails.php"); }
		}



 		require("navbar.html");
 	?>

<center>
	<table>
		<div class = "main">
		<center>
			<?php
				echo'<table><div class = "main"><center><p>';
				echo"Details will take a few seconds to update, refresh in a few seconds to view changes.";
				echo '</div></td></tr></table>';
	
				echo'<table><div class = "main"><center><p>';
				echo '<form action="?op=cupw" method="POST"></br>';
				echo 'Password: <input type="password" name="password" MAXLENGTH="16">';
				echo '<input type="submit"></br>';
				echo '</p></form>';
				echo '</div></td></tr></table>';

				echo'<table><div class = "main"><center><p>';
				echo '<form action="?op=cuem" method="POST"></br>';
				echo 'Email: <input name="email" MAXLENGTH="30" value="';
				echo $memberrows[email];
				echo '">';
				echo '<input type="submit"></br>';
				echo '</p></form>';
				echo '</div></td></tr></table>';

				echo'<table><div class = "main"><center><p>';
				
				echo '<img src="';
				echo $memberrows['avatar'];
				echo '" border="0" alt="Avatar" class="avatar">';
				
				echo '<form action="?op=cua" method="POST"></br>';
				echo 'Avatar: <input name="avatar" value="';
				echo $memberrows[avatar];
				echo '">';
				echo '<input type="submit"></br>';
				echo '</form>';
				echo 'For now upload a image to any hosting site and post the directlink here</p>';
				echo '</div></td></tr></table>';
	
				echo'<table><div class = "main"><center><p>';
				echo '<form action="?op=cut" method="POST"></br>';
				echo 'Title: <input name="title" MAXLENGTH="46" value="';
				echo $memberrows[Title];
				echo '">';
				echo '<input type="submit"></br>';
				echo '</p></form>';
				echo '</div></td></tr></table>';
			?>

		</center>

</html>