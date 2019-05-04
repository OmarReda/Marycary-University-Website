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
    <li><a class="active" href="profile.php">Profile</a></li>
    <li><a href="Courses.php">Courses</a></li>
    <li><a href="ChooseDepartment.php?logout='1'" class="list-group-item" style="color: red;">Log Out</a></li>
  </ul>
</div>

<div class="profile">
        <table>
          <tr>
            <th>Title</th>
            <th>Information</th>
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

  $sql = "SELECT * from student s, department d WHERE s.dept_ID = d.dept_ID AND s.username = '".$_SESSION['username']."'";

  $result = $conn->query($sql);

  if($result-> num_rows > 0){
    while($row = $result-> fetch_assoc()){
    echo "<tr><td>UserID</td><td>" . $row["user_ID"]. "</td></tr><td>Username</td><td>" . $row["username"] . "</td></tr><td>Email</td><td>" . $row["email"] . "</td></tr><td>Department ID</td><td>" . $row["name"] . "</td></tr><td>Registration Date</td><td>" . $row["registration_Date"] . "</td></tr>";
    }
    echo "</table>";
    } else { echo "0 results"; }
      $conn->close();
    ?>
    </table>
    </div>

    <?php } else {
    $content = 'You Did not Choose Your Department Yet!';
    $content2 ='No Information to Dispaly, Please Choose your Department.';
    echo '<span class="style3"><strong>'.$content.'</strong></span>';
    echo '<span class="style4">'.$content2.'</span>';}?>
  
</body>
</html>
