<?php
include_once('../../../../core/initialize.php');

if(isset($_GET['id'])){
    $organization = getOrganizationById($_GET['id']);
    foreach($organization as $k => $v) {
        $$k = $v;  
        //echo "$$k : $v <br/>";
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
                    <td class="field-key">Org. Name:</td>
                    <td><b><span><?php echo $name ?></span></b></td>
                </tr>
                <tr>
                    <td class="field-key">Description:</td>
                    <td><b><span><?php echo $description ?></span></b></td>
                </tr>
                <tr>
                    <td class="field-key">Domain ID:</td>
                    <td><b><span><?php echo $domain_id ?></span></b></td>
                </tr>
                <tr>
                    <td class="field-key">Org. Type:</td>
                    <td><b><span><?php echo $type ?></span></b></td>
                </tr>
                <tr>
                    <td class="field-key">Address:</td>
                    <td><b><span><?php echo $address ?></span></b></td>
                </tr>
                <tr>
                    <td class="field-key">Contact Person:</td>
                    <td><b><span><?php echo $contact_person ?></span></b></td>
                </tr>
                <tr>
                    <td class="field-key">Contact Email:</td>
                    <td><b><span><?php echo $contact_email ?></span></b></td>
                </tr>
                <tr>
                    <td class="field-key">Contact Phone:</td>
                    <td><b><span><?php echo $contact_phone ?></span></b></td>
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