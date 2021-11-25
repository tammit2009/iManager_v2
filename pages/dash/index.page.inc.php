<div class="row mb-3">
    <div class="col-md-12">
        <div class="card">  <!-- border_top_custom -->
            <div class="card-body d-flex justify-content-between align-items-center">
                <h3 class="m-0"><?= "Welcome " . $user['name']; ?></h3>    
                <h5 class="m-0"><?= date('Y-m-d H:i:s', time()); ?></h5>
            </div>
        </div>
    </div>
</div>

<div class="row mb-3 px-2">
    
    <div class="col-md-4 px-1">
        <div class="row row-cols-1 row-cols-md-2 no-gutters">  <!-- border_top_custom -->
            <div class="kpi_ticker">
                <div class="card rounded-0 border-bottom-0">
                    <div class="card-body">
                        <div>
                            <i class="fa fa-shopping-bag"></i>
                        </div>
                        <div class="text-center">
                            <h4 id="num_products">10k</h4>
                            <span><b>PRODUCTS</b></span>
                        </div>      
                    </div>
                </div>
            </div>
            <div class="kpi_ticker">
                <div class="card rounded-0 border-left-0 border-bottom-0">
                <div class="card-body">
                        <div>
                            <i class="fa fa-sort-alpha-up-alt"></i>
                        </div>
                        <div class="text-center">
                            <h4 id="num_categories">10k</h4>
                            <span><b>CATEGORIES</b></span>
                        </div>          
                    </div>
                </div>
            </div>
            <div class="kpi_ticker">
                <div class="card rounded-0">
                <div class="card-body">
                    <div>
                        <i class="fa fa-thumbs-up"></i>
                        </div>
                        <div class="text-center">
                            <h4 id="num_brands">10k</h4>
                            <span><b>BRANDS</b></span>
                        </div>    
                    </div>
                </div>
            </div>
            <div class="kpi_ticker">
                <div class="card rounded-0 border-left-0">
                <div class="card-body">
                    <div>
                        <i class="fa fa-pallet"></i>
                        </div>
                        <div class="text-left">
                            <h4 id="num_stock">10k</h4>
                            <span><b>STOCK</b></span>
                        </div>    
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4 px-1">
        <div class="row row-cols-1 row-cols-md-2 no-gutters">  <!-- border_top_custom -->
            <div class="kpi_ticker">
                <div class="card rounded-0 border-bottom-0">
                    <div class="card-body">
                        <div>
                            <i class="fa fa-users"></i>
                        </div>
                        <div class="text-center">
                            <h4 id="num_users">10k</h4>
                            <span><b>USERS</b></span>
                        </div>      
                    </div>
                </div>
            </div>
            <div class="kpi_ticker">
                <div class="card rounded-0 border-left-0 border-bottom-0">
                <div class="card-body">
                        <div>
                            <i class="fa fa-user-tie"></i>
                        </div>
                        <div class="text-center">
                            <h4 id="num_staff">2</h4>
                            <span><b>STAFF</b></span>
                        </div>          
                    </div>
                </div>
            </div>
            <div class="kpi_ticker">
                <div class="card rounded-0">
                <div class="card-body">
                    <div>
                        <i class="fa fa-wallet"></i>
                        </div>
                        <div class="text-center">
                            <h4 id="num_customers">10k</h4>
                            <span><b>CUSTOMERS</b></span>
                        </div>    
                    </div>
                </div>
            </div>
            <div class="kpi_ticker">
                <div class="card rounded-0 border-left-0">
                <div class="card-body">
                    <div>
                        <i class="fa fa-store"></i>
                        </div>
                        <div class="text-center">
                            <h4 id="num_vendors">10k</h4>
                            <span><b>VENDORS</b></span>
                        </div>    
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4 px-1 pr-2">
        <div class="row row-cols-1 row-cols-md-1 no-gutters">  <!-- border_top_custom -->
            <div>
                <div class="card rounded-0" style="height:203px">
                    <div class="card-body">
                        <table class="table" id="stock_by_status">
                            <tbody id="stock_by_status_items">
                                <tr>
                                    <td class="px-4"><i class="fa fa-pallet text-success">&nbsp;&nbsp;</i> 
                                        <a href="" class="text-success" style="text-decoration: none"><b>TOTAL STOCK ITEMS</b></a>
                                    </td>
                                    <td class="text-success text-right px-3"><b id="summary_num_stock">100</b></td>
                                </tr>
                                <tr>
                                    <td class="px-4"><i class="fa fa-shopping-cart text-danger">&nbsp;&nbsp;</i> 
                                        <a href="" class="text-danger" style="text-decoration: none"><b>REORDER ITEMS</b></a>
                                    </td>
                                    <td class="text-danger text-right px-3"><b id="summary_num_reorder">100</b></td>
                                </tr>
                                <tr>
                                    <td class="px-4"><i class="fa fa-battery-empty text-secondary">&nbsp;&nbsp;</i> 
                                        <a href="" class="text-secondary" style="text-decoration: none"><b>ZERO-LEVEL ITEMS</b></a>
                                    </td>
                                    <td class="text-secondary text-right px-3"><b id="summary_num_zero">100</b></td>
                                </tr>
                                <tr>
                                    <td class="px-4"><i class="fa fa-ban text-info">&nbsp;&nbsp;</i> 
                                        <a href="" class="text-info" style="text-decoration: none"><b>DISCONTINUED ITEMS</b></a>
                                    </td>
                                    <td class="text-info text-right px-3"><b id="summary_num_discontinued">100</b></td>
                                </tr>
                            </tbody>
                        </table>
                        
                    </div>
                    
                </div>
            </div>
        </div>
    </div>

    <!-- Top Replenishment Items -->

</div>

<div class="row mb-3">
    <div class="col-md-12">
        <div class="card shadow">  <!-- border_top_custom -->
            <div class="card-header d-flex justify-content-between mb-0 bg-white">
                <h5 class="mb-0">Stock Status By Category</h5>
                <!-- <a href="#" class="btn btn-sm btn-secondary">See All</a> -->
            </div>

            <!-- <div class="card-body card-scrollable-1">
                <table class="table table-bordered" id="stock_by_category">
                    <thead>
                        <tr>
                            <th class="text-left" style="width: 40%;">Category</th>
                            <th class="text-center" style="width: 30%;">Stock Level</th>
                            <th class="text-center" style="width: 30%;">Reserved</th>
                        </tr>
                    </thead>
                    <tbody id="stock_by_category_items">
                        </!-- Placeholder --/>
                    </tbody>
                </table>
            </div> -->

            <div class="card-body" style="height: 350px;">
                <canvas id="stock_status_chart"></canvas>
            </div>

        </div>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-6 px-1">
        <div class="col-md-12 mb-4">
            <div class="card shadow">  <!-- border_top_custom -->
                <div class="card-header d-flex justify-content-between mb-0 bg-white">
                    <h5 class="mb-0">Recent User Events</h5>
                </div>
                <div class="card-body">
                    <div class="table_wrap" id="recent_events">
                        <div class="table_body">
                            <!-- Placeholder -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card shadow">  <!-- border_top_custom -->
            <div class="card-header d-flex justify-content-between mb-0 bg-white">
                <h5 class="mb-0">Recent Requests</h5>
                <!-- <a href="#" class="btn btn-sm btn-secondary">See All</a> -->
            </div>
            <div class="card-body card-scrollable-2">
                <table class="table" id="recent_requests">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 15%;">Created</th>
                            <th class="text-left" style="width: 20%;">User</th>
                            <!-- <th class="text-center" style="width: 15%;">Type</th> -->
                            <!-- <th class="text-center" style="width: 15%;">Category</th> -->
                            <th class="text-left" style="width: 20%;">Descr.</th>
                            <th class="text-center" style="width: 10%;">Status</th>
                        </tr>
                    </thead>
                    <tbody id="recent_request_items">
                        <!-- Placeholder -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function(){

    $('.page-title').addClass('d-none');

    const baseUrl = window.location.origin;

    // Get KPI Data
    getRecentEvents();
    getRecentRequests();
    getStockAnalysisSummary();
    getStockByCategory();
    getCountOfProducts();
    getCountOfCategories();
    getCountOfBrands();
    getCountOfStock();
    getCountOfUsers();
    getCountOfCustomers();
    getCountOfVendors();

    function getRecentEvents() {
        $.ajax({
            url: `${baseUrl}/imanager/core/ajax/main/common.php`, 
            method: "POST",
            dataType: "text",
            data: { get_recent_events: 1 },
            success: function(rsp) {
                //alert(rsp);
                $("#recent_events .table_body").append(rsp);
            }
        })
    };

    function getRecentRequests() {
        $.ajax({
            url: `${baseUrl}/imanager/core/ajax/main/common.php`, 
            method: "POST",
            dataType: "text",
            data: { get_recent_requests: 1 },
            success: function(rsp) {
                //alert(rsp);
                $("#recent_request_items").append(rsp);
            }
        })
    };

    function getStockByCategory() {

        $.ajax({
            url: `${baseUrl}/imanager/core/ajax/main/common.php`, 
            method: "POST",
            dataType: "json",
            data: { get_stock_by_category: 1 },
            success: function(rsp) {
                //alert(rsp);
                //$("#stock_by_category_items").append(rsp);

                // Create chart data
                var category_abbrv = [];
                var stock_level = [];
                var resvd = [];

                rsp.forEach(category => {
                    category_abbrv.push(category.category_abbrv);
                    stock_level.push(category.stock_level);
                    resvd.push(category.reserved);
                });

                //console.log(category_abbrv);

                var ctx = document.getElementById('stock_status_chart').getContext('2d');
                var chart = new Chart(ctx, {
                    type: "bar",
                    data: {
                        labels: category_abbrv,
                        datasets: [
                            {
                                label: "Stock Level",
                                backgroundColor: "#d9534f",
                                borderColor: "#d9656b",
                                data: stock_level
                            },
                            {
                                label: "Reserved",
                                backgroundColor: "#0275d8",
                                borderColor: "#0275d8",
                                data: resvd,
                            },
                        ]
                    },

                    options: {
                        legend: {
                            display: true, 
                            position: "bottom", 
                        }, 
                        scales: {
                            xAxes: [{
                                ticks: {
                                    fontSize: 10
                                }
                            }]
                        },
                        responsive: true,
                        maintainAspectRatio: false,
                        // title: {
                        //     text: "Title",    
                        //     display: true,
                        //     fontSize: 20,                     
                        //     padding: 10,                         
                        //     lineHeight: 2, // default 1.2 
                        // }           
                    }
                });

            }
        })

    };

    function getCountOfProducts() {
        $.ajax({
            url: `${baseUrl}/imanager/core/ajax/main/common.php`, 
            method: "POST",
            dataType: "json",
            data: { get_count_of_products: 1 },
            success: function(rsp) {
                //console.log(rsp);
                $("#num_products").html(rsp.num_products);
            }
        })
    };

    function getCountOfCategories() {
        $.ajax({
            url: `${baseUrl}/imanager/core/ajax/main/common.php`, 
            method: "POST",
            dataType: "json",
            data: { get_count_of_categories: 1 },
            success: function(rsp) {
                //console.log(rsp);
                $("#num_categories").html(rsp.num_categories);
            }
        })
    };

    function getCountOfBrands() {
        $.ajax({
            url: `${baseUrl}/imanager/core/ajax/main/common.php`, 
            method: "POST",
            dataType: "json",
            data: { get_count_of_brands: 1 },
            success: function(rsp) {
                //console.log(rsp);
                $("#num_brands").html(rsp.num_brands);
            }
        })
    };

    function getCountOfStock() {
        $.ajax({
            url: `${baseUrl}/imanager/core/ajax/main/common.php`, 
            method: "POST",
            dataType: "json",
            data: { get_count_of_stock: 1 },
            success: function(rsp) {
                //console.log(rsp);
                $("#num_stock").html(rsp.num_stock);
            }
        })
    };

    function getCountOfUsers() {
        $.ajax({
            url: `${baseUrl}/imanager/core/ajax/main/common.php`, 
            method: "POST",
            dataType: "json",
            data: { get_count_of_users: 1 },
            success: function(rsp) {
                //console.log(rsp);
                $("#num_users").html(rsp.num_users);
            }
        })
    };

    function getCountOfCustomers() {
        $.ajax({
            url: `${baseUrl}/imanager/core/ajax/main/common.php`, 
            method: "POST",
            dataType: "json",
            data: { get_count_of_customers: 1 },
            success: function(rsp) {
                //console.log(rsp);
                $("#num_customers").html(rsp.num_customers);
            }
        })
    };

    function getCountOfVendors() {
        $.ajax({
            url: `${baseUrl}/imanager/core/ajax/main/common.php`, 
            method: "POST",
            dataType: "json",
            data: { get_count_of_vendors: 1 },
            success: function(rsp) {
                //console.log(rsp);
                $("#num_vendors").html(rsp.num_vendors);
            }
        })
    };

    function getStockAnalysisSummary() {
        $.ajax({
            url: `${baseUrl}/imanager/core/ajax/main/common.php`, 
            method: "POST",
            dataType: "json",
            data: { get_stock_analysis_summary: 1 },
            success: function(rsp) {
                //console.log(rsp);
                $("#summary_num_stock").html(rsp.num_stock);
                $("#summary_num_reorder").html(rsp.num_reorder);
                $("#summary_num_zero").html(rsp.num_zero);
                $("#summary_num_discontinued").html(rsp.num_discontinued);
            }
        });
    }

});
</script>