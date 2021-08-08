<?php
class Post{
    private $user_obj;
    private $con;
    
    public function __construct($con,$user){
        $this->con=$con;
        $this->user_obj=new User($con,$user);
    }
    
    public function submitPost($body,$user_to){
        $body=strip_tags($body);
        $body=mysqli_real_escape_string($this->con,$body);
        $check_empty=preg_replace('/\s+/','',$body);
        
        
        if($check_empty!=''){
            $data_added=date("Y-m-d H:i:s");
            $added_by=$this->user_obj->getUsername();
            
       
        if($user_to==$added_by){
            $user_to="none";
        }
        $query=mysqli_query($this->con,"INSERT INTO posts VALUES('','$body','$added_by','$user_to','$data_added','no','no','0')");
        $returned_id=mysqli_insert_id($this->con);
        
        $num_posts=$this->user_obj->getNumberPosts();
        $num_posts++;
        $update_query=mysqli_query($this->con,"UPDATE users SET num_posts='$num_posts' WHERE username='$added_by'");
    }
    }
   
    public function loadPostsFriends($data,$limit){
        $page=$data['page'];
        $userLoggedIn=$this->user_obj->getUsername();
        if($page==1)
            $start=0;
        else
            $start=($page-1)*$limit;
        
        
        $str="";
        $data_query=mysqli_query($this->con,"SELECT * FROM posts WHERE deleted='no' ORDER BY id DESC");
        if(mysqli_num_rows($data_query)>0){
            $num_iterations=0;
            $count=1;
            
            while($row=mysqli_fetch_array($data_query)){
                $id=$row['id'];
                $body=$row['body'];
                $added_by=$row['added_by'];
                $date_time=$row['data_added']; 
                $time_message="";


            if($row['user_to']=='none'){
                $user_to="";
            }else{
                $user_to_obj=new User($this->con,$row['user_to']);
                $user_to_name=$user_to_obj->getFirstAndLastName();
                $user_to="<a href='".$row['user_to']."'>".$user_to_name."</a>";
            }
            $added_by_obj=new User($this->con,$added_by);
            if($added_by_obj->isClosed()){
                continue;
            }
            $user_loged_obj=new User($this->con,$userLoggedIn);
            if($user_loged_obj->isFriend($added_by)){

                if($num_iterations++<$start){continue;}
                if($count>$limit){break;}else{$count++;}

                $user_details_query=mysqli_query($this->con,"SELECT fname, lname, profile_pic FROM users WHERE username='$added_by'");
                $user_rows=mysqli_fetch_array($user_details_query);
                $fname=$user_rows['fname'];
                $lname=$user_rows['lname'];
                $profile_pic=$user_rows['profile_pic'];
                ?>
                <script>
                    function toggle<?php echo $id;?>(){
                        var comment=document.getElementById('toogleComment<?php echo $id;?>');
                        if(comment.style.display=='block'){
                            comment.style.display='none';
                        }else{comment.style.display='block';}
                    }
                </script>
                <?php
                $date_time_now=date("Y-m-d H:i:s");
                $start_date=new DateTime($date_time);
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

                $str.="<div class='post_main' onClick='javascript:toggle$id()'>

                            <div id='post_body'>
                            ".$body."
                            <br>
                            <br>

                            </div>
                            <hr>
                            <div class='post_header'>                      
                                <div class='post_profile_pic'>
                                    <img src='".$profile_pic."'>
                                </div>
                            <div class='posted_by' style='color:#ACACAC;'>
                                <a href='".$added_by."'>".$fname." ".$lname."</a>&nbsp; ".$user_to."
                                <br>
                                 <span class='post_time'>".$time_message."</span>
                            </div>
                            </div>
                            <div class='post_comment' id='toogleComment$id' style='display:none;' width='100%'>
                                <iframe src='comments.php?post_id=$id' id='comment_iframe' width='100%' frameborder='0'></iframe> 
                            </div>
                       </div>";    
                }

            }
            if($count>$limit){
                $str.="<input type='hidden' class='nextPage' value='".($page+1)."'>
                       <input type='hidden' class='noMorePosts' value='false'>
                       ";
            }else{
                $str.="<input type='hidden' class='noMorePosts' value='true'><br><p style='text-align:center; font-size:20px;'>No more post to show...</p><br><br>";
            }
        }
        echo $str;
    }
}

    
?>