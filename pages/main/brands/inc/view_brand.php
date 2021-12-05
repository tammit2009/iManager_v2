<?php
include_once('../../../../core/initialize.php');

if(isset($_GET['id'])){
    $brand = fetchBrandById($_GET['id']);
    foreach($brand as $k => $v) {
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
        <!-- <div class="card-header bg-white"> -->
            <!-- <h3 class="widget-user-username"></?php echo ucwords($name) ?></h3>
            <h5 class="widget-user-desc"></?php echo $email ?></h5> -->
        <!-- </div> -->
        <div class="card-body">
            <table style="font-size:14px;width:100%;">
            <tr>
                <td class="field-key">Brand Name:</td>
                    <td><b><span><?php echo $name ?></span></b></td>
                </tr>
                <tr>
                    <td class="field-key">Created On:</td>
                    <td><b><span><?php echo $created_on ?></span></b></td>
                </tr>
                <tr>
                    <td class="field-key">Created By:</td>
                    <td><b><span><?php echo $creator ?></span></b></td>
                </tr>
                <tr>
                    <td class="field-key">Catalog Symbol:</td>
                    <td><b><span><?php echo $catalog_symbol ?></span></b></td>
                </tr>                  
            </table>
        </div>
        <!-- <div class="card-footer">
            <div class="container-fluid"></div>
        </div> -->
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