<div class="container">
    <div class="row justify-content-center mb-3">

        <div class="col-lg-5 px-0" id="registerCard">
            <div class="card mx-auto" style="width: 25rem;">
                <div class="card-header text-center text-light bg-info">
                    <h3>Register</h3>
                </div>
                <div class="card-body">
                    <form id="register_form">

                        <!-- Error Container -->
                        <div id="errs" class="errcontainer"></div>

                        <div class="form-group">
                            <label for="name">Username</label>
                            <input 
                                type="text" 
                                name="name" 
                                class="form-control" 
                                id="name" 
                                onkeydown="if(event.key === 'Enter'){event.preventDefault();register();}" 
                                aria-describedby="e_error"
                            >
                            <small id="name_error" class="form-text text-muted"></small>
                        </div>

                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input 
                                type="email" 
                                name="email" 
                                class="form-control" 
                                id="email" 
                                onkeydown="if(event.key === 'Enter'){event.preventDefault();register();}" 
                                aria-describedby="e_error"
                            >
                            <small id="email_error" class="form-text text-muted"></small>
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input 
                                type="password" 
                                name="password" 
                                class="form-control" 
                                id="password" 
                                onkeydown="if(event.key === 'Enter'){event.preventDefault();register();}"
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
                                onkeydown="if(event.key === 'Enter'){event.preventDefault();register();}"
                            >
                            <small id="p_error" class="form-text text-muted"></small>
                        </div>

                        <div class="form-group">
                            <label for="usergroupSelect">Usergroup Request</label>
                            <select  
                                type="text" 
                                name="usergroupSelect" 
                                class="form-control" 
                                id="usergroupSelect" 
                            >
                                <option value="basic">Default</option>
                                <option value="admin">Admin (requires approval)</option>
                            </select>
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <button 
                                type="button" 
                                class="btn btn-info px-4 mr-2"
                                onclick="register();"
                            ><i class="fa fa-user-plus">&nbsp;</i>Register</button>
                            <p class="m-0 mr-3">Have an account? <span><a href="auth.php?page=login">Login</a></span></p>
                        </div>
                        
                    </form>

                </div>
            </div>
        </div>

    </div>
</div>



