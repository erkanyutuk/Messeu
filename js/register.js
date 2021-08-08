$(document).ready(function() {

        //Toggle Signup and Sign In
            $("#signup").click(function() {
                $("#first").slideToggle("slow", function() {
                    $("#second").slideToggle("slow");
                });

            });
            $("#signin").click(function() {
                    $("#second").slideToggle("slow", function() {
                            $("#first").slideToggle("slow");
                    });
            });

            /*
            var fname = document.getElementsByName('reg_fname').value;
            var lname = document.getElementsByName('reg_lname').value;
            var email = document.getElementsByName('email').value;
            var password = document.getElementsByName('reg_password').value;
            var cpassword = document.getElementsByName('reg_cpassword').value;*/
        });