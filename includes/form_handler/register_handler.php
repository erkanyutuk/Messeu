<?php

$fname='';
$lname='';
$email='';
$password='';
$cpassword='';
$date='';
$error=array();

if(isset($_POST['register_button'])){
    
    //First Name
    $fname=strip_tags($_POST['reg_fname']);
    $fname=str_replace(' ','',$fname);
    $fname=ucfirst(strtolower($fname));
    $_SESSION['reg_fname']=$fname;
    
    //Last Name
    $lname=strip_tags($_POST['reg_lname']);
    $lname=str_replace(' ','',$lname);
    $lname=ucfirst(strtolower($lname));
    $_SESSION['reg_lname']=$lname;
    
    //Email
    $email=strip_tags($_POST['reg_email']);
    $email=str_replace(' ','',$email);
    $email=strtolower($email);
    $_SESSION['reg_email']=$email;
    
    //Password
    $password=strip_tags($_POST['reg_password']);
    $cpassword=strip_tags($_POST['reg_cpassword']);
    
    $date=date("Y-m-d");
    
    
    
    
        if(filter_var($email,FILTER_VALIDATE_EMAIL)){
           $email=filter_var($email,FILTER_VALIDATE_EMAIL);
           $domain = explode("@", $email, 2);
           if(checkdnsrr($domain[1])){
               $e_check=mysqli_query($con,"SELECT email FROM users WHERE email='$email'");
               $num_rows=mysqli_num_rows($e_check);
               if($num_rows>0){
                   array_push($error,'Email already in use<br>');
                   
                 }
           }else{
               array_push($error,'Email Address is invalid<br>');
               
           }
        
       }else{
           array_push($error,'Email Address is invalid<br>');
       }
        
        
        
    
        
    
    
    if(strlen($fname)>25||strlen($fname)<3){
        array_push($error,'Your First Name must be between 2 and 25 character<br>');
      
    }
    
    
    if(strlen($lname)>25||strlen($lname)<3){
        array_push($error,'Your Last Name must be between 2 and 25 character<br>');
    }
    
    
    if(strlen($password)>30||strlen($password)<5){
        array_push($error,'Your Password must be between 5 and 30 character<br>');
        
    }
    
    
    if(strlen($password!=$cpassword)){
        array_push($error,'Password dont Match<br>');
    }
    else{
        if(preg_match('/[^A-Za-z0-9]/',$password)){
             array_push($error,'Your password can only contain english characters or numbers<br>');
        }
    }
    
    if(empty($error)){
        $password=md5($password);
        $username=strtolower($fname.'_'.$lname);
        $check_username=mysqli_query($con,"SELECT username FROM users where username='$username'");
        $i=0;
        while(mysqli_num_rows($check_username)){
            $username=$username.'_'.$i;
            $check_username=mysqli_query($con,"SELECT username FROM users where username='$username'");
            $i++;           
        }
        $rand=rand(1,2);
        if($rand==1){$profile_pic='images/profile_pic/defaults/head_deep_blue.png';}
        if($rand==2){$profile_pic='images/profile_pic/defaults/head_emerald.png';}
        $query=mysqli_query($con,"INSERT INTO users VALUES('','$fname','$lname','$username','$email','$password','$date','$profile_pic', '0' , '0' , 'no' , ',')");
        
        $check_username=mysqli_query($con,"SELECT * FROM users WHERE username='$username'");
        if(mysqli_num_rows($check_username)==1){
        $_SESSION['username']=$username;
        header("Location:index.php");
        exit();
        }
    }
    
    
}       
?>
