<meta name="Websitename" content="" />

<?php
 	require("navbar.html");
 ?>

<table>
	<div class = "main">
		<center>
			<?php
				$id=$_GET['id'];
			?>

			<table width="400" border="1" align="center" cellpadding="0" cellspacing="1">
				<tr>
					<form id="form1" name="form1" method="post" action="add_topic.php">
						<td>
							<table width="100%" border="1" cellpadding="3" cellspacing="1">
								<tr>
									<td colspan="3" bgcolor="#8a0000"><strong><font color = "#FFFFFF">Create New Topic</font></strong> </td>
								</tr>
								
								<tr>
									<td width="14%"><strong>Topic</strong></td>
									<td width="2%">:</td>
									<td width="84%"><input name="topic" type="text" id="topic" size="50" /></td>
								</tr>

								<tr>
									<td valign="top"><strong>Detailt</strong></td>
									<td valign="top">:</td>
									<td><textarea name="detail" cols="50" rows="3" id="detail"></textarea></td>
								</tr>

								<tr>
									<td>&nbsp;</td>
									<?php
										echo '<td><input name="id" type="hidden" value="';
										echo $id;
										echo '"></td>';
									?>

									<td><input type="submit" name="Submit" value="Submit" /> <input type="reset" name="Submit2" value="Reset" /></td>
								</tr>
							</table>
						</td>
					</form>
				</tr>
			</table>
		</div>
	</table>
</center>

</html>