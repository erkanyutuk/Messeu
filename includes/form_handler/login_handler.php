<?php 
if(isset($_POST['login_button'])){
    $login_email=filter_var($_POST['login_email'],FILTER_SANITIZE_EMAIL);
    
    $_SESSION['login_email']=$login_email;
    $login_password=md5($_POST['login_password']);
    $check_database=mysqli_query($con,"SELECT * FROM users WHERE email='$login_email' and password='$login_password'");
    $check_number=mysqli_num_rows($check_database);
    
    if($check_number==1){
        $row=mysqli_fetch_array($check_database);
        $username=$row['username'];
        $_SESSION['username']=$username;
        
        $user_closed=mysqli_query($con,"SELECT * FROM users where email='$login_email' and closed='yes'");
        $closed_number=mysqli_num_rows($user_closed);
        if($closed_number==1){
            $user_reopen=mysqli_query($con,"UPDATE users SET closed='no' where email='$login_email'");
        }
        
        header("Location:index.php");
        exit();
        
    }else{
        array_push($error,'Email or Password was incorrect<br>');
    }
    
    
}
?>