<?php 
    $brands = fetch_all_brands2();
    $categories = fetch_all_categories2();
    $pkgunits = fetch_all_pkg_unit_types();
    $pkglots = fetch_all_pkg_lot_types();
?>

<div class="row">
    <div class="col-md-12">

        <div class="dashboard card my-3">
            <div class="card-body">

                <form id="manage_vproduct_form" enctype="multipart/form-data"> <!-- 'enctype' not really needed here with FormData() used below -->

                    <input type="hidden" name="vproduct_id" value="<?php echo isset($id) ? $id : '' ?>">
                    <input type="hidden" name="vproduct_createdby" value="<?php echo isset($created_by) ? '' : $_SESSION['userid'] ?>">
                    <input type="hidden" name="domainid" id="domainid" value="<?php echo isset($domain_id) ? $domain_id : '' ?>">
                    <input type="hidden" name="subdomid" id="subdomid" value="<?php echo isset($sub_dom_id ) ? $sub_dom_id  : '' ?>">

                    <div class="row mb-3">
                        <div class="col-md-6">

                            <div class="form-group">
                                <label for="">Domain</label>
                                <select name="vproduct_domainid" id="vproduct_domainid" class="custom-select custom-select-sm">
                                    <option value="0">------</option>
                                </select>
                            </div> 

                            <div class="form-group">
                                <label for="">Vendor</label>
                                <input type="hidden" name="vproduct_vendorid" id="vproduct_vendorid" value="<?php echo isset($vendorid) ? $vendorid : '' ?>">
                                <input type="text" name="vproduct_vendor" id="vproduct_vendor" class="form-control form-control-sm" readonly value="<?php echo isset($vendorname) ? $vendorname : '' ?>">
                            </div>

                        </div>
                        <div class="col-md-6">

                            <div class="form-group">
                                <label for="">Subdomain</label>
                                <select name="vproduct_subdomid" id="vproduct_subdomid" class="custom-select custom-select-sm">
                                    <option value="0">------</option>
                                </select>
                            </div> 

                            <div class="form-group">
                                <label for="">SKU</label>
                                <div class="input-group input-group-sm">
                                    <input type="text" class="form-control" name="vproduct_psku" id="vproduct_psku" aria-label="SKU" value="<?php echo isset($provisional_sku) ? $provisional_sku : 'UKNDMMY' ?>" readonly>
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="button">Create New</button>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    
                    <div class="row">

                        <div class="col-md-6">

                            <div class="form-group">
                                <label for="">Brand</label>
                                <select class="form-control form-control-sm" id="vproduct_brand" name="vproduct_brand">
                                    <?php foreach ($brands as $brnd) { ?>
                                    <option 
                                        value="<?= $brnd['brand_id']; ?>"
                                            <?php 
                                            if (isset($brand)) { 
                                                if ($brand == $brnd['name']) echo 'selected'; 
                                            }
                                            ?>
                                        >
                                        <?= ucwords($brnd['name']); ?>
                                    </option>
                                    <?php $i++; } ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="">Description</label>
                                <textarea name="vproduct_descr" id="vproduct_descr" class="form-control form-control-sm" rows="9"><?php echo isset($product_name_descr) ? $product_name_descr : '' ?></textarea>
                            </div>

                        </div> 

                        <div class="col-md-6">

                            <div class="form-group">
                                <label for="">Category</label>
                                <select class="form-control form-control-sm" name="vproduct_category" id="vproduct_category">
                                <?php foreach ($categories as $cat) { ?>
                                    <option 
                                            value="<?= $cat['category_id']; ?>"
                                            <?php 
                                            if (isset($category)) { 
                                                if ($category == $cat['name']) echo 'selected'; 
                                            }
                                            ?>
                                        >
                                        <?= ucwords($cat['name']); ?>
                                    </option>
                                    <?php $i++; } ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="">Tags</label>
                                <input type="text" name="vproduct_tags" id="vproduct_tags" class="form-control form-control-sm" value="<?php echo isset($tags) ? $tags : '' ?>">
                            </div>

                            <div class="form-group">
                                <label for="">Features (e.g. Weight, Volume)</label>
                                <input type="text" name="vproduct_features" class="form-control form-control-sm" value="<?php echo isset($features ) ? $features  : '' ?>">
                            </div>

                            <div class="form-group">
                                <label for="">Attributes (e.g. size, color)</label>
                                <input type="text" name="vproduct_attributes" class="form-control form-control-sm" value="<?php echo isset($attributes ) ? $attributes  : '' ?>">
                            </div>

                            <!-- <div class="form-group">
                                <label for="">Long Description</label>
                                <input type="text" name="name" class="form-control form-control-sm" value="<?php echo isset($name) ? $name : '' ?>">
                            </div> -->
                            
                        </div>
                        
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Package Unit</label>
                                <select class="form-control form-control-sm" name="vproduct_pkgunit" id="vproduct_pkgunit">
                                    <?php foreach ($pkgunits as $pkgunit) { ?>
                                    <option 
                                            value="<?= $pkgunit['id']; ?>"
                                            <?php 
                                            if (isset($unit)) { 
                                                if ($unit == $pkgunit['label']) echo 'selected'; 
                                            }
                                            ?>
                                        >
                                        <?= $pkgunit['label']; ?>
                                    </option>
                                    <?php $i++; } ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="">Units per Lot</label>
                                <input type="text" name="vproduct_unitsperlot" class="form-control form-control-sm" value="<?php echo isset($qty_per_offer) ? $qty_per_offer : 1 ?>">
                            </div>

                            <!-- <div class="form-group">
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

                            <!-- <div class="form-group">
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
                            </div> -->
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Package Lot</label>
                                <select class="form-control form-control-sm" name="vproduct_pkglot" id="vproduct_pkglot">
                                    <?php foreach ($pkglots as $pkglot) { ?>
                                    <option 
                                        value="<?= $pkglot['id']; ?>"
                                        <?php 
                                        if (isset($lot)) { 
                                            if ($lot == $pkglot['label']) echo 'selected'; 
                                        }
                                        ?>
                                    >
                                        <?= $pkglot['label']; ?>
                                    </option>
                                    <?php $i++; } ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="">Unit Price</label>
                                <input type="text" name="vproduct_unit_price" class="form-control form-control-sm" value="<?php echo isset($offer_price ) ? $offer_price  : "0.00" ?>">
                            </div>

                            <div class="form-check mb-3 mt-4">
                                <input type="checkbox" class="form-check-input" name="vproduct_active" id="vproduct_active" <?php echo isset($active ) ? ( $active  == 1 ? 'checked' : '' ) : 'checked' ?>>
                                <label class="form-check-label" for="vproduct_active">Product Active</label>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="col-lg-12 text-right justify-content-center d-flex">
                        <button type="submit" class="btn btn-primary mr-2">Save</button>
                        <button class="btn btn-secondary" type="button" onclick="location.href = 'main.php?dir=vproducts&page=list_vproducts'">Cancel</button>
                    </div>
                </form>

            </div>
        </div>

    </div>
</div>

<script>

$(document).ready(function() {

    initializeVendorProductDomainsSelect();

    $('#vproduct_domainid').on('change', function() {
        // alert( this.value );
        domainsChangeVendorProductUpdateSubDomSelect( this.value );
    });

    // submit form as standard and continue with ajax in 'main_scripts.js'
    $('#manage_vproduct_form').submit(function(e) {
        e.preventDefault();

        var form_data = new FormData($(this)[0]);	// This method has to be used in order to submit file(s)
        manageVendorProduct(form_data);
    });

});
    
	
</script>