<?php
    include('Connection.php')
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	<div class="container">
		<div class="img">
			<img src="cd.png">
		</div>
		<div class="login-content">
			<form action="#" method="POST" enctype="multipart/form-data">
			<img src="abhaya.png">
				<h3 class="title">STUDENT LOG-IN</h3>
           		<div class="input-div one">
           		   <div class="i">
           		   		<i class="fas fa-user"></i>
           		   </div>
           		   <div class="div">
           		   		<h5>Username</h5>
						<input type="text" class="input" name="name">
           		   </div>
           		</div>
           		<div class="input-div pass">
           		   <div class="i"> 
           		    	<i class="fas fa-lock"></i>
           		   </div>
           		   <div class="div">
           		    	<h5>Password</h5>
						<input type="password" class="input" name="password">
            	   </div>
            	</div>
            	<a href="#">Forgot Password?</a>
            	<input type="submit" class="btn" name="signin" value="Login">
            </form>
        </div>
    </div>
    <script type="text/javascript" src="main.js"></script>
	<?php
            if(isset($_POST['name'])){
                $name_given_by_user=$_POST['name'];
                $password_given_by_user=$_POST['password'];
                $query1="SELECT * FROM students_data WHERE name='".$name_given_by_user."'AND password='".$password_given_by_user."' limit 1";
                $result1=mysqli_query($con,$query1);

                if(mysqli_num_rows($result1)==1)
                {
                    setcookie("namecookie",$name_given_by_user);
                    header("Location:students_main_web.html");
                }
                else{
                echo"<script>alert('wrong username or password')</script>";
                exit();
                }   
            }
    ?>
</body>
</html>