
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
            <h1>Registration List</h1>
        </div>
		
		<!-- <fieldset align="center" style="padding:20px;">
			<legend>register</legend> -->
            <div align="center">
                <?php
                    $conn = mysqli_connect("localhost","root","","mydatabase");
                    if(!$conn){
                        echo "<script>alert('Database connection failed');</script>";
                    }
                    $query="SELECT * FROM students";
                    $result = mysqli_query($conn, $query);
                    echo "<table border='1'>";
                        echo "<tr>
                            <th>First Name</ht>
                            <th>Last Name</ht>
                            <th>Gender</ht>
                            <th>Course</ht>
                        </tr>";
                    while($row = mysqli_fetch_array($result)){
                        echo "<tr>
                            <td> ". $row['firstName']. "</td>
                            <td> ". $row['lastName']. "</td>
                            <td> ". $row['gender']. "</td>
                            <td> ". $row['course']. "</td>
                        </tr>";
                    }

                    echo "</table>";
                    
                ?>
            </div>
			
		<!-- </fieldset> -->

    </div>

    <!-- Footer: starts -->
    <?php include('footer.php');  ?>
    <!-- Footer: stops -->
</body>
</html>