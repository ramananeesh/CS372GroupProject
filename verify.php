<?php
    // Flag that this user is using an alternate Sign-In
    session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Verifying User</title>
        <script src="./js/jquery-1.11.0.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <link href="https://cdn.jsdelivr.net/sweetalert2/4.2.4/sweetalert2.min.css" rel="stylesheet"/>
        <script src="https://cdn.jsdelivr.net/sweetalert2/4.2.4/sweetalert2.min.js"></script>
        <script type="text/javascript" src="./js/admin.js"></script>
        <script type="text/javascript">
        
        var tries = 3;
        
        function makeAjaxRequest(type, url, data, func){
            $.ajax({
                type: type,                                           // GET or POST
                url: url,                                               // Path to file
                data: data,
                timeout: 10000,                                          // Waiting time
                beforeSend: function() {                                // Before Ajax 
                  //$content.append('<div id="load">Loading</div>');      // Load message
                },
                complete: function() {                                  // Once finished
                  //$('#load').remove();                               // Clear message
                },
                success: function(data){
                    func(data);
                },
                fail: function() {                                      // Show error msg 
                    alert("Error with Ajax call!");
                  //$('#panel').html('<div class="loading">Please try again soon.</div>');
                }
            });
        }
        
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
                    username: sessionStorage.getItem("emailID"),
                    email: sessionStorage.getItem("emailID")
                },
                func = function(data){
                    if(data != 'ban')
                        window.open("dashboard.php", "_self");
                    else if(data == 'ban'){
                      alert("You have been banned!");
                      window.open("sessionEnd.php", "_self");
                    }
                    else{
                        alert("Error with sign-in!");
                      window.open("sessionEnd.php", "_self");
                    }
                };
                
                makeAjaxRequest(type, url, info, func);
            }
        }
        </script>
        
    </head>
    
    <body onload="init();">
        <h1>Verifying... You will be redirected shortly...</h1>
    </body>
    
</html>