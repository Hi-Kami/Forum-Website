<?
	$host = "mysql3.000webhost.com";
	$db = "a7071081_user";
	$user = "a7071081_user";
	$pass = "imapassword6";

	$ms = mysql_pconnect($host, $user, $pass);
		
	if ( !$ms )
	{
		echo'<table><div class = "main"><center><p>';
		echo "Error connecting to database.\n";
		echo '</p></form></div></td></tr></table>';
	}
	
	mysql_select_db($db);

?>