<?php 
    
include_once('../../security.php');

// Connect to database
$opr = new DBOperation();
if ($opr->dbConnected()) {

    $output = array();
    $all_stock_records = array();
    $flt_stock_records = array();

    // Get all the records in the selection
    $sql = "SELECT stock.id, stock.item, products.product_name, products.unit, 
            stock.curr_stock_level
            FROM stock INNER JOIN products ON stock.sku = products.sku ";

    // Passing in the Domain & Subdomain ID
    if (isset($_POST['domainid']) && isset($_POST['subdomid'])) {
        // echo "Domain ID: ". $_POST['domainid'] .'\n' . $_POST['subdomid'] .'\n';
        $sql .= "WHERE stock.domain_id=". $_POST['domainid'] . " AND stock.sub_dom_id=". $_POST['subdomid'] . " ";
    }

    $res = $opr->sqlSelect($sql);
    if ($res && $res->num_rows > 0) {
        while ($row = $res->fetch_assoc()) {
            $all_stock_records[] = $row;
        }
        $res->free_result();
    }

    // Conditional query
    $query = "";
    $query .= $sql;  

    if (isset($_POST['search']['value'])) {
        if (isset($_POST['domainid']) && isset($_POST['subdomid'])) 
            $query .= 'AND (stock.item LIKE "%' . $_POST['search']['value'] . '%" ';
        else 
            $query .= 'WHERE (stock.item LIKE "%' . $_POST['search']['value'] . '%" ';

        $query .= 'OR products.product_name LIKE "%' . $_POST['search']['value'] . '%") ';
    }
    
    if (isset($_POST['order'])) {
        $query .= 'ORDER BY ' . $_POST['order'][0]['column'] . ' ' . $_POST['order'][0]['dir'] . ' ';
    } 
    else {
        $query .= 'ORDER BY id ASC ';
    }

    if ($_POST['length'] != -1) {
        $query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
    }

    // echo $query;

    $res = $opr->sqlSelect($query);
    if ($res && $res->num_rows > 0) {
        while ($row = $res->fetch_assoc()) {
            $flt_stock_records[] = $row;
        }
        $res->free_result();
    }

    $opr->close();

    $total_rows = count($all_stock_records);
    $filtered_rows = count($all_stock_records);

    $data = array();

    $i = $_POST['start'] + 1;

    foreach($flt_stock_records as $row) {
        $sub_array = array();

        $sub_array[] = $i;
        $sub_array[] = $row['item'];
        $sub_array[] = $row['product_name'];
        $sub_array[] = $row['unit'];
        $sub_array[] = $row['curr_stock_level'];
        $sub_array[] = '<button type="button" data-dismiss="modal" class="select_stock btn btn-secondary btn-sm' .
                       ' btn-flat px-2" data-id="'. $row['id'] .'"><i class="fa fa-search"></i></button>';

        $data[] = $sub_array;
        ++$i;
    }

    $output = array(
        "draw"              => intval($_POST["draw"]),
        "recordsTotal"      => $total_rows,
        "recordsFiltered"   => $filtered_rows,
        "data"              => $data
    );

    echo json_encode($output);
 
}

?>