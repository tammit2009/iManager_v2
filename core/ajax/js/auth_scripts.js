
const baseUrlAuth = window.location.origin;

// global functions to send form data to server
function request(url, data, callback) {
    var xhr = new XMLHttpRequest();
	xhr.open('POST', url, true);

    var loader = document.createElement('div');
	loader.className = 'loader';
    document.body.appendChild(loader);

	xhr.addEventListener('readystatechange', function() {
		if(xhr.readyState === 4) {
			if(callback) {
				callback(xhr.response);
			}
            loader.remove();
		}
	});

	// if input parameter 'data' is false, create a new form datastructure
	var formdata = data ? (data instanceof FormData ? data : 
                new FormData(document.querySelector(data))) : new FormData();

	// insert the csrf_token generated from the head meta tag in the form
	var csrfMetaTag = document.querySelector('meta[name="csrf_token"]');
	if(csrfMetaTag) {
		formdata.append('csrf_token', csrfMetaTag.getAttribute('content'));
	}	

    xhr.send(formdata);
};

// register.php
function register() {

    // send ajax request
    request(`${baseUrlAuth}/imanager/core/ajax/auth/register.php`, '#register_form', function(data) {
        
        document.getElementById('errs').innerHTML = "";
		var transition = document.getElementById('errs').style.transition;
		document.getElementById('errs').style.transition = "none";
		document.getElementById('errs').style.opacity = 0;    
		
		// alert(data);

        try {
            data = JSON.parse(data);
			//console.log(data);           
            if (!(data instanceof Array)) { throw Exception('bad data') }

            //Show errors to user
            for (var i = 0; i < data.length; i++) {
                switch(data[i].code) {
					case 0:
						document.getElementById('errs').innerHTML += '<div>Your account has been created!</div><div>Please validate your email by checking your inbox for a validation link before logging in.</div>';
						document.getElementById('register_form').reset();
						break;
					default:
						document.getElementById('errs').innerHTML += '<div class="err">' + data[i].message + '.</div>';
				}
            }
        }
        catch (e) {
            document.getElementById('errs').innerHTML = '<div class="err">An unknown error occurred. Please try again later.</div>';
        }
        setTimeout(function() {
			document.getElementById('errs').style.transition = transition;
			document.getElementById('errs').style.opacity = 1;
		}, 100);

    });
}

function sendValidateEmailRequest() {
	
	request(`${baseUrlAuth}/imanager/core/ajax/auth/send_validation_email.php`, '#validate_email_form', function(data) {

		document.getElementById('errs').innerHTML = "";
		var transition = document.getElementById('errs').style.transition;
		document.getElementById('errs').style.transition = "none";
		document.getElementById('errs').style.opacity = 0;

		// alert(data);

		try {
			data = JSON.parse(data);
			//console.log(data); 

			switch(data.code) {
				case 0:
					document.getElementById('errs').innerHTML += '<div>Email Sent... Check your email and click the link in the email to validate your email.</div>';
					document.getElementById('validate_email_form').reset();
					break;
				default:
					document.getElementById('errs').innerHTML += '<div class="err">' + data.message +  '.</div>';
			}
		}
		catch (e) {
            document.getElementById('errs').innerHTML = '<div class="err">An unknown error occurred. Please try again later.</div>';
        }
		setTimeout(function() {
			document.getElementById('errs').style.transition = transition;
			document.getElementById('errs').style.opacity = 1;
		}, 10);
	});
}

function passwordResetRequest() {

	request(`${baseUrlAuth}/imanager/core/ajax/auth/password_reset_request.php`, '#reset_password_form', function(data) {

		document.getElementById('errs').innerHTML = "";
		var transition = document.getElementById('errs').style.transition;
		document.getElementById('errs').style.transition = "none";
		document.getElementById('errs').style.opacity = 0;

		// alert(data);

		try {
			data = JSON.parse(data);

			switch(data.code) {
				case 0:
					document.getElementById('errs').innerHTML += '<div>An email has been sent if an account with that email exists</div>';
					document.getElementById('reset_password_form').reset();
					break;
				default:
					document.getElementById('errs').innerHTML += '<div class="err">' + data.message +  '.</div>';
			}
		}
		catch (e) {
			document.getElementById('errs').innerHTML = '<div class="err">An unknown error occurred. Please try again later.</div>';
		}
		setTimeout(function() {
			document.getElementById('errs').style.transition = transition;
			document.getElementById('errs').style.opacity = 1;
		}, 10);
	});
}

function changePassword() {

	request(`${baseUrlAuth}/imanager/core/ajax/auth/change_password.php`, '#change_password_form', function(data) {

		document.getElementById('errs').innerHTML = "";
		var transition = document.getElementById('errs').style.transition;
		document.getElementById('errs').style.transition = "none";
		document.getElementById('errs').style.opacity = 0;

		// alert(data);

		try {
			data = JSON.parse(data);
			if(!(data instanceof Array)) {throw Exception('bad data');}

			//Show errors to user
			for(var i = 0;i < data.length;++i) {
				switch(data[i].code) {
					case 0:
						document.getElementById('errs').innerHTML += '<div>Your password has been reset! You can now <a href="./auth.php?page=login">login</a></div>';
						document.getElementById('change_password_form').reset();
						break;
					default:
						document.getElementById('errs').innerHTML += '<div class="err">' + data[i].message + '.</div>';
				}
			}
		}
		catch (e) {
			document.getElementById('errs').innerHTML = '<div class="err">An unknown error occurred. Please try again later.</div>';
		}
		setTimeout(function() {
			document.getElementById('errs').style.transition = transition;
			document.getElementById('errs').style.opacity = 1;
		}, 10);

	});
}

function login() {

	request(`${baseUrlAuth}/imanager/core/ajax/auth/login.php`, '#login_form', function(data) {

		document.getElementById('errs').innerHTML = "";
		var transition = document.getElementById('errs').style.transition;
		document.getElementById('errs').style.transition = "none";
		document.getElementById('errs').style.opacity = 0;

		// alert(data);

		data = JSON.parse(data);
		switch(data.code) {
			case 0:
				// if (data.groupid === 2) 
				// 		window.location = `${baseUrlAuth}/imanager/admin/dashboard.php`;
				// else 
				// window.location = `${baseUrlAuth}/imanager/main.php?page=home`;
				window.location = `${baseUrlAuth}/imanager/dashboard.php?page=index`;
				break;
			default:
				document.getElementById('errs').innerHTML += '<div class="err">' + data.message +  '.</div>';
		}
		setTimeout(function() {
			document.getElementById('errs').style.transition = transition;
			document.getElementById('errs').style.opacity = 1;
		}, 10);
	});
};

function logout() {
	request(`${baseUrlAuth}/imanager/core/ajax/auth/logout.php`, false, function(data) {
		if(data.trim() === "0") {
			window.location = `${baseUrlAuth}/imanager/auth.php?page=login`;
		}
		else {
			console.log(data);
		}
	});
};


