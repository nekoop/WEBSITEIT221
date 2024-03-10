<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Registration</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<link rel="stylesheet" href="style.css">

</head>
<body>
	<form action="register.php" method="post">
		<div class="container register-form">
			<div class="form">
			<?php
    if(isset($_POST["FirstName"])){
        $LastName = $_POST["LastName"];
        $FirstName = $_POST["FirstName"];
        $MiddleName = $_POST["MiddleName"];
        $Country = $_POST["countrySelect"];
        $Municipality = $_POST["MunicipalitystateSelect"];
        $City = $_POST["citySelect"];
        $Barangay = $_POST["barangaySelect"];
        $LotBlk = $_POST["lot_blk"];
        $Street = $_POST["street"];
        $Subdivision = $_POST["subdivision"];
        $ContactNumber = $_POST["contact_number"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $RepeatPassword = $_POST["repeat_password"];
        $errors = array();
       
        // Validate if all fields are empty
        if (empty($LastName) || empty($FirstName) || empty($MiddleName) || empty($Country) || empty($Municipality) || empty($City) || empty($Barangay) || empty($LotBlk) || empty($Street) || empty($Subdivision) || empty($ContactNumber) || empty($email) || empty($password) || empty($RepeatPassword)) {
            array_push($errors, "All fields are required");
        }
        // Validate if the email is valid
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
            array_push($errors, "Email is not valid");
        }
        // Password should not be less than 8 characters
        if (strlen($password) < 8) {
            array_push($errors, "Password must be at least 8 characters long");
        }
        // Check if passwords match
        if ($password != $RepeatPassword){
            array_push($errors, "Passwords do not match");
        }
 
        // Password hashing
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
 
        // Database connection
        require_once "database.php";
 
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $rowCount = $result->num_rows;
        if ($rowCount > 0) {
            array_push($errors, "Email Already Exists!");
        }
        //echo("Selected the users");
        if (count($errors) > 0){
            foreach($errors as $error) {
                echo "<div class='alert alert-danger'>$error</div>";
            }
        } else {
            // Insert user data into the database
            $sql = "INSERT INTO users(LastName, FirstName, MiddleName, Country, Municipality, City, Barangay, LotBlk, Street, Subdivision, ContactNumber, email, password) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssssssssssss", $LastName, $FirstName, $MiddleName, $Country, $Municipality, $City, $Barangay, $LotBlk, $Street, $Subdivision, $ContactNumber, $email, $passwordHash);
 
            //echo($conn->error);
            if ($stmt->execute()) {
                echo "<div class='alert alert-success'> You are Registered Successfully! </div>";
            } else {
                echo "<div class='alert alert-danger'>Registration failed. Please try again later.</div>";
            }
        }
    }
    ?>
        <h3>Registration form</h3>
        <h4>Full name</h4>
        <form action="registration.php" method="POST">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="LastName">Last Name</label>
                        <input type="text" class="form-control" name="LastName" id="LastName" placeholder="Lastname" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="FirstName">First Name</label>
                        <input type="text" class="form-control" name="FirstName" id="FirstName" placeholder="Firstname" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="MiddleName">Middle Name</label>
                        <input type="text" class="form-control" name="MiddleName" id="MiddleName" placeholder="Middlename" required>
                    </div>
                </div>
            </div>
            <!-- Country, State, City selection dropdowns -->
            <h4>Country</h4>
            <div class="form-g">
                <select class="form-select country" name="countrySelect" id="countrySelect" aria-label="Default select example" onchange="loadStates()">
                    <option selected>Select Country</option>
                </select>
 
                <select class="form-select state" name="MunicipalitystateSelect" id="MunicipalitystateSelect" aria-label="Default select example" onchange="loadCities()">
                    <option selected>Select State</option>
                </select>
 
                <select class="form-select city" name="citySelect" id="citySelect" aria-label="Default select example">
                    <option selected>Select City</option>
                </select>
               
                <select class="form-select barangay"  name="barangaySelect" id="barangaySelect" aria-label="Default select example">
                    <option selected>Select Barangay</option>
                    <option value="Barangay 1">Barangay 1</option>
                    <option value="Barangay 2">Barangay 2</option>
                </select>
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <div class="row">
                    <div class="col-md-4">
                        <input type="text" class="form-control" name="lot_blk" id="lot_blk" placeholder="Lot/BLK" required>
                    </div>
                    <div class="col-md-4">
                        <input type="text" class="form-control" name="street" id="street" placeholder="Street" required>
                    </div>
                    <div class="col-md-4">
                        <input type="text" class="form-control" name="subdivision" id="subdivision" placeholder="Subdivision" required>
                    </div>
                </div>
            </div>
 
            <div class="form-group">
                <label for="contact_number">Contact Number</label>
                <input type="text" class="form-control" name="contact_number" id="contact_number" placeholder="Contact Number" required>
            </div>
           
 
            <!-- Other fields and dropdowns -->
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="Enter your email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="**********" required>
            </div>
            <div class="form-group">
                <label for="repeat_password">Please Repeat Password</label>
                <input type="password" class="form-control" name="repeat_password" id="repeat_password" placeholder="**********" required>
            </div>
 
 
 
 
            <div class="form-group">
                <button type="submit" class="btn btn-primary">
                    Register Now!
                    <span class="btn-icon"><i class="fas fa-user-plus"></i></span>
                </button>
            </div>
 
            <div>
            <p class="already-registered-text">Already Registered? <a href="login.php" class="already-registered-link">Login Here</a></p>
            </div>
        </form>
 
    </div>
 
    <script src="app.js"></script>
 
    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
 
  </body>
</html>