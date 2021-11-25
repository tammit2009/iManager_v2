
<!-- Edit Uncategorized Vendor Product Modal-->
<div class="modal fade" id="editUKNvproductModal" tabindex="-1" role="dialog" aria-labelledby="editUKNvproductModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editUKNvproductModalLabel">Edit Uncategorized Vendor Product</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">

                <!-- Nav tabs -->
                <ul class="nav nav-tabs mb-3 mx-3" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="main-tab" data-toggle="tab" href="#main" role="tab" aria-controls="main" aria-selected="true">Product</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="details-tab" data-toggle="tab" href="#details" role="tab" aria-controls="main" aria-selected="true">Details</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="brand-tab" data-toggle="tab" href="#brand" role="tab" aria-controls="brand" aria-selected="false">Brand</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="category-tab" data-toggle="tab" href="#category" role="tab" aria-controls="category" aria-selected="false">Category</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pkgunit-tab" data-toggle="tab" href="#pkgunit" role="tab" aria-controls="packaging" aria-selected="false">Package Unit</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pkglot-tab" data-toggle="tab" href="#pkglot" role="tab" aria-controls="packaging" aria-selected="false">Package Lot</a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content mx-3">
                    <div class="tab-pane active" id="main" role="tabpanel" aria-labelledby="main-tab">
                        <form id="edit_vproduct_form">
                
                            <div class="my-3">
                                <div class="row">
                                    <div class="col-md-12">

                                        <input type="hidden" name="vproduct_id" id="vproduct_id">

                                        <table class="table table-bordered my-3">
                                            <!-- <thead>
                                                <tr>
                                                    <th>Property</th>
                                                    <th>Description</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead> -->
                                            <tbody>
                                                <tr>
                                                    <td class="text-left" style="width:30%">Brand</td>
                                                    <td class="text-left" style="width:45%"><span id="vproduct_brand"></span></td>
                                                    <td class="text-center">
                                                        <span class="badge badge-secondary" style="font-size:14px;">
                                                            <i class="fa fa-times">&nbsp;</i>Invalid
                                                        </span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-left">Category</td>
                                                    <td class="text-left"><span id="vproduct_category"></span></td>
                                                    <td class="text-center">
                                                        <span class="badge badge-secondary" style="font-size:14px;">
                                                            <i class="fa fa-times">&nbsp;</i>Invalid
                                                        </span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-left">Product Name</td>
                                                    <td class="text-left"><span id="vproduct_name">Undefined</span></td>
                                                    <td class="text-center">
                                                        <span class="badge badge-secondary" style="font-size:14px;">
                                                            <i class="fa fa-times">&nbsp;</i>Invalid
                                                        </span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-left">Product Short Description</td>
                                                    <td class="text-left"><span id="vproduct_description"></span></td>
                                                    <td class="text-center">
                                                        <span class="badge badge-secondary" style="font-size:14px;">
                                                            <i class="fa fa-times">&nbsp;</i>Invalid
                                                        </span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-left">Product Package Unit</td>
                                                    <td class="text-left"><span id="vproduct_pkgunit"></span></td>
                                                    <td class="text-center">
                                                        <span class="badge badge-secondary" style="font-size:14px;">
                                                            <i class="fa fa-times">&nbsp;</i>Invalid
                                                        </span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-left">Product Package Lot</td>
                                                    <td class="text-left"><span id="vproduct_pkglot"></span></td>
                                                    <td class="text-center">
                                                        <span class="badge badge-secondary" style="font-size:14px;">
                                                            <i class="fa fa-times">&nbsp;</i>Invalid
                                                        </span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-left">Provisional SKU</td>
                                                    <td class="text-left"><span id="vproduct_psku"></span></td>
                                                    <td class="text-center">
                                                        <span class="badge badge-secondary" style="font-size:14px;">
                                                            <i class="fa fa-times">&nbsp;</i>Invalid
                                                        </span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-left">Recommended SKU</td>
                                                    <td class="text-left"><span id="vproduct_fsku">-----</span></td>
                                                    <td class="text-center">
                                                        <span class="badge badge-secondary" style="font-size:14px;">
                                                            <i class="fa fa-times">&nbsp;</i>Invalid
                                                        </span>
                                                    </td>
                                                </tr>
                                            </tbody>

                                        </table>

                                        <!-- <div class="form-group">
                                            <label for="">Product Name</label>
                                            <input type="text" name="vproduct_name" id="vproduct_name" class="form-control form-control-sm" required>
                                        </div>         

                                        <div class="form-group">
                                            <label for="">Brand</label>
                                            <input type="text" name="vproduct_brand" id="vproduct_brand" class="form-control form-control-sm" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="">Category</label>
                                            <input type="text" name="vproduct_category" id="vproduct_category" class="form-control form-control-sm" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="">Product Description</label>
                                            <input type="text" name="vproduct_description" id="vproduct_description" class="form-control form-control-sm">
                                        </div>

                                        <div class="form-group">
                                            <label for="">Provisional SKU</label>
                                            <input type="text" name="vproduct_psku" id="vproduct_psku" class="form-control form-control-sm" required>
                                        </div> -->

                                    </div>

                                    <div class="col-md-12 d-flex justify-content-end mt-3">
                                        <button type="submit" class="update_vproduct_btn btn btn-info" onclick="return false;">Update Product</button>
                                        <button class="btn btn-secondary ml-2" type="button" data-dismiss="modal">Cancel</button>
                                    </div>
                                    
                                </div>
                            </div>

                        </form>
                    </div>

                    <div class="tab-pane" id="details" role="tabpanel" aria-labelledby="details-tab">
                
                        <div class="my-3">
                            <div class="row">
                                <div class="col-md-12">

                                    <div class="form-group">
                                        <label for="">Product Name</label>
                                        <input type="text" name="vproduct_name_input" id="vproduct_name_input" 
                                            class="form-control form-control-sm" style="width: 85%">
                                    </div>         

                                    <div class="form-group">
                                        <label for="">Description</label>
                                        <!-- <input type="text" name="vproduct_description_input" id="vproduct_description_input" class="form-control form-control-sm"> -->
                                        <textarea name="vproduct_description_input" id="vproduct_description_input" 
                                            class="form-control form-control-sm" rows="3" style="width: 85%"></textarea>
                                    </div>

                                </div>

                                <!-- <div class="col-md-12 d-flex justify-content-end mt-3">
                                    <button type="submit" class="update_vproduct_btn btn btn-info" onclick="return false;">Update Product</button>
                                </div> -->
                                
                            </div>
                        </div>

                    </div>

                    <div class="tab-pane" id="brand" role="tabpanel" aria-labelledby="brand-tab">

                        <div class="col-md-12 px-2 mb-4 pt-3">

                            <div class="form-group row mb-4">
                                <!-- <label for="brand_selection" class="col-md-2">Brand:</label> -->
                                <div class="col-md-12">
                                    <input type="text" name="brand_selection" id="brand_selection" class="form-control" placeholder="Select a brand below">
                                </div>
                            </div>
                            
                            <!-- <p style="background:#f5f5f5;padding:8px;border-radius:6px;font-weight:bold;">Select Brand</p> -->
                            <!-- <br> -->

                            <table class="table table-bordered" id="brand_selection_list" style="font-size:14px;">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 5%;">#</th>
                                        <th class="text-left" style="width: 35%;">Brand Name</th>
                                        <th class="text-center" style="width: 25%;">Catalog Symbol</th>
                                        <th class="text-center" style="width: 15%;">Action</th>
                                    </tr>
                                </thead>

                                <tbody>

                                <?php 
                                $brands = fetch_all_brands();
                                if ($brands == -1 || empty($brands)) {
                                    echo "No Record Found"; exit;
                                } else {
                                    $i = 1;
                                    foreach ($brands as $row) { ?>

                                    <tr>
                                        <td class="text-center"><?php echo $i; ?></td>
                                        <td class="text-left"><?php echo $row['name']; ?></td>
                                        <td class="text-center"><?php echo $row['catalog_symbol']; ?></td>
                                        <td class="text-center">
                                            <button 
                                                type="button" 
                                                data-dismiss="modal"
                                                style="font-size:13px;"
                                                class="select_role btn btn-secondary btn-sm btn-flat px-3" 
                                                data-id="<?php echo $row['id']; ?>"
                                                data-name="<?php echo $row['label']; ?>"
                                            >
                                                <i class="fa fa-search"></i>
                                                Select
                                            </button>
                                        </td>
                                    </tr>

                                    <?php $i++; } ?>

                                <?php } ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="category" role="tabpanel" aria-labelledby="category-tab">

                        <div class="col-md-12 px-2 mb-4 pt-3">

                            <div class="form-group row mb-4">
                                <!-- <label for="category_selection" class="col-md-2">Category:</label> -->
                                <div class="col-md-12">
                                    <input type="text" name="category_selection" id="category_selection" class="form-control" placeholder="Select a category below">
                                </div>
                            </div>
                            
                            <!-- <p style="background:#f5f5f5;padding:8px;border-radius:6px;font-weight:bold;">Select Category</p> -->
                            <!-- <br> -->

                            <table class="table table-bordered" id="category_selection_list" style="font-size:14px;">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 5%;">#</th>
                                        <th class="text-left" style="width: 35%;">Category Name</th>
                                        <th class="text-center" style="width: 25%;">Catalog Symbol</th>
                                        <th class="text-center" style="width: 15%;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                <?php 
                                $categories = fetch_all_categories();
                                if ($categories == -1 || empty($categories)) {
                                    echo "No Record Found"; exit;
                                } else {
                                    $i = 1;
                                    foreach ($categories as $row) { ?>

                                    <tr>
                                        <td class="text-center"><?php echo $i; ?></td>
                                        <td class="text-left"><?php echo $row['name']; ?></td>
                                        <td class="text-center"><?php echo $row['catalog_symbol']; ?></td>
                                        <td class="text-center">
                                            <button 
                                                type="button" 
                                                data-dismiss="modal"
                                                style="font-size:13px;"
                                                class="select_role btn btn-secondary btn-sm btn-flat px-3" 
                                                data-id="<?php echo $row['id']; ?>"
                                                data-name="<?php echo $row['label']; ?>"
                                            >
                                                <i class="fa fa-search"></i>
                                                Select
                                            </button>
                                        </td>
                                    </tr>

                                    <?php $i++; } ?>

                                <?php } ?>

                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="tab-pane" id="pkgunit" role="tabpanel" aria-labelledby="pkgunit-tab">

                        <div class="col-md-12 px-2 mb-4 pt-3">

                            <div class="form-group row mb-4">
                                <!-- <label for="pkgunit_selection" class="col-md-2">Brand:</label> -->
                                <div class="col-md-12">
                                    <input type="text" name="pkgunit_selection" id="pkgunit_selection" class="form-control" placeholder="Select a package unit type below">
                                </div>
                            </div>
                            
                            <!-- <p style="background:#f5f5f5;padding:8px;border-radius:6px;font-weight:bold;">Select Package Lot</p> -->
                            <!-- <br> -->

                            <table class="table table-bordered" id="pkgunit_selection_list" style="font-size:14px;">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 5%;">#</th>
                                        <th class="text-left" style="width: 40%;">Label</th>
                                        <th class="text-center" style="width: 15%;">Catalog Symbol</th>
                                        <th class="text-center" style="width: 15%;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                <?php 
                                $pkg_lots = fetch_all_pkg_lot_types();
                                if ($pkg_lots == -1 || empty($pkg_lots)) {
                                    echo "No Record Found"; exit;
                                } else {
                                    $i = 1;
                                    foreach ($pkg_lots as $row) { ?>

                                    <tr>
                                        <td class="text-center"><?php echo $i; ?></td>
                                        <td class="text-left"><?php echo $row['label']; ?></td>
                                        <td class="text-center"><?php echo $row['catalog_symbol']; ?></td>
                                        <td class="text-center">
                                            <button 
                                                type="button" 
                                                data-dismiss="modal"
                                                style="font-size:13px;"
                                                class="select_role btn btn-secondary btn-sm btn-flat px-3" 
                                                data-id="<?php echo $row['id']; ?>"
                                                data-name="<?php echo $row['label']; ?>"
                                            >
                                                <i class="fa fa-search"></i>
                                                Select
                                            </button>
                                        </td>
                                    </tr>

                                    <?php $i++; } ?>

                                <?php } ?>
                                </tbody>

                            </table>
                        </div>
                    </div>

                    <div class="tab-pane" id="pkglot" role="tabpanel" aria-labelledby="pkglot-tab">

                        <div class="col-md-12 px-2 mb-4 pt-3">

                            <div class="form-group row mb-4">
                                <!-- <label for="pkglot_selection" class="col-md-2">Brand:</label> -->
                                <div class="col-md-12">
                                    <input type="text" name="pkglot_selection" id="pkglot_selection" class="form-control" placeholder="Select a package lot type below">
                                </div>
                            </div>
                            
                            <!-- <p style="background:#f5f5f5;padding:8px;border-radius:6px;font-weight:bold;">Select Package Lot</p> -->
                            <!-- <br> -->

                            <table class="table table-bordered" id="pkglot_selection_list" style="font-size:14px;">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 10%;">#</th>
                                        <th class="text-left" style="width: 40%;">Label</th>
                                        <th class="text-center" style="width: 20%;">Catalog Symbol</th>
                                        <th class="text-center" style="width: 15%;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                <?php 
                                $pkg_units = fetch_all_pkg_unit_types();
                                if ($pkg_units == -1 || empty($pkg_units)) {
                                    echo "No Record Found"; exit;
                                } else {
                                    $i = 1;
                                    foreach ($pkg_units as $row) { ?>

                                    <tr>
                                        <td class="text-center"><?php echo $i; ?></td>
                                        <td class="text-left"><?php echo $row['label']; ?></td>
                                        <td class="text-center"><?php echo $row['catalog_symbol']; ?></td>
                                        <td class="text-center">
                                            <button 
                                                type="button" 
                                                data-dismiss="modal"
                                                style="font-size:13px;"
                                                class="select_role btn btn-secondary btn-sm btn-flat px-3" 
                                                data-id="<?php echo $row['id']; ?>"
                                                data-name="<?php echo $row['label']; ?>"
                                            >
                                                <i class="fa fa-search"></i>
                                                Select
                                            </button>
                                        </td>
                                    </tr>

                                    <?php $i++; } ?>

                                <?php } ?>
                                </tbody>

                            </table>
                        </div>
                    </div>

                </div>
                
            </div>
            <!-- <div class="modal-footer"></div> -->
        </div>
    </div>
</div>

<script>
$(document).ready(function() {

    // triggered when modal is about to be shown 
    $('#editUKNvproductModal').on('show.bs.modal', function(e) {
        // get data-vprodid attribute of the clicked element
        var vprodid = $(e.relatedTarget).data('vprodid');
        // Set the UI element values
        getVendorProductById(vprodid);
    });

    // initiate ajax and continue in 'main_scripts.js'
    $('#editUKNvproductModal').delegate('.update_vproduct_btn', 'click', function(e) {
        var form_data = $("#edit_vproduct_form").serializeArray(); // convert form to array
        //updateUnknowVendorProduct(form_data);
    });

    $('#brand_selection_list').DataTable();
    $('#category_selection_list').DataTable();
    $('#pkgunit_selection_list').DataTable();
    $('#pkglot_selection_list').DataTable();

});   
</script>