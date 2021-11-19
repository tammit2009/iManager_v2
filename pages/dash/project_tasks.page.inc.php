<div class="dashboard card my-4">

    <div class="card-body">

    <?php
        $opr = new DBOperation();
        if (!$opr->dbConnected()) {
            echo "No Record Found"; exit;
        }
        
        $res = $opr->sqlSelect("SELECT * FROM project_tasks");

        if (mysqli_num_rows($res) > 0) { ?>

        <table class="table table-hover table-bordered table-project-task" id="list">

            <thead>
                <tr>
                    <th class="text-center" style="width: 3%;" >#</th>
                    <th class="text-left"  style="width: 20%;">Task</th>
                    <th class="text-center" style="width: 14%;">Progress</th>
                    <th class="text-left" style="width: 18%;">Tracking Description</th>
                    <th class="text-center" style="width: 6%;">Status</th>
                    <th class="text-center" style="width: 5%;">Duration</th>
                    <th class="text-center" style="width: 12%;">Due</th>
                    <th class="text-center" style="width: 10%;">Actions</th>
                </tr>
            </thead>

            <tbody>
            <?php
                $i = 1;
                while ($row = mysqli_fetch_assoc($res)) { ?>

                    <tr role="row" class="odd">
                        <td class="text-center"><?php echo $i; ?></td>
                        <td class="text-left"><b><?php echo $row['task']; ?></b></td>
                        <td class="text-center project_progress">
                            <!-- <b></?php echo $row['progress']; ?>%</b> -->
                            <small>
                                <?php echo $row['progress'] ?>% 
                            </small>
                            <div class="progress progress-sm">
                                <div class="progress-bar bg-success" role="progressbar" aria-valuenow="<?php echo $row['progress'] ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $row['progress'] ?>%">
                                </div>
                            </div>

                        </td>
                        <td class="text-left"><b><?php echo $row['tracking_descr']; ?></b></td>
                        <td class="text-center">
                            <!-- <b></?php echo $row['status']; ?></b> -->
                            <?php
                                if($row['status'] =='Not started'){
                                    echo "<span class='badge badge-default p-2'>{$row['status']}</span>";
                                }
                                elseif($row['status'] =='Pending'){
                                    echo "<span class='badge badge-secondary p-2'>{$row['status']}</span>";
                                }
                                elseif($row['status'] =='Started'){
                                    echo "<span class='badge badge-primary p-2'>{$row['status']}</span>";
                                }
                                elseif($row['status'] =='In progress'){
                                    echo "<span class='badge badge-info p-2'>{$row['status']}</span>";
                                }
                                elseif($row['status'] =='On-track'){
                                    echo "<span class='badge badge-info p-2'>{$row['status']}</span>";
                                }
                                elseif($row['status'] =='On-Hold'){
                                    echo "<span class='badge badge-warning p-2'>{$row['status']}</span>";
                                }
                                elseif($row['status'] =='Overdue'){
                                    echo "<span class='badge badge-danger p-2'>{$row['status']}</span>";
                                }
                                elseif($row['status'] =='Completed'){
                                    echo "<span class='badge badge-success p-2'>{$row['status']}</span>";
                                }
							?>                        
                        </td>
                        <td class="text-center"><b><?php echo $row['duration']; ?></b></td>
                        <td class="text-center"><b><?php echo $row['due_date']; ?></b></td>
                        <td class="text-center">
                            <button type="button" class="btn btn-default btn-sm btn-flat border-info wave-effect text-info dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                Action
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item view_task" href="javascript:void(0)" data-id="<?php echo $row['id']; ?>">View</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="./dashboard.php?page=edit_task&amp;id=<?php echo $row['id']; ?>">Edit</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item delete_task" href="javascript:void(0)" data-id="<?php echo $row['id']; ?>">Delete</a>
                            </div>
                        </td>
                    </tr>

                <?php 
                $i++;
            } 
            ?>

            </tbody>

        </table>

        <?php 
            $res->free_result();
            $opr->close();
        }
        else {
            echo "No Record Found";
        }
        ?>

    </div>
</div>

<script>
$(document).ready(function(){

    //$('#list').DataTable();     // initialize the datatable

});
</script>
