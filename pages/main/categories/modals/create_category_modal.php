<!-- Create Category Modal-->
<div class="modal fade" id="createCategoryModal" tabindex="-1" role="dialog" aria-labelledby="createCategoryModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <form id="create_category_form" enctype="multipart/form-data">

                <div class="modal-header">
                    <h5 class="modal-title" id="createCategoryModalLabel">Create New Category</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    
                    <div class="my-3">
                        
                        <input type="hidden" name="category_id" id="category_id">

                        <div class="form-group">
                            <label for="">Category Name</label>
                            <input type="text" name="category_name" id="category_name" class="form-control form-control-sm" required>
                        </div>

                        <div class="form-group">
                            <label for="">Abbreviation</label>
                            <input type="text" name="category_abbrv" id="category_abbrv" class="form-control form-control-sm" required>
                        </div>

                        <div class="form-group">
                            <label for="">ParentId</label>
                            <input type="text" name="category_parentid" id="category_parentid" class="form-control form-control-sm" value="NULL" readonly>
                        </div>

                        <div class="form-group">
                            <label for="">Category Description</label>
                            <input type="text" name="category_description" id="category_description" class="form-control form-control-sm">
                        </div>

                        <div class="form-group">
                            <label for="">Catalog Symbol</label>
                            <input type="text" name="category_catalog_symbol" id="category_catalog_symbol" class="form-control form-control-sm">
                        </div>

                        <div class="form-group">
                            <label for="category_img_file">Category Image</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="category_img_file" name="category_img_file" onchange="displayImg(this)" accept="image/*">
                                <label class="custom-file-label" for="category_img_file"><?php echo isset($avatar) ? $avatar : 'Choose file' ?></label>
                            </div>
                        </div>

                        <div class="form-group d-flex justify-content-center align-items-center">
                            <img id="category_img" class="img-fluid img-thumbnail" src="<?php echo isset($avatar) ? PROFILE_PIX_URL_BASE_PATH.$avatar : PROFILE_PIX_URL_BASE_PATH.'no-image-available.svg' ?>" alt="Avatar">
                        </div>
                            
                    </div>

                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="create_category_btn btn btn-info" onclick="return false;">Create Category</button>
                </div>

            </form>
        </div>
    </div>
</div>

<style>
	img#category_img {
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
			$('#category_img').attr('src', e.target.result);
		}
		reader.readAsDataURL(input.files[0]);
		// console.log(input.files[0])
		$('label[for = category_img_file]').text( input.files[0].name );
	}
}

$(document).ready(function() {

    // initiate ajax and continue in 'main_scripts.js'
    $('#createCategoryModal').delegate('.create_category_btn', 'click', function(e) {
        e.preventDefault();
        
        var form_data = new FormData($("#create_category_form")[0]); // possible image file to be uploaded
        createNewCategory(form_data);
    });

});   

</script>