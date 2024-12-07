<?php
include "conf.php";
session_start();
$user_id = $_SESSION['id'];

if(!isset($user_id)){
    header("location: login.php");
}

if(isset($_GET['logout'])){
    unset($user_id);
    session_destroy();
    header("location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <style>
        /* تنسيق الصفحة العامة */
body {
    font-family: "Cairo", sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f9f9f9;
    color: #333;
    line-height: 1.6;
}

.container {
    max-width: 600px;
    margin: 50px auto;
    padding: 20px;
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    text-align: center;
}

/* تنسيق القسم الشخصي */
.profile {
    padding: 20px;
}

/* الصورة الشخصية */
.logo img {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    border: 2px solid #e83a15;
    object-fit: cover;
    margin-bottom: 15px;
}

/* اسم المستخدم */
.profile h3 {
    font-size: 1.5em;
    color: #e83a15;
    margin: 10px 0;
}

/* الروابط */
.profile a {
    display: inline-block;
    margin: 10px 5px;
    padding: 10px 20px;
    color: white;
    text-decoration: none;
    font-size: 1em;
    border-radius: 5px;
}

.profile .update {
    background-color: #007bff;
}

.profile .update:hover {
    background-color: #0056b3;
}

.profile .logout {
    background-color: #e83a15;
}

.profile .logout:hover {
    background-color: #d73210;
}

/* وسائل الإعلام */
@media (max-width: 768px) {
    .container {
        width: 90%;
    }

    .profile h3 {
        font-size: 1.2em;
    }

    .profile a {
        padding: 8px 15px;
        font-size: 0.9em;
    }

    .logo img {
        width: 100px;
        height: 100px;
    }
}

    </style>
</head>
<body>
    <div class="container">
        <div class="profile">
            <?php
                $select = mysqli_query($con,"SELECT * FROM user WHERE id='$user_id'") or die('query failed');
                if(mysqli_num_rows($select) > 0){
                    $fetch = mysqli_fetch_assoc($select);
                }
                if($fetch['image'] == ''){
                    echo "<div class='logo'><img src='image/default.png'></div>";
                }else{
                    echo "<div class='logo'><img src='upload_images/".$fetch['image']."'></div>";
                }
                echo "<h3>". $fetch['name'] ."</h3>";
                echo "
                <div>
                <a href='update.php' class='update'>update profile</a>
                <a href='home.php?logout=".$user_id."' class='logout'>logout</a>
                </div>
                ";
            ?>
        </div>
    </div>
</body>
</html>