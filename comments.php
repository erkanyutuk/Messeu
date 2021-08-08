<?php
require "config/config.php";
include "includes/classes/user.php";
include "includes/classes/post.php";
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
    <title></title>
</head>

<body>


    <?php
    if(isset($_GET["post_id"])){
        $post_id=$_GET["post_id"];
    }
    $user_query=mysqli_query($con,"SELECT * FROM posts WHERE id='$post_id'");
    $row_com=mysqli_fetch_array($user_query);
    $posted_to=$row_com['added_by'];
    
    if(isset($_POST['postComment'.$post_id])){
        $post_body=$_POST['post_body'];
        $post_body=mysqli_escape_string($con,$post_body);
        $date_time_now=date("Y-m-d H:i:s");

        $sql="INSERT INTO comments VALUES('','$post_body','$userLoggedIn','$posted_to','$date_time_now','no','$post_id')";
        mysqli_query($con, $sql);
        
    }
?>


    <form action="comments.php?post_id=<?php echo $post_id;?>" method="post" id="comment_form" name="postComment<?php echo $post_id;?>">
        <input type="text" name="post_body">
        <input type="submit" name="postComment<?php echo $post_id;?>" value="Post">
    </form>

    <!--Load Comments-->
    <?php
    $get_comments=mysqli_query($con,"SELECT * FROM comments where post_id='$post_id' ORDER BY ID ASC");
    $count=mysqli_num_rows($get_comments);
    if($count!=0){
        while($comment=mysqli_fetch_array($get_comments)){
            $comment_body=$comment['post_body'];
            $posted_by=$comment['posted_by'];
            $posted_to=$comment['posted_to'];
            $added_time=$comment['data_added'];
            $removed=$comment['removed'];
            
                $date_time_now=date("Y-m-d H:i:s");
                $start_date=new DateTime($added_time);
                $end_date=new DateTime($date_time_now);
                $interval=$start_date->diff($end_date);

                if($interval->y>=1){
                    if($interval==1)
                        $time_message=$interval->y." year ago.";
                    else
                        $time_message=$interval->y." years ago.";
                }
                else if($interval->m>=1){
                    if($interval->d==0){
                        $days=" ago.";
                    }else if($interval->d==1){
                        $days=$interval->d." day ago.";
                    }else{
                        $days=$interval->d." days ago.";
                    }
                    if($interval->m==1){
                        $time_message=$interval->m." month".$days;
                    }else{
                        $time_message=$interval->m." months".$days;
                    }
                }
                else if($interval->d>=1){
                    if($interval->d==1){
                        $time_message=$interval->d."Yesterday.";
                    }else{
                        $time_message=$interval->d." days ago.";
                    }
                }
                else if($interval->h>=1){
                        if($interval->h==1){
                        $time_message=$interval->h." hour ago.";
                    }else{

                        $time_message=$interval->h." hours ago.";
                    }
                }
                else if($interval->i>=1){
                        if($interval->i==1){
                        $time_message=$interval->i." minute ago.";
                    }else{
                        $time_message=$interval->i." minutes ago.";
                    }
                }
                else{
                    if($interval->s<30){
                        $time_message="Just now.";
                    }
                    else{
                        $time_message=$interval->s." seconds ago.";
                    }

                }
            
                $user_obj=new User($con,$posted_by);
            
            $pro_pic=$user_obj->getPicture();
            $name=$user_obj->getFirstAndLastName();
            echo '<div class="comment_section" >
            <div style="margin-bottom:25px;"><a href="'.$posted_by.'" target="_parent"><img src="'.$pro_pic.'" width="30px" height="30px" style="border-radius:100px;float:left;" title="'.$name.'"></a>
            
            <div class="comment_by" style="background:#e9ebee;margin-left:35px; border-radius:10px; font-size:15px; padding-left:5px;padding-right:5px; line-height:30px;">
                <p><a href="'.$posted_by.'" target="_parent">'
                        .$name.':</a>

                    '.$comment_body.'
                </p>

             </div>

                <span style="font-size:11px;float:right;margin-top:-13px; margin-right:10px;">
                    '.$time_message.'</span>
             </div>
             </div>';
        }
    }
    
    ?>
   

</body>

</html>
