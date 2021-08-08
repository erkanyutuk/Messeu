<?php
class User{
    private $user;
    private $con;
    
    public function __construct($con,$user){
        $this->con=$con;
        $user_details_query=mysqli_query($con,"SELECT * FROM users WHERE username='$user'");
        $this->user=mysqli_fetch_array($user_details_query);
    }
    public function getUsername(){
        $username=$this->user['username'];
        return $username;
    }
    
    public function getPicture(){
        $picture=$this->user['profile_pic'];
        return $picture;
    }
    public function isFriend($username_to_check){
        $usernameComma=",".$username_to_check.",";
        if(strstr($this->user['friend_array'],$usernameComma)||$username_to_check==$this->user['username']){
            return true;
        }else{
            return false;
        }
        
        
    }
    public function getNumberPosts(){
        $posts_number=$this->user['num_posts'];
        return $posts_number;
    }
    
    public function getFirstAndLastName(){
       
        $row=$this->user;
        return $row['fname']." ".$row['lname'];
    }
    public function isClosed(){
        $username=$this->user['username'];
        $query=mysqli_query($this->con,"SELECT closed FROM users WHERE username='$username'");
        $row=mysqli_fetch_array($query);
        if($row['closed']=="yes"){
            return true;
        }else{
            return false;
        }
    }
}

?>