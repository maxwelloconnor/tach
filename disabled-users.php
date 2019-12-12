<?php 
/*
Group 22 - Miguel Macciocchi, Keith Mathur, Max O'Connor, Liam Stachiw
Date: 
Course: WEBD3201
Brief Description:
*/

include "header.php";

$userType = trim($_SESSION['user']['user_type']);

if ($userType != 'a')
{
	header("Location: index.php");
}
else
{
	$results = pg_prepare($dbconn, "disable_users_query", $sql_check_disable_user);
	$results = pg_execute($dbconn, "disable_users_query", array('DISABLED'));
	
	$records = pg_num_rows($results);
}
?>

<div class="body">
	<div class="container">
	
		<?php 
			if (pg_num_rows($results) == 0)
			{
				echo "<p>There are currently no disabled users.</p>";
				
				$footer = "footer_f.php";

			}
			else
			{
				$footer = "footer.php";
				
				$output_table = "<table>";
				$output_table .= "<tr>";
				$output_table .= "<th>User ID</th>";
				$output_table .= "<th>First Name</th>";
				$output_table .= "<th>Last Name</th>";
				$output_table .= "<th>Email Address</th>";
				$output_table .= "<th>Last Access</th>";
				$output_table .= "<th>Profile Status</th>";
				$output_table .- "</tr>";
				
				for ($i = 0; $i < $records; $i++)
				{
					$row = pg_fetch_assoc($results, $i);
					
					$output_table .= "<tr>";
					$output_table .= "<td>".$row['user_id']."</td>";
					$output_table .= "<td>".$row['first_name']."</td>";
					$output_table .= "<td>".$row['last_name']."</td>";
					$output_table .= "<td>".$row['email_address']."</td>";
					$output_table .= "<td>".$row['last_access']."</td>";
					$output_table .= "<td>".$row['profile_status']."</td>";
					$output_table .- "</tr>";
				}
				$output_table .= "</table>";
				
				echo $output_table;
			}
		?>
	
	</div>
</div>

<?php include 'footer_f.php'; ?>