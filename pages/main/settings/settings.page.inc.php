<?php 
    $settings = fetch_all_sys_settings();
    foreach($settings as $setting) {
        $key = $setting['sys_key'];
        $val = $setting['sys_value'];
        $$key = $val; // echo "$$key : $val <br/>";       
    }
?>

<div class="dashboard card my-3">
    <div class="card-body">
        
        <form id="manage_settings">
            
            <div class="row my-2">

                <div class="col-md-12">
                    <h4>General</h4>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">System Name</label>
                        <input type="text" name="system_name" class="form-control form-control-sm" required value="<?= $system_name ?>">
                    </div>
                    <div class="form-group">
                        <label for="">System Short Name</label>
                        <input type="text" name="system_shortname" class="form-control form-control-sm" required value="<?= $system_shortname ?>">
                    </div>
                    <div class="form-group">
                        <label for="">Company Name</label>
                        <input type="text" name="system_name" class="form-control form-control-sm" required value="<?= $company_name ?>">
                    </div>
                    <div class="form-group">
                        <label for="">System Logo</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="customFile" name="img" onchange="displayImg(this,$(this))">
                            <label class="custom-file-label" for="customFile"><?= $system_logo ?></label>
                        </div>
                    </div>
                    <!-- <div class="form-group d-flex justify-content-center align-items-center">
						<img src="</?php echo isset($avatar) ? PROFILE_PIX_DIR.$avatar : PROFILE_PIX_DIR.'no-image-available.svg' ?>" alt="Avatar" id="cimg" class="img-fluid img-thumbnail">
					</div> -->
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Company Email</label>
                        <input type="email" name="system_name" class="form-control form-control-sm" required value="<?= $company_email ?>">
                    </div>
                    <div class="form-group">
                        <label for="">Company Address</label>
                        <textarea class="form-control" name="porder_notes" id="porder_notes" rows="3"><?= $company_address ?></textarea>
                    </div>
                </div>

            </div>

            <div class="row my-4">

                <div class="col-md-12">
                    <h4>Domain Functions</h4>
                </div>
                
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Domain Function 1</label>
                        <input type="text" name="system_name" class="form-control form-control-sm" required value="<?= $dom_function_1 ?>">
                    </div>
                    <div class="form-group">
                        <label for="">Domain Function 2</label>
                        <input type="text" name="system_shortname" class="form-control form-control-sm" required value="<?= $dom_function_2 ?>">
                    </div>
                    <div class="form-group">
                        <label for="">Domain Function 3</label>
                        <input type="text" name="system_name" class="form-control form-control-sm" required value="<?= $dom_function_3 ?>">
                    </div>
                    <div class="form-group">
                        <label for="">Domain Function 4</label>
                        <input type="email" name="system_name" class="form-control form-control-sm" required value="<?= $dom_function_4 ?>">
                    </div>
                    <div class="form-group">
                        <label for="">Domain Function 5</label>
                        <input type="text" name="system_name" class="form-control form-control-sm" required value="<?= $dom_function_5 ?>">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Domain Function 6</label>
                        <input type="text" name="system_name" class="form-control form-control-sm" required value="<?= $dom_function_6 ?>">
                    </div>
                    <div class="form-group">
                        <label for="">Domain Function 7</label>
                        <input type="text" name="system_name" class="form-control form-control-sm" required value="<?= $dom_function_7 ?>">
                    </div>
                    <div class="form-group">
                        <label for="">Domain Function 8</label>
                        <input type="text" name="system_name" class="form-control form-control-sm" required value="<?= $dom_function_8 ?>">
                    </div>
                    <div class="form-group">
                        <label for="">Domain Function 9</label>
                        <input type="text" name="system_name" class="form-control form-control-sm" required value="<?= $dom_function_9 ?>">
                    </div>
                    <div class="form-group">
                        <label for="">Domain Function 10</label>
                        <input type="text" name="system_name" class="form-control form-control-sm" required value="<?= $dom_function_10 ?>">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Domain Function 11</label>
                        <input type="text" name="system_name" class="form-control form-control-sm" required value="<?= $dom_function_11 ?>">
                    </div>
                    <div class="form-group">
                        <label for="">Domain Function 12</label>
                        <input type="text" name="system_name" class="form-control form-control-sm" required value="<?= $dom_function_12 ?>">
                    </div>
                    <div class="form-group">
                        <label for="">Domain Function 13</label>
                        <input type="text" name="system_name" class="form-control form-control-sm" required value="<?= $dom_function_13 ?>">
                    </div>
                    <div class="form-group">
                        <label for="">Domain Function 14</label>
                        <input type="text" name="system_name" class="form-control form-control-sm" required value="">
                    </div>
                    <div class="form-group">
                        <label for="">Domain Function 15</label>
                        <input type="text" name="system_name" class="form-control form-control-sm" required value="">
                    </div>
                </div>
            </div>

            <div class="col-md-12 d-flex justify-content-end">
                <button id="porder_create_btn" type="button" class="btn bg-theme-accent px-3 mr-2">Save</button>
                <button class="btn btn-secondary" type="button" onclick="location.href = 'dashboard.php?page=index'">Cancel</button>
            </div>
            
        </form>

    </div>
</div>
