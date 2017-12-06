<?php
    session_start();
    session_destroy();
    //header("Location: ./login.php");
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Logging Out...</title>
        <script src="https://apis.google.com/js/platform.js"></script>
        <meta name="google-signin-client_id" content="783497289681-md44u43oh563o2jrf0gjsfbtgr6oh2qg.apps.googleusercontent.com">
        <script type="text/javascript">
        
            var tries = 0;
        
            function load() {
                gapi.load('auth2', function() {
                    gapi.auth2.init();
                    
                });
                signOut();
            }
            
            function signOut() {
                
                if(tries < 3){
                    try{
                        var auth2 = gapi.auth2.getAuthInstance();
                        auth2.signOut().then(function() {
                                window.open("./login.php", "_self");
                        });
                        tries += 3;
                    }
                    catch(e){setTimeout(signOut, 500);}
                }
                else{
                    window.open("./login.php", "_self");
                }
            }
            
            
        </script>
    </head>
    <body onload="load();">
        <h1>Logging you out...</h1>
        <h2>If it takes more than 5 seconds, please follow this link <a href="./login.php">to the Login Page</a></h2>
    </body>
</html>