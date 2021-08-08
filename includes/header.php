<?php
require "config/config.php";
if(isset($_SESSION['username'])){
    $userLoggedIn=$_SESSION['username'];
    $userData=mysqli_query($con,"SELECT * FROM users where username='$userLoggedIn'");
    $user=mysqli_fetch_array($userData);
}else{
    header('Location:register.php');
}

?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="css/header.css">
    <link rel="stylesheet" type="text/css" href="css/container.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    
    <script src="js/jQuery.js"></script>
    
</head>

<body style="background:#e9ebee">
    <div class="top_bar">
        <div class="logo">
            <a href="index.php"><img src="icons/logo.png" class="logo_img"></a>
        </div>
        <div class="search">
            <input type="text" placeholder="Search...">
        </div>
        <nav>
            <a href="<?php echo $userLoggedIn;?>"><img id="profile_img" src="<?php echo $user['profile_pic'];?>"></a> 
            <a href="<?php echo $userLoggedIn;?>" class="navbar_links"><?php echo $user['fname'].' '.$user['lname']?></a>
            <a href="index.php" class="navbar_links">Home</a>
            <a href="index.php" class="navbar_links">Friends</a>
            <img src="icons/message.png" class="navbar_icons">
            <img src="icons/user.png" class="navbar_icons">
            <img src="icons/notification.png" class="navbar_icons">
            <a href="includes/form_handler/logout.php"><img src="icons/arrow.png" id="arrow_icon"></a>
        </nav>

    </div>
    