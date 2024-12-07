<?php
include("conf.php");
if (isset($_POST['submit'])) {
    $name=mysqli_real_escape_string($con,$_POST['name']);
    $email=mysqli_real_escape_string($con,$_POST['email']);
    $pass=mysqli_real_escape_string($con,md5($_POST['password']));
    $cpass=mysqli_real_escape_string($con,md5($_POST['cpassword']));
    $image=$_FILES['image']['name'];
    $image_size=$_FILES['image']['size'];
    $image_tmp=$_FILES['image']['tmp_name'];
    $image_folder='image/'.$image;
    $select=mysqli_query($con,"SELECT * FROM user WHERE email= '$email' AND 
    password='$pass'") or die('qurey faild');
    
    if (mysqli_num_rows($select)>0) {
        $massage[]='user alread exist';
    }else {
        if ($pass!=$cpass) {
            $massage[]='confirm password not matched!';
        }elseif ($image_size>200000) {
            $massage[]='image size is too large!';
        }else {
            $insert=mysqli_query($con,"INSERT INTO user(name,email,password,image) VALUE('$name', '$email', '$pass', '$image')")
            or die('conect failed');
        }if (mysqli_num_rows($select) > 0) {
            $message[] = 'User already exists';
        } else {
            if ($pass != $cpass) {
                $message[] = 'Confirm password does not match';
            } elseif ($image_size > 2000000) {
                $message[] = 'Image is too large';
            } else {
                $insert = mysqli_query($con, 
                    "INSERT INTO user(name, email, password, image) VALUES('$name', '$email', '$pass', '$image')"
                ) or die('query failed');
                
                if ($insert) {
                    move_uploaded_file($image_tmp_name, $image_folder);
                    $message[] = 'Registered successfully';
                    header('location: login.php');
                } else {
                    $message[] = 'Registration failed';
                }
            }
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="form-container">
        <form action="" method="post" enctype="multipart/form-data">
            <h3>register now</h3>
            <?php
            if (isset($massage)) {
                foreach($massage as $massage){
                    echo '<div class="massage">'.$massage.'</div>';
                }
            }
            ?>

            <input type="text" name="name" placeholder="username" class="box" required>
            <input type="email" name="email" placeholder="email" class="box" required>
            <input type="password" name="password" placeholder="password" class="box" required>
            <input type="password" name="cpassword" placeholder="confirm password" class="box" required>
            <input type="file" name="image" class="box" accept="image/jpg,image/jpeg,image/png">
            <input type="submit" name="submit" value="register now" class="btn">
            <p>already have an account? <a href="login.php">login now</a></p>
        </form>
    </div>
</body>

</html>