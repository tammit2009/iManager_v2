
<!-- Edit Category Modal-->
<div class="modal fade" id="editCategoryModal" tabindex="-1" role="dialog" aria-labelledby="editCategoryModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">

        <form id="edit_category_form">

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editCategoryModalLabel">Edit Category</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    
                    <div class="my-3">
                        
                            <input type="hidden" name="edit_category_id" id="edit_category_id">

                            <div class="form-group">
                                <label for="">Category Name</label>
                                <input type="text" name="edit_category_name" id="edit_category_name" class="form-control form-control-sm" required>
                            </div>

                            <div class="form-group">
                                <label for="">Abbreviation</label>
                                <input type="text" name="edit_category_abbrv" id="edit_category_abbrv" class="form-control form-control-sm" required>
                            </div>

                            <div class="form-group">
                                <label for="">ParentId</label>
                                <input type="text" name="edit_category_parentid" id="edit_category_parentid" class="form-control form-control-sm" value="NULL" readonly>
                            </div>

                            <div class="form-group">
                                <label for="">Category Description</label>
                                <input type="text" name="edit_category_description" id="edit_category_description" class="form-control form-control-sm">
                            </div>

                            <div class="form-group">
                                <label for="">Catalog Symbol</label>
                                <input type="text" name="edit_category_catalog_symbol" id="edit_category_catalog_symbol" class="form-control form-control-sm">
                            </div>

                            <div class="form-group">
                                <label for="">Category Image</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="edit_category_img_file" name="edit_category_img_file" onchange="displayEditImg(this)" accept="image/*">
                                    <label class="custom-file-label" for="edit_category_img_file"><?php echo isset($avatar) ? $avatar : 'Choose file' ?></label>
                                </div>
                            </div>

                            <div class="form-group d-flex justify-content-center align-items-center">
                                <img id="edit_category_img" class="img-fluid img-thumbnail" src="<?php echo isset($avatar) ? PROFILE_PIX_URL_BASE_PATH.$avatar : PROFILE_PIX_URL_BASE_PATH.'no-image-available.svg' ?>" alt="Avatar">
                            </div>
                        
                    </div>

                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="update_category_btn btn btn-info" onclick="return false;">Update category</button>
                </div>
            </div>

        </form>
    </div>
</div>

<style>
	img#edit_category_img {
		height: 15vh;
		width: 15vh;
		object-fit: cover;
		border-radius: 100% 100%;
	}
</style>

<script>

function displayEditImg(input) {
	if (input.files && input.files[0]) {
		var reader = new FileReader();		// HTML5 API
		reader.onload = function (e) {
			$('#edit_category_img').attr('src', e.target.result);
		}
		reader.readAsDataURL(input.files[0]);
		// console.log(input.files[0])
		$('label[for = edit_category_img_file]').text( input.files[0].name );
	}
}

$(document).ready(function() {

    // triggered when modal is about to be shown 
    $('#editCategoryModal').on('show.bs.modal', function(e) {
        // get data-id attribute of the clicked element
        var categoryid = $(e.relatedTarget).data('categoryid');
        // Set the UI element values
        getCategoryById(categoryid);
    });

    // initiate ajax and continue in 'main_scripts.js'
    $('#editCategoryModal').delegate('.update_category_btn', 'click', function(e) {
        var form_data = new FormData($("#edit_category_form")[0]); // possible image file to be uploaded
        updateCategory(form_data);
    });

});   
</script>
