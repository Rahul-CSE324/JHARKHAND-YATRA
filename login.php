<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: url("header_image.jpg");
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .bg-image {
            position: fixed;
            top: 0; left: 0;
            width: 100%;
            height: 100%;
            background: url('img/header_image.jpg') no-repeat center center/cover;
            z-index: -1;
        }
        .login-container {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter:blur(15px);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 20px rgba(20, 62, 103, 0.69);
            width: 300px;
            text-align: center;
        }
        .login-container:hover {
            transform: translateY(-10px);
            box-shadow: 0 12px 20px rgba(0,0,0,0.3);
        }


        h2 {
            margin-bottom: 20px;
            color: #333;
        }

        .input-group {
            margin-bottom: 15px;
            text-align: left;
        }

        label {
            font-size: 14px;
            color: #555;
        }

        input {
            width: 90%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        .btn {
            width: 100%;
            padding: 10px;
            border: none;
            background-color:rgba(3, 5, 147, 0.81);
            color: white;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn:hover {
            background-color:rgb(3, 98, 51);
        }

        .link {
            margin-top: 10px;
        }

        .link a {
            color: #8000ffff;
            text-decoration: none;
        }

        .link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="bg-image"></div>
    
   <?php

   include("config.php");
   
   if(isset($_POST["submit"])){
   
   $Email=$_POST["Email"];
   
   $Password=$_POST["Password"];
   
   $result=mysqli_query($con, "SELECT * FROM users WHERE Email='$Email' AND password='$Password'") or die("Cann't fetching the data");
   
   $data=mysqli_fetch_assoc($result);
   
   if (is_array($data) && !empty($data)){
   
   $_SESSION['Email']=$data["Email"];
   
   $_SESSION['Age']=$data["Age"];
   
   $_SESSION['Username']=$data["Username"];
   
   $_SESSION['Id']=$data["Id"];
   
   }else{ echo "<div class='massage'>Wrong input</div>";
   
   echo "<a href='login.php'><button class='btn'>Go back</button></a>";
   
   }
   if (isset($_SESSION['Email'])){
   
   header('location: home.html');
   
   }
}
    ?>

    <div class="login-container">
        <h2>Login</h2>
        <form action="" method="post">
            <div class="input-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="Email" placeholder="Enter your email" required>
            </div>
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="Password" placeholder="Enter your password" required>
            </div>
            <input type="submit" value="Log In" class="btn" name="submit">
        </form>
        <div class="link">
            Don't have an account? <a href="register.php">Sign up now</a>
        </div>
    </div>
</body>
</html>
