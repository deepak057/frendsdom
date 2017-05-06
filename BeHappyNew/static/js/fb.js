// This is called with the results from from FB.getLoginStatus().
  function statusChangeCallback(response) {
   
  }

  function fb_logout(){
  	FB.getLoginStatus(function(response) {
        if (response && response.status === 'connected') {
            FB.logout(function(response) {
                document.location.reload();
            });
        }
    });
  }

  function fb_login(){
	    FB.login(function(response) {
	        if (response.authResponse) {
	            console.log('Welcome!  Fetching your information.... ');
	            //console.log(response); // dump complete info
	            access_token = response.authResponse.accessToken; //get access token
	            user_id = response.authResponse.userID; //get FB UID

	            FB.api('/me?fields=first_name, last_name, picture, email', function(response) {
	                  AppSignUpSocial.Signup(response.email,response.first_name,response.last_name,response.picture.data.url,response.id,"facebook");     
                    //window.location = window.location.origin+"/dev";
	            });

	        } else {
	            //user hit cancel button
	            console.log('User cancelled login or did not fully authorize.');

	        }
	    }, {
	        scope: 'public_profile,email'
	    });
	}

  // This function is called when someone finishes with the Login
  // Button.  See the onlogin handler attached to it in the sample
  // code below.
  function checkLoginState() {
    FB.getLoginStatus(function(response) {
          var accessToken = response.authResponse.accessToken;
      statusChangeCallback(response);
    });
  }
setTimeout(function(){
  FB.init({
    appId      : '1180162548689254',
    cookie     : true,  // enable cookies to allow the server to access 
                        // the session
    xfbml      : true,  // parse social plugins on this page
    version    : 'v2.2' // use graph api version 2.5
  });
},200);


  // Here we run a very simple test of the Graph API after login is
  // successful.  See statusChangeCallback() for when this call is made.
  function testAPI() {
    console.log('Welcome!  Fetching your information.... ');
    FB.api('/me?fields=first_name, last_name, picture, email', function(response) {
      console.log(response);
    });
  }
