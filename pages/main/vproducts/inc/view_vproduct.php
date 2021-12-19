<?php
include_once('../../../../core/initialize.php');

if(isset($_GET['id'])){
    $vproduct = fetchVendorProductById($_GET['id']);
    foreach($vproduct as $k => $v) {
        $$k = $v;  
        // echo "$$k : $v <br/>";
    }
} 
?>
<style>
    td {
        height: 30px;
        vertical-align: top;
    }
    td.field-key {
        width: 40%;
    }
</style>
<div class="container-fluid">
	<!-- <div class="card"> -->
        
        <div class="card-body">
            <table style="font-size:14px;width:100%;">
                <!-- <tr>
                    <td class="field-key">Domain:</td>
                    <td><b><span></?php echo $domain_name; ?></span></b></td>
                </tr>  -->
                <tr>
                    <td class="field-key">Vendor:</td>
                    <td><b><span><?php echo $vendor_name; ?></span></b></td>
                </tr> 
                <tr>
                    <td class="field-key">Subdomain:</td>
                    <td><b><span><?php echo $subdom_name; ?></span></b></td>
                </tr> 
                <tr>
                    <td class="field-key">SKU:</td>
                    <td><b><span><?php echo $provisional_sku; ?></span></b></td>
                </tr> 
                <tr>
                    <td class="field-key">Brand Name:</td>
                    <td><b><span><?php echo $brand; ?></span></b></td>
                </tr>
                <tr>
                    <td class="field-key">Category Name:</td>
                    <td><b><span><?php echo $category; ?></span></b></td>
                </tr>
                <tr>
                    <td class="field-key">Product Descr:</td>
                    <td><b><span><?php echo $product_name_descr; ?></span></b></td>
                </tr>
                <tr>
                    <td class="field-key">Features:</td>
                    <td><b><span><?php echo $features; ?></span></b></td>
                </tr>
                <tr>
                    <td class="field-key">Attributes:</td>
                    <td><b><span><?php echo $attributes; ?></span></b></td>
                </tr>
                <tr>
                    <td class="field-key">Unit:</td>
                    <td><b><span><?php echo $unit; ?></span></b></td>
                </tr>
                <tr>
                    <td class="field-key">Lot:</td>
                    <td><b><span><?php echo $lot; ?></span></b></td>
                </tr>
                <tr>
                    <td class="field-key">Per Lot:</td>
                    <td><b><span><?php echo $qty_per_offer; ?></span></b></td>
                </tr>
                <tr>
                    <td class="field-key">Unit Price:</td>
                    <td><b><span><?php echo $offer_price; ?></span></b></td>
                </tr>
                <tr>
                    <td class="field-key">Created On:</td>
                    <td><b><span><?php echo $created_on; ?></span></b></td>
                </tr>
                <tr>
                    <td class="field-key">Created By:</td>
                    <td><b><span><?php echo $creator; ?></span></b></td>
                </tr>
                           
            </table>
        </div>

	<!-- </div> -->
</div>
<div class="modal-footer display p-0 m-0">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
</div>

<style>
	#uni_modal .modal-footer{
		display: none
	}
	#uni_modal .modal-footer.display{
		display: flex
	}
</style>