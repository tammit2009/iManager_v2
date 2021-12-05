<?php
include_once('../../../../core/initialize.php');

if(isset($_GET['id'])){
    $member = getMemberById($_GET['id']);
    foreach($member as $k => $v) {
        $$k = $v;  // echo "$$k : $v <br/>";
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
                    <td class="field-key">Username:</td>
                    <td><b><span><?php echo $username ?></span></b></td>
                </tr>
                <tr>
                    <td class="field-key">Domain:</td>
                    <td><b><span><?php echo $domain_name ?></span></b></td>
                </tr>
                <tr>
                    <td class="field-key">Organization:</td>
                    <td><b><span><?php echo $orgname ?></span></b></td>
                </tr>
                <tr>
                    <td class="field-key">OrgType:</td>
                    <td><b><span><?php echo $orgtype ?></span></b></td>
                </tr>
                <tr>
                    <td class="field-key">Department:</td>
                    <td><b><span><?php echo $department ?></span></b></td>
                </tr>
                <tr>
                    <td class="field-key">Functional Role:</td>
                    <td><b><span><?php echo $functional_role ?></span></b></td>
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