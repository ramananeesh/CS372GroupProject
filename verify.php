<?php
    // Flag that this user is using an alternate Sign-In
    session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Verifying User</title>
        <script src="./js/jquery-1.11.0.min.js"></script>
        <script type="text/javascript" src="./js/admin.js"></script>
        <script type="text/javascript">
        
        function init(){
            if(sessionStorage.getItem("userName") === null ||
                sessionStorage.getItem("userName") === "" ||
                    sessionStorage.getItem("userID") === null ||
                    sessionStorage.getItem("userID") === "" ||
                        sessionStorage.getItem("emailID") === null ||
                        sessionStorage.getItem("emailID") === ""){
                window.open("login.php", "_self");
                return;
            }
            else{
                var type = "POST", url = "./ajax_queries/altSignUp.php", 
                info = {
                    name: sessionStorage.getItem("userName"),
                    id: sessionStorage.getItem("userID"),
                    username: "alt",
                    email: sessionStorage.getItem("emailID")
                },
                func = function(data){ window.open("dashboard.php", "_self");};
                
                makeAjaxRequest(type, url, info, func);
            }
        }
        
        init();
        </script>
    </head>
    <body>
        <h1>Verifying... You will be redirected shortly...</h1>
    </body>
</html>