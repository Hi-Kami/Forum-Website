<meta name="Websitename" content="" />

<?php
	require("navbar.html");
?>

<center>
	<?php

        		include ("dbstuff.php");

		if ( $_GET["op"] == "reg" )
		{
			$bInputFlag = false;
			foreach ( $_POST as $field )
			{
				if ($field == "")
				{
					$bInputFlag = false;
				}
				else
				{
					$bInputFlag = true;
				}
			}

			if ($bInputFlag == false)
			{
				echo'<table><div class = "main"><center><p>';
				echo "Problem with your registration info. Please go back and try again.";
				echo '<form action="?op=reg" method="POST"></br>';
				echo 'Username: <input name="username" MAXLENGTH="25"></br>';
				echo 'Password: <input type="password" name="password" MAXLENGTH="16"></br>';
				echo 'Email Address: <input name="email" MAXLENGTH="30"></br>';
				echo '<input type="submit"></br>';
				echo '</p></form></div></table>';
				die("");
			}
			
			if( !(strlen( $_POST[password] ) > 6 ) )
			{
				echo'<table><div class = "main"><center><p>';
				echo "Your password is too short. Please go back and try again.";
				echo '<form action="?op=reg" method="POST"></br>';
				echo 'Username: <input name="username" MAXLENGTH="25"></br>';
				echo 'Password: <input type="password" name="password" MAXLENGTH="16"></br>';
				echo 'Email Address: <input name="email" MAXLENGTH="30"></br>';
				echo '<input type="submit"></br>';
				echo '</p></form></div></table>';
				die("");
			}

			$cleanpw = crypt(md5($_POST[password]),md5($_POST[username]));
			$q = "INSERT INTO `members` (`username`,`password`,`email`) VALUES ('$_POST[username]','$cleanpw','$_POST[email]')";

			$r = mysql_query($q);

			if ( !mysql_insert_id() )
			{
				echo'<table><div class = "main"><center><p>';
				echo "Error: User not added.";
				echo '<form action="?op=reg" method="POST"></br>';
				echo 'Username: <input name="username" MAXLENGTH="25"></br>';
				echo 'Password: <input type="password" name="password" MAXLENGTH="16"></br>';
				echo 'Email Address: <input name="email" MAXLENGTH="30"></br>';
				echo '<input type="submit"></br>';
				echo '</p></form></div></table>';
				die("");
			}
			else
			{
				Header("Location: register.php?op=thanks");
			}

  		}
		elseif ( $_GET["op"] == "thanks" )
		{
			echo'<table><div class = "main"><center><p>';
			echo "Thanks for registering!";
			echo '</p></form></div></table>';
		}
		else
		{
			echo'<table><div class = "main"><center><p>';
			echo '<form action="?op=reg" method="POST"></br>';
			echo 'Username: <input name="username" MAXLENGTH="25"></br>';
			echo 'Password: <input type="password" name="password" MAXLENGTH="16"></br>';
			echo 'Email Address: <input name="email" MAXLENGTH="30"></br>';
			echo '<input type="submit"></br>';
			echo '</p></form></div></table>';
		}
	?>
</center>
</center>

</html>