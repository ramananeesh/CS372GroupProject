function fbLog() {
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
        //testAPI();
        var type = "FacebookLogin";
        FB.api('/me', { locale: 'tr_TR', fields: 'name, email' },
            function(response) {
                /*console.log(response.email);
                console.log(response.name);
                console.log(response.gender);
                console.log(response.birthday);
                console.log(response.hometown);
                console.log(response.education);
                console.log(response.website);
                console.log(response.work);*/
                sessionStorage.setItem("userName", response.name);
                sessionStorage.setItem("emailID", response.email);
                alert("Hi" + " " + response.email);
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
}

function login(f) {
    if (validate(this)) {
        sessionStorage.setItem("typeofLogin", "normalLogin");
        window.open("dashboard.php");
    }
    else
        return false;

}


function validate(f) {
    var userList = ["ramaa02",
        "huntmj01", "staudj01"
    ];
    var password = "adminLogin";
    /*if ((f.username.value.match(/.+@.+\.edu$/))) {
    	alert("Invalid username. Remember: The username is the email id" +
    		" being used. It should be a .edu email");
    	/*f.usernameError.value="Invalid username. Remember: The username is the email id"+
    				" being used. It should be a .edu email";
    	return false;
    }*/
    //else {
    if (!(f.username.value == userList[0]) &&
        !(f.username.value == userList[1]) &&
        !(f.username.value == userList[2])) {
        alert("Invalid username. Due to lack of Database, only" +
            " admin credentials will work");
        return false;
    }
    else {
        if (f.password.value.length < 6) {
            alert("Password length too small");
            return false;
        }
        else if (!(f.password.value == password)) {
            alert("Incorrect Password. Due to lack of Database, only" +
                " only admin credentials will work");
            return false;
        }
        else {

            sessionStorage.setItem("userName", f.username.value);
            //sessionStorage.setItem("emailID", f.emailID.value);
            sessionStorage.setItem("password", f.password.value);
            window.open("dashboard.php", "_self");
            return true;
        }
    }
    //}

}

function showSignUp(){

    document.getElementById("emailDiv").style.display = '';
    document.getElementById("passwordDiv").style.display = '';
    document.getElementById("nameDiv").style.display = '';
    document.getElementById("login_b").innerHTML = "Sign Up";
}

function signupValidate(f) {
   
    //document.getElementById("emailDiv").style.visibility = 'visible';
    
    if ((document.getElementById("login_b").innerHTML + "").toString().trim() == "Login"){
        // User is signing in and not signing up
        return true;
    }
    
    if (document.getElementById("email").value.match(/.+@.+\..+$/)) {
        alert("Invalid email format.");
        return false;
    }
    
    if( document.getElementById("username").value == "" ||
        document.getElementById("password").value == "" ||
        document.getElementById("passwordReenter").value == "" ||
        document.getElementById("name").value == "" ||
        document.getElementById("email").value == ""
        )
    {
         alert("All fields are required!");
         return false;
    }

    if (document.getElementById("password").value.length < 6) {
        alert("Your password must be at least 6 characters long.");
        
        return false;
    }
    
    if(document.getElementById("password").value !== document.getElementById("passwordReenter").value){
         alert("Your passwords don't match!");
        
        return false;
    }
    
    //var userN = f.username.value.split("@")[0];
    //sessionStorage.setItem("userName", f.username.value);
    //sessionStorage.setItem("emailID", f.email.value);
    //sessionStorage.setItem("password", f.password.value);

    return true;
}

function proceed() {
    FB.login(function(response) {
        if (response.authResponse == 'connected') {
            window.top.location = "dashboard.php";
        }
    });
}

function onSignIn(googleUser) {
    //alert("Hi google");
    var profile = googleUser.getBasicProfile();
    /*console.log('ID: ' + profile.getId()); // Do not send to your backend! Use an ID token instead.
    console.log('Name: ' + profile.getName());
    console.log('Image URL: ' + profile.getImageUrl());
    console.log('Email: ' + profile.getEmail()); // This is null if the 'email' scope is not present.*/
    var uid = profile.getId();
    var name = profile.getName();
    var emailID = profile.getEmail();
    sessionStorage.setItem("userName", name);
    sessionStorage.setItem("userID", uid);
    sessionStorage.setItem("emailID", emailID);
    //alert(emailID);
    var type = "gmailLogin";
    sessionStorage.setItem("typeofLogin", type);
    window.open("dashboard.php", "_self");
}
