<?php 

$notifications = getAllNotifications();

?>
<div class="row">
    <div class="col-md-12">
        <div class="dashboard card my-4">
            <div class="card-header bg-white">
                <div class="card-header-panel">
                    <a href="./notifications.php?page=new_notification" class="btn btn-block btn-sm btn-default btn-flat border-primary">
                        <i class="fa fa-plus"></i> Create Notification
                    </a>
                </div>
            </div>
            <div class="card-body">

            <?php if (count($notifications) > 0) { ?>

                <table class="table tabe-hover table-bordered table-users" id="list">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 5%;">#</th>
                            <th class="text-left" style="width: 15%;">Notified At</th>
                            <th class="text-left" style="width: 15%;">Type</th>
                            <th class="text-left" style="width: 15%;">Message</th>
                            <th class="text-left" style="width: 15%;">Status</th>
                            <th class="text-center" style="width: 10%;">Action</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php $i = 1; foreach ($notifications as $row) { ?>

                            <tr role="row" class="odd">
                                <td class="text-center"><?php echo $i; ?></td>
                                <td class="text-left"><b><?php echo $row['notified_at']; ?></b></td>
                                <td class="text-left"><b><?php echo $row['type']; ?></b></td>
                                <td class="text-left"><b><?php echo $row['message']; ?></b></td>
                                <td class="text-left"><b><?php echo $row['status']; ?></b></td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-default btn-sm btn-flat border-info text-info dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                        Action
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item view_notification" href="./notifications.php?page=view_notification&amp;id=<?php echo $row['id']; ?>" >View</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item delete_notification" href="javascript:void(0)" data-id="<?php echo $row['id']; ?>">Delete</a>
                                    </div>
                                </td>
                            </tr>

                        <?php $i++; } ?>

                    </tbody>
                </table>

                <?php } else { echo "No Record Found"; } ?>
                         
            </div>
        </div>
    </div>

</div>


<script>
$(document).ready(function(){

    $('#list').DataTable();     // initialize the datatable

});
</script>