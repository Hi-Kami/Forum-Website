<meta name="Websitename" content="" />

<?php
	require("navbar.html");
?>

<body>
	<center>
		<?php
			$db_name="a7071081_user"; // Database name
			$tbl_name="forum_categories"; // Table name

			session_start();
			include "dbstuff.php";
	
			$sql="SELECT * FROM $tbl_name ORDER BY id ASC";
			// OREDER BY id DESC is order result by descending
			$result=mysql_query($sql);
		?>

		<table>
			<tr>
				<td width="4%" align="center" ><strong></strong></td>
				<td width="76%" align="center" ><strong>Category</strong></td>
				<td width="20%" align="center" ><strong>Threads</strong></td>
			</tr>

			<?php
				while($rows=mysql_fetch_array($result)){ // Start looping table row
			?>
			
			<tr>
				<td><img src="topic.png" border="0" alt="Bla" class="avatar"></td>
				<td><a href="main_forum.php?id=<? echo $rows['id']; ?>"><? echo $rows['name']; ?></a></font><BR></td>
				<td><? echo $rows['threads']; ?></font></td>
			</tr>

			<?php
				// Exit looping and close connection
				}
				mysql_close();
			?>
			<tr>
				<?php
					session_start();
					if ($_SESSION["valid_user"])
					{
						echo '</a></td>';
					}
				?>
			</tr>
		</table>
	</center>
</body>

</html>