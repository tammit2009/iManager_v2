
<div class="container">
    <div class="row justify-content-center mb-3">

        <div class="col-lg-5 px-0" id="loginCard">
            <div class="card mx-auto" style="width: 25rem;">
                <div class="card-header text-center text-light bg-info">
                    <h3>Login</h3>
                </div>
                <div class="card-body">
                    <form id="login_form">
                        
                        <!-- Error Container -->
                        <div id="errs" class="errcontainer"></div>

                        <div class="form-group">
                            <label for="login_email">Email address</label>
                            <?php if (isset($_COOKIE['email'])) { ?>
                                <!-- </?php echo $_COOKIE['email']; ?> -->
                                <input type="email" name="email" class="form-control" id="email" value="" aria-describedby="e_error">
                            <?php } else { ?>
                                <input type="email" name="email" class="form-control" id="email" aria-describedby="e_error">
                            <?php } ?>
                            <small id="e_error" class="form-text text-muted"></small>
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <?php if (isset($_COOKIE['pass'])) { ?>
                                <!--</?php echo $_COOKIE['pass']; ?/>-->
                                <input type="password" name="password" class="form-control" id="password" value="">
                            <?php } else { ?>
                                <input type="password" name="password" class="form-control" id="password" value="">
                            <?php } ?>
                            <small id="p_error" class="form-text text-muted"></small>
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <button 
                                type="button" 
                                class="btn btn-info px-4 mr-2"
                                onclick="login();"
                            ><i class="fa fa-lock">&nbsp;</i>Login</button>
                            <p class="m-0 mr-3">
                                Register an account <span><a href="auth.php?page=register"> here</a></span>
                            </p>
                        </div>

                        <div class="form-check my-3">
                            <input class="form-check-input" type="checkbox" name="remember_me" value="1" id="remember_me">
                            <label class="form-check-label" for="remember_me">
                                Remember Me
                            </label>
                        </div>

                    </form>
                    <hr>
                    <p style="font-size:0.9rem; margin-bottom:5px">
                        Forgot Password? <a href="auth.php?page=reset_password">Reset it</a>
                    </p>
                </div>
            </div>
        </div>

    </div>
</div>


