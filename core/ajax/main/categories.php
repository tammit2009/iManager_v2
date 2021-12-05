<?php 
include_once('../../security.php');
include_once('db_functions.php');

// Fetch Category By Id
if (isset($_GET["getCategoryById"])) {
    if (isset($_GET["categoryid"])) {
        $result = getCategoryById($_GET['categoryid']); // returns array of roles
        echo json_encode($result);
    }
    else {
        echo json_encode(array());  // return empty
    }
}

// Create New Category
if (isset($_POST["createNewCategory"])) {
    // print_r($_POST);  // print_r($_FILES);
    
    $id = saveCategory($_POST, $_FILES);

    if ($id > 0) {
        $result = array( 'code' => 0, 'message' => 'New category successfully created.', 'id' => $id );
    }
    else {
        switch($id) {
            case -1: 
                $result = array( 'code' => 1, 'message' => 'Unable to insert domain operator in db.' );
                break;
            case -2: 
                $result = array( 'code' => 2, 'message' => 'Category name already exists..' );
                break; 
            case -3: 
                $result = array( 'code' => 3, 'message' => 'Abbreviation already exists.' );
                break; 
            case -4: 
                $result = array( 'code' => 4, 'message' => 'Catalog symbol already exists.' );
                break; 
            case -5: 
                $result = array( 'code' => 5, 'message' => 'Unable to insert domain operator in db.' );
                break; 
            case -6: 
                $result = array( 'code' => 6, 'message' => 'Database exception.' );
                break;
            case -7: 
                $result = array( 'code' => 7, 'message' => 'Failed to connect to database.' );
                break;
            default: 
                $result = array( 'code' => 8, 'message' => 'Unknown error.' );
        }
    }

    echo json_encode($result);
}

// Update Category
if (isset($_POST["updateCategory"]) && isset($_POST["edit_category_id"])) {
    // print_r($_POST); print_r($_FILES);

    $category_id = $_POST['edit_category_id'];
    $category_name = $_POST['edit_category_name'];
    $category_abbrv = $_POST['edit_category_abbrv'];
    $category_parentid = $_POST['edit_category_parentid'];
    $category_description = $_POST['edit_category_description'];
    $category_catalog_symbol = $_POST['edit_category_catalog_symbol'];

    $post = array(
        'category_id' => $category_id,
        'category_name' => $category_name,
        'category_abbrv' => $category_abbrv,
        'category_parentid' => $category_parentid,
        'category_description' => $category_description,
        'category_catalog_symbol' => $category_catalog_symbol,
    );


    $id = saveCategory($post, $_FILES);

    if ($id > 0) {
        $result = array( 'code' => 0, 'message' => 'New category successfully created.', 'id' => $id );
    }
    else {
        switch($id) {
            case -1: 
                $result = array( 'code' => 1, 'message' => 'Unable to insert domain operator in db.' );
                break;
            case -2: 
                $result = array( 'code' => 2, 'message' => 'Category name already exists..' );
                break; 
            case -3: 
                $result = array( 'code' => 3, 'message' => 'Abbreviation already exists.' );
                break; 
            case -4: 
                $result = array( 'code' => 4, 'message' => 'Catalog symbol already exists.' );
                break; 
            case -5: 
                $result = array( 'code' => 5, 'message' => 'Unable to insert domain operator in db.' );
                break; 
            case -6: 
                $result = array( 'code' => 6, 'message' => 'Database exception.' );
                break;
            case -7: 
                $result = array( 'code' => 7, 'message' => 'Failed to connect to database.' );
                break;
            default: 
                $result = array( 'code' => 8, 'message' => 'Unknown error.' );
        }
    }

    echo json_encode($result);
}

// Delete Category
if (isset($_POST["deleteCategory"]) && isset($_POST["categoryid"])) {
    // print_r($_POST);

    $category_id = $_POST['categoryid'];

    $success = deleteCategory($category_id);
    if ($success === 0) {
        $result = array( 'code' => 0, 'message' => 'Category successfully deleted.' );
    }
    else {
        if ($success === -1) {
            $result = array( 'code' => 1, 'message' => 'Failed to connect to database.' );
        }
        else if ($success === -2) {
            $result = array( 'code' => 2, 'message' => 'Unable to update category.' );
        }
        else {
            $result = array( 'code' => 3, 'message' => 'Unknown error.' );
        }
    }

    echo json_encode($result);
}


?>