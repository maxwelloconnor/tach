<?php 
/*
Group 22 - Miguel Macciocchi, Keith Mathur, Max O'Connor, Liam Stachiw
Date: 
Course: WEBD3201
Brief Description:
*/

include "header.php";

if(isset($_SESSION['user']))
{
	isDisabled(trim($_SESSION['user']['profile_status']));
	
	if (trim($_SESSION['user']['profile_status']) != "COMPLETE")
	{
		$_SESSION['error'] = "<p>Sorry, but your profile must be COMPLETE in order to view 'Interests'.</p>";
		header("Location: acceptable-use.php");
	}
	
	if (isset($_POST['delete']))
	{
		$result_delete = pg_prepare($dbconn, 'user_delete_interest', $sql_delete_interest);
		$result = pg_execute($dbconn, 'user_delete_interest', array($_POST['listing_id']));
		
		unset($_POST['delete']);
	}
	
	$results = pg_prepare($dbconn, 'user_interests_query', $sql_user_interests);
	$results = pg_execute($dbconn, 'user_interests_query', array(trim($_SESSION['user']['user_id'])));
	$records = pg_num_rows($results);
	
	$related_results = pg_prepare($dbconn, 'user_interests_in_query', $sql_user_interested_in);
	$related_results = pg_execute($dbconn, 'user_interests_in_query', array(trim($_SESSION['user']['user_id'])));	
	$related_records = pg_num_rows($related_results);
	
	if (pg_num_rows($results) == 0)
	{
		$error = "<p>You currently have no interests.</p>";
	}
}
?>

<div class="body">
	<div class="container">
	
		<?php 
			
			if (isset($error))
			{
				echo $error;
			}
			
			if (isset($records))
			{
				if ($records > 0)
				{
					
					echo "<h1>Here are your interests:</h1>";
					for ($i = 0; $i < $records; $i++)
					{
						$row = pg_fetch_assoc($results, $i);
						
						echo "<form method='POST' action=". $_SERVER['PHP_SELF'] .">";
							echo'<tr>';
								echo "<td>".$row["user_id_interested_in"]."</td>  ";
								echo "<td bgcolor='#fffb28'>". $row["date_interested"]. "<input type='hidden' name='listing_id' value='".$row['listing_id']."'></td>    ";
								echo "<td><input name='delete' type='submit' value='Remove'>" . "<input type='hidden' name='listing_id' value='".$row['listing_id']."'></td>";
							echo '</tr> <br/>';
						echo '</form>';
					}
				}
			}
			
			if (isset($related_records))
			{
				if ($related_records > 0)
				{
					echo "<h1>Here are people interested who are interested in you:</h1>";
					for ($i = 0; $i < $related_records; $i++)
					{
						$row = pg_fetch_assoc($related_results, $i);
						
						echo "<form method='POST' action=". $_SERVER['PHP_SELF'] .">";
							echo'<tr>';
								echo "<td bgcolor='#fffb28'>". $row["user_id_interested"]. "<input type='hidden' name='listing_id' value='".$row['listing_id']."'></td>    ";
								echo "<td><input name='delete' type='submit' value='Remove'>" . "<input type='hidden' name='listing_id' value='".$row['listing_id']."'></td>";
							echo '</tr> <br/>';
						echo '</form>';
					}
				}
			}
		?>
	
	</div>
</div>

<?php include "footer_f.php"; ?>