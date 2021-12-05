<?php 
    if (isset($_GET['startp']) && (isset($_GET['endp']))) {
        $stock_txns = fetch_stock_txns($_GET['startp'], $_GET['endp']);
    }
    else {
        $stock_txns = fetch_stock_txns(date("Y-m-d",strtotime("-3 days")), date("Y-m-d"));
    }
?>

<div id="picker_values">
    
</div>

<div class="row">
    <div class="col-md-12">

        <div class="dashboard card my-2">

            <div class="card-header bg-white">
                <div class="card-header-panel d-flex align-items-center justify-content-between">
                    <h3 class="my-0">Stock Transactions</h3>
                </div>
            </div>
    
            <div class="card-body">

                <!-- Date Range Pickers -->
                <div class="row">
                    <div class="col-md-5">
                        <div>
                            <span style="font-size:18px;">Start Period:</span>
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="picker1_prepend">
                                        <i class="fa fa-calendar text-info"></i>
                                    </span>
                                </div>
                                <input type="text" id="picker1" class="form-control form-control-sm">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-5">
                        <div>
                            <span style="font-size:18px;">End Period:</span>

                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="picker2_prepend">
                                        <i class="fa fa-calendar text-info"></i>
                                    </span>
                                </div>
                                <input type="text" id="picker2" class="form-control form-control-sm">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <br>
                        <button type="button" id="pickers_set" class="btn btn-sm btn-block btn-info"><i class="fa fa-search"></i> Search</button>
                    </div>
                </div>

                <?php 
                if ($stock_txns == -1 || empty($stock_txns)) {
                    echo "No Record Found"; 
                } 
                else { 
                ?>

                <hr class="mt-4 mb-4">
                
                <table class="table table-hover table-bordered table-products" id="listStockTxns">

                    <thead>
                        <tr>
                            <th class="text-center" style="width: 7%;">#</th>
                            <th class="text-center" style="width: 12%;">Txn Date</th>
                            <th class="text-center" style="width: 10%;">Domain</th>
                            <th class="text-center" style="width: 10%;">SubDom</th>
                            <th class="text-center" style="width: 10%;">Activity</th>
                            <th class="text-center" style="width: 7%;">RecordId</th>
                            <th class="text-center" style="width: 15%;">Product</th>
                            <th class="text-center" style="width: 7%;">Qty</th>
                            <th class="text-center" style="width: 7%;">Type</th>
                            <th class="text-center" style="width: 10%;">Status</th>
                            <!-- <th class="text-center" style="width: 15%;">User</th> -->
                        </tr>
                    </thead>
                    
                    <tbody>
                        <?php $i = 1;
                        foreach ($stock_txns as $row) { ?>

                        <tr role="row" class="odd">
                            <td class="text-center"><?php echo $i; ?></td>
                            <td class="text-center"><b><?php echo substr($row['txn_date'], 0, 10); ?></b></td>
                            <td class="text-center"><b><?php echo $row['domain_name']; ?></b></td>
                            <td class="text-center"><b><?php echo $row['subdom_name']; ?></b></td>
                            <td class="text-center"><b><?php echo $row['table_str']; ?></b></td>
                            <td class="text-center"><b><?php echo $row['record_id']; ?></b></td>
                            <td class="text-center"><b><?php echo $row['product_name']; ?></b></td>
                            <td class="text-center"><b><?php echo $row['qty']; ?></b></td>
                            <td class="text-center"><b><?php echo $row['action_type']; ?></b></td>
                            <td class="text-center">
                                <b>
                                    <?php 
                                    if ($row['status'] === 0) { 
                                        echo "<span class='badge badge-secondary p-2'>PROCESSING</span>";
                                    } else if ($row['status'] === 1) { 
                                        echo "<span class='badge badge-warning p-2'>PENDING</span>";
                                    } else if ($row['status'] === 2) { 
                                        echo "<span class='badge badge-success p-2'>COMPLETED</span>";
                                    } else if ($row['status'] === 3) { 
                                        echo "<span class='badge badge-warning p-2'>REJECTED</span>";
                                    } else { 
                                        echo "<span class='badge badge-warning p-2'>UNKNOWN</span>";
                                    } 
                                    ?>
                                </b>
                            </td>
                            <!-- <td class="text-center"><b><?php echo $row['user']; ?></b></td> -->
                        </tr>

                        <?php $i++; } ?>

                    </tbody>
                </table>

                <?php } ?>

            </div>
        </div>

    </div>
</div>


<script>
$(document).ready(function() {

    $('.page-title').addClass('d-none');

    $('#listStockTxns').DataTable();     // initialize the datatable

    var end_date = new Date();
    var start_date = new Date();
    start_date.setDate(start_date.getDate() - 3);

    <?php if (isset($_GET['startp'])) { ?>
        var startp = '<?php echo $_GET['startp']; ?>';
        start_date = new Date(startp);
    <?php } ?>

    <?php if (isset($_GET['endp'])) { ?>
        var endp = '<?php echo $_GET['endp']; ?>';
        end_date = new Date(endp);
    <?php } ?>

    // Date Range Pickers
    $('#picker1').datetimepicker({
        //timepicker: true,
        datepicker: true,
        format: 'Y-m-d',    // 'Y-m-d H:i'
        value: start_date,              
        onShow: function(ct) {
            this.setOptions({
                maxDate: $('#picker2').val() ? $('#picker2').val() : false
            });
        }        
    });

    $('#picker2').datetimepicker({
        //timepicker: true,
        datepicker: true,
        format: 'Y-m-d',  // 'Y-m-d H:i'
        value: end_date,              
        onShow: function(ct) {
            this.setOptions({
                minDate: $('#picker1').val() ? $('#picker1').val() : false
            });
        }        
    });

    $('#pickers_set').on('click', function() {
        var picker1 = $('#picker1').val();
        var picker2 = $('#picker2').val();

        window.location = `${baseUrlMain}/main.php?dir=stats&page=stock_txns&startp=${picker1}&endp=${picker2}`;
    });

});
</script>

