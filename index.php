<?php
include "includes/header.php";
include "includes/container.php";
include "includes/classes/user.php";
include "includes/classes/post.php";

if(isset($_POST['post'])){
    $post=new Post($con, $userLoggedIn);
    $post->submitPost($_POST['post_text'],'none');
    header('Location: index.php?');
    exit;

}
?>
<?php
    
?>
<div class="post_area"><img id="loading" src="icons/loading.gif"></div>

<script>
    var userLoggedIn = '<?php echo $userLoggedIn;?>';
    $(document).ready(function() {
        $('#loading').show();

        $.ajax({
            url: "includes/form_handler/ajax_load_posts.php",
            type: "POST",
            data: "page=1&userLoggedIn=" + userLoggedIn,
            cache: false,

            success: function(data) {
                $('#loading').hide();
                $('.post_area').html(data);
            }
        });

        $(window).scroll(function() {
            var height = $('.post_area').height();
            var scroll_top = $(this).scrollTop();
            var page = $('.post_area').find('.nextPage').val();
            var noMorePosts = $('.post_area').find('.noMorePosts').val();

            if ((document.body.scrollHeight == document.body.scrollTop + window.innerHeight) && noMorePosts == 'false') {
                $('#loading').show();

                var ajaxReq = $.ajax({
                    url: "includes/form_handler/ajax_load_posts.php",
                    type: "POST",
                    data: "page=" + page + "&userLoggedIn=" + userLoggedIn,
                    cache: false,

                    success: function(response) {
                        $('.post_area').find('.nextPage').remove();
                        $('.post_area').find('.noMorePosts').remove();
                        $('#loading').hide();
                        $('.post_area').append(response);

                    }
                });
            }
            return false;


        });
    });

</script>
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<script>
    (adsbygoogle = window.adsbygoogle || []).push({
        google_ad_client: "ca-pub-6320734730171698",
        enable_page_level_ads: true
    });

</script>


</body>

</html>
