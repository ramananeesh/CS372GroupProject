/*function fbLog() {
    //onlogin="checkLoginState();"
    checkLoginState();
}
// This is called with the results from from FB.getLoginStatus().
function statusChangeCallback(response) {
    //alert("Hi Facebook");
    console.log('statusChangeCallback');
    console.log(response);
    // The response object is returned with a status field that lets the
    // app know the current login status of the person.
    // Full docs on the response object can be found in the documentation
    // for FB.getLoginStatus().
    var user = " ";
    FB.api('/me', function(response) {

        sessionStorage.setItem("userName", response.name);
    });
    if (response.status === 'connected') {
        // Logged into your app and Facebook.
        var type = "FacebookLogin";
        FB.api('/me', { locale: 'tr_TR', fields: 'name, email' },
            function(response) {
                sessionStorage.setItem("userName", response.name);
                sessionStorage.setItem("emailID", response.email);
                //alert("Hi" + " " + response.email);
            }, { scope: 'email' }
        );

        //sessionStorage.setItem("emailID",response.email);
        //sessionStorage.setItem("userName", response.name); 
        //alert(response.email);
        sessionStorage.setItem("typeofLogin", type);
        window.open("dashboard.php", "_self");
        //window.close();
    }
    else {
        // The person is not logged into your app or we are unable to tell.
        document.getElementById('status').innerHTML = 'Please log ' +
            'into this app.';
        //alert("Please log in to the app");
    }
}

// This function is called when someone finishes with the Login
// Button.  See the onlogin handler attached to it in the sample
// code below.
function checkLoginState() {
    //alert("Hi");
    FB.getLoginStatus(function(response) {

        statusChangeCallback(response);
    });
}

window.fbAsyncInit = function() {
    FB.init({
        appId: '152162102051722',
        cookie: true, // enable cookies to allow the server to access 
        // the session
        xfbml: true, // parse social plugins on this page
        version: 'v2.8' // use graph api version 2.8
    });

    // Now that we've initialized the JavaScript SDK, we call 
    // FB.getLoginStatus().  This function gets the state of the
    // person visiting this page and can return one of three states to
    // the callback you provide.  They can be:
    //
    // 1. Logged into your app ('connected')
    // 2. Logged into Facebook, but not your app ('not_authorized')
    // 3. Not logged into Facebook and can't tell if they are logged into
    //    your app or not.
    //
    // These three cases are handled in the callback function.

    FB.getLoginStatus(function(response) {
        statusChangeCallback(response);
    });

};

// Load the SDK asynchronously
(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s);
    js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

// Here we run a very simple test of the Graph API after login is
// successful.  See statusChangeCallback() for when this call is made.
function testAPI() {
    console.log('Welcome!  Fetching your information.... ');
    FB.api('/me', function(response) {
        console.log('Successful login for: ' + response.name);
        //alert("Thanks for logging in");
        document.getElementById('status').innerHTML = 'Thanks for logging in, ' + response.name + '!';
        sessionStorage.setItem("userName", response.name);
    });
}*/

// function login(f) {
//     if (validate(this)) {
//         sessionStorage.setItem("typeofLogin", "normalLogin");
//         window.open("dashboard.php");
//     }
//     else
//         return false;

// }


// function validate(f) {
//     var userList = ["ramaa02",
//         "huntmj01", "staudj01"
//     ];
//     var password = "adminLogin";
//     /*if ((f.username.value.match(/.+@.+\.edu$/))) {
//     	alert("Invalid username. Remember: The username is the email id" +
//     		" being used. It should be a .edu email");
//     	/*f.usernameError.value="Invalid username. Remember: The username is the email id"+
//     				" being used. It should be a .edu email";
//     	return false;
//     }*/
//     //else {
//     if (!(f.username.value == userList[0]) &&
//         !(f.username.value == userList[1]) &&
//         !(f.username.value == userList[2])) {
//         alert("Invalid username. Due to lack of Database, only" +
//             " admin credentials will work");
//         return false;
//     }
//     else {
//         if (f.password.value.length < 6) {
//             sweetAlert("Password Problem!","Password length too small","warning");
//             return false;
//         }
//         else if (!(f.password.value == password)) {
//             sweetAlert("Passsword Error!","Incorrect Password. Due to lack of Database, only" +
//                 " only admin credentials will work","error");
//             return false;
//         }
//         else {

//             sessionStorage.setItem("userName", f.username.value);
//             //sessionStorage.setItem("emailID", f.emailID.value);
//             sessionStorage.setItem("password", f.password.value);
//             window.open("dashboard.php", "_self");
//             return true;
//         }
//     }
//     //}

// }

function showSignUp(){
    
    var par = document.getElementById("status");
    var toggle;

    if(document.getElementById("login_b").innerHTML != "Sign Up"){
        document.getElementById("emailDiv").style.display = '';
        document.getElementById("passwordDiv").style.display = '';
        document.getElementById("nameDiv").style.display = '';
        document.getElementById("login_b").innerHTML = "Sign Up";
        
        // Remove Children
        par.removeChild(par.firstChild);
        par.removeChild(par.firstChild);
        
        // Create toggle element
        toggle = document.createElement("a");
        toggle.setAttribute("href", "#Login");
        toggle.setAttribute("onclick", "showLogin()");
        toggle.appendChild(document.createTextNode("Login"));
        
        // Append Children
        par.appendChild(toggle);
        par.appendChild(document.createTextNode(" / Sign Up"));
        
    }
}

function showLogin(){
    
    var par = document.getElementById("status");
    var toggle;

    if(document.getElementById("login_b").innerHTML != "Login"){
        document.getElementById("emailDiv").style.display = 'none';
        document.getElementById("passwordDiv").style.display = 'none';
        document.getElementById("nameDiv").style.display = 'none';
        document.getElementById("login_b").innerHTML = "Login";
        
        // Remove Children
        par.removeChild(par.firstChild);
        par.removeChild(par.firstChild);
        
        // Create toggle element
        toggle = document.createElement("a");
        toggle.setAttribute("href", "#signup");
        toggle.setAttribute("onclick", "showSignUp()");
        toggle.appendChild(document.createTextNode("Sign Up"));
        
        // Append Children
        par.appendChild(document.createTextNode("Login / "));
        par.appendChild(toggle);
    }
}

function signupValidate(f) {
   
    //document.getElementById("emailDiv").style.visibility = 'visible';
    
    if ((document.getElementById("login_b").innerHTML + "").toString().trim() == "Login"){
        
        // Set session variable
        sessionStorage.setItem("typeofLogin", "standard");
        
        // User is signing in and not signing up
        return true;
    }
    if( document.getElementById("username").value == "" ||
        document.getElementById("password").value == "" ||
        document.getElementById("passwordReenter").value == "" ||
        document.getElementById("name").value == "" ||
        document.getElementById("email").value == ""
        )
    {
         sweetAlert("Important!","All fields are required!","warning");
         return false;
    }
    if (document.getElementById("email").value.match(/.+@.+\..+$/) == null) {
        sweetAlert("Email Problem!","Invalid email format.","warning");
        return false;
    }
    
    if(document.getElementById("name").value.match(/^[A-z]+\ +[A-z]+$/) == null){
        sweetAlert("Name input error!","Invalid name format: Must be only first and last name","warning");
        return false;
    }
    
    

    if (document.getElementById("password").value.length < 6) {
        sweetAlert("Password too small!","Your password must be at least 6 characters long.","warning");
        
        return false;
    }
    
    if(document.getElementById("password").value !== document.getElementById("passwordReenter").value){
         sweetAlert("Password mismatch!","Your passwords don't match!","error");
        
        return false;
    }
    
    //var userN = f.username.value.split("@")[0];
    //sessionStorage.setItem("userName", f.username.value);
    //sessionStorage.setItem("emailID", f.email.value);
    //sessionStorage.setItem("password", f.password.value);

    return true;
}

/*function proceed() {
    FB.login(function(response) {
        if (response.authResponse == 'connected') {
            window.top.location = "verify.php";
        }
    });
}*/

function onSignIn(googleUser) {
    var profile = googleUser.getBasicProfile();
    var uid = profile.getId();
    var name = profile.getName();
    var emailID = profile.getEmail();
    sessionStorage.setItem("userName", name);
    sessionStorage.setItem("userID", uid);
    sessionStorage.setItem("emailID", emailID);
    var type = "gmailLogin";
    sessionStorage.setItem("typeofLogin", type);
    window.open("verify.php", "_self");
}

function errorMsg(){
    sweetAlert({title: 'Error',
				text: "Your account has been deactivated.You may contest the ban through the contact page",
				type: "error",
				showCancelButton: true,
				dangerMode: true,
				confirmButtonText: "Redirect to contact page",
				cancelButtonText: "Not required"
				},
				function(isConfirm){

				if (isConfirm){
    				window.open("./contact.php","_self");

    			} else {
    				window.open("./index.php","_self");
    			}
				 });
}
