<?php


$user_object = new User($con, $_SESSION['username']);

$name = $user_object->getFirstAndLastName();
$num_likes = $user_object->getNumLikes();
?>
<div class="contain">
    <div class="row">
        <div class="col-lg-3 mb-1 mt-3">

            <div class="user_details">
                <img src="<?php echo $user['profile_pic']; ?>">
                <a href="index.php">
                    <?php
                    echo $name; ?></a><br>
                <p>
                    Number of Likes:
                    <?php echo $num_likes; ?><br>
                    Number of Posts:
                    <?php echo $user['num_likes']; ?><br>
                </p>

            </div>
        </div>
        <div class="col-lg-6 mt-3">
            <div class="main_post mb-3">
                <form class="post_form" action="index.php" method="post">
                    <textarea name="post_text" id="post_text" placeholder="Got something to say?"></textarea>
                    <input type="submit" name="post" id="post_button" value="Share">
                </form>

            </div>
        </div>
    </div>