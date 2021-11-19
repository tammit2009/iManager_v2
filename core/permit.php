<?php 

function permit($page_access_group, $redirect=true, $all_inclusive=false) {

    // Get the user (not really needed)
    $user = getUserById($_SESSION['userid']);
    if (!($user <= 0) && !empty($user)) {

        $match = false;

        // Get the associated roles from the page_access_group
        $page_roles = get_page_access_roles($page_access_group);
        if (!empty($page_roles) && count($page_roles) > 0) {
            // Check if the user has any of these roles found
            $group_roles = getRolesByGroupId($_SESSION['groupid']);
            if (!empty($group_roles) && count($group_roles) > 0) {
                // Note: "all_inclusive=true" means all roles must be part of the PAG.
                if ($all_inclusive) $match = true;
                foreach($page_roles as $page_role) {
                    $page_role_matched = false; 
                    foreach($group_roles as $group_role) {
                        if ($group_role === $page_role) {
                            $page_role_matched = true;
                            break;
                        }
                    }
                    if ($all_inclusive) { $match = $match && $page_role_matched; }
                    else { $match = $match || $page_role_matched; }
                }
                if (!$match) {
                    // Roles NOT Matched -> 'Block'
                    if ($redirect) {
                        header("Location: exception.php?page=unauthorized");
                        die;
                    }
                    return false;
                }
            }
            else {
                // No group roles -> 'Block'
                if ($redirect) {
                    header("Location: exception.php?page=unauthorized");
                    die;
                }
                return false;
            }
        }

        // If no page roles, allow access
    }
    else {
        // echo "Invalid user";

        // Block
        if ($redirect) {
            header("Location: exception.php?page=unauthorized");
            die;
        }
        return false;
    }

    return true;
}

?>