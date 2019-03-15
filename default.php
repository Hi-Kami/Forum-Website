<meta name="Websitename" content="" />

<title>Bla</title>
<head>
	<?php
 		require("navbar.html");
 	?>
</head>

<center>
	<table>
		<tr valign="top">
			<td>
				<div class = "side">
				<center>
					<ul>
						<li><b>News Articles</b></li>
						<?php
							$tbl_name="news"; 
							session_start();
							include "dbstuff.php";
		
							$id=$_GET['newsid'];
							$sql="SELECT * FROM $tbl_name ORDER BY id DESC";
							$result=mysql_query($sql);
							while( $rows=mysql_fetch_array( $result ) )
							{
								echo '<li>';
								echo '<a href="default.php?newsid=';
								echo $rows['id'];
								echo '">';
								echo $rows['title'];
								echo '</a>';
								echo '</li></br>';
							}
			
						?>
	
					</ul>
				</center>
				</div>
			</td>

			<td>
				<div class = "main">
					<p>
						<?php
							$newsid = $_GET["newsid"];
							if( !$newsid )
							{
								$sql="SELECT * FROM $tbl_name ORDER BY id DESC LIMIT 1";
							}
							else
							{
								$sql="SELECT * FROM $tbl_name WHERE id='$id' LIMIT 1";
							}
							$result=mysql_query($sql);
							$row=mysql_fetch_array( $result ) ;
			
							echo '<b>';
							echo $row['title'];
							echo ' - ';
							echo $row['datetime'];
							echo '</b></br>';
							echo $row['content'];
						?>
					</p>
				</div>
			</td>
		</tr>
	</table>
</center>

</html>