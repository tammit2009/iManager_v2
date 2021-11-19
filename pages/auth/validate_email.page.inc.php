
<?php include('./core/ajax/auth/db_functions.php'); ?>

<?php if(isset($_GET['reqid']) && $_GET['reqid'] !== '' && isset($_GET['verify']) && $_GET['verify'] !== '') { ?>

<div class="container">
    <div class="row justify-content-center mb-3">

        <div class="col-lg-5 px-0" id="validateEmailCard">
            <div class="card mx-auto" style="width: 25rem;">

                <div class="card-header text-center text-light bg-info">
                    <h3>Email Validation</h3>
                </div>

                <div class="card-body">
                    
                    <?php runEmailValidation( $_GET['reqid'], $_GET['verify'] ); ?>

                </div>
            </div>
        </div>

    </div>
</div>

<?php } else { ?>

<div class="container">
    <div class="row justify-content-center mb-3">

        <div class="col-lg-5 px-0" id="validateEmailCard">
            <div class="card mx-auto" style="width: 25rem;">
                <div class="card-header text-center text-light bg-info">
                    <h3>Email Validation Request</h3>
                </div>
                <div class="card-body">
                    <form id="validate_email_form">

                        <!-- Error Container -->
                        <div id="errs" class="errcontainer"></div>

                        <div class="form-group">
                            <label for="validateEmail">Email address</label>
                            <input 
                                type="email" 
                                name="validateEmail" 
                                class="form-control" 
                                id="validateEmail" 
                                required
                                placeholder="Enter your email"
                                onkeydown="if(event.key === 'Enter'){event.preventDefault();sendValidateEmailRequest();}" 
                                aria-describedby="e_error"
                            >
                            <small id="email_error" class="form-text text-muted"></small>
                        </div>

                        <div class="d-flex flex-column">
                            <button 
                                type="button" 
                                class="btn btn-info px-2"
                                onclick="sendValidateEmailRequest();"
                            ><i class="fa fa-user-plus">&nbsp;</i>Request Validation</button>

                            <p class="m-0 mt-3 text-center">Already verified? <span><a href="auth.php?page=login">Login</a></span></p>
                        </div>
                        
                    </form>

                </div>
            </div>
        </div>

    </div>
</div>

<?php } ?>
