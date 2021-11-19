<?php 

$errors = array();

if (isset($_GET['delete_conversation'])) {
    if (validate_conversation_id($_GET['delete_conversation']) === false) {
        $errors[] = 'Invalid conversation ID';
    }

    if (empty($errors)) {
        delete_conversation($_GET['delete_conversation']);
    }
}

$conversations = fetch_conversation_summary();

if (empty($conversations)) {
    $errors[] = 'You have no messages.';
}

?>

<div class="row">
    <div class="col-md-12">
        <div class="dashboard card my-4">
            <div class="card-header bg-white">
                <div class="card-header-panel">
                    <a href="./messages.php?page=new_conversation" class="btn btn-block btn-sm btn-default btn-flat border-primary">
                        <i class="fa fa-plus"></i> Create Conversation
                    </a>
                </div>
            </div>
            <div class="card-body">

            <?php
            // Error Messages
            if (!empty($conversations && empty($errors) === false)) {
                foreach($errors as $error) {
                    echo '<div class="msg error">'. $error . '</div>';
                }
            }
            
            if (count($conversations) > 0) { ?>

            <table class="table tabe-hover table-bordered table-users" id="list">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 5%;">#</th>
                        <th class="text-center" style="width: 15%;">Last Reply</th>
                        <th class="text-left" style="width: 30%;">Subject</th>
                        <th class="text-center" style="width: 10%;">Status</th>
                        <th class="text-center" style="width: 10%;">Action</th>
                    </tr>
                </thead>

                <tbody>

                    <?php 
                        $i = 1; 
                        foreach ($conversations as $conversation) { ?>

                        <tr role="row" class="odd">
                            <td class="text-center"><?php echo $i; ?></td>
                            <td class="text-center"><b><?php echo date('d/m/Y H:i:s', $conversation['last_reply']); ?></b></td>
                            <td class="text-left"><b><?php echo $conversation['subject']; ?></b></td>
                            <td class="text-center">
                                <b><?php if ($conversation['unread_messages']) { echo 'unread'; } else { echo 'read';  } ?></b>
                            </td>
                            <td class="text-center">
                                <button type="button" class="btn btn-default btn-sm btn-flat border-info text-info dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                    Action
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item view_conversation" href="messages.php?page=view_conversation&amp;conversation_id=<?php echo $conversation['id']; ?>" >View</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item delete_conversation" href="messages.php?page=inbox&amp;delete_conversation=<?php echo $conversation['id']; ?>">Delete</a>
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

<!-- <div class="actions">
    <a href="index.php?page=new_conversation">New Conversation</a>
    <a href="index.php?page=logout">Logout</a>
</div>

<div class="conversations">
    </?php 
    foreach ($conversations as $conversation) {
        ?>
        <div class="conversation </?php if ($conversation['unread_messages']) echo 'unread'; ?>">
            <h2>
                <a href="index.php?page=inbox&amp;delete_conversation=</?php echo $conversation['id']; ?>">[x]</a>
                <a href="index.php?page=view_conversation&amp;conversation_id=</?php echo $conversation['id']; ?>"><?php echo $conversation['subject']; ?></a>
            </h2>
            <p>Last Reply: </?php echo date('d/m/Y H:i:s', $conversation['last_reply']); ?></p>
        </div>

        </?php
    }
    ?>
</div> -->

<script>
$(document).ready(function(){

    $('#list').DataTable();     // initialize the datatable

});
</script>