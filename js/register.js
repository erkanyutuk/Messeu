$(document).ready(function() {
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
        });