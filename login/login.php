<?php
include("conf.php");
session_start();
if (isset($_POST['submit'])) {
    $email=mysqli_real_escape_string($con,$_POST['email']);
    $pass=mysqli_real_escape_string($con,md5($_POST['password']));
    $select=mysqli_query($con,"SELECT * FROM user WHERE email= '$email' AND 
    password='$pass'") or die('qurey faild');
    
    if (mysqli_num_rows($select)>0) {
        $row = mysqli_fetch_assoc($select);
        $_SESSION['id']= $row['id'];
        header("location: home.php");
    }else {
        $message[] = 'email or password incorrect';
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="form-container">
        <form action="" method="post" enctype="multipart/form-data">
            <h3>login now</h3>
            <?php
            if (isset($massage)) {
                foreach($massage as $massage){
                    echo '<div class="massage">'.$massage.'</div>';
                }
            }
            ?>
            
            <input type="email" name="email" placeholder="email" class="box" required>
            <input type="password" name="password" placeholder="password" class="box" required>
            <input type="submit" name="submit" value="login now" class="btn">
            <p>already have an account? <a href="reg.php">register now</a></p>
        </form>
    </div>
</body>
</html>