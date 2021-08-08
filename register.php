<?php
require 'config/config.php';
require 'includes/form_handler/register_handler.php';
require 'includes/form_handler/login_handler.php';
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Register Messeu</title>
    <link rel="stylesheet" type="text/css" href="css/registerr.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body>
    <?php
    if (isset($_POST['register_button'])) {
        echo '
        <script>
        $(document).ready(function(){
            $("#first").hide();
            $("#second").show();
            
        
        });
        </script>
        ';
    } ?>
    <div id="main">
        <div id="main_color"></div>
        <div class="login_box">
            <div class="Login_header">
                <h1>MESSEU</h1>
                <b>Login or Signup below!</b>
            </div>
            <div class="first" id="first">
                <form action="register.php" method="post">
                    <div id="input">
                        <i class="fa fa-envelope icon"></i>
                        <input type="email" name="login_email" placeholder="Enter Email Address" value="<?php if (isset($_SESSION['login_email'])) {
                                                                                                            echo $_SESSION['login_email'];
                                                                                                        }    ?>" required>
                    </div>
                    <div id="input">

                        <i class="fa fa-key icon"></i>
                        <input type="password" name="login_password" placeholder="Enter Password" required>
                    </div>

                    <?php if (in_array('Email or Password was incorrect<br>', $error)) {
                        echo 'Email or Password was incorrect<br>';
                    } ?>

                    <input type="submit" name="login_button" value='Log In'>
                    <br>
                    <a href="#" id="signup" class="signup">Need an account? Sign up here!</a>
                </form>

            </div>
            <div class="second" id="second">

                <form action="register.php" method="post">
                    <div id="input">
                        <i class="fa fa-user icon"></i>
                        <input type="text" placeholder="First Name" name="reg_fname" value="<?php if (isset($_SESSION['reg_fname'])) {
                                                                                                echo $_SESSION['reg_fname'];
                                                                                            }    ?>" required>
                        <input id="last_name" type="text" placeholder="Last Name" name="reg_lname" value="<?php if (isset($_SESSION['reg_lname'])) {
                                                                                                                echo $_SESSION['reg_lname'];
                                                                                                            }    ?>" required>
                    </div>
                    <?php if (in_array('Your First Name must be between 2 and 25 character<br>', $error)) {
                        echo 'Your First Name must be between 2 and 25 character<br>';
                    } ?>
                    <?php if (in_array('Your Last Name must be between 2 and 25 character<br>', $error)) {
                        echo 'Your Last Name must be between 2 and 25 character<br>';
                    } ?>

                    <div id="input">
                        <i class="fa fa-envelope icon"></i>
                        <input type="email" placeholder="Email" name="reg_email" value="<?php if (isset($_SESSION['reg_email'])) {
                                                                                            echo $_SESSION['reg_email'];
                                                                                        }    ?>" required>
                    </div>
                    <?php if (in_array('Email already in use<br>', $error)) {
                        echo 'Email already in use<br>';
                    } else if (in_array('Email Address is invalid<br>', $error)) {
                        echo 'Email Address is invalid<br>';
                    } ?>




                    <div id="input">
                        <i class="fa fa-key icon"></i>
                        <input type="password" placeholder="Enter password" name="reg_password" required>
                    </div>
                    <?php if (in_array('Your Password must be between 5 and 30 character<br>', $error)) {
                        echo 'Your Password must be between 5 and 30 character<br>';
                    } ?>


                    <div id="input">
                        <i class="fa fa-key icon"></i>
                        <input type="password" placeholder="Confirm password" name="reg_cpassword" required>
                    </div>
                    <?php if (in_array('Password dont Match<br>', $error)) {
                        echo 'Password dont Match<br>';
                    } ?>

                    <input id="register_button" type="submit" value="Register" name="register_button">
                    <br>
                    <a href="#" id="signin" class="signin">Already have an account? Sign in here!</a>
                </form>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="js/register.js"></script>


</body>


</html>