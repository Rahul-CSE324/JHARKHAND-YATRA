<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
    <style>
        /* Reset default styles */
/* Reset default styles */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Arial, sans-serif;
}

/* Background styling */
body {
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    background: url("img/header_image.jpg") no-repeat center center/cover;
}

/* Container for the form */
.container {
    width: 380px;
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(15px);
    padding: 25px 30px;
    border-radius: 12px;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
    text-align: center;
    position: fixed;
}

/* Form heading */
.container h2 {
    font-size: 26px;
    margin-bottom: 20px;
    color: #333;
}

/* Input fields */
.field.input input {
    width: 100%;
    padding: 12px;
    margin: 10px 0;
    border: 1px solid #ccc;
    border-radius: 8px;
    outline: none;
    font-size: 15px;
    transition: border-color 0.3s, box-shadow 0.3s;
}

.field.input input:focus {
    border-color: #007bff;
    box-shadow: 0 0 6px rgba(0, 123, 255, 0.4);
}
.button{padding: 12px;
    margin-top: 15px;
    background: rgba(3, 5, 147, 0.81);
    border: none;
    border-radius: 8px;
    color: #fff;
    font-size: 16px;
    font-weight: bold;
    cursor: pointer;
    transition: background 0.3s;
}
.button:hover {
    background: #038f1dff;
}

/* Submit button */
.btn {
     position: fixed;      /* keeps it floating on the screen */
    top: 55%;             /* vertically center */
    right: 40px;          /* distance from right edge */
    transform: translateY(-50%)
    width: 100%;
    padding: 12px;
    margin-top: 15px;
    background: rgba(3, 5, 147, 0.81);
    border: none;
    border-radius: 8px;
    color: #fff;
    font-size: 16px;
    font-weight: bold;
    cursor: pointer;
    transition: background 0.3s;
}


/* Link below the form */
.link {
    margin-top: 15px;
    font-size: 14px;
    color: #333;
}

.link a {
    color: #9d00ff;
    text-decoration: none;
}

.link a:hover {
    text-decoration: underline;
}

/* Message box for errors and success */
.massage {
     position: fixed;      /* keeps it floating on the screen */
    top: 50%;             /* vertically center */
    right: 40px;          /* distance from right edge */
    transform: translateY(-50%); /* true vertical centering */
    margin: 15px auto;
    padding: 12px;
    width: 90%;
    max-width: 350px;
    border-radius: 8px;
    font-weight: bold;
    box-shadow: 0 4px 10px rgba(0,0,0,0.2);
    text-align: center;
}

/* Error message style */
.massage {
    background: #f8d7da;
    color: #721c24;
}

/* Success message style */
.massage.success {
    background: #d4edda;
    color: #155724;
}

/* Buttons inside messages (like Go back or Login Now) */
.massage + a button {
    margin-top: 10px;
    width: auto;
    padding: 10px 20px;
    background: #007bff;
    border-radius: 6px;
    font-weight: bold;
    cursor: pointer;
    border: none;
    color: white;
    transition: background 0.3s;
}

.massage + a button:hover {
    background: #0056b3;
}

    </style>
</head>
<body>
    <div class="background"></div> 

    
    <?php
include("config.php");
if (isset($_POST['submit'])) {       
    $Username = $_POST["Username"];
    $Email    = $_POST["Email"];
    $Age      = $_POST["Age"];
    $Password = $_POST["Password"];

    // validate email format
    if (!filter_var($Email, FILTER_VALIDATE_EMAIL) || !preg_match("/@gmail\.com$/", $Email)) {
    echo "<div class='massage'>Only Gmail addresses are allowed!</div>";
    echo "<a href='javascript:self.history.back()'><button class='btn'>Go back</button></a>";
    exit();
}


    // verify unique email
    $verify_query = mysqli_query($con, "SELECT Email FROM users WHERE Email='$Email'");

    if (mysqli_num_rows($verify_query) != 0) {
        echo "<div class='massage'>This email is used, try another one please!</div>";
        echo "<a href='javascript:self.history.back()'><button class='btn'>Go back</button></a>";
    } else {
        mysqli_query($con, "INSERT INTO users (Username, Email, Age, Password) 
        VALUES ('$Username','$Email','$Age','$Password')") or die("Insertion problem");
        
        echo "<div class='massage'>Registration Successfully</div>";
        echo "<a href='login.php'><button class='btn'>Login Now</button></a>";
    }
}

    ?>
    <div class="container">
        <form action="register.php" method="post">
            <h2>Register</h2>
            <div class="field input">
                <input type="text" name="Username" placeholder="Enter your username" required>
            </div>
            <div class="field input">
                <input type="Email" name="Email" placeholder="Enter your email" required>
            </div>
            <div class="field input">
                <input type="number" name="Age" placeholder="Enter your age" required>
            </div>
            <div class="field input">
                <input type="password" name="Password" placeholder="Enter your password" required>
            </div>
            <div class="field">
                <input type="submit" value="Register" name="submit" class="button">
            </div>
            <div class="link">
                Already have an account? <a href="login.php">Log in now</a>
            </div>
        </form>
    </div>
</body>
</html>
