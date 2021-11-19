<div class="row">
    <div class="col-md-12">

        <div class="dashboard card my-4">
            <div class="card-body">

                <form id="manage_product" action="../core/services/process.php" method="POST">

                    <input type="hidden" name="manage_product" value="<?php echo isset($id) ? $id : '' ?>">
                    
                    <div class="row">
                        <div class="col-md-6">

                            <div class="form-group">
                                <label for="">Product Name</label>
                                <input type="text" name="name" class="form-control form-control-sm" value="<?php echo isset($name) ? $name : '' ?>">
                            </div>

                            <div class="form-group">
                                <label for="">Product Unit</label>
                                <select class="form-control form-control-sm" id="product_unit">
                                    <option>Select Unit</option>
                                    <!-- <option>Piece</option>
                                    <option>Box</option>
                                    <option>Packet</option>
                                    <option>Pack</option>
                                    <option>Bag</option>
                                    <option>Satchet</option> -->
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="">Brand</label>
                                <select class="form-control form-control-sm" id="product_brand" name="product_brand">
                                    <option value="" selected>Select Brand</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="">Category</label>
                                <select class="form-control form-control-sm" name="product_category" id="product_category">
                                    <option value="" selected>Select Category</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="">SKU</label>
                                <div class="input-group input-group-sm">
                                    <select class="custom-select" id="inputGroupSelect04">
                                        <option selected>Choose...</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="button">Create New</button>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="">Weight (kg)</label>
                                <input type="text" name="name" class="form-control form-control-sm" value="<?php echo isset($name) ? $name : '' ?>">
                            </div>

                            <div class="form-group">
                                <label for="">Volume</label>
                                <input type="text" name="name" class="form-control form-control-sm" value="<?php echo isset($name) ? $name : '' ?>">
                            </div>

                            <div class="form-group">
                                <label for="">Short Description</label>
                                <input type="text" name="name" class="form-control form-control-sm" value="<?php echo isset($name) ? $name : '' ?>">
                            </div>

                            <div class="form-group">
                                <label for="">Long Description</label>
                                <input type="text" name="name" class="form-control form-control-sm" value="<?php echo isset($name) ? $name : '' ?>">
                            </div>

                            <div class="form-group">
                                <label for="">Unit Price</label>
                                <input type="text" name="name" class="form-control form-control-sm" value="<?php echo isset($name) ? $name : '' ?>">
                            </div>

                            <div class="form-group">
                                <label for="">Main Pix</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Upload</span>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="inputGroupFile01">
                                        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="">Gallery Pix</label>
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                        <button class="btn btn-outline-secondary" type="button">Button</button>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="inputGroupFile03">
                                        <label class="custom-file-label" for="inputGroupFile03">Choose file</label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="">Tags</label>
                                <input type="text" name="name" class="form-control form-control-sm" value="<?php echo isset($name) ? $name : '' ?>">
                            </div>

                            <div class="form-group">
                                <label for="">Frequency Weighting</label>
                                <input type="text" name="name" class="form-control form-control-sm" value="<?php echo isset($name) ? $name : '' ?>">
                            </div>

                            <div class="form-group">
                                <label for="">Keep Stock?</label>
                                <input type="text" name="name" class="form-control form-control-sm" value="<?php echo isset($name) ? $name : '' ?>">
                            </div>


                            <div class="form-group">
                                <label for="">Created On</label>
                                <input type="text" name="name" class="form-control form-control-sm" value="<?php echo isset($name) ? $name : '' ?>">
                            </div>

                            <div class="form-group">
                                <label for="">Created By</label>
                                <input type="text" name="name" class="form-control form-control-sm" value="<?php echo isset($name) ? $name : '' ?>">
                            </div>

                            <!-- <div class="form-group">
                                <label for="">Last Name</label>
                                <input type="text" name="lastname" class="form-control form-control-sm" required value="">
                            </div> -->
                            <!-- <div class="form-group">
                                <label for="">User Group</label>
                                <select name="groupid" id="groupid" class="custom-select custom-select-sm">
                                    <option value="1" </?php if (isset($groupid)) { if ($groupid == 1) echo 'selected'; }; ?>>Basic</option>
                                    <option value="3" </?php if (isset($groupid)) { if ($groupid == 3) echo 'selected'; }; ?>>Employee</option>
                                    <option value="4" </?php if (isset($groupid)) { if ($groupid == 4) echo 'selected'; }; ?>>Manager</option>
                                    <option value="2" </?php if (isset($groupid)) { if ($groupid == 2) echo 'selected'; }; ?>>Administrator</option>
                                </select>
                            </div> -->
                            <!-- <div class="form-group">
                                <label for="">Avatar</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="customFile" name="img" onchange="displayImg(this,$(this))">
                                    <label class="custom-file-label" for="customFile"></?php echo isset($avatar) ? $avatar : 'Choose file' ?></label>
                                </div>
                            </div> -->
                            <!-- <div class="form-group d-flex justify-content-center align-items-center">
                                <img src="</?php echo isset($avatar) ? PROFILE_PIX_DIR.$avatar : PROFILE_PIX_DIR.'no-image-available.svg' ?>" alt="Avatar" id="cimg" class="img-fluid img-thumbnail">
                            </div> -->
                        </div>
                        <div class="col-md-6">

                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                                <label class="form-check-label" for="defaultCheck1">
                                    <b>This product has multiple variants</b> e.g. Multiple Sizes and/or Colors
                                </label>
                            </div>

                            <div class="form-group">
                                <label for="">Color</label>
                                <input type="text" name="name" class="form-control form-control-sm" value="<?php echo isset($name) ? $name : '' ?>">
                            </div>

                            <div class="form-group">
                                <label for="">Size</label>
                                <input type="text" name="name" class="form-control form-control-sm" value="<?php echo isset($name) ? $name : '' ?>">
                            </div>

                            <!-- <div class="form-group">
                                <label class="control-label">Email</label>
                                <input type="email" class="form-control form-control-sm" name="email" required value="<?php echo isset($email) ? $email : '' ?>">
                                <small id="#msg"></small>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Password</label>
                                <input type="password" class="form-control form-control-sm" name="password" <?php echo !isset($id) ? "required":'' ?>>
                                <small><i></?php echo isset($id) ? "Leave this blank if you dont want to change you password":'' ?></i></small>
                            </div>
                            <div class="form-group">
                                <label class="label control-label">Confirm Password</label>
                                <input type="password" class="form-control form-control-sm" name="cpass" <?php echo !isset($id) ? "required":'' ?>>
                                <small id="pass_match" data-status=''></small>
                            </div>
                        </div> -->
                    </div>
                    <hr>
                    <div class="col-lg-12 text-right justify-content-center d-flex">
                        <button type="submit" class="btn btn-primary mr-2">Save</button>
                        <button class="btn btn-secondary" type="button" onclick="location.href = 'dashboard.php?page=list_products'">Cancel</button>
                    </div>
                </form>

            </div>
        </div>

    </div>
</div>

<style>

    /* .select2-container {
        width: 100% !important;
    } */

    /* .select2-container--default .select2-selection--single {
        background-color: #fff;
        border: 1px solid #d1d3e2;
        border-radius: 0.2rem;
        line-height: 1.5;
        font-size: 0.875rem;
        padding: 0.25rem 0.5rem;
        height: calc(1.5em + 0.5rem + 5px);
    } */

    /* .select2-selection__rendered {
        color: #6e707e !important;
        padding: 0 2px 1px !important;
        /\* font-size: 14px !important;
        padding-left: 14px !important; *\/
    } */

    /* .select2-container--default .select2-selection--single .select2-selection__arrow b {
        background-image: url(../assets/imgs/arrow_down.png);
        background-color: transparent;
        background-size: contain;
        border: none !important;
        height: 18px !important;
        width: 18px !important;
        margin: auto !important;
        top: 5px !important;
        left: auto !important; 
    }  */

</style>

<script>

$(document).ready(function() {

    // const baseUrl = window.location.origin;

    // initializeBrandsSelect();
    // initializeCategoriesSelect();
    // initializeProductUnitsSelect();

    // function initializeBrandsSelect() {
    //     $.ajax({
    //         url: `${baseUrl}/imanager/core/services/process.php`,
    //         method: 'POST',
    //         data: {
    //             get_all_brands: 1
    //         },
    //         datatype: 'text',
    //         success: function(data) {
    //             //alert(data);
    //             $("#product_brand").select2({
    //                 data: JSON.parse(data)
    //             });
    //         }
    //     });
    // }

    // function initializeCategoriesSelect() {
    //     $.ajax({
    //         url: `${baseUrl}/imanager/core/services/process.php`,
    //         method: 'POST',
    //         data: {
    //             get_all_categories: 1
    //         },
    //         datatype: 'text',
    //         success: function(data) {
    //             //alert(data);
    //             $("#product_category").select2({
    //                 data: JSON.parse(data)
    //             });
    //         }
    //     })
    // }

    // function initializeProductUnitsSelect() {
    //     $.ajax({
    //         url: `${baseUrl}/imanager/core/services/process.php`,
    //         method: 'POST',
    //         data: {
    //             get_all_product_units: 1
    //         },
    //         datatype: 'json',
    //         success: function(data) {
    //             var parsed = JSON.parse(data);
    //             //alert(parsed);
    //             $.each(parsed, function(key, value) {
    //                 //console.log("key: ", key, "value: ", value.status_label);
    //                 $("#product_unit").append(
    //                     "<option value=" + value.status_value +">"+value.status_label+"</option>"
    //                 );
    //             })
    //         }
    //     })
    // }


    // 	$.ajax({
	// 		url:'../core/services/ajax.php?action=save_user',
	// 		data: new FormData($(this)[0]),	// '#manage_user' form
	// 		cache: false,
	// 		contentType: false,
	// 		processData: false,
	// 		method: 'POST',
	// 		type: 'POST',
	// 		success:function(resp){

	// 			alert(resp.trim());

	// 			end_load()

	// 			if(resp == 1){

	// 				window.location = `${baseUrl}/imanager/admin/dashboard.php?page=list_users`;

	// 				//alert_toast('Data successfully saved.',"success");
	// 				// setTimeout(function(){
	// 				// 	//location.replace('dashboard.php?page=list_users')
	// 				// 	window.location = `${baseUrl}/imanager/admin/dashboard.php?page=list_users`;
	// 				// }, 750)
	// 			}else if(resp == 2){
	// 				$('#msg').html("<div class='alert alert-danger'>Email already exist.</div>");
	// 				$('[name="email"]').addClass("border-danger")
					
	// 			}

	// 		}
	// 	});
	// });

    // $("#searchBox").keyup(function() {
    //     var query = $("#searchBox").val();
        
    //     if (query.length > 2) {
    //         $.ajax({
    //             url: 'index.php',
    //             method: 'POST',
    //             data: {
    //                 search: 1,
    //                 q: query
    //             },
    //             datatype: 'text',
    //             success: function(data) {
    //                 $("#response").html(data);
    //             }
    //         })
    //     }
    // });

    // $(document).on('click', 'li', function() {
    //     var country = $(this).text();
    //     $('#searchBox').val(country);
    //     $('#response').html("");
    // });

});
    
	
</script>