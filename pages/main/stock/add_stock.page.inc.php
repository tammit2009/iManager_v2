
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
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">xxxx</label>
                        <input type="email" class="form-control form-control-sm" name="email" id="email" required value="<?php echo isset($email) ? $email : '' ?>">
                        <small id="email_msg"></small>
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