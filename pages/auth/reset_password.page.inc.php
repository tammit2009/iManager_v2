
<?php if(empty($_GET['reqid']) && empty($_GET['reset'])) { ?>

<div class="container">
    <div class="row justify-content-center mb-3">

        <div class="col-lg-5 px-0" id="resetPasswordCard">
            <div class="card mx-auto" style="width: 25rem;">
                <div class="card-header text-center text-light bg-info">
                    <h3>Password Recovery</h3>
                </div>
                <div class="card-body">
                    <form id="reset_password_form">

                        <!-- Error Container -->
                        <div id="errs" class="errcontainer"></div>

                        <div class="form-group">
                            <label for="resetEmail">Email address</label>
                            <input 
                                type="email" 
                                name="resetEmail" 
                                class="form-control" 
                                id="resetEmail" 
                                required
                                placeholder="Enter your email"
                                onkeydown="if(event.key === 'Enter'){event.preventDefault();passwordResetRequest();}" 
                                aria-describedby="e_error"
                            >
                            <small id="email_error" class="form-text text-muted"></small>
                        </div>

                        <div class="d-flex flex-column">
                            <button 
                                type="button" 
                                class="btn btn-info px-2"
                                onclick="passwordResetRequest();"
                            ><i class="fa fa-user-plus">&nbsp;</i>Send Password Reset</button>

                            <p class="m-0 mt-3 text-center">Remembered your password? <span><a href="auth.php?page=login">Login</a></span></p>
                        </div>
                        
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<?php } else { ?>    

<div class="container">
    <div class="row justify-content-center mb-3">

        <div class="col-lg-5 px-0" id="changePasswordCard">
            <div class="card mx-auto" style="width: 25rem;">
                <div class="card-header text-center text-light bg-info">
                    <h3>Change Password</h3>
                </div>
                <div class="card-body">
                    <form id="change_password_form">

                        <!-- Error Container -->
                        <div id="errs" class="errcontainer"></div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input 
                                type="password" 
                                name="password" 
                                class="form-control" 
                                id="password" 
                                placeholder="Enter Password"
                                required
                                onkeydown="if(event.key === 'Enter'){event.preventDefault();changePassword();}"
                            >
                            <small id="password_error" class="form-text text-muted"></small>
                        </div>

                        <div class="form-group">
                            <label for="confirm-password">Confirm Password</label>
                            <input 
                                type="password" 
                                name="confirm-password" 
                                class="form-control" 
                                id="confirm-password" 
                                placeholder="Confirm your password"
                                required
                                onkeydown="if(event.key === 'Enter'){event.preventDefault();changePassword();}"
                            >
                            <small id="p_error" class="form-text text-muted"></small>
                        </div>

                        <input id="id" name="id" type="hidden" value="<?php echo htmlspecialchars($_GET['reqid']); ?>" />
                        <input id="hash" name="hash" type="hidden" value="<?php echo htmlspecialchars($_GET['reset']); ?>" />

                        <div class="d-flex flex-column">
                            <button 
                                type="button" 
                                class="btn btn-info px-2"
                                onclick="changePassword();"
                            ><i class="fa fa-user-plus">&nbsp;</i>Change Password</button>

                            <p class="m-0 mt-3 text-center"><span><a href="auth.php?page=login">Back to login</a></span></p>
                        </div>
                        
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<?php } ?>    