<?php
    $error = array();
    $firstName=$lastName=$email=$password1=$password2= "";
    $conn = mysqli_connect("localhost","root","","mydatabase");
    if(!$conn){
        echo "<script>alert('Database connection failed');</script>";
    }
    if(isset($_POST['registration_btn'])){
        $firstName = testInput($_POST['firstName']);
        $lastName = testInput($_POST['lastName']);
        $course = testInput($_POST['course']);
        $gender = testInput($_POST['gender']);
        $contact = testInput($_POST['contact']);
        $email = testInput($_POST['email']);
        
        if(empty($firstName)){
            array_push($error, "First name is required");
        }
        if(empty($lastName)){
            array_push($error, "Last name is required");
        }
        if(empty($email)){
            array_push($error, "email is required");
        }
        if(empty($contact)){
            array_push($error, "Contact is required");
        }
        if(empty($gender)){
            array_push($error, "Gender is required");
        }

        $duplicate=mysqli_query($conn,"select * from students where email='$email'");
	   if (mysqli_num_rows($duplicate) > 0){
			array_push($errors, "User already exist.");
	   }

        if(count($error) == 0){
            $conn = mysqli_connect("localhost","root","","mydatabase");
            if(!$conn){
                echo "ERROR in database connection";
                exit();
            }
            $query = "INSERT INTO students(firstName, lastName, course, gender, contact, email) 
            VALUES('$firstName', '$lastName', '$course', '$gender', '$contact', '$email')";
            if(mysqli_query($conn, $query)){
                header("location:index.php");
            }else{
                echo "<script>alert('Something went wrong');</script>";
            }
            
        }
        
    }
    
    function printError($error){
        echo "<h3 style='color:red;'>";
        foreach($error as $value){
            echo $value ."<br>";
        }
        echo "</h3>";
    }
    function testInput($data){
        $data = trim($data);
        $data = stripcslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <!-- Navegation bar: Starts -->
    <?php include('header.php'); ?>
    <!-- Navegation bar: Stops -->
	
    <div class="container">
        <div class="title">
            <h1>Register for a course</h1>
        </div>
		
		<!-- <fieldset align="center" style="padding:20px;">
			<legend>register</legend> -->
            <div align="center">
                <?php if(isset($error)){printError($error);} ?>
            <form action="registration.php" method="post"  >
                <label>First Name:</label>
                <input type="text" name="firstName" placeholder="Enter first name"><br><br>
                <label>Last Name:</label>
                <input type="text" name="lastName" placeholder="Enter last name"><br><br>
                <label>Select Course:</label>
                <select name="course">
                    <option value="Web Design">Web Design</option>
                    <option value="Graphics Design">Graphics Design</option>
                    <option value="Java Programming">Java Programming</option>
                    <option value="Mobile App">Mobile App</option>
                    <option value="IT Essentials">IT Essentials</option>
                </select><br><br>
                <label>Gender:</label>
                Male: <input type="radio" name="gender" value="Male">
                Female: <input type="radio" name="gender" value="Female"><br><br>
                <label>Contact:</label>
                <input type="text" name="contact" placeholder="Enter phone number"><br><br>
                <label>Email</label>
                <input type="email" name="email" placeholder="Enter email"><br><br>
                <input type="submit" value="Submit" name="registration_btn">
                <input type="reset" value="Reset">
            </form>
            </div>
			
		<!-- </fieldset> -->

    </div>

    <!-- Footer: starts -->
    <?php include('footer.php');  ?>
    <!-- Footer: stops -->
</body>
</html>