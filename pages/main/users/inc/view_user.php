<?php
include_once('../../../../core/initialize.php');

if(isset($_GET['id'])){
    $type_arr = array('',"Basic","Admin","Manager","Employee");
    $usr = getUserById($_GET['id']);
    foreach($usr as $k => $v) {
        $$k = $v;  
        // echo "$$k : $v <br/>";
    }
} 
?>
<div class="container-fluid">
	<div class="card card-widget widget-user shadow">
        <div class="widget-user-header bg-dark">
            <h3 class="widget-user-username"><?php echo ucwords($name) ?></h3>
            <h5 class="widget-user-desc"><?php echo $email ?></h5>
        </div>
        <div class="widget-user-image">
            User's Image: 
            <?php if(empty($avatar) || (!empty($avatar) && !is_file( PROFILE_PIX_PATH.$avatar ))): ?> 
                <span class="brand-image img-circle elevation-2 d-flex justify-content-center align-items-center bg-primary text-white font-weight-500" style="width: 90px;height:90px"><h4><?php echo strtoupper($name) ?></h4></span>
            <?php else: ?>
                <img class="img-circle elevation-2" src="<?php echo PROFILE_PIX_URL_BASE_PATH.$avatar ?>" alt="User Avatar"  style="width: 90px;height:90px;object-fit: cover">
            <?php endif ?>
        </div>
        <div class="card-footer">
            <div class="container-fluid">
                <dl>
                    <dt>Group</dt>
                    <dd><?php echo $type_arr[$groupid] ?></dd>
                </dl>
            </div>
        </div>
	</div>
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