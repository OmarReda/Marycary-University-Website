<?php 
	session_start(); 

	if (!isset($_SESSION['username'])) {
		$_SESSION['msg'] = "You must log in first";
		header('location: logIn.html');
	}

	if (isset($_GET['logout'])) {
		session_destroy();
		unset($_SESSION['username']);
		header("location: logIn.html");
	}

?>

<html>
<head>
	<title>
		Welcome
	</title>
	    <link rel="stylesheet" type="text/css" href="style3.css">   
</head>

<body>
	<div class="head">
		<?php  if (isset($_SESSION['username'])) : ?>
			<p><strong>Welcome</strong> <br><?php echo $_SESSION['username']; ?></p>
		<?php endif ?>
	</div>

	<div class="logo"> <p>Marycary University</p></div>


<div class="contain">
  <ul>
    <li><a href="ChooseDepartment.php">Department</a></li>
    <li><a href="profile.php">Profile</a></li>
    <li><a class="active" href="Courses.php">Courses</a></li>
    <li><a href="ChooseDepartment.php?logout='1'" class="list-group-item" style="color: red;">Log Out</a></li>
  </ul>
</div>


<div>
  <table>
    <tr>
   	  <th>Course ID</th>
      <th>Course</th>
      <th>Credit Hours</th>
      <th>Instructor</th>
      <th>Course Description</th>
  </tr>

<?php

   if(isset($_SESSION['dept'])){ 
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "registrations";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 

	$sql = "SELECT Course_ID, Course_Name, Credit_Hours, Instructor_Name, Course_Description from course Where course.dept_ID = '".$_SESSION['dept']."'";

	$result = $conn->query($sql);

	if($result-> num_rows > 0){
		while($row = $result-> fetch_assoc()){
		echo "<tr><td>" . $row["Course_ID"]. "</td><td>" . $row["Course_Name"] . "</td><td>" . $row["Credit_Hours"] . "</td><td>" . $row["Instructor_Name"] . "</td><td>" . $row["Course_Description"] . "</td></tr>";
		}
		echo "</table>";
		} else { echo "0 results"; }
			$conn->close();
		?>
		
<?php } else {
$content = 'You Did not Choose Your Department Yet!';
$content2 ='No Courses To Display';
echo '<span class="style3"><strong>'.$content.'</strong></span>';
echo '<span class="style4">'.$content2.'</span>';}?>
  </table>
 		</div>

</body>
</html>