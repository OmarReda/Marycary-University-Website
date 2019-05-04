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

	$conn = mysqli_connect('localhost', 'root', '', 'registrations');
	// Check connection
	if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
	}
	if (isset($_POST['submit'])){
		if(isset($_SESSION['username'])){
			$Department = $_POST['department'];
			$sql = "UPDATE student SET dept_ID = $Department Where student.username = '".$_SESSION['username']."'";
			if (mysqli_query($conn, $sql)) {
			} else {
			    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
			} 			
			$_SESSION['dept'] = $Department;
			$conn->close();
		}
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

<?php if(!isset($_SESSION['dept'])){ ?>
<div class="choose">
 <form action="ChooseDepartment.php" method="post">
 	<p><strong> Please Choose your Department </strong> </p>
 	<p> Be Careful as your choice will be permenant </p>
   <select id="department" name="department">
     <option value="11"> Computer and Communication</option>
     <option value="22"> ElectroMechanical</option>
     <option value="33"> Construction and Architecture</option>
     <option value="44"> Petrochemical</option>
   </select>
   <br><br>
   <input type="submit" name="submit">
 </form>
</div>
	<?php } else {
	$content = 'You Have Already Choose Your Department!';
	$content2 ='If you want to change your department, Please visit your academic advisor. Thank You.';
	echo '<span class="style"><strong>'.$content.'</strong></span>';
	echo '<span class="style2">'.$content2.'</span>';}?>

<div class="contain">
  <ul>
    <li><a class="active" href="ChooseDepartment.php">Department</a></li>
    <li><a href="profile.php">Profile</a></li>
    <li><a href="Courses.php">Courses</a></li>
    <li><a href="ChooseDepartment.php?logout='1'" class="list-group-item" style="color: red;">Log Out</a></li>
  </ul>
</div>



</body>
</html>
