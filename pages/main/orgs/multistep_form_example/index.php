<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Multi-Step Form Using Bootstrap 4, JQuery, AJAX & PHP</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style type="text/css">
        #second, #third, #result {
            display: none;
        }
    </style>
</head>
<body class="bg-dark">
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6 bg-light p-4 rounded">
                <h5 class="text-center text-light bg-success mb-2 p-2 rounded lead" id="result">Hello World!</h5>
                
                <div class="progress mb-3" style="height:40px;">
                    <div class="progress-bar bg-danger" role="progress-bar" style="width:20%;" id="progressBar">
                        <b class="lead" id="progressText">Step - 1</b>
                    </div>
                </div>

                <form action="" method="post" id="form-data">

                    <div id="first">
                        <h4 class="text-center bg-primary p-1 rounded text-light">Personal Information</h4>
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Full Name">
                            <b class="form-text text-danger" id="nameError"></b>
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Username">
                            <b class="form-text text-danger" id="usernameError"></b>
                        </div>
                        <div class="form-group">
                            <a href="#" class="btn btn-danger" id="next-1">Next</a>
                        </div>
                    </div>

                    <div id="second">
                        <h4 class="text-center bg-primary p-1 rounded text-light">Contact Information</h4>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Email">
                            <b class="form-text text-danger" id="emailError"></b>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="tel" name="phone" id="phone" class="form-control" placeholder="Phone">
                            <b class="form-text text-danger" id="phoneError"></b>
                        </div>
                        <div class="form-group">
                            <a href="#" class="btn btn-danger" id="prev-2">Previous</a>
                            <a href="#" class="btn btn-danger" id="next-2">Next</a>
                        </div>
                    </div>

                    <div id="third">
                        <h4 class="text-center bg-primary p-1 rounded text-light">Choose Password</h4>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="pass" id="pass" class="form-control" placeholder="Password">
                            <b class="form-text text-danger" id="passError"></b>
                        </div>
                        <div class="form-group">
                            <label for="confirm_password">Confirm Password</label>
                            <input type="password" name="cpass" id="cpass" class="form-control" placeholder="Confirm Password">
                            <b class="form-text text-danger" id="cpassError"></b>
                        </div>
                        <div class="form-group">
                            <a href="#" class="btn btn-danger" id="prev-3">Previous</a>
                            <input type="submit" name="submit" value="Submit" id="submit" class="btn btn-success">
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <script type="text/javascript">
        $(document).ready(function() {

            $('#next-1').click(function(e) {
                e.preventDefault();     // prevent page refresh

                $('#nameError').html('');
                $('#usernameError').html('');

                if ($('#name').val() == '') {
                    $("#nameError").html('* Name is required.');
                    return false;       
                }
                else if ($('#name').val().length < 4) {
                    $("#nameError").html('* Name must be of more than 3 characters.');
                    return false;  
                }
                else if (!isNaN($('#name').val())) {
                    $("#nameError").html('* Numbers are not allowed.');
                    return false; 
                }
                else if ($('#username').val() == '') {
                    $("#usernameError").html('* Username is required.');
                    return false; 
                }
                else if ($('#username').val().length < 5) {
                    $("#usernameError").html('* Username must be of more than 4 characters.');
                    return false;  
                }
                else {
                    $('#second').show();
                    $('#first').hide();
                    $('#progressBar').css('width', '60%');
                    $('#progressText').html('Step - 2');
                }
            });

            $('#next-2').click(function(e) {
                e.preventDefault();     // prevent page refresh

                $('#emailError').html('');
                $('#phoneError').html('');

                if ($('#email').val() == '') {
                    $("#emailError").html('* Email is required.');
                    return false;       
                }
                else if (!validateEmail($('#email').val())) {
                    $("#emailError").html('* Email is not valid.');
                    return false;
                }
                else if ($('#phone').val() == '') {
                    $("#phoneError").html('* Phone number is required.');
                    return false; 
                }
                else if (isNaN($('#phone').val())) {
                    $("#phoneError").html('* Only numbers are allowed.');
                    return false; 
                }
                else if ($('#phone').val().length != 10) {
                    $("#phoneError").html('* Phone number must be 10 digits.');
                    return false; 
                }
                else {
                    $('#third').show();
                    $('#second').hide();
                    $('#progressBar').css('width', '100%');
                    $('#progressText').html('Step - 3');
                }

                function validateEmail($email) {
                    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
                    return emailReg.test($email);
                }
            });

            $('#submit').click(function(e) {
                e.preventDefault();

                $('#passError').html('');
                $('#cpassError').html('');

                if ($("#pass").val() == '') {
                    $('#passError').html('* Password is required.');
                    return false;
                }
                else if ($("#pass").val().length < 7){
                    $('#passError').html('* Password length must be of more than 6 characters.');
                    return false;
                }
                else if ($('#cpass').val() == '') {
                    $('#cpassError').html('* Confirm password is required.');
                    return false;
                }
                else if ($('#cpass').val() != $("#pass").val()) {
                    $('#cpassError').html('* Confirm password did not match with above password.');
                    return false;
                }
                else {
                    
                    // Submit the form with json
                    $.ajax({
                        url: 'action.php',
                        method: 'post',
                        data: $('#form-data').serialize(),
                        success: function(response) {
                            $('#result').show();
                            $('#result').html(response);
                            $('#form-data')[0].reset();
                        }
                    });
                }
            });

            $('#prev-2').click(function(e) {
                e.preventDefault();     // prevent page refresh

                $('#first').show();
                $('#second').hide();
                $('#progressBar').css('width', '20%');
                $('#progressText').html('Step - 1');
            });

            $('#prev-3').click(function(e) {
                e.preventDefault();     // prevent page refresh

                $('#second').show();
                $('#third').hide();
                $('#progressBar').css('width', '60%');
                $('#progressText').html('Step - 2');
            });

        });
    </script>

</body>
</html>