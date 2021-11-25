<?php 
include_once('../../security.php');
include_once('db_functions.php');

// Get This Company Details
if (isset($_POST['get_platform_company_details'])) {
    
    $response = [];

    $system_name = "";
    $system_shortname = "";
    $company_name = "";
    $company_email = "";
    $company_address = "";
    $system_logo = "";

    $opr = new DBOperation();
    if ($opr->dbConnected()) {
        
        $res = $opr->sqlSelect("SELECT * FROM sys_settings");
        if (mysqli_num_rows($res) > 0) {

            while ($row = mysqli_fetch_assoc($res)) { 
                if ($row['sys_key'] === "system_name") {
                    $system_name = $row['sys_value'];
                }
                if ($row['sys_key'] === "system_shortname") {
                    $system_shortname = $row['sys_value'];
                }
                if ($row['sys_key'] === "company_name") {
                    $company_name = $row['sys_value'];
                }
                if ($row['sys_key'] === "company_email") {
                    $company_email = $row['sys_value'];
                }
                if ($row['sys_key'] === "company_address") {
                    $company_address = $row['sys_value'];
                }
                if ($row['sys_key'] === "system_logo") {
                    $system_logo = $row['sys_value'];
                }
            }

            $res->free_result();
            $opr->close();
        }
        else {
            echo "No Record Found";
        }
    }

    $response = array(
        "system_name" => $system_name, 
        "system_shortname" => $system_shortname,
        "company_name" => $company_name,
        "company_email" => $company_email,
        "company_address" => $company_address,
        "system_logo" => $system_logo
    );

    exit(json_encode($response));
}


//////////////////////////////////////////////////////////////////
//                  JQUERY ON-DEMAND DB QUERIES                 //
//////////////////////////////////////////////////////////////////

// Get all brands
if (isset($_POST['get_all_brands'])) {
    $response = [];
    $opr = new DBOperation();
    if (!$opr->dbConnected()) {
        exit(json_encode(array("msg" => "Error connecting"))); 
    }
    $query = "SELECT id, name FROM brands";
    $results = $opr->sqlSelect($query);
    if ($results && $results->num_rows > 0) {
        while ($data = $results->fetch_array()) {
            $val = array("id" => $data['id'], "text" => $data['name']);
            $response[] = $val;
        }
    }
    $opr->close();
    exit(json_encode($response));
}

// Get all categories
if (isset($_POST['get_all_categories'])) {
    $response = [];
    $opr = new DBOperation();
    if (!$opr->dbConnected()) {
        exit(json_encode(array("msg" => "Error connecting"))); 
    }
    $query = "SELECT id, name FROM categories";
    $results = $opr->sqlSelect($query);
    if ($results && $results->num_rows > 0) {
        while ($data = $results->fetch_array()) {
            $val = array("id" => $data['id'], "text" => $data['name']);
            $response[] = $val;
        }
    }
    $opr->close();
    exit(json_encode($response));
}

// Get all the product units
if (isset($_POST['get_all_product_units'])) {
    $response = [];
    $opr = new DBOperation();
    if (!$opr->dbConnected()) {
        exit(json_encode(array("msg" => "Error connecting"))); 
    }
    $query = "SELECT * FROM status_codes WHERE type='product_unit'";
    $results = $opr->sqlSelect($query);
    if ($results && $results->num_rows > 0) {
        while ($data = $results->fetch_assoc()) {
            $response[] = $data;
        }
    }
    $opr->close();
    exit(json_encode($response));
}

// Search brands (NOT ACTIVE)
if (isset($_POST['search_brands'])) {
    $response = "<ul><li>No data found</li></ul>";

    $connection = new mysqli('localhost', 'root', 'takethat', 'testpad', 3307);

    $q = $connection->real_escape_string($_POST['q']);

    $sql = $connection->query("SELECT name FROM country WHERE name LIKE '%$q%'");
    if ($sql && $sql->num_rows > 0) {
        $response = "<ul>";

        while ($data = $sql->fetch_array()) {
            $response .= "<li>". $data['name']. "</li>";
        }

        $response .= "</ul>";
    }

    exit($response);
}

// Search categories (NOT ACTIVE)
if (isset($_POST['search_categories'])) {
    $response = "<ul><li>No data found</li></ul>";

    $connection = new mysqli('localhost', 'root', 'takethat', 'testpad', 3307);

    $q = $connection->real_escape_string($_POST['q']);

    $sql = $connection->query("SELECT name FROM country WHERE name LIKE '%$q%'");
    if ($sql && $sql->num_rows > 0) {
        $response = "<ul>";

        while ($data = $sql->fetch_array()) {
            $response .= "<li>". $data['name']. "</li>";
        }

        $response .= "</ul>";
    }

    exit($response);
}

// Handle 'manage_product' Form
if (isset($_POST['manage_product'])) {

    echo "Managing Products";

    print_r($_POST);

}


// Get Recent Events

if (isset($_POST["get_recent_events"])) {
    $response = "<ul><li>No data found</li></ul>";

    $opr = new DBOperation();
    if (!$opr->dbConnected()) {
        exit($response); 
    }

    $query = "  SELECT id, created_on, type, category, table_str, table_id, action, status, route,
                (SELECT name FROM users WHERE id=generated_by) as user, 
                generated_by, xinfo 
                FROM `ims_events` WHERE category = 'user_access'";            

    $results = $opr->sqlSelect($query);
    if ($results && $results->num_rows > 0) {

        $response = "<ul>";

        while ($data = $results->fetch_assoc()) {

            $response .= "
            <li>
                <div class=\"item\">
                    <div class=\"action_date\">
                        <span>". substr($data['created_on'], 0, 10) . "</span>
                    </div>
                    <div class=\"action\">
                        <span>". $data['action'] . "</span>
                    </div>
                    <div class=\"action_user\">
                        <span>". $data['user'] . "</span>
                    </div>";
            
            if ($data['type'] === 'info') {
                $response .= "<div class=\"status\"><span class=\"info\">Info</span></div></div></li>";
            } 
            else {
                $response .= "<div class=\"status\"><span class=\"err\">Error</span></div></div></li>";
            }

        }

        $response .= "</ul>";
    }

    $opr->close();

    exit($response);
}

// Get Recent Requests

if (isset($_POST["get_recent_requests"])) {
    $response = "<tr><td>No data found</td></tr>";

    $opr = new DBOperation();
    if (!$opr->dbConnected()) {
        exit($response); 
    }

    $query = "SELECT id, created_on, (SELECT name FROM users WHERE generated_by = users.id) as user, 
                request_type, request_category, table_str, record_id, xinfo, status FROM `ims_requests`
                ORDER BY created_on DESC LIMIT 5";

    $results = $opr->sqlSelect($query);
    if ($results && $results->num_rows > 0) {

        $response = "";

        while ($data = $results->fetch_assoc()) {

            $response .= "<tr>
                <td class=\"text-center\">". substr($data['created_on'], 0, 10) . "</td>
                <td class=\"text-left\">". $data['user'] . "</td>
                <td class=\"text-left\">". $data['xinfo'] . "</td>";

            if ($data['status'] === 0) {
                $response .= "<td class=\"text-center\"><span class=\"pending\">PENDING</span></td>";
            } 
            else {
                $response .= "<td class=\"text-center\"><span class=\"closed\">CLOSED</span></td>";
            }

            $response .= "</tr>";
        }

    }
    $opr->close();

    exit($response);
}


// Get All Stock
if (isset($_POST['get_all_stock'])) {

    $response = "<tr><td>No data found</td></tr>";

    $opr = new DBOperation();
    if (!$opr->dbConnected()) {
        exit(json_encode(array("msg" => "Error connecting"))); 
    }

    $query =   "SELECT stock.item, stock.sku, products.product_name, 
                (SELECT name FROM brands WHERE products.brand_id = brands.id) as brand, 
                (SELECT name FROM categories WHERE products.category_id = categories.id) as category, 
                stock.curr_stock_level, stock.pending_reserved, stock.reorder_tresh, stock.required_level 
                FROM `stock` INNER JOIN `products` ON stock.sku = products.sku";

    $results = $opr->sqlSelect($query);
    if ($results && $results->num_rows > 0) {

        $response = "";

        while ($data = $results->fetch_assoc()) {

            $response .= "
            <tr>
                <td class=\"text-left\">Adhesives and Sealants</td>
                <td class=\"text-center\">0</td>
                <td class=\"text-center\">0</td>
            </tr>
            ";
        }
    }
    $opr->close();

    exit($response);
}

// Get stock kpi by category
if (isset($_POST['get_stock_by_category'])) {

    // $response = "<tr><td>No data found</td></tr>";
    $response = [];

    $opr = new DBOperation();
    if (!$opr->dbConnected()) {
        exit(json_encode(array("msg" => "Error connecting"))); 
    }

    $query = "SELECT (SELECT name FROM categories WHERE products.category_id = categories.id) as category, 
             (SELECT abbrv FROM categories WHERE products.category_id = categories.id) as category_abbrv,
              sum(stock.curr_stock_level) as stock_level, sum(stock.pending_reserved) as reserved 
              FROM `stock` INNER JOIN `products` ON stock.sku = products.sku 
              GROUP BY products.category_id ORDER BY products.category_id";

    $results = $opr->sqlSelect($query);
    if ($results && $results->num_rows > 0) {
        while ($data = $results->fetch_assoc()) {
            // $response .= "<tr>
            //     <td class=\"text-left\">". $data['category'] . "</td>
            //     <td class=\"text-center\">". $data['stock_level'] . "</td>
            //     <td class=\"text-center\">". $data['reserved'] . "</td>
            // </tr>";
            $response[] = $data;
        }
    }
    $opr->close();

    // exit($response);
    exit(json_encode($response));
}


// Get stock kpi by brand
if (isset($_POST['get_stock_by_brand'])) {
    $response = [];
    $opr = new DBOperation();
    if (!$opr->dbConnected()) {
        exit(json_encode(array("msg" => "Error connecting"))); 
    }

    // SELECT (SELECT name FROM brands WHERE products.brand_id = brands.id) as brand, sum(stock.curr_stock_level) as stock_level, sum(stock.pending_reserved) as reserved FROM `stock` INNER JOIN `products` ON stock.sku = products.sku GROUP BY products.brand_id ORDER BY products.brand_id

    $query =   "SELECT stock.item, stock.sku, products.product_name, (SELECT name FROM brands 
                WHERE products.brand_id = brands.id) as brand, (SELECT name FROM categories 
                WHERE products.category_id = categories.id) as category, stock.curr_stock_level, 
                stock.pending_reserved, stock.reorder_tresh, stock.required_level
                FROM `stock` INNER JOIN `products` ON stock.sku = products.sku";

    $results = $opr->sqlSelect($query);
    if ($results && $results->num_rows > 0) {
        while ($data = $results->fetch_array()) {
            // $val = array("id" => $data['id'], "text" => $data['name']);
            // $response[] = $val;
        }
    }
    $opr->close();
    exit(json_encode($response));
}

// Get This Company Details
if (isset($_POST['get_this_company_details'])) {
    
    $response = [];

    $system_name = "";
    $system_shortname = "";
    $company_name = "";
    $company_email = "";
    $company_address = "";
    $system_logo = "";

    $opr = new DBOperation();
    if ($opr->dbConnected()) {
        
        $res = $opr->sqlSelect("SELECT * FROM sys_settings");
        if (mysqli_num_rows($res) > 0) {

            while ($row = mysqli_fetch_assoc($res)) { 
                if ($row['sys_key'] === "system_name") {
                    $system_name = $row['sys_value'];
                }
                if ($row['sys_key'] === "system_shortname") {
                    $system_shortname = $row['sys_value'];
                }
                if ($row['sys_key'] === "company_name") {
                    $company_name = $row['sys_value'];
                }
                if ($row['sys_key'] === "company_email") {
                    $company_email = $row['sys_value'];
                }
                if ($row['sys_key'] === "company_address") {
                    $company_address = $row['sys_value'];
                }
                if ($row['sys_key'] === "system_logo") {
                    $system_logo = $row['sys_value'];
                }
            }

            $res->free_result();
            $opr->close();
        }
        else {
            echo "No Record Found";
        }
    }

    $response = array(
        "system_name" => $system_name, 
        "system_shortname" => $system_shortname,
        "company_name" => $company_name,
        "company_email" => $company_email,
        "company_address" => $company_address,
        "system_logo" => $system_logo
    );

    exit(json_encode($response));
}

// TODO: Collapse the Below Into One Function

// Get number of products
if (isset($_POST['get_count_of_products'])) {
    $response = [];
    $opr = new DBOperation();
    if (!$opr->dbConnected()) {
        exit(json_encode(array("msg" => "Error connecting"))); 
    }
    $query =   "SELECT count(id) as num_products FROM products LIMIT 1";
    $result = $opr->sqlSelect($query);
    if ($result && $result->num_rows === 1) {
        $count = $result->fetch_assoc();
        $response = $count;
    }
    $opr->close();
    exit(json_encode($response));
}

// Get number of categories
if (isset($_POST['get_count_of_categories'])) {
    $response = [];
    $opr = new DBOperation();
    if (!$opr->dbConnected()) {
        exit(json_encode(array("msg" => "Error connecting"))); 
    }
    $query =   "SELECT count(id) as num_categories FROM categories LIMIT 1";
    $result = $opr->sqlSelect($query);
    if ($result && $result->num_rows === 1) {
        $count = $result->fetch_assoc();
        $response = $count;
    }
    $opr->close();
    exit(json_encode($response));
}

// Get number of brands
if (isset($_POST['get_count_of_brands'])) {
    $response = [];
    $opr = new DBOperation();
    if (!$opr->dbConnected()) {
        exit(json_encode(array("msg" => "Error connecting"))); 
    }
    $query =   "SELECT count(id) as num_brands FROM brands LIMIT 1";
    $result = $opr->sqlSelect($query);
    if ($result && $result->num_rows === 1) {
        $count = $result->fetch_assoc();
        $response = $count;
    }
    $opr->close();
    exit(json_encode($response));
}

// Get number of stock
if (isset($_POST['get_count_of_stock'])) {
    $response = [];
    $opr = new DBOperation();
    if (!$opr->dbConnected()) {
        exit(json_encode(array("msg" => "Error connecting"))); 
    }
    $query =   "SELECT count(id) as num_stock FROM stock LIMIT 1";
    $result = $opr->sqlSelect($query);
    if ($result && $result->num_rows === 1) {
        $count = $result->fetch_assoc();
        $response = $count;
    }
    $opr->close();
    exit(json_encode($response));
}

// Get number of users
if (isset($_POST['get_count_of_users'])) {
    $response = [];
    $opr = new DBOperation();
    if (!$opr->dbConnected()) {
        exit(json_encode(array("msg" => "Error connecting"))); 
    }
    $query =   "SELECT count(id) as num_users FROM users LIMIT 1";
    $result = $opr->sqlSelect($query);
    if ($result && $result->num_rows === 1) {
        $count = $result->fetch_assoc();
        $response = $count;
    }
    $opr->close();
    exit(json_encode($response));
}

// Get number of customers
if (isset($_POST['get_count_of_customers'])) {
    $response = [];
    $opr = new DBOperation();
    if (!$opr->dbConnected()) {
        exit(json_encode(array("msg" => "Error connecting"))); 
    }
    $query =   "SELECT count(id) as num_customers FROM organizations WHERE type='customer' LIMIT 1";
    $result = $opr->sqlSelect($query);
    if ($result && $result->num_rows === 1) {
        $count = $result->fetch_assoc();
        $response = $count;
    }
    $opr->close();
    exit(json_encode($response));
}

// Get vendor By Id
if (isset($_POST['get_vendor_by_id'])) {
    $response = [];
    $opr = new DBOperation();
    if (!$opr->dbConnected()) {
        exit(json_encode(array("msg" => "Error connecting"))); 
    }

    $vid = $_POST['get_vendor_by_id'];
    $query = "SELECT name as vendor FROM organizations WHERE id=? LIMIT 1";
    $result = $opr->sqlSelect($query, "i", $vid);
    if ($result && $result->num_rows === 1) {
        $vendor = $result->fetch_assoc();
        $response = $vendor;
    }
    $opr->close();
    exit(json_encode($response));
}

// Get number of vendors
if (isset($_POST['get_count_of_vendors'])) {
    $response = [];
    $opr = new DBOperation();
    if (!$opr->dbConnected()) {
        exit(json_encode(array("msg" => "Error connecting"))); 
    }
    $query =   "SELECT count(id) as num_vendors FROM organizations WHERE type='vendor' LIMIT 1";
    $result = $opr->sqlSelect($query);
    if ($result && $result->num_rows === 1) {
        $count = $result->fetch_assoc();
        $response = $count;
    }
    $opr->close();
    exit(json_encode($response));
}

// Get stock analysis summary
if (isset($_POST['get_stock_analysis_summary'])) {
    $response = [];
    $opr = new DBOperation();
    if (!$opr->dbConnected()) {
        exit(json_encode(array("msg" => "Error connecting"))); 
    }

    $count_stock = array();
    $count_reorder = array();
    $count_zero = array();
    $count_discontinued = array();

    $query = "SELECT count(id) as num_stock FROM stock LIMIT 1";
    $result = $opr->sqlSelect($query);
    if ($result && $result->num_rows === 1) {
        $count_stock = $result->fetch_assoc();
    }

    $query = "SELECT COUNT(id) as num_reorder FROM `stock` WHERE `curr_stock_level` <= `reorder_tresh`";
    $result = $opr->sqlSelect($query);
    if ($result && $result->num_rows === 1) {
        $count_reorder = $result->fetch_assoc();
    }

    $query = "SELECT COUNT(id) as num_zero FROM `stock` WHERE `curr_stock_level` = 0";
    $result = $opr->sqlSelect($query);
    if ($result && $result->num_rows === 1) {
        $count_zero = $result->fetch_assoc();
    }

    $query = "SELECT COUNT(id) as num_discontinued FROM `stock` WHERE `required_level` = 0 AND `curr_stock_level` = 0";
    $result = $opr->sqlSelect($query);
    if ($result && $result->num_rows === 1) {
        $count_discontinued = $result->fetch_assoc();
    }

    $response = $count_stock + $count_reorder + $count_zero + $count_discontinued;

    $opr->close();

    exit(json_encode($response));
}

// Send Notification
if (isset($_POST['send_notification'])) {

    $status = $_POST['status'];
    $msg = $_POST['msg'];

    flash("status", $status);
    flash("msg", $msg);

    echo 0;
}


// // Get all users
// if (isset($_POST['get_all_users'])) {
//     $response = [];
//     $opr = new DBOperation();
//     if (!$opr->dbConnected()) {
//         exit(json_encode(array("msg" => "Error connecting"))); 
//     }
//     $query =   "SELECT users.id, users.name, users.email, users.domain,
//                 users.avatar, users.groupid, users.verified, users.created_on
//                 FROM users";
//     $result = $opr->sqlSelect($query);
//     if ($result && $result->num_rows > 0) {
//         while ($row = mysqli_fetch_assoc($result)) { 
//             $response[] = $row;
//         }        
//     }
//     $opr->close();
//     exit(json_encode($response));
// }

?>