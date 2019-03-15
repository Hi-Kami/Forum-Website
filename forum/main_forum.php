<meta name="Websitename" content="" />

	<?php
 		require("navbar.html");
 	?>

<body>
	<center>
		<?php
			$db_name="a7071081_user"; // Database name
			$tbl_name="forum_question"; // Table name
			$tbl_name2="forum_answer";
			$tbl_name3="forum_categories";

			echo '<a class = "link" href="default.php">Forums</a></br>';

			session_start();
			include "dbstuff.php";

			if ( $_SESSION["status"]=="dev" || $_SESSION["status"]=="admin" || $_SESSION["status"]=="owner")
			{
				if ($_GET["op"] == "unpin")
				{
					$theid = $_GET["thredid"];
					mysql_query("UPDATE  $tbl_name SET pinned='0' WHERE id=$theid");
					Header("Location: main_forum.php");
				}

				if ($_GET["op"] == "pin")
				{
					$theid = $_GET["thredid"];
					mysql_query("UPDATE  $tbl_name SET pinned='1' WHERE id=$theid");
					Header("Location: main_forum.php");
				}

				if ($_GET["op"] == "lock")
				{
					$theid = $_GET["thredid"];
					$islocked = $_GET["locked"];
					if( $islocked == 0 )
					{
						mysql_query("UPDATE  $tbl_name SET locked='1' WHERE id=$theid");
					}
					else
					{	
						mysql_query("UPDATE  $tbl_name SET locked='0' WHERE id=$theid");
					}
					Header("Location: main_forum.php");
				}

				if ($_GET["op"] == "remove") 
				{	
					$theid = $_GET["thredid"];
					$catid = $_GET["catid"];
					mysql_query("DELETE FROM  $tbl_name  WHERE id=$theid");
					mysql_query("DELETE FROM  $tbl_name2 WHERE question_id=$theid");
		
					$tbl_name20="forum_categories";
	
					$sql20="SELECT * FROM $tbl_name20 WHERE id='$catid'";
					$result20=mysql_query($sql20);
					$rows=mysql_fetch_array($result20);
					$thread = $rows['threads'];
					$thread = $thread - 1;

					$sql30="UPDATE $tbl_name20 SET threads='$thread' WHERE id='$catid'";
					$result30=mysql_query($sql30);
		
					Header("Location: main_forum.php");
				}

			}


			$id=$_GET['id'];

			$sql="SELECT * FROM $tbl_name WHERE catid ='$id'";
			$result=mysql_query($sql);

		?>

		<table width="90%"  cellpadding="3" cellspacing="1">
			<tr>
				<td width="4%"><strong></strong></td>
				<td width="55%"><strong>Topic</strong></td>
				<td width="15%"><strong>Views</strong></td>
				<td width="13%"><strong>Replies</strong></td>
				<td width="13%"><strong>Date/Time</strong></td>
			</tr>
	
			<form>
				<?php
					//Pageination
					$page = $_GET['page'];
					if($page == ""){ $page = "1"; }
	
					$sql = "COUNT(*) FROM forum_question WHERE catid ='$id'";
					$query = mysql_query($sql);

					$num = $query;  

					$per_page = "5";
					$last_page = ceil($num/$per_page);
					$first_page = "1"; 

					//Nav
        					echo '<a class="pagination"href=';
					echo '?page=';
					echo $first_page;
					echo '&id=';
					echo $id;
					echo '>First Page</a>';
					echo"||";
	
					if($page == $first_page)
					{
        		
    					}
					else
					{
        						$previous = $page-1;
        						echo '<a class="pagination"href=';
						echo '?page=';
						echo $previous;
						echo '&id=';
						echo $id;
						echo '>Previous</a>';
						echo"||";
					}

					if($page == $last_page)
					{
    		   
					}
					else
					{
        						$next = $page+1;
        						echo '<a class="pagination"href=';
						echo '?page=';
						echo $next;
						echo '&id=';
						echo $id;
						echo '>Next</a>';
						echo"||";
					}

				echo '<a class="pagination"href=';
				echo '?page=';
				echo $last_page;
				echo '&id=';
				echo $id;
				echo '>Last Page</a>';

				//nav

				//Pagination

				$AdminOB = false;
				if ( $_SESSION["status"]=="dev" || $_SESSION["status"]=="admin" || $_SESSION["status"]=="owner")
				{
					$AdminOB = true;
				}
	
				while($rows=mysql_fetch_array($result))
				{
					echo '<tr>';
					if( $rows['pinned'] == 1 )
					{
						if( $rows['locked'] == 1 )
						{
							echo '<td><img src="lock.png" border="0" alt="locked" class="avatar"></td>';
						}
						else
						{
							echo '<td ><img src="pinned.png" border="0" alt="Pinned" class="avatar"></td>';
						}
				
						echo '<td>';	
						if ( $AdminOB == true )
						{
							echo '<a href="main_forum.php?op=unpin&thredid=';
							echo $rows['id'];
							echo '"><img src="pin.png" border="0" alt="Pin/unpin" class="avatar"/></a>';
	
							echo '<a href="main_forum.php?op=lock&thredid=';
							echo $rows['id'];
							echo '&locked=';
							echo $rows['locked'];
							echo '"><img src="llock.png" border="0" alt="Lock/Unlock" class="avatar"/></a>';

							echo '<a href="main_forum.php?op=remove&thredid=';
							echo $rows['id'];
							echo '&catid=';
							echo $rows['catid'];
							echo '"><img src="remove.png" border="0" alt="Remove" class="avatar"/></a>';
						}	
					echo '<a href="view_topic.php?id='; 
					echo $rows['id']; 
					echo '">';
					echo $rows['topic']; 
					echo '</a></font><BR></td>';
					echo '<td align="center">'; 
					echo $rows['view'];
					echo '</font></td>';
					echo '<td align="center">'; 
					echo $rows['reply']; 
					echo '</font></td>';
					echo '<td align="center">'; 
					echo $rows['datetime'];
					echo '</font></td>';
					echo '</tr>';
				}	
			}
		?>


		<?php
			$start = ($page-1)*$per_page;
	
			$limit = "SELECT * FROM $tbl_name WHERE catid ='$id' LIMIT $start, $per_page";  
			$result=mysql_query($limit);

			while($rows=mysql_fetch_array($result))
			{ // Start looping table row

				echo '<tr>';
				if( $rows['pinned'] == 0 )
				{
					if( $rows['locked'] == 1 )
					{
						echo '<td><img src="lock.png" border="0" alt="locked" class="avatar"></td>';
					}
					else
					{
						echo '<td><img src="question.png" border="0" alt="" class="avatar"></td>';
					}
			
					echo '<td>';	
					if ( $AdminOB == true )
					{
						echo '<a href="main_forum.php?op=pin&thredid=';
						echo $rows['id'];
						echo '"><img src="pin.png" border="0" alt="Pin/unpin" class="avatar"/></a>';

						echo '<a href="main_forum.php?op=lock&thredid=';
						echo $rows['id'];
						echo '&locked=';
						echo $rows['locked'];
						echo '"><img src="llock.png" border="0" alt="Lock/Unlock" class="avatar"/></a>';

						echo '<a href="main_forum.php?op=remove&thredid=';
						echo $rows['id'];
						echo '&catid=';
						echo $rows['catid'];
						echo '"><img src="remove.png" border="0" alt="Remove" class="avatar"/></a>';
					}
					echo '<a href="view_topic.php?id='; 
					echo $rows['id']; 
					echo '">';
					echo $rows['topic']; 
					echo '</a></font><BR></td>';
					echo '<td align="center">'; 
					echo $rows['view'];
					echo '</font></td>';
					echo '<td align="center">'; 
					echo $rows['reply']; 
					echo '</font></td>';
					echo '<td align="center">';
					echo $rows['datetime'];
					echo '</font></td>';
					echo '</tr>';
				}
			}

		?>
	</form>
	
	<?php
		// Exit looping and close connection
		mysql_close();
	?>
	
	<tr>

		<?php
			session_start();
			if ($_SESSION["valid_user"])
			{
				echo '<td colspan="5" align="right"><a href="create_topic.php?id=';
				echo $id;
				echo '"><strong>Create New Topic</strong> </a></td>';
			}
		?>

		</tr>
	</table>
	</table>

	<?php
		//Nav

        		echo '<a class="pagination"href=';
		echo '?page=';
		echo $first_page;
		echo '&id=';
		echo $id;
		echo '>First Page</a>';
		echo"||";
	
		if($page == $first_page)
		{
        			
    		}
		else
		{
        			$previous = $page-1;
        			echo '<a class="pagination"href=';
			echo '?page=';
			echo $previous;
			echo '&id=';
			echo $id;
			echo '>Previous</a>';
			echo"||";
		}

	
		if($page == $last_page)
		{
    		   
		}
		else
		{
 	       		$next = $page+1;
 	       		echo '<a class="pagination "href=';
			echo '?page=';
			echo $next;
			echo '&id=';
			echo $id;
			echo '>Next</a>';
			echo"||";
		}

		echo '<a class="pagination"href=';
		echo '?page=';
		echo $last_page;
		echo '&id=';
		echo $id;
		echo '>Last Page</a>';
	?>
</p>

</div>
</td>
</tr>
</table>
</center>

</html>