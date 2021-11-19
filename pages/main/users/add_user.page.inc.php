<?php 
    $groups = fetch_all_groups();
    $domains = fetch_all_domains();
?>

<div class="dashboard card my-4">
    <div class="card-body">
        
        <form id="manage_user_form" enctype="multipart/form-data"> <!-- 'enctype' not really needed here with FormData() used below -->
            <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
            <div class="row">
                <div class="col-md-6"> <!-- border-right -->
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" name="name" id="name" class="form-control form-control-sm" value="<?php echo isset($name) ? $name : '' ?>">
                    </div>
                    <!-- <div class="form-group">
                        <label for="">Last Name</label>
                        <input type="text" name="lastname" class="form-control form-control-sm" required value="">
                    </div> -->
                    <div class="form-group">
                        <label for="">User Group</label>
                        <select name="groupid" id="groupid" class="custom-select custom-select-sm">
                            <!-- </?php if (!isset($groupid)) { echo "<option value='1'>Basic</option>"; } ?> -->
                            <?php foreach ($groups as $group) { ?>
                                <option 
                                    value="<?= $group['id']; ?>"
                                    <?php 
                                    if (isset($groupid)) { 
                                        if ($groupid == $group['id']) echo 'selected'; 
                                    }
                                    else {
                                        if ($group['id'] == 1) { echo 'selected'; }
                                    } 
                                    ?>
                                >
                                    <?= ucwords($group['name']); ?>
                                </option>
                            <?php $i++; } ?>
                        </select>
					</div>
                    <div class="form-group">
                        <label for="">Domain</label>
                        <select name="domain" id="domain" class="custom-select custom-select-sm">
                            <!-- </?php if (!isset($domainid)) { echo "<option value='default'>Default</option>"; } ?> -->
                            <?php foreach ($domains as $dom) { ?>
                                <option 
                                    value="<?= $dom['id']; ?>"
                                    <?php 
                                    if (isset($domain)) { 
                                        if ($domain == $dom['id']) echo 'selected'; 
                                    }
                                    else {
                                        if ($dom['name'] == 'default') { echo 'selected'; }
                                    } 
                                    ?>
                                >
                                    <?= $dom['name']; ?>
                                </option>
                            <?php $i++; } ?>
                        </select>
					</div>
                    <div class="form-group">
                        <label for="">Avatar</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="imgFile" name="imgFile" onchange="displayImg(this)" accept="image/*">
                            <label class="custom-file-label" for="imgFile"><?php echo isset($avatar) ? $avatar : 'Choose file' ?></label>
                        </div>
                    </div>
                    <div class="form-group d-flex justify-content-center align-items-center">
						<img id="cimg" class="img-fluid img-thumbnail" src="<?php echo isset($avatar) ? PROFILE_PIX_URL_BASE_PATH.$avatar : PROFILE_PIX_URL_BASE_PATH.'no-image-available.svg' ?>" alt="Avatar">
					</div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">Email</label>
                        <input type="email" class="form-control form-control-sm" name="email" id="email" required value="<?php echo isset($email) ? $email : '' ?>">
                        <small id="email_msg"></small>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Password</label>
                        <input type="password" class="form-control form-control-sm" name="password" id="password" <?php echo !isset($id) ? "required":'' ?>>
                        <small><i><?php echo isset($id) ? "Leave this blank if you dont want to change you password":'' ?></i></small>
                    </div>
                    <div class="form-group">
                        <label class="label control-label">Confirm Password</label>
                        <input type="password" class="form-control form-control-sm" name="cpass" id="cpass" <?php echo !isset($id) ? "required":'' ?>>
                        <small id="pass_match" data-status=''></small>
                    </div>
                    <div class="form-check mt-4">
						<input type="checkbox" class="form-check-input" name="verified" id="verified" <?php echo isset($verified) ? ( $verified == 1 ? 'checked' : '' ) : '' ?>>
						<label class="form-check-label" for="verified">User verified</label>
					</div>
                </div>
            </div>
            <hr>
            <div class="col-lg-12 text-right justify-content-center d-flex">
                <button class="btn btn-primary mr-2" type="submit">Save</button>
                <button class="btn btn-secondary" type="button" onclick="location.href = 'main.php?dir=users&page=list_users'">Cancel</button>
            </div>
        </form>

    </div>
</div>

<style>
	img#cimg{
		height: 15vh;
		width: 15vh;
		object-fit: cover;
		border-radius: 100% 100%;
	}
</style>

<script>

function displayImg(input) {
	if (input.files && input.files[0]) {
		var reader = new FileReader();		// HTML5 API
		reader.onload = function (e) {
			$('#cimg').attr('src', e.target.result);
		}
		reader.readAsDataURL(input.files[0]);
		// console.log(input.files[0])
		$('label[for = imgFile]').text( input.files[0].name );
	}
}

// Compare password
$('[name="password"],[name="cpass"]').keyup(function(){
	var pass = $('[name="password"]').val();
	var cpass = $('[name="cpass"]').val();
	if(cpass == '' || pass == ''){
		$('#pass_match').attr('data-status','');
	}else{
		if(cpass == pass){
			$('#pass_match').attr('data-status','1').html('<i class="text-success">Password Matched.</i>');
		}else{
			$('#pass_match').attr('data-status','2').html('<i class="text-danger">Password does not match.</i>');
		}
	}
});

// submit form as standard and continue with ajax in 'main_scripts.js'
$('#manage_user_form').submit(function(e) {
	e.preventDefault();

	// var form_data = $("#manage_user_form").serializeArray(); // This wont work: convert form to array
	// if ($('[name="imgFile')[0].files.length > 0) { 
	// 	var imgFile =  $('[name="imgFile"]')[0].files[0].name;
	// 	form_data.push({ name: 'avatar', value: imgFile });
	// }

	var form_data = new FormData($(this)[0]);	// This method has to be used in order to submit file(s)

	// Print the FormData
	// for (var pair of form_data.entries()) { console.log(pair[0]+ ', ' + pair[1]); }

	manageUser(form_data);
});
	
</script>