<meta name="Websitename" content="" />

<?php
 	require("navbar.html");
 ?>

<center>
	<table><div class = "main"><center>
		<?php
			session_start();
			include "dbstuff.php";
			if ($_GET["op"] == "login")
			{
				if (!$_POST["username"] || !$_POST["password"])
				{

					echo '<table><div class = "main"><center><p>';
					echo "You need to provide a username and password.";
					echo '<form action="?op=login" method="POST">';
					echo 'Username: <input name="username" size="15"></br>';
					echo 'Password: <input type="password" name="password" size="16"></br>';
					echo '<input type="submit" value="Login">';
					echo '</p></form></center></div></td></tr></table>';
					die("");
				}

				$cleanpw = crypt(md5($_POST[password]),md5($_POST[username]));
				$q = "SELECT * FROM `members` "
		        		."WHERE `username`='".$_POST["username"]."' "
		       		."AND `password`=('$cleanpw')"
		       		."LIMIT 1";

				$r = mysql_query($q);
				if ( $obj = @mysql_fetch_object($r) )
				{
					$_SESSION["valid_id"] = $obj->id;
					$_SESSION["valid_user"] = $_POST["username"];
					$_SESSION["avatar"] = $obj->avatar;
					$_SESSION["valid_time"] = time();

					$status_table = "member_status";
					$tmpsql="SELECT * FROM $status_table WHERE id=$obj->id";
					$tmpresult=mysql_query($tmpsql);
					$tmprows=@mysql_fetch_array($tmpresult);
				
					if($tmprows['status']=="dev")
					{
						$_SESSION["status"] = "dev";
					}
					if($tmprows['status']=="owner")
					{
						$_SESSION["status"] = "owner";
					}
					else if($tmprows['status']=="admin")
					{
						$_SESSION["status"] = "admin";
					}
					else if($tmprows['status']=="vip")
					{
						$_SESSION["status"] = "vip";
					}
					else
					{
						$_SESSION["status"] = "mem";
					}
				
					Header("Location: default.php");
				}
				else
				{
					echo '<table><div class = "main"><center><p>';
					echo "Sorry, Wrong login information. Try Again";
					echo '<form action="?op=login" method="POST">';
					echo 'Username: <input name="username" size="15"></br>';
					echo 'Password: <input type="password" name="password" size="16"></br>';
					echo '<input type="submit" value="Login">';
					echo '</p></form></center></div></td></tr></table>';
					die("");
				}
			}
			else
			{
				echo '<table><div class = "main"><center><p>';
				echo '<form action="?op=login" method="POST">';
				echo 'Username: <input name="username" size="15"></br>';
				echo 'Password: <input type="password" name="password" size="16"></br>';
				echo '<input type="submit" value="Login">';
				echo '</p></form></center></div></td></tr></table>';
			}
		?>
</center>

</html>