<?php
include_once('../../../../core/initialize.php');

if(isset($_GET['id'])){
    $doperator = getDoperatorById($_GET['id']);
    foreach($doperator as $k => $v) {
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
            <table style="font-size:14px;">
                <tr>
                    <td class="field-key">Username:</td>
                    <td><b><span><?php echo $username ?></span></b></td>
                </tr>
                <tr>
                    <td class="field-key">Domain:</td>
                    <td><b><span><?php echo $domain ?></span></b></td>
                </tr>
                <tr>
                    <td class="field-key">Subdomain:</td>
                    <td><b><span><?php echo $sub_dom ?></span></b></td>
                </tr>
                <tr>
                    <td class="field-key">Dom Function Key:</td>
                    <td><b><span><?php echo $dom_function_key ?></span></b></td>
                </tr>
                <tr>
                    <td class="field-key">Dom Function:</td>
                    <td><b><span><?php echo $dom_function ?></span></b></td>
                </tr>
                <tr>
                    <td class="field-key">Associated Role:</td>
                    <td><b><span><?php echo $assoc_rolename ?></span></b></td>
                </tr>
                <tr>
                    <td class="field-key">Description:</td>
                    <td><b><span><?php echo $description ?></span></b></td>
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