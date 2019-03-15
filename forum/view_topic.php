<meta name="Websitename" content="" />

<?php
	require("navbar.html");
?>

<div class = "main">
<center>
		<?php
		$db_name="a7071081_user"; // Database name
		$tbl_name="forum_question"; // Table name
		$user_tbl="members";
		$status_table="member_status";
	
		session_start();
		include "dbstuff.php";

		// get value of id that sent from address bar
		$id=$_GET['id'];

		$sql="SELECT * FROM $tbl_name WHERE id='$id'";
		$result=mysql_query($sql);

		$rows=mysql_fetch_array($result);
		$topic = $rows['topic'];

		echo '<a class = "link" href="default.php">Forums</a>';
		echo '<a class = "link" > - </a> ';
		echo '<a class = "link" href="main_forum.php?id=';
		echo $rows['catid'];
		echo '">';
		echo "back";//change to display sub cat
		echo '</a>';

		$mname=$rows['userid'];
		$membersql="SELECT * FROM $user_tbl WHERE id='$mname'";
		$memberresult=mysql_query($membersql);
		$memberrows=@mysql_fetch_array($memberresult);
	?>

	<table width="90%" height = "200" border="0"frame="border" align="center" cellpadding="0" cellspacing="1"style="table-layout: fixed;">
		<tr>
			<td width="20%" height ="20%" border="0">
				<strong><? echo $memberrows['username']; ?></strong>
			</td>
				<td width="80%" height ="20%" border="0">
				<strong><? echo $topic; ?></strong>
			</td>
		</tr>

		<tr>
			<td width="20%" height ="10%" border="0">
				<strong>
					<?php
	
						$tmpsql="SELECT * FROM $status_table WHERE id=$mname";
						$tmpresult=mysql_query($tmpsql);
						$tmprows=@mysql_fetch_array($tmpresult);
						if($tmprows['status']=="dev" || $tmprows['status']=="owner")
						{
							echo "Developer";
						}
						else if($tmprows['status']=="admin")
						{
							echo "Admin";
						}
						else if($tmprows['status']=="vip")
						{
							echo "VIP Member";
						}
						else
						{
							echo "Member";
						}
	
					?>
				</strong>
			</td>

			<td width="80%" height ="80%" border="0" rowspan="4">
				<? echo $rows['detail']; ?></td>
			</tr>
			<? $locked = $rows['locked']; ?>
			<tr>
				<td width="20%" height ="10%" border="0">
					<strong>
						<?php
							echo $memberrows['Title'];
						?>
					</strong>
				</td>
			</tr>

			<tr>
				<td width="20%" height ="40%" border="0">
					<strong>
						<?php
							echo '<img src="';
							echo $memberrows['avatar'];
							echo '" border="0" alt="Avatar" class="avatar">';
						?>
					</strong>
				</td>
			</tr>
	
			<tr>
				<td width="20%" height ="20%" border="0">
					<strong>
						<? echo $rows['datetime']; ?>
					</strong>
				</td>
			</tr>
		</td>
	</tr>
</table>
<BR>
	<?php
		$tbl_name2="forum_answer"; // Switch to table "forum_answer"
	
		$sql2="SELECT * FROM $tbl_name2 WHERE question_id='$id' ORDER BY a_id";
		$result2=mysql_query($sql2);

		while($rows=mysql_fetch_array($result2))
		{
			$mname=$rows['userid'];
			$membersql="SELECT * FROM $user_tbl WHERE id='$mname'";
			$memberresult=mysql_query($membersql);
			$memberrows=@mysql_fetch_array($memberresult);
			
			?>
			<table width="90%" height = "200" border="0" frame="border" align="center" cellpadding="0" cellspacing="1" style="table-layout: fixed;">
				<tr>
					<td width="20%" height ="15%" border="0"><strong>Number</strong>
					:
					<? echo $rows['a_id']; ?></td>
					<td width="80%" height ="30%" border="0" rowspan="2"><strong><? echo $topic; ?></strong</td>
				</tr>

				<tr>
					<td width="20%" height ="15%" border="0"><strong><? echo $memberrows['username']; ?></strong></td>
				</tr>
	
				<tr>
					<td width="20%" height ="10%" border="0">
					<strong>
			<?php
					$tmpsql="SELECT * FROM $status_table WHERE id=$mname";
					$tmpresult=mysql_query($tmpsql);
					$tmprows=@mysql_fetch_array($tmpresult);
					if($tmprows['status']=="dev" || $tmprows['status']=="owner")
					{
						echo "Developer";
					}
					else if($tmprows['status']=="admin")
					{
						echo "Admin";
					}
					else if($tmprows['status']=="vip")
					{
						echo "VIP Member";
					}
					else
					{
						echo "Member";
					}
			?>
					</strong><
				</td>
			
				<td width="80%" height ="70%" border="0" rowspan="4"><? echo $rows['a_answer']; ?>
				</td>
			</tr>

			<tr>
				<td width="20%" height ="10%" border="0">
					<strong>
						<?php
							echo $memberrows['Title'];
						?>
					</strong>
				</td>
			</tr>

		<tr>
			<td width="20%" height ="40%" border="0">
				<strong>
					<?php
						echo '<img src="';
						echo $memberrows['avatar'];
						echo '" border="0" alt="Avatar" class="avatar">';
					?>
				</strong>
			</td>
		</tr>

	<tr>
		<td width="20%" height ="15%" border="0"><strong><? echo $rows['a_datetime']; ?></strong></td>
	</tr>

</table>
</td>
</tr>
</table>
<br>

<?
	}

	$sql3="SELECT view FROM $tbl_name WHERE id='$id'";
	$result3=mysql_query($sql3);

	$rows=mysql_fetch_array($result3);
	$view=$rows['view'];

	// if have no counter value set counter = 1
	if(empty($view))
	{
		$view=1;
		$sql4="INSERT INTO $tbl_name(view) VALUES('$view') WHERE id='$id'";
		$result4=mysql_query($sql4);
	}

	// count more value
	$addview=$view+1;
	$sql5="update $tbl_name set view='$addview' WHERE id='$id'";
	$result5=mysql_query($sql5);

	mysql_close();
?>

<?php

session_start();
if ( $_SESSION["valid_user"] && $locked ==0  )
{
	echo '<BR><table width="90%" height="200" border="0" frame="border" align="center" cellpadding="0" cellspacing="1">';
	echo '<tr>';
	echo '<form name="form1" method="post" action="add_answer.php">';
	echo '<td>';
	echo '<tr>';
	echo '<td valign="top"><strong>Reply</strong></td>';
	echo '<td valign="top">:</td>';
	echo '<td><textarea name="a_answer" cols="90" rows="6" id="a_answer"></textarea></td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td>&nbsp;</td>';
	echo '<td><input name="id" type="hidden" value="';
	echo $id;
	echo '"></td>';
	echo '<td><input type="submit" name="Submit" value="Submit"> <input type="reset" name="Submit2" value="Reset"></td>';
	echo '</tr>';
	echo '</table>';
	echo '</td>';
	echo '</form>';
	echo '</tr>';
	echo '</table>';
}
?>


</div>
</td>
</tr>
</table>



</center>

</html>