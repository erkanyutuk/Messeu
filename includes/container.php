<?php 
?>
<div class="left_profile">
    <div class="user_details">
        <img src="<?php echo $user['profile_pic'];?>">
        <a href="index.php">
            <?php echo $user['fname'].' '.$user['lname'];?></a><br>
        <p>
            Friends:
            <?php echo $user['num_likes'];?><br>
            Age:
            <?php echo $user['num_likes'];?><br>
            Location:
            <?php echo $user['num_likes'];?><br>
            Gender: Male<br>
        </p>
    </div>

</div>
<div class="main_post">
    <form class="post_form" action="index.php" method="post">
        <textarea name="post_text" id="post_text" placeholder="Got something to say?"></textarea>
        <input type="submit" name="post" id="post_button" value="Share">
        
    </form>
</div>
