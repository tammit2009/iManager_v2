
const baseUrlMain = window.location.origin + '/imanager';

/*
 * Manage Roles
 *
 */

function getRoleById(roleId) {

    $.ajax({
        url: baseUrlMain+'/core/ajax/main/roles.php',
        method: 'GET',
        data: { "getRoleById": 1, "roleid": roleId},
        type: 'text',
        success: function(response) {
            response = JSON.parse(response);
            // console.log(response);

            var role_id = response.id;
            var role_name = response.name;
            var role_description = response.description;
            var page_access_level = response.page_access_level;

            // Get the existing checkbox states
            read_chk = page_access_level & 1;
            create_chk = (page_access_level & 2) >> 1;
            edit_chk = (page_access_level & 4) >> 2;
            delete_chk = (page_access_level & 8) >> 3;

            $("#edit_role_form #role_id").val(role_id);
            $("#edit_role_form #role_name").val(role_name);
            $("#edit_role_form #role_description").val(role_description);

            // Note: to see if checked -> $('.form-check-input#check_read').is(':checked');
            $("#edit_role_form .form-check-input#check_read").prop('checked', read_chk ? true: false);    
            $("#edit_role_form .form-check-input#check_create").prop('checked', create_chk ? true: false);
            $("#edit_role_form .form-check-input#check_edit").prop('checked', edit_chk ? true: false);
            $("#edit_role_form .form-check-input#check_delete").prop('checked', delete_chk ? true: false);

        }
    });
}

function createNewRole(form_data) {

    // validate inputs
    if ($("#role_name").val() === "") {
        alert("Please enter the group name");
    }
    else {
        // add the method name
        form_data.push({ name: 'createNewRole', value: 1 });

        $.ajax({
            url: baseUrlMain+'/core/ajax/main/roles.php',
            method: 'POST',
            type: 'text',
            data: form_data,
            success: function(response) {
                // alert(response);
                response = JSON.parse(response);
                // alert(response.message);

                // Reset the form
                // document.getElementById('create_role_form').reset(); // the javascript way
                $("#create_role_form").trigger("reset");                // the jquery way

                // Update any UI element
                //$("#get_category").html(rsp);

                // Close the modal
                $('#createRoleModal').modal('toggle'); 
                // $("#modal .close").click();             // worst case scenario

                if (response.code !== 0) {
                    // Notification using sweetalert lib
                    swalert_notify("Failed", 'Failed to create a new role', 'error');
                }
                else {
                    // Prepare and send a notification
                    var status, msg;
                    if (response.code === 0) {    // created
                        status = "success";
                        msg = "New role successfully created";
                    }
                    else {                  // unknown error
                        status = "warning";
                        msg = "Unknown";
                    }

                    // Notification using helper function 'flash' in utilities (redirect)
                    $.ajax({
                        // Send notification
                        url: `${baseUrlMain}/core/security.php`,
                        method: "POST",
                        data: { "send_notification": 1, "status": status, "msg": msg},                
                        success: function(resp) {
                            // alert(resp);
                        }
                    });

                    // Do a redirect to list roles
                    window.location = `${baseUrlMain}/main.php?dir=roles&page=list_roles`;
                }
            }
        });
    } 
}  

function updateRole(form_data) {

    // validate inputs
    if ($("#role_name").val() === "") {
        alert("Please enter the group name");
    }
    else {
        // add the method name
        form_data.push({ name: 'updateRole', value: 1 });

        $.ajax({
            url: baseUrlMain+'/core/ajax/main/roles.php',
            method: 'POST',
            type: 'text',
            data: form_data,
            success: function(response) {
                // alert(response);
                response = JSON.parse(response);
                // alert("response code: " + response.code);

                // Reset the form
                // document.getElementById('create_role_form').reset(); // the javascript way
                $("#edit_role_form").trigger("reset");                // the jquery way

                // Update any UI element
                //$("#get_category").html(rsp);

                // Close the modal
                $('#editRoleModal').modal('toggle'); 
                // $("#modal .close").click();             // worst case scenario

                if (response.code !== 0) {
                    // Notification using sweetalert lib
                    swalert_notify("Failed", 'Failed to update role', 'error');
                }
                else {
                    // Prepare and send a notification
                    var status, msg;
                    if (response.code === 0) {    // created
                        status = "success";
                        msg = "Role successfully updated";
                    }
                    else {                  // unknown error
                        status = "warning";
                        msg = "Unknown";
                    }

                    // Notification using helper function 'flash' in utilities (redirect)
                    $.ajax({
                        // Send notification
                        url: `${baseUrlMain}/core/security.php`,
                        method: "POST",
                        data: { "send_notification": 1, "status": status, "msg": msg},                
                        success: function(resp) {
                            // alert(resp);
                        }
                    });

                    // Do a redirect to list roles
                    window.location = `${baseUrlMain}/main.php?dir=roles&page=list_roles`;
                }
            }
        });
    }
}  

function deleteRole(roleId) {

    if (confirm("Are you sure you want to delete..?")) {
        $.ajax({
            url: baseUrlMain+'/core/ajax/main/roles.php',
            method: "POST",
            data: { deleteRole: 1, roleid: roleId },
            success: function(response) {

                // alert(response);
                response = JSON.parse(response);
                // alert(response.message);

                if (response.code !== 0) {
                    // Notification using sweetalert lib
                    swalert_notify("Failed", 'Failed to delete role', 'error');
                }
                else {
                    // Prepare and send a notification
                    var status, msg;
                    if (response.code === 0) {    // created
                        status = "success";
                        msg = "Role successfully deleted";
                    }
                    else {                  // unknown error
                        status = "warning";
                        msg = "Unknown";
                    }

                    // Notification using helper function 'flash' in utilities (redirect)
                    $.ajax({
                        // Send notification
                        url: `${baseUrlMain}/core/security.php`,
                        method: "POST",
                        data: { "send_notification": 1, "status": status, "msg": msg},                
                        success: function(resp) {
                            // alert(resp);
                        }
                    });

                    // Do a redirect to list roles
                    window.location = `${baseUrlMain}/main.php?dir=roles&page=list_roles`;
                }
            }
        });
    }
    else {
        // Do nothing.
    }
}
     
/*
 * Manage Groups
 *
 */

function getGroupById(groupId) {

    $.ajax({
        url: baseUrlMain+'/core/ajax/main/groups.php',
        method: 'GET',
        data: { "getGroupById": 1, "groupid": groupId},
        type: 'text',
        success: function(response) {
            response = JSON.parse(response);
            // console.log(response);

            var group_id = response.id;
            var group_name = response.name;
            var group_description = response.description;

            $("#edit_group_form #group_id").val(group_id);
            $("#edit_group_form #group_name").val(group_name);
            $("#edit_group_form #group_description").val(group_description);
        }
    });
}

function createNewGroup(form_data) {

    // validate inputs
    if ($("#group_name").val() === "") {
        alert("Group Name is Required");
    }
    else {
        // add the method name
        form_data.push({ name: 'createNewGroup', value: 1 });

        $.ajax({
            url: baseUrlMain+'/core/ajax/main/groups.php',
            method: 'POST',
            type: 'text',
            data: form_data,
            success: function(response) {
                // alert(response);
                response = JSON.parse(response);
                // alert(response.message);

                // Reset the form
                $("#create_group_form").trigger("reset");                // the jquery way

                // Update any UI element
                //$("#get_category").html(rsp);

                // Close the modal
                $('#createGroupModal').modal('toggle'); 

                if (response.code !== 0) {
                    // Notification using sweetalert lib
                    swalert_notify("Failed", 'Failed to create a new group', 'error');
                }
                else {
                    // Prepare and send a notification
                    var status, msg;
                    if (response.code === 0) {    // created
                        status = "success";
                        msg = "New group successfully created";
                    }
                    else {                  // unknown error
                        status = "warning";
                        msg = "Unknown";
                    }

                    // Notification using helper function 'flash' in utilities (redirect)
                    $.ajax({
                        // Send notification
                        url: `${baseUrlMain}/core/security.php`,
                        method: "POST",
                        data: { "send_notification": 1, "status": status, "msg": msg},                
                        success: function(resp) {
                            // alert(resp);
                        }
                    });

                    // Do a redirect to list roles
                    window.location = `${baseUrlMain}/main.php?dir=groups&page=list_groups`;
                }
            }
        });
    }
}  

function updateGroup(form_data) {

    // validate inputs
    if ($("#edit_group_form #group_name").val() === "") {
        alert("Group Name is Required");
    }
    else {
        // add the method name
        form_data.push({ name: 'updateGroup', value: 1 });

        $.ajax({
            url: baseUrlMain+'/core/ajax/main/groups.php',
            method: 'POST',
            type: 'text',
            data: form_data,
            success: function(response) {
                // alert(response);
                response = JSON.parse(response);
                // alert("response code: " + response.code);

                // Reset the form
                $("#edit_group_form").trigger("reset");                // the jquery way

                // Update any UI element
                //$("#get_category").html(rsp);

                // Close the modal
                $('#editGroupModal').modal('toggle'); 

                if (response.code !== 0) {
                    // Notification using sweetalert lib
                    swalert_notify("Failed", 'Failed to update group', 'error');
                }
                else {
                    // Prepare and send a notification
                    var status, msg;
                    if (response.code === 0) {    // created
                        status = "success";
                        msg = "Group successfully updated";
                    }
                    else {                  // unknown error
                        status = "warning";
                        msg = "Unknown";
                    }

                    // Notification using helper function 'flash' in utilities (redirect)
                    $.ajax({
                        // Send notification
                        url: `${baseUrlMain}/core/security.php`,
                        method: "POST",
                        data: { "send_notification": 1, "status": status, "msg": msg},                
                        success: function(resp) {
                            // alert(resp);
                        }
                    });

                    // Do a redirect to list roles
                    window.location = `${baseUrlMain}/main.php?dir=groups&page=list_groups`;
                }
            }
        });
    }  
}  

function deleteGroup(groupId) {

    if (confirm("Are you sure you want to delete..?")) {
        $.ajax({
            url: baseUrlMain+'/core/ajax/main/groups.php',
            method: "POST",
            data: { deleteGroup: 1, groupid: groupId },
            success: function(response) {
                // alert(response);
                response = JSON.parse(response);
                // alert(response.message);

                if (response.code !== 0) {
                    // Notification using sweetalert lib
                    swalert_notify("Failed", 'Failed to delete group', 'error');
                }
                else {
                    // Prepare and send a notification
                    var status, msg;
                    if (response.code === 0) {    // created
                        status = "success";
                        msg = "Group successfully deleted";
                    }
                    else {                  // unknown error
                        status = "warning";
                        msg = "Unknown";
                    }

                    // Notification using helper function 'flash' in utilities (redirect)
                    $.ajax({
                        // Send notification
                        url: `${baseUrlMain}/core/security.php`,
                        method: "POST",
                        data: { "send_notification": 1, "status": status, "msg": msg},                
                        success: function(resp) {
                            // alert(resp);
                        }
                    });

                    // Do a redirect to list roles
                    window.location = `${baseUrlMain}/main.php?dir=groups&page=list_groups`;
                }
            }
        });
    }
    else {
        // Do nothing.
    }
}


/*
 * Manage Groups / Roles
 *
 */

function getGroupRoleById(groupId, roleId) {

    $.ajax({
        url: baseUrlMain+'/core/ajax/main/groups.php',
        method: 'GET',
        data: { "getGroupRoleById": 1, "groupid": groupId, "roleid": roleId},
        type: 'text',
        success: function(response) {
            response = JSON.parse(response);
            // console.log(response);

            var group_id = response.group_id;
            var role_id = response.role_id;
            var group_role_label = response.label;
            var group_role_descr = response.description;

            $("#edit_group_role_form #group_id").val(group_id);
            $("#edit_group_role_form #role_id").val(role_id);
            $("#edit_group_role_form #group_role_label").val(group_role_label);
            $("#edit_group_role_form #group_role_descr").val(group_role_descr);
        }
    });
}

function addRoleToGroup(form_data) {

    // validate inputs
    if ($("#targetGroupRole").val() === "") {
        alert("Please select a Role for inclusion into this group first.");
    }
    else {
        // add the method name
        form_data.push({ name: 'addRoleToGroup', value: 1 });

        $.ajax({
            url: baseUrlMain+'/core/ajax/main/groups.php',
            method: 'POST',
            type: 'text',
            data: form_data,
            success: function(response) {
                // alert(response);
                response = JSON.parse(response);
                // alert(response.message);

                // Reset the form
                $("#add_role_to_group_form").trigger("reset");                

                if (response.code !== 0) {
                    // Notification using sweetalert lib
                    swalert_notify("Failed", 'Failed to add a new role', 'error');
                }
                else {
                    // Prepare and send a notification
                    var status, msg;
                    status = "success";
                    msg = "New group successfully created";

                    // Notification using helper function 'flash' in utilities (redirect)
                    $.ajax({
                        // Send notification
                        url: `${baseUrlMain}/core/security.php`,
                        method: "POST",
                        data: { "send_notification": 1, "status": status, "msg": msg},                
                        success: function(resp) {
                            // alert(resp);
                        }
                    });

                    // Do a redirect to list roles
                    window.location = `${baseUrlMain}/main.php?dir=groups&page=view_group&id=${response.groupid}`;
                }
            }
        });
    }
}

function updateGroupRole(form_data) {

    // validate inputs
    if ($("#edit_group_role_form #group_role_label").val() === "") {
        alert("Group Name is Required");
    }
    else {
        // add the method name
        form_data.push({ name: 'updateGroupRole', value: 1 });

        $.ajax({
            url: baseUrlMain+'/core/ajax/main/groups.php',
            method: 'POST',
            type: 'text',
            data: form_data,
            success: function(response) {
                // alert(response);
                response = JSON.parse(response);
                // alert("response code: " + response.code);

                // Reset the form
                $("#edit_group_role_form").trigger("reset");                // the jquery way

                // Update any UI element
                //$("#get_category").html(rsp);

                // Close the modal
                $('#editGroupRoleModal').modal('toggle'); 

                if (response.code !== 0) {
                    // Notification using sweetalert lib
                    swalert_notify("Failed", 'Failed to update group role', 'error');
                }
                else {
                    // Prepare and send a notification
                    var status, msg;
                    status = "success";
                    msg = "Group Role successfully updated";
                    
                    // Notification using helper function 'flash' in utilities (redirect)
                    $.ajax({
                        // Send notification
                        url: `${baseUrlMain}/core/security.php`,
                        method: "POST",
                        data: { "send_notification": 1, "status": status, "msg": msg},                
                        success: function(resp) {
                            // alert(resp);
                        }
                    });

                    // Do a redirect to list roles
                    window.location = `${baseUrlMain}/main.php?dir=groups&page=view_group&id=${response.groupid}`;
                }
            }
        });
    }  
} 

function deleteGroupRole(groupId, roleId) {

    if (confirm("Are you sure you want to delete..?")) {
        $.ajax({
            url: baseUrlMain+'/core/ajax/main/groups.php',
            method: "POST",
            data: { deleteGroupRole: 1, groupid: groupId, roleid: roleId },
            success: function(response) {
                // alert(response);
                response = JSON.parse(response);
                // alert(response.message);

                if (response.code !== 0) {
                    // Notification using sweetalert lib
                    swalert_notify("Failed", 'Failed to delete group', 'error');
                }
                else {
                    // Prepare and send a notification
                    var status, msg;
                    status = "success";
                    msg = "Group successfully deleted";
                    
                    // Notification using helper function 'flash' in utilities (redirect)
                    $.ajax({
                        // Send notification
                        url: `${baseUrlMain}/core/security.php`,
                        method: "POST",
                        data: { "send_notification": 1, "status": status, "msg": msg},                
                        success: function(resp) {
                            // alert(resp);
                        }
                    });

                    // Do a redirect to list roles
                    window.location = `${baseUrlMain}/main.php?dir=groups&page=view_group&id=${response.groupid}`;
                }
            }
        });
    }
    else {
        // Do nothing.
    }
}


/*
 * Manage Page Access Groups
 *
 */

function getPagrById(pagrId) {

    $.ajax({
        url: baseUrlMain+'/core/ajax/main/pagrs.php',
        method: 'GET',
        data: { "getPagrById": 1, "pagrid": pagrId},
        type: 'text',
        success: function(response) {
            response = JSON.parse(response);
            // console.log(response);

            var pagr_id = response.id;
            var pagr_label = response.label;
            var pagr_description = response.description;

            $("#edit_pagr_form #pagr_id").val(pagr_id);
            $("#edit_pagr_form #pagr_label").val(pagr_label);
            $("#edit_pagr_form #pagr_description").val(pagr_description);
        }
    });
}

function createNewPagr(form_data) {
    
    // validate inputs
    if ($("#pagr_name").val() === "") {
        alert("Page Access Group Name is Required");
    }
    else {
        // add the method name
        form_data.push({ name: 'createNewPagr', value: 1 });

        $.ajax({
            url: baseUrlMain+'/core/ajax/main/pagrs.php',
            method: 'POST',
            type: 'text',
            data: form_data,
            success: function(response) {
                // alert(response);
                response = JSON.parse(response);
                // alert(response.message);

                // Reset the form
                $("#create_pagr_form").trigger("reset");                // the jquery way

                // Update any UI element
                //$("#get_category").html(rsp);

                // Close the modal
                $('#createPagrModal').modal('toggle'); 

                if (response.code !== 0) {
                    // Notification using sweetalert lib
                    swalert_notify("Failed", 'Failed to create a new pagr', 'error');
                }
                else {
                    // Prepare and send a notification
                    var status, msg;
                    if (response.code === 0) {    // created
                        status = "success";
                        msg = "New Page Access Group successfully created";
                    }
                    else {                  // unknown error
                        status = "warning";
                        msg = "Unknown";
                    }

                    // Notification using helper function 'flash' in utilities (redirect)
                    $.ajax({
                        // Send notification
                        url: `${baseUrlMain}/core/security.php`,
                        method: "POST",
                        data: { "send_notification": 1, "status": status, "msg": msg},                
                        success: function(resp) {
                            // alert(resp);
                        }
                    });

                    // Do a redirect to list roles
                    window.location = `${baseUrlMain}/main.php?dir=pagrs&page=list_pagrs`;
                }
            }
        });
    }
}  

function updatePagr(form_data) {

    // validate inputs
    if ($("#edit_pagr_form #pagr_label").val() === "") {
        alert("Page Access Group Label is Required");
    }
    else {
        // add the method name
        form_data.push({ name: 'updatePagr', value: 1 });

        $.ajax({
            url: baseUrlMain+'/core/ajax/main/pagrs.php',
            method: 'POST',
            type: 'text',
            data: form_data,
            success: function(response) {
                // alert(response);
                response = JSON.parse(response);
                // alert("response code: " + response.code);

                // Reset the form
                $("#edit_pagrs_form").trigger("reset");                // the jquery way

                // Update any UI element
                //$("#get_category").html(rsp);

                // Close the modal
                $('#editPagrModal').modal('toggle'); 

                if (response.code !== 0) {
                    // Notification using sweetalert lib
                    swalert_notify("Failed", 'Failed to update Page Access Group', 'error');
                }
                else {
                    // Prepare and send a notification
                    var status, msg;
                    if (response.code === 0) {    // created
                        status = "success";
                        msg = "Page Access Group successfully updated";
                    }
                    else {                  // unknown error
                        status = "warning";
                        msg = "Unknown";
                    }

                    // Notification using helper function 'flash' in utilities (redirect)
                    $.ajax({
                        // Send notification
                        url: `${baseUrlMain}/core/security.php`,
                        method: "POST",
                        data: { "send_notification": 1, "status": status, "msg": msg},                
                        success: function(resp) {
                            // alert(resp);
                        }
                    });

                    // Do a redirect to list roles
                    window.location = `${baseUrlMain}/main.php?dir=pagrs&page=list_pagrs`;
                }
            }
        });
    }  
}  

function deletePagr(pagrId) {

    if (confirm("Are you sure you want to delete..?")) {
        $.ajax({
            url: baseUrlMain+'/core/ajax/main/pagrs.php',
            method: "POST",
            data: { deletePagr: 1, pagrid: pagrId },
            success: function(response) {
                // alert(response);
                response = JSON.parse(response);
                // alert(response.message);

                if (response.code !== 0) {
                    // Notification using sweetalert lib
                    swalert_notify("Failed", 'Failed to delete PA Group', 'error');
                }
                else {
                    // Prepare and send a notification
                    var status, msg;
                    if (response.code === 0) {    // created
                        status = "success";
                        msg = "Page Access Group successfully deleted";
                    }
                    else {                  // unknown error
                        status = "warning";
                        msg = "Unknown";
                    }

                    // Notification using helper function 'flash' in utilities (redirect)
                    $.ajax({
                        // Send notification
                        url: `${baseUrlMain}/core/security.php`,
                        method: "POST",
                        data: { "send_notification": 1, "status": status, "msg": msg},                
                        success: function(resp) {
                            // alert(resp);
                        }
                    });

                    // Do a redirect to list roles
                    window.location = `${baseUrlMain}/main.php?dir=pagrs&page=list_pagrs`;
                }
            }
        });
    }
    else {
        // Do nothing.
    }
}


/*
 * Manage Page Access Groups / Roles
 *
 */

function getPagrRoleById(pagrId, roleId) {

    $.ajax({
        url: baseUrlMain+'/core/ajax/main/pagrs.php',
        method: 'GET',
        data: { "getPagrRoleById": 1, "pagrid": pagrId, "roleid": roleId},
        type: 'text',
        success: function(response) {
            response = JSON.parse(response);
            // console.log(response);

            var pagr_id = response.pag_id;
            var role_id = response.role_id;
            var pagr_role_label = response.label;
            var pagr_role_descr = response.description;

            $("#edit_pagr_role_form #pagr_id").val(pagr_id);
            $("#edit_pagr_role_form #role_id").val(role_id);
            $("#edit_pagr_role_form #pagr_role_label").val(pagr_role_label);
            $("#edit_pagr_role_form #pagr_role_descr").val(pagr_role_descr);
        }
    });
}

function addRoleToPagr(form_data) {

    // validate inputs
    if ($("#targetPagrRole").val() === "") {
        alert("Please select a Role for inclusion into this PAGR first.");
    }
    else {
        // add the method name
        form_data.push({ name: 'addRoleToPagr', value: 1 });

        $.ajax({
            url: baseUrlMain+'/core/ajax/main/pagrs.php',
            method: 'POST',
            type: 'text',
            data: form_data,
            success: function(response) {
                // alert(response);
                response = JSON.parse(response);
                // alert(response.message);

                // Reset the form
                $("#add_role_to_pagr_form").trigger("reset");                

                if (response.code !== 0) {
                    // Notification using sweetalert lib
                    swalert_notify("Failed", 'Failed to add a new role', 'error');
                }
                else {
                    // Prepare and send a notification
                    var status, msg;
                    status = "success";
                    msg = "New group successfully created";

                    // Notification using helper function 'flash' in utilities (redirect)
                    $.ajax({
                        // Send notification
                        url: `${baseUrlMain}/core/security.php`,
                        method: "POST",
                        data: { "send_notification": 1, "status": status, "msg": msg},                
                        success: function(resp) {
                            // alert(resp);
                        }
                    });

                    // Do a redirect to list roles
                    window.location = `${baseUrlMain}/main.php?dir=groups&page=view_pagr&id=${response.pagrid}`;
                }
            }
        });
    }
}

function updatePagrRole(form_data) {

    // validate inputs
    if ($("#edit_pagr_role_form #pagr_role_label").val() === "") {
        alert("PAGR Label is Required");
    }
    else {
        // add the method name
        form_data.push({ name: 'updatePagrRole', value: 1 });

        $.ajax({
            url: baseUrlMain+'/core/ajax/main/pagrs.php',
            method: 'POST',
            type: 'text',
            data: form_data,
            success: function(response) {
                // alert(response);
                response = JSON.parse(response);
                // alert("response code: " + response.code);

                // Reset the form
                $("#edit_pagr_role_form").trigger("reset");                // the jquery way

                // Update any UI element
                //$("#get_category").html(rsp);

                // Close the modal
                $('#editPagrRoleModal').modal('toggle'); 

                if (response.code !== 0) {
                    // Notification using sweetalert lib
                    swalert_notify("Failed", 'Failed to update pagr role', 'error');
                }
                else {
                    // Prepare and send a notification
                    var status, msg;
                    status = "success";
                    msg = "PAGR Role successfully updated";
                    
                    // Notification using helper function 'flash' in utilities (redirect)
                    $.ajax({
                        // Send notification
                        url: `${baseUrlMain}/core/security.php`,
                        method: "POST",
                        data: { "send_notification": 1, "status": status, "msg": msg},                
                        success: function(resp) {
                            // alert(resp);
                        }
                    });

                    // Do a redirect to list roles
                    window.location = `${baseUrlMain}/main.php?dir=pagrs&page=view_pagr&id=${response.pagrid}`;
                }
            }
        });
    }  
} 

function deletePagrRole(pagrId, roleId) {

    if (confirm("Are you sure you want to delete..?")) {
        $.ajax({
            url: baseUrlMain+'/core/ajax/main/pagrs.php',
            method: "POST",
            data: { deletePagrRole: 1, pagrid: pagrId, roleid: roleId },
            success: function(response) {
                // alert(response);
                response = JSON.parse(response);
                // alert(response.message);

                if (response.code !== 0) {
                    // Notification using sweetalert lib
                    swalert_notify("Failed", 'Failed to delete PAGR', 'error');
                }
                else {
                    // Prepare and send a notification
                    var status, msg;
                    status = "success";
                    msg = "PAGR successfully deleted";
                    
                    // Notification using helper function 'flash' in utilities (redirect)
                    $.ajax({
                        // Send notification
                        url: `${baseUrlMain}/core/security.php`,
                        method: "POST",
                        data: { "send_notification": 1, "status": status, "msg": msg},                
                        success: function(resp) {
                            // alert(resp);
                        }
                    });

                    // Do a redirect to list roles
                    window.location = `${baseUrlMain}/main.php?dir=pagrs&page=view_pagr&id=${response.pagrid}`;
                }
            }
        });
    }
    else {
        // Do nothing.
    }
}


/*
 * Manage Users
 *
 */

function manageUser(form_data) {
    
    // Validate inputs // TODO: include validation for name and password rules
    if ($("#name").val() === "") {  // Not necessary
        alert("Name is Required");
    }
    else {

        // reset indicators
        $('input').removeClass("border-danger")
    	$('#msg').html('')

        start_load();

        // exit if passwords do not match
		if($('[name="password"]').val() != '' && $('[name="cpass"]').val() != ''){
			if($('#pass_match').attr('data-status') != 1){
				if($("[name='password']").val() !=''){
					$('[name="password"],[name="cpass"]').addClass("border-danger")
					end_load()
					return false;
				}
			}
		}

        // add the method name
        // form_data.push({ name: 'createNewUser', value: 1 }); // This will not work
        form_data.append('manageUser', 1);

        $.ajax({
            url: baseUrlMain+'/core/ajax/main/users.php?action=manage_user',  // spin it up a little, for variation
            method: 'POST',                  // "type: 'POST'" seems to be used as well          
            cache: false,  
            contentType: false,              // content type used when sending data to the server. Default is: "application/x-www-form-urlencoded"
            processData: false,
            // dataType: 'text',             // type of data expected back: json|xml|script|html
            type: 'POST',
            data: form_data,
            success: function(response) {
                end_load();

                // console.log(response);
                response = JSON.parse(response);
                // alert("code: " + response.code + ", message: " + response.message);

                // Reset the form
                $("#manage_user_form").trigger("reset");                // the jquery way

                // Update any UI element
                //$("#get_category").html(rsp);

                // Prepare and send a notification
                var status, msg;

                if (response.code == 0) {
                    status = "success";
                    msg = "User successfully saved";

                    // Notification using helper function 'flash' in utilities (redirect)
                    $.ajax({
                        // Send notification
                        url: `${baseUrlMain}/core/security.php`,
                        method: "POST",
                        data: { "send_notification": 1, "status": status, "msg": msg},                
                        success: function(resp) {
                            // alert(resp);
                        }
                    });

                    // Do a redirect to list roles
                    window.location = `${baseUrlMain}/main.php?dir=users&page=list_users`;
                }
                else if (response.code == 2) {
                    // $('#msg').html("<div class='alert alert-danger'>Email already exist.</div>");
                    $('#email_msg').html("<div style=\"color:red; margin-top:5px;\";>Email already exist.</div>");	
                    $('[name="email"]').addClass("border-danger")
                }
                else {
                    status = "error";
                    msg = response.message;

                    // Notification using sweetalert lib
                    swalert_notify(status, msg, status);

                    // setTimeout(function(){
                    //     //location.replace('dashboard.php?dir=users&page=list_users')
                    //     window.location = `${baseUrl}/main.php?dir=users&page=list_users`;
                    // }, 750)
                }
            }
        });
    }
} 

function deleteUser(id) {

    start_load()

    $.ajax({
    	url:  baseUrlMain+'/core/ajax/main/users.php?action=delete_user',
    	method:'POST',
    	data:{id: id},
    	success:function(response){

            end_load()

            // alert(response);
            response = JSON.parse(response);
            // alert("code: " + response.code + ", message: " + response.message);

            // Prepare and send a notification
            var status, msg;

            if (response.code == 0) {
                status = "success";
                msg = "User successfully deleted";

                // Notification using helper function 'flash' in utilities (redirect)
                $.ajax({
                    // Send notification
                    url: `${baseUrlMain}/core/security.php`,
                    method: "POST",
                    data: { "send_notification": 1, "status": status, "msg": msg},                
                    success: function(resp) {
                        // alert(resp);
                    }
                });

                // Do a redirect to list users
                // window.location = `${baseUrlMain}/main.php?dir=users&page=list_users`;
                window.location.reload();
            }
            else {
                status = "error";
                msg = response.message;

                // Notification using sweetalert lib
                swalert_notify(status, msg, status);

                setTimeout(function(){
                    window.location.reload();
                }, 2000)
            }
    	}
    });
}


/*
 * Manage Domains
 *
 */

function getDomainById(domainId) {

    $.ajax({
        url: baseUrlMain+'/core/ajax/main/domains.php',
        method: 'GET',
        data: { "getDomainById": 1, "domainid": domainId},
        type: 'text',
        success: function(response) {
            response = JSON.parse(response);
            // console.log(response);

            var domain_id = response.id;
            var domain_name = response.name;
            var domain_description = response.description;

            $("#edit_domain_form #domain_id").val(domain_id);
            $("#edit_domain_form #domain_name").val(domain_name);
            $("#edit_domain_form #domain_description").val(domain_description);
        }
    });
}

function createNewDomain(form_data) {

    // validate inputs
    if ($("#domain_name").val() === "") {
        alert("Domain Name is Required");
    }
    else {
        // add the method name
        form_data.push({ name: 'createNewDomain', value: 1 });

        $.ajax({
            url: baseUrlMain+'/core/ajax/main/domains.php',
            method: 'POST',
            type: 'text',
            data: form_data,
            success: function(response) {
                // alert(response);
                response = JSON.parse(response);
                // console.log(response.message);

                // Reset the form
                $("#create_domain_form").trigger("reset");                

                // Update any UI element e.g. '$("#get_category").html(rsp);'

                // Close the modal
                $('#createDomainModal').modal('toggle'); 

                if (response.code !== 0) {
                    // Notification using sweetalert lib
                    swalert_notify("Failed", 'Failed to create a new domain', 'error');
                }
                else {
                    // Prepare and send a notification
                    var status, msg;
                    status = "success";
                    msg = "New domain successfully created";

                    // Notification using helper function 'flash' in utilities (redirect)
                    $.ajax({
                        // Send notification
                        url: `${baseUrlMain}/core/security.php`,
                        method: "POST",
                        data: { "send_notification": 1, "status": status, "msg": msg},                
                        success: function(resp) {
                            // alert(resp);
                        }
                    });

                    // Do a redirect to list roles
                    window.location = `${baseUrlMain}/main.php?dir=orgs&page=list_domains`;
                }
            }
        });
    }
}  

function updateDomain(form_data) {

    // validate inputs
    if ($("#edit_domain_form #domain_name").val() === "") {
        alert("Domain Name is Required");
    }
    else {
        // add the method name
        form_data.push({ name: 'updateDomain', value: 1 });

        $.ajax({
            url: baseUrlMain+'/core/ajax/main/domains.php',
            method: 'POST',
            type: 'text',
            data: form_data,
            success: function(response) {
                // alert(response);
                response = JSON.parse(response);
                // alert("response code: " + response.code);

                // Reset the form
                $("#edit_domain_form").trigger("reset");                

                // Update any UI element e.g. '$("#get_category").html(rsp);'

                // Close the modal
                $('#editDomainModal').modal('toggle'); 

                if (response.code !== 0) {
                    // Notification using sweetalert lib
                    swalert_notify("Failed", 'Failed to update group', 'error');
                }
                else {
                    // Prepare and send a notification
                    var status, msg;
                    status = "success";
                    msg = "Domain successfully updated";

                    // Notification using helper function 'flash' in utilities (redirect)
                    $.ajax({
                        // Send notification
                        url: `${baseUrlMain}/core/security.php`,
                        method: "POST",
                        data: { "send_notification": 1, "status": status, "msg": msg},                
                        success: function(resp) {
                            // alert(resp);
                        }
                    });

                    // Do a redirect to list roles
                    window.location = `${baseUrlMain}/main.php?dir=orgs&page=list_domains`;
                }
            }
        });
    }  
}  

function deleteDomain(domainId) {

    if (confirm("Are you sure you want to delete..?")) {
        $.ajax({
            url: baseUrlMain+'/core/ajax/main/domains.php',
            method: "POST",
            data: { deleteDomain: 1, domainid: domainId },
            success: function(response) {
                // alert(response);
                response = JSON.parse(response);
                // alert(response.message);

                if (response.code !== 0) {
                    // Notification using sweetalert lib
                    swalert_notify("Failed", 'Failed to delete domain', 'error');
                }
                else {
                    // Prepare and send a notification
                    var status, msg;
                    status = "success";
                    msg = "Domain successfully deleted";

                    // Notification using helper function 'flash' in utilities (redirect)
                    $.ajax({
                        // Send notification
                        url: `${baseUrlMain}/core/security.php`,
                        method: "POST",
                        data: { "send_notification": 1, "status": status, "msg": msg},                
                        success: function(resp) {
                            // alert(resp);
                        }
                    });

                    // Do a redirect to list roles
                    window.location = `${baseUrlMain}/main.php?dir=orgs&page=list_domains`;
                }
            }
        });
    }
    else {
        // Do nothing.
    }
}



/*
 * Manage Subdomains
 *
 */

function getSubDomainById(domainId, subdomId) {

    $.ajax({
        url: baseUrlMain+'/core/ajax/main/subdomains.php',
        method: 'GET',
        data: { "getSubDomById": 1, "domainid": domainId, "subdomid": subdomId},
        type: 'text',
        success: function(response) {
            response = JSON.parse(response);
            // console.log(response);

            var domainId = response.parent_domain_id;
            var subdomId = response.id;
            var name = response.name;
            var description = response.description;

            $("#edit_subdom_form #domain_id").val(domainId);
            $("#edit_subdom_form #subdom_id").val(subdomId);
            $("#edit_subdom_form #subdom_name").val(name);
            $("#edit_subdom_form #subdom_descr").val(description);
        }
    });
}

function addSubDomToDomain(form_data) {

    // validate inputs
    if ($("#targetSubDomName").val() === "") {
        alert("Please enter subdomain name first.");
    }
    else {
        // add the method name
        form_data.push({ name: 'addSubDomToDomain', value: 1 });
        // console.log(form_data);

        $.ajax({
            url: baseUrlMain+'/core/ajax/main/subdomains.php',
            method: 'POST',
            type: 'text',
            data: form_data,
            success: function(response) {
                // alert(response);
                response = JSON.parse(response);
                // alert(response.message);

                // Reset the form
                $("#add_subdom_to_domain_form").trigger("reset");                

                if (response.code !== 0) {
                    // Notification using sweetalert lib
                    swalert_notify("Failed", 'Failed to add a new subdomain', 'error');
                }
                else {
                    // Prepare and send a notification
                    var status, msg;
                    status = "success";
                    msg = "New subdomain successfully created and added.";

                    // Notification using helper function 'flash' in utilities (redirect)
                    $.ajax({
                        // Send notification
                        url: `${baseUrlMain}/core/security.php`,
                        method: "POST",
                        data: { "send_notification": 1, "status": status, "msg": msg},                
                        success: function(resp) {
                            // alert(resp);
                        }
                    });

                    // Do a redirect to list roles
                    window.location = `${baseUrlMain}/main.php?dir=orgs&page=view_domain&id=${response.domainid}`;
                }
            }
        });
    }
}

function updateSubDomain(form_data) {

    // validate inputs
    if ($("#edit_subdom_form #subdom_name").val() === "") {
        alert("Subdomain name is Required");
    }
    else {
        // add the method name
        form_data.push({ name: 'updateSubDomain', value: 1 });

        $.ajax({
            url: baseUrlMain+'/core/ajax/main/subdomains.php',
            method: 'POST',
            type: 'text',
            data: form_data,
            success: function(response) {
                // alert(response);
                response = JSON.parse(response);
                // alert("response code: " + response.code);

                // Reset the form
                $("#edit_subdom_form").trigger("reset");                

                // Update any UI element e.g. '$("#get_category").html(rsp);'

                // Close the modal
                $('#editSubDomModal').modal('toggle'); 

                if (response.code !== 0) {
                    // Notification using sweetalert lib
                    swalert_notify("Failed", 'Failed to update subdomain', 'error');
                }
                else {
                    // Prepare and send a notification
                    var status, msg;
                    status = "success";
                    msg = "Subdomain successfully updated";
                    
                    // Notification using helper function 'flash' in utilities (redirect)
                    $.ajax({
                        // Send notification
                        url: `${baseUrlMain}/core/security.php`,
                        method: "POST",
                        data: { "send_notification": 1, "status": status, "msg": msg},                
                        success: function(resp) {
                            // alert(resp);
                        }
                    });

                    // Do a redirect to list roles
                    window.location = `${baseUrlMain}/main.php?dir=orgs&page=view_domain&id=${response.domainid}`;
                }
            }
        });
    }  
} 

function deleteSubDomain(domainId, subdomId) {

    if (confirm("Are you sure you want to delete..?")) {
        $.ajax({
            url: baseUrlMain+'/core/ajax/main/subdomains.php',
            method: "POST",
            data: { deleteSubDomain: 1, domainid: domainId, subdomid: subdomId },
            success: function(response) {
                // alert(response);
                response = JSON.parse(response);
                // alert(response.message);

                if (response.code !== 0) {
                    // Notification using sweetalert lib
                    swalert_notify("Failed", 'Failed to delete subdomain', 'error');
                }
                else {
                    // Prepare and send a notification
                    var status, msg;
                    status = "success";
                    msg = "Subdomain successfully deleted";
                    
                    // Notification using helper function 'flash' in utilities (redirect)
                    $.ajax({
                        // Send notification
                        url: `${baseUrlMain}/core/security.php`,
                        method: "POST",
                        data: { "send_notification": 1, "status": status, "msg": msg},                
                        success: function(resp) {
                            // alert(resp);
                        }
                    });

                    // Do a redirect to list roles
                    window.location = `${baseUrlMain}/main.php?dir=orgs&page=view_domain&id=${response.domainid}`;
                }
            }
        });
    }
    else {
        // Do nothing.
    }
}


/*
 * Manage Stock
 *
 */

function createSKU(form_data) {

    // validate inputs
    if ($("#brand").val() === "") {
        alert("Brand is Required");
    }
    else if ($("#category").val() === "") {
        alert("Category is Required");
    }
    else if ($("#package").val() === "") {
        alert("Packaging is Required");
    }
    else if ($("#number").val() === "") {
        alert("Number is Required");
    }
    else {
        // add the method name
        form_data.push({ name: 'createSKU', value: 1 });

        $.ajax({
            url: baseUrlMain+'/core/ajax/main/stock.php',
            method: 'POST',
            type: 'text',
            data: form_data,
            success: function(response) {
                // alert(response);
                response = JSON.parse(response);
                // alert(response.message);

                $('#sku_the_result').html('<div class="alert alert-success">' + response.sku + '</div>');
            }
        });
    }
}


/*
 * Manage Store Requisitions
 *
 */

function initializeStoreReqDomainsSelect() {

    // Clear the select
    $("#domainid").empty();

    $.ajax({
        url: baseUrlMain+'/core/ajax/main/domains.php',
        method: 'POST',
        data: {
            get_all_domains: 1
        },
        datatype: 'json',
        success: function(data) {
            // alert(data);
            var parsed = JSON.parse(data);
            // console.log(parsed);

            // var domain_id = false;
            // var user_id = false;

            // if ($("#edit_userid").val() != '') {
            //     user_id = $("#edit_userid").val();
            // }

            $.each(parsed, function(key, value) {
                // console.log("key: ", key, "value: ", value);
                $("#domainid").append(
                    "<option value=" + value.id +">" + value.name +"</option>"
                );

                // if (parseInt(user_id) === parseInt(value.id)) {
                //     domain_id = value.domain;
                // }
            });

            // if (!domain_id || !user_id) {
            //     domain_id = parsed[0].domain;
            //     user_id = parsed[0].id;
            // }
            
            // // Set the first element as selected
            // $("#userid").val(user_id);   // $("#vendorid").val(parsed[Object.keys(parsed)[0]].id);

            // Set the first element as selected
            var domain_id = parsed[0].id;
            $("#domainid").val(domain_id);

            // Now trigger the subdom select
            initializeStoreReqSubDomsSelect(domain_id);
        }
    });
}

function initializeStoreReqSubDomsSelect(domainId) {

    // Clear the select
    $("#subdomid").empty();

    // // Set the hidden domainid field
    // $("#domainid").val(domainId);

    $.ajax({
        url: baseUrlMain+'/core/ajax/main/subdomains.php',
        method: 'POST',
        data: {
            get_subdoms_by_domain: 1,
            domainid: domainId
        },
        datatype: 'json',
        success: function(data) {
            // alert(data);
            var parsed = JSON.parse(data);
            // console.log(parsed);

            // var subdom_id = false;

            // if ($("#edit_subdomid").val() != '') {
            //     subdom_id = $("#edit_subdomid").val();
            //     //alert("subdom_id found: " + subdom_id);
            // }

            $.each(parsed, function(key, value) {
                // console.log("key: ", key, "value: ", value.status_label);
                $("#subdomid").append(
                    "<option value=" + value.id +">" + value.name + "</option>"
                );
            });

            // if (!subdom_id) {
            //     // Set the first element as selected
            //     $("#subdomid").val(parsed[0].id);
            // }
            // else {
            //     $("#subdomid").val(subdom_id); 
            // }

            // Set the first element as selected
            $("#subdomid").val(parsed[0].id);
        }
    })
}

function domainsChangeStoreReqUpdateSubDomSelect( value ) {

    // Get the vendor's domain
    $.ajax({
        url: baseUrlMain+'/core/ajax/main/domains.php',
        method: 'POST',
        data: {
            get_domain_by_id: 1,
            domainid: value
        },
        datatype: 'json',
        success: function(data) {
            // alert(data);
            var parsed = JSON.parse(data);
            // console.log(parsed);

            // Now trigger the subdom select
            initializeStoreReqSubDomsSelect(parsed.id);
        }
    })  
}

function addStoreRequisitionRow() {

    $.ajax({
        url: baseUrlMain+'/core/ajax/main/store_reqs.php', 
        method: "POST",
        data: { get_new_requisition_item: 1 },
        success: function(rsp) {
            //alert(rsp);
            $("#store_requisition_item").append(rsp);
            // set the number fields (auto-incrementing)
            var n = 0;
            $(".number").each(function() {
                $(this).html(++n);  
            });
            // set the hidden input's id field
            n = 0;
            $(".stock_product_id").each(function() {
                ++n; 
                $(this).attr('id', 'stock_product_' + n); 
            });
            // set the select button's data-xdata attribute field
            n = 0;
            $(".select_stock_product").each(function() {
                $(this).attr('data-xdata', ++n); 
            });
        }
    })
}

function storeRequisitionItemChangeUpdate(elem) {

    // alert("storeRequisitionItemChange");

    var stock_product_id = $(elem).val();
    var tr = $(elem).parent().parent();
    // $(".overlay").show();

    $.ajax({
        url: baseUrlMain+'/core/ajax/main/store_reqs.php',
        method: "POST",
        dataType: "text",
        data: { get_stock_item_details: 1, id: stock_product_id },
        success: function(response) {
            // console.log(response);
            response = JSON.parse(response);

            tr.find(".stock_product_id").val(response["id"]);
            tr.find(".stock_product_sku").val(response["sku"]);

            tr.find(".stock_product_item").val(response["item"]);

            tr.find(".stock_product_unit").val(response["unit"]);
            tr.find('.stock_product_unit').html(response["unit"]);

            tr.find(".stock_product_descr").val(response["short_descr"]);
            tr.find(".stock_product_descr").html(response["short_descr"]);

            tr.find(".stock_product_avail").html(response["curr_stock_level"] - response["pending_reserved"]);
            tr.find(".stock_product_avail").val(response["curr_stock_level"] - response["pending_reserved"]);

            if (tr.find(".stock_product_avail").val() > 0)
                tr.find(".stock_product_qty").val(1);
            else 
                tr.find(".stock_product_qty").val(0);
        }
    })
}

function validateStockProductQty(elem) {
    var qty = $(elem);
    var tr = $(elem).parent().parent();
    var avail_stock_qty = parseInt(tr.find(".stock_product_avail").val());
    //alert(tr.find(".stock_product_qty").val());

    if (isNaN(qty.val()) || qty.val() < 0) {
        alert("Please enter a valid quantity");
        qty.val(1);
    }
    else {
        if (parseInt(qty.val()) > avail_stock_qty) {
            alert("Sorry, this required quantity exceeds available quantity");
            if (avail_stock_qty > 0) qty.val(1);
            else  qty.val(0);
        }
    }
}

// Create Store Requisition
function createStoreRequisition(form_data) {

    if ($("#requisition_descr").val() === "") {
        alert("Please enter requisition description");
    }
    else if ($("#picker").val() === "") {
        alert("Please enter the date"); // not necessary
    }
    else {
        // add the method name
        form_data.push({ name: 'createStoreRequisition', value: 1 });

        $.ajax({
            url: baseUrlMain+'/core/ajax/main/store_reqs.php',
            method: "POST",
            data: form_data,
            success: function(response) {
                // console.log(response);
                response = JSON.parse(response);

                if (response.code !== 0) {
                    // Notification using sweetalert lib
                    swalert_notify("Failed", 'Failed to create the requisition', 'error');
                }
                else {
                    $("#store_requisition_form").trigger("reset");

                    // Prepare and send a notification
                    var status, msg;
                    status = "success";
                    msg = "Store requisition successfully created";
                    
                    // Notification using helper function 'flash' in utilities (redirect)
                    $.ajax({
                        // Send notification
                        url: `${baseUrlMain}/core/security.php`,
                        method: "POST",
                        data: { "send_notification": 1, "status": status, "msg": msg},                
                        success: function(resp) {
                            // alert(resp);
                        }
                    });

                    // Do a redirect to list roles
                    window.location = `${baseUrlMain}/main.php?dir=store_reqs&page=list_requisitions`;
                }
            }
        });
    }  
}

// Approve Store Requisition
function approveStoreRequisition(form_data) {
    if ($("#requistion_approver_notes").val() === "") {
        alert("Please enter approver notes");
    }
    else {
        
        form_data.push({name: "requisition_approve", value: 2});
        // console.log(form_data);

        $.ajax({
            url: `${baseUrlMain}/core/ajax/main/store_reqs.php`,
            method: "POST",
            data: form_data,                
            success: function(response) {
                // alert(response);
                response = JSON.parse(response);

                if (response.code !== 0) {
                    // Notification using sweetalert lib
                    swalert_notify("Failed", 'Failed to approve the requisition', 'error');
                }
                else {
                    $("#view_approve_complete_requisition_form").trigger("reset");

                    // Prepare and send a notification
                    var status, msg;
                    status = "success";
                    msg = "Store requisition successfully approved";
                    
                    // Notification using helper function 'flash' in utilities (redirect)
                    $.ajax({
                        // Send notification
                        url: `${baseUrlMain}/core/security.php`,
                        method: "POST",
                        data: { "send_notification": 1, "status": status, "msg": msg},                
                        success: function(resp) {
                            // alert(resp);
                        }
                    });

                    // Do a redirect to list roles
                    window.location = `${baseUrlMain}/main.php?dir=store_reqs&page=list_requisitions`;
                }
            }
        });
    }    
}

// Reject Store Requisition
function rejectStoreRequisition(form_data) {

    form_data.push({name: "requisition_reject", value: 4});
    // console.log(form_data);

    $.ajax({
        url: `${baseUrlMain}/core/ajax/main/store_reqs.php`,
        method: "POST",
        data: form_data,                
        success: function(response) {
            // alert(response);
            response = JSON.parse(response);

            if (response.code !== 0) {
                // Notification using sweetalert lib
                swalert_notify("Failed", 'Failed to reject the requisition', 'error');
            }
            else {
                $("#view_approve_complete_requisition_form").trigger("reset");

                // Prepare and send a notification
                var status, msg;
                status = "success";
                msg = "Store requisition successfully rejected";
                
                // Notification using helper function 'flash' in utilities (redirect)
                $.ajax({
                    // Send notification
                    url: `${baseUrlMain}/core/security.php`,
                    method: "POST",
                    data: { "send_notification": 1, "status": status, "msg": msg},                
                    success: function(resp) {
                        // alert(resp);
                    }
                });

                // Do a redirect to list roles
                window.location = `${baseUrlMain}/main.php?dir=store_reqs&page=list_requisitions`;
            }
        }
    });
}

// Storekeeper Complete Store Requisition
function storekeeperCompleteStoreRequisition(form_data) {
    
    if ($("#requistion_store_notes").val() === "") {
        alert("Please enter storekeeper notes");
    }
    else {

        form_data.push({name: "requisition_complete", value: 3});   // 3 = complete, 4 = reject
        // console.log(form_data);

        $.ajax({
            url: `${baseUrlMain}/core/ajax/main/store_reqs.php`,
            method: "POST",
            data: form_data,
            success: function(response) {
                // alert(response);
                response = JSON.parse(response);

                if (response.code !== 0) {
                    // Notification using sweetalert lib
                    swalert_notify("Failed", 'Failed to complete the requisition', 'error');
                }
                else {
                    $("#view_approve_complete_requisition_form").trigger("reset");
    
                    // Prepare and send a notification
                    var status, msg;
                    status = "success";
                    msg = "Store requisition successfully completed";
                    
                    // Notification using helper function 'flash' in utilities (redirect)
                    $.ajax({
                        // Send notification
                        url: `${baseUrlMain}/core/security.php`,
                        method: "POST",
                        data: { "send_notification": 1, "status": status, "msg": msg},                
                        success: function(resp) {
                            // alert(resp);
                        }
                    });
    
                    // Do a redirect to list roles
                    window.location = `${baseUrlMain}/main.php?dir=store_reqs&page=list_requisitions`;
                }
            }
        });
    }
}

// Storekeeper Hold Store Requisition
function storekeeperHoldStoreRequisition(form_data) {
    // alert("Hold button clicked");
}

// Storekeeper Reject Store Requisition
function storekeeperRejectStoreRequisition(form_data) {

    form_data.push({name: "requisition_store_reject", value: 5});
    // console.log(form_data);

    $.ajax({
        url: `${baseUrlMain}/core/ajax/main/store_reqs.php`,
        method: "POST",
        data: form_data,                
        success: function(response) {
            // alert(response);
            response = JSON.parse(response);

            if (response.code !== 0) {
                // Notification using sweetalert lib
                swalert_notify("Failed", 'Failed to complete the requisition', 'error');
            }
            else {
                $("#view_approve_complete_requisition_form").trigger("reset");

                // Prepare and send a notification
                var status, msg;
                status = "success";
                msg = "Store requisition successfully rejected";
                
                // Notification using helper function 'flash' in utilities (redirect)
                $.ajax({
                    // Send notification
                    url: `${baseUrlMain}/core/security.php`,
                    method: "POST",
                    data: { "send_notification": 1, "status": status, "msg": msg},                
                    success: function(resp) {
                        // alert(resp);
                    }
                });

                // Do a redirect to list roles
                window.location = `${baseUrlMain}/main.php?dir=store_reqs&page=list_requisitions`;
            }
        }
    });
}


/*
 * Manage Customer Purchase Requisitions
 *
 */

function getPlatformCompanyDetails() {

    $.ajax({
        url: baseUrlMain+'/core/ajax/main/common.php', 
        method: "POST",
        dataType: "text",
        data: { get_platform_company_details: 1 },
        success: function(rsp) {
            //alert(rsp);
            var sys_settings = JSON.parse(rsp);

            // add_preq.page
            $("#preq_supplier").val(sys_settings.company_name);

            // view_porder.page
            $("#porder_supplier_company_name").html(sys_settings.company_name);
            $("#porder_supplier_email").html(sys_settings.company_email);
            $("#porder_supplier_address").html(sys_settings.company_address);
        }
    })
};

function addNewPurchaseRequisitionRow() {
    $.ajax({
        url: baseUrlMain+'/core/ajax/main/customer_preqs.php', 
        method: "POST",
        data: { get_new_preq_item: 1 },
        success: function(response) {
            //alert(response);
            $("#preq_item").append(response);

            // set the number fields (auto-incrementing)
            var n = 0;
            $(".number").each(function() {
                $(this).html(++n);  
            });

            // set the hidden input's id field programmatically
            n = 0;
            $(".product_id").each(function() {
                ++n; 
                $(this).attr('id', 'product_' + n); 
            });

            // set the select button's data-xdata attribute field
            n = 0;
            $(".select_product").each(function() {
                $(this).attr('data-xdata', ++n); 
            });
        }
    })
}
    
function customerPurchaseRequisitionItemChangeUpdate(elem) {

    // TODO: Ensure that the product id is NOT repeated
        
    var product_id = $(elem).val(); 
    var tr = $(elem).parent().parent();

    // $(".overlay").show();

    $.ajax({
        url: baseUrlMain+'/core/ajax/main/customer_preqs.php',
        method: "POST",
        dataType: "json",
        data: { get_preq_item_details: 1, id: product_id },
        success: function(response) {
            // alert(response);
            
            tr.find(".product_name").val(response["product_name"]);

            tr.find(".product_brand_id").val(response["brand_id"]);
            tr.find(".product_brand").html(response["brand"]);
            tr.find(".product_brand").val(response["brand"]);

            tr.find(".product_category_id").val(response["category_id"]);
            tr.find(".product_category").html(response["category"]);
            tr.find(".product_category").val(response["category"]);

            tr.find(".product_descr").html(response["short_descr"]);
            tr.find(".product_descr").val(response["short_descr"]);

            tr.find(".product_unit").val(response["unit"]);
            tr.find(".product_qty").val(1);
            tr.find(".product_rate").val(response["unit_price"]);
            tr.find(".product_total").val( tr.find(".product_qty").val() * tr.find(".product_rate").val() );
            calculate_customer_preq(0, 0, 0);
        }
    }); 
}

function calculate_customer_preq(_discount, _paid, _shipping) {

    var sub_total = 0;
    var vat = 0;
    var total_amt = 0;
    var discount = _discount ? _discount : 0.0;
    var shipping = _shipping ? _shipping : 0.0;
    var grand_total = 0;
    var paid_amt = _paid ? _paid : 0.0;
    var due = 0;

    $(".product_total").each(function() {
        sub_total = sub_total + ($(this).val() * 1);
    });

    vat = 0.075 * sub_total;
    vat = vat.toFixed(2);
    total_amt = sub_total + parseFloat(vat); 
    total_amt = total_amt - parseFloat(discount);
    total_amt = total_amt.toFixed(2);
    grand_total = parseFloat(total_amt) + parseFloat(shipping);
    paid_amt = parseFloat(paid_amt).toFixed(2);
    grand_total = parseFloat(grand_total).toFixed(2);
    due = grand_total - paid_amt;
    due = parseFloat(due).toFixed(2);

    $("#preq_subtotal").val(sub_total);
    $("#preq_vat").val(vat);
    $("#preq_discount").val(discount);
    $("#preq_total_amt").val(total_amt);
    $("#preq_shipping").val(shipping);
    $("#preq_grand_total").val(grand_total);
    $("#preq_paid_amount").val(paid_amt);
    $("#preq_due_amount").val(due);
    $("#preq_payment_status").val("PENDING");
}

function validateCustomerPreqProductQty(elem) {
    var qty = $(elem);
    var tr = $(elem).parent().parent();
    //alert(tr.find(".product_qty").val());
    if (isNaN(qty.val())) {
        alert("Please enter a valid quantity");
        qty.val(1);
    }
    else {
        tr.find(".product_total").val(qty.val() * tr.find(".product_rate").val());
        calculate_customer_preq(0, 0, 0);
    }
}

function recalculateCustomerPreqDiscount(elem) {
    var discount = $(elem).val();
    var paid = $("#preq_paid_amount").val();
    var shipping = $("#preq_shipping").val();
    calculate_customer_preq(discount, paid, shipping);
}

function recalculateCustomerPreqPaidAmt(elem) {
    var paid = $(this).val();
    var discount = $("#preq_discount").val();
    var shipping = $("#preq_shipping").val();
    calculate_customer_preq(discount, paid, shipping);
}

function recalculateCustomerPreqShipping(elem) {
    var shipping = $(this).val();
    var paid = $("#preq_paid_amount").val();
    var discount = $("#preq_discount").val();
    calculate_customer_preq(discount, paid, shipping);
}

function createPurchaseRequisition(form_data) {
    // console.log(form_data);

    if ($("#picker").val() === "") {
        alert("Please enter the date"); // not necessary
    }
    else if ($("#preq_descr").val() === "") {
        alert("Please enter purchase requisition description");
    }
    else if ($("#preq_notes").val() === "") {
        alert("Please enter pr notes");
    }
    else if ($("#preq_paid_amount").val() === "") {
        alert("Please enter paid amount");
    }
    else {
        // add the method name
        form_data.push({ name: 'createPurchaseRequisition', value: 1 });
        
        $.ajax({
            url: baseUrlMain+'/core/ajax/main/customer_preqs.php',
            method: "POST",
            data: form_data,
            success: function(response) {
                // console.log(response);
                response = JSON.parse(response);

                if (response.code !== 0) {
                    // Notification using sweetalert lib
                    swalert_notify("Failed", 'Failed to create the requisition', 'error');
                }
                else {
                    $("#preq_form").trigger("reset");
    
                    // Prepare and send a notification
                    var status, msg;
                    status = "success";
                    msg = "Customer purchase requisition successfully created";
                    
                    // Notification using helper function 'flash' in utilities (redirect)
                    $.ajax({
                        // Send notification
                        url: `${baseUrlMain}/core/security.php`,
                        method: "POST",
                        data: { "send_notification": 1, "status": status, "msg": msg},                
                        success: function(resp) {
                            // alert(resp);
                        }
                    });
    
                    // Do a redirect to list roles
                    window.location = `${baseUrlMain}/main.php?dir=customer_reqs&page=list_preqs`;
                }
            }
        });
    }   
}

function approveCustomerPurchaseRequisition(form_data) {
    // alert("approve clicked");
    
    if ($("#customer_preq_approver_notes").val() === "") {
        alert("Please enter approver notes");
    }
    else {
        form_data.push({name: "customer_preq_approval", value: 2});

        $.ajax({
            url: `${baseUrlMain}/core/ajax/main/customer_preqs.php`,
            method: "POST",
            data: form_data,                
            success: function(response) {
                // console.log(response);
                response = JSON.parse(response);

                if (response.code !== 0) {
                    // Notification using sweetalert lib
                    swalert_notify("Failed", 'Failed to approve the requisition', 'error');
                }
                else {
                    $("#preq_form").trigger("reset");
    
                    // Prepare and send a notification
                    var status, msg;
                    status = "success";
                    msg = "Customer purchase requisition successfully approved";
                    
                    // Notification using helper function 'flash' in utilities (redirect)
                    $.ajax({
                        // Send notification
                        url: `${baseUrlMain}/core/security.php`,
                        method: "POST",
                        data: { "send_notification": 1, "status": status, "msg": msg},                
                        success: function(resp) {
                            // alert(resp);
                        }
                    });
    
                    // Do a redirect to list roles
                    window.location = `${baseUrlMain}/main.php?dir=customer_reqs&page=list_preqs`;
                }
            }
        });
    }  
}

function rejectCustomerPurchaseRequisition(form_data) {
    // alert("reject clicked");

    form_data.push({name: "customer_preq_approval", value: 4});  // reject (4)

    $.ajax({
        url: `${baseUrlMain}/core/ajax/main/customer_preqs.php`,
        method: "POST",
        data: form_data,                
        success: function(response) {
            // alert(response);
            response = JSON.parse(response);

            if (response.code !== 0) {
                // Notification using sweetalert lib
                swalert_notify("Failed", 'Failed to reject the requisition', 'error');
            }
            else {
                $("#preq_form").trigger("reset");

                // Prepare and send a notification
                var status, msg;
                status = "success";
                msg = "Customer purchase requisition successfully rejected";
                
                // Notification using helper function 'flash' in utilities (redirect)
                $.ajax({
                    // Send notification
                    url: `${baseUrlMain}/core/security.php`,
                    method: "POST",
                    data: { "send_notification": 1, "status": status, "msg": msg},                
                    success: function(resp) {
                        // alert(resp);
                    }
                });

                // Do a redirect to list roles
                window.location = `${baseUrlMain}/main.php?dir=customer_reqs&page=list_preqs`;
            }
        }
    });
}


/*
 * Manage Customer Purchase Order
 *
 */

function printCustomerPorderInvoice(porderId) {
    window.location.href = baseUrlMain+'/core/services/invoice_bill.php?cpo_id='+porderId;   
}

function updateCustomerPorderQty(elem) {
    var qty = $(elem);

    if (isNaN(qty.val()) || qty.val() < 0 || qty.val() === '') {
        alert("Please enter a valid quantity");
        qty.val(0);
    }
    else {
        var tr = $(elem).parent().parent();
        var ordered_qty = parseInt(tr.find(".product_ordered_qty").html());
        var fulfilled_qty = parseInt(tr.find(".product_fulfilled_qty").html());
        var pending_qty = ordered_qty - fulfilled_qty;

        if (parseInt(qty.val()) > pending_qty) {
            alert("Sorry, this required quantity exceeds pending quantity");
            qty.val(0);
        }
        else {
            pending_qty = pending_qty - qty.val();
            tr.find(".product_pending_qty").html(pending_qty);
        }
    }
}

function calculate_customer_porder(_discount, _paid, _shipping) {

    var sub_total = 0;
    var vat = 0;
    var total_amt = 0;
    var discount = _discount ? _discount : 0.0;
    var shipping = _shipping ? _shipping : 0.0;
    var grand_total = 0;
    var paid_amt = _paid ? _paid : 0.0;
    var due = 0;

    $(".product_total").each(function() {
        sub_total = sub_total + (parseFloat($(this).text().replace(",", "")));
    });

    vat = 0.075 * sub_total;
    vat = vat.toFixed(2);
    total_amt = sub_total + parseFloat(vat); 
    total_amt = total_amt - parseFloat(discount);
    total_amt = total_amt.toFixed(2);
    grand_total = parseFloat(total_amt) + parseFloat(shipping);
    paid_amt = parseFloat(paid_amt).toFixed(2);
    grand_total = parseFloat(grand_total).toFixed(2);
    due = grand_total - paid_amt;
    due = parseFloat(due).toFixed(2);

    $("#customer_porder_subtotal").val(sub_total);
    $("#customer_porder_vat").val(vat);
    $("#customer_porder_discount").val(discount);
    $("#customer_porder_total_amt").val(total_amt);
    $("#customer_porder_shipping").val(shipping);
    $("#customer_porder_grand_total").val(grand_total);
    $("#customer_porder_paid_amount").val(paid_amt);
    $("#customer_porder_due_amount").val(due);
    $("#customer_porder_payment_status").val("PENDING");
}

function validateCustomerPorderDiscount(elem) {
    var discount = $(elem).val();
    var paid = $("#customer_porder_paid_amount").val();
    var shipping = $("#customer_porder_shipping").val();
    calculate_customer_porder(discount, paid, shipping);
}

function validateCustomerPorderPaidAmount(elem) {
    var paid = $(elem).val();
    var discount = $("#customer_porder_discount").val();
    var shipping = $("#customer_porder_shipping").val();
    calculate_customer_porder(discount, paid, shipping);
}

function validateCustomerPorderShipping(elem) {
    var shipping = $(elem).val();
    var paid = $("#customer_porder_paid_amount").val();
    var discount = $("#customer_porder_discount").val();
    calculate_customer_porder(discount, paid, shipping);
}

function createCustomerPurchaseOrder(form_data) {

    // console.log(form_data);

    if ($("#picker").val() === "") {
        alert("Please enter the date"); // not necessary
    }
    else if ($("#customer_porder_descr").val() === "") {
        alert("Please enter purchase order description");
    }
    else if ($("#customer_porder_issuer_notes").val() === "") {
        alert("Please enter purchase order issuer notes");
    }
    else if ($("#customer_porder_paid_amount").val() === "") {
        alert("Please enter paid amount");
    }
    else {
        // add the method name
        form_data.push({ name: 'createPurchaseOrder', value: 1 });

        $.ajax({
            url: `${baseUrlMain}/core/ajax/main/customer_porders.php`,
            method: "POST",
            data: form_data,                                    
            success: function(response) {
                // console.log(response);
                response = JSON.parse(response);

                if (response.code !== 0) {
                    // Notification using sweetalert lib
                    swalert_notify("Failed", 'Failed to create the Customer Purchase Order', 'error');
                }
                else {
                    $("#customer_porder_form").trigger("reset");
    
                    // Prepare and send a notification
                    var status, msg;
                    status = "success";
                    msg = "Customer purchase order successfully created";
                    
                    // Notification using helper function 'flash' in utilities (redirect)
                    $.ajax({
                        // Send notification
                        url: `${baseUrlMain}/core/security.php`,
                        method: "POST",
                        data: { "send_notification": 1, "status": status, "msg": msg},                
                        success: function(resp) {
                            // alert(resp);
                        }
                    });
    
                    // Do a redirect to list roles
                    window.location = `${baseUrlMain}/main.php?dir=customer_pos&page=list_porders`;
                }
            }
        });
    }      
}

function receiveCustomerPorderItems(form_data) {

    if ($("#porder_rx_notes").val() === "") {
        alert("Please enter storekeeper notes");
    }
    else {

        // append the method name
        form_data.push({name: "receive_customer_porder_items", value: 1});   

        $.ajax({
            url: baseUrlMain+'/core/ajax/main/customer_porders.php',
            method: "POST",
            data: form_data,
            success: function(response) {
                // console.log(response);
                response = JSON.parse(response);

                if (response.code !== 0) {
                    // Notification using sweetalert lib
                    swalert_notify("Failed", 'Failed to receive customer purchase order items', 'error');
                }
                else {
                    $("#customer_porder_form").trigger("reset");
    
                    // Prepare and send a notification
                    var status, msg;
                    status = "success";
                    msg = "Customer purchase order items successfully received";
                    
                    // Notification using helper function 'flash' in utilities (redirect)
                    $.ajax({
                        // Send notification
                        url: `${baseUrlMain}/core/security.php`,
                        method: "POST",
                        data: { "send_notification": 1, "status": status, "msg": msg},                
                        success: function(resp) {
                            // alert(resp);
                        }
                    });
    
                    // Do a redirect to list roles
                    window.location = `${baseUrlMain}/main.php?dir=customer_pos&page=list_porders`;
                }
            }
        });
    }
}


/*
 * Manage Vendor Products
 *
 */

// Uploda functionality
function uploadVProductsCsv(form_data) {

    // validation: has a csv file been selected?
    var csvFileAvailable = false;
    for (var pair of form_data.entries()) {
        if (pair[0] == 'vproduct_csv' && pair[1].name !== '') {
            csvFileAvailable = true;
        }
    }

    if (!csvFileAvailable) {
        alert('You must select the products csv file first!');
    }
    else {
        // add the method name
        form_data.append( 'uploadVProductsCsv', 1 );

        // Print the FormData
        // for (var pair of form_data.entries()) { console.log(pair[0]+ ', ' + pair[1]); }

        $.ajax({
            url: baseUrlMain+'/core/ajax/main/vproducts.php',
            method: "POST",
            data: form_data,
            dataType: "json",       // type of data expected back: json|xml|script|html
            contentType: false,     // content type used when sending data to the server. Default is: "application/x-www-form-urlencoded"
            cache: false,
            processData: false,
            success: function(data) { // returns { code, column, row_data } json object
                // console.log(data);
                if (data.code === 0) {
                    // alert("Valid CSV File");
                    var html = '<div align="center"><button type="button" id="import_data" class="btn btn-info btn-flat px-4 py-2 float-right mb-3">Import</button></div>';
                
                    html += '<table class="table table-striped table-bordered" style="font-size:13px;table-layout:fixed;word-wrap:breakword;">';
                    // CSV Header
                    if (data.column) {
                        html += '<tr>';
                        for (var i = 0; i < data.column.length; i++) {
                            var width = "";
                            switch(i) {
                                case 0:
                                    width = "12%";
                                    break;
                                case 1:
                                    width = "14%";
                                    break;
                                case 2:
                                    width = "24%";
                                    break;
                                case 3:
                                    width = "10%";
                                    break;
                                case 4:
                                    width = "10%";
                                    break;
                                case 5:
                                    width = "8%";
                                    break;
                                case 6:
                                    width = "12%";
                                    break;
                                case 7:
                                    width = "10%";
                                    break;
                            }
                            html += '<th style="width:' + width + ';">' + data.column[i] + '</th>';
                        }
                        html += '</tr>';
                    }
                    // CSV Content
                    if (data.row_data) {
                        for (var i = 0; i < data.row_data.length; i++) {
                            html += '<tr>';
                            html += '<td class="brand" contenteditable>' + data.row_data[i].brand + '</td>';
                            html += '<td class="category" contenteditable>' + data.row_data[i].category + '</td>';
                            html += '<td class="product_name_descr" contenteditable>' + data.row_data[i].product_name_descr + '</td>';
                            html += '<td class="feature" contenteditable>' + data.row_data[i].feature + '</td>';
                            html += '<td class="unit" contenteditable>' + data.row_data[i].unit + '</td>';
                            html += '<td class="lot" contenteditable>' + data.row_data[i].lot + '</td>';
                            html += '<td class="qty_per_offer" contenteditable>' + data.row_data[i].qty_per_offer + '</td>';
                            html += '<td class="offer_price" contenteditable>' + data.row_data[i].offer_price + '</td></tr>';
                        }
                    }
                    html += '<table>';
                    $('#csv_vproducts_file_data').html(html);
                    $('#upload_csv_vproducts_form')[0].reset();
                    $('#csv_vproducts_import').css("display","block");
                }
                else {
                    alert("Invalid CSV File");
                }
            }   
        })
    } 
}

function initializeVendorProductsSelect() {

    $.ajax({
        url: baseUrlMain+'/core/ajax/main/organizations.php',
        method: 'POST',
        data: {
            get_all_vendors: 1
        },
        datatype: 'json',
        success: function(data) {
            // alert(data);
            var parsed = JSON.parse(data);
            // console.log(parsed);
            $.each(parsed, function(key, value) {
                // console.log("key: ", key, "value: ", value);
                $("#vendorid").append(
                    "<option value=" + value.id +">" + value.name +"</option>"
                );
            });
            
            // Set the first element as selected
            $("#vendorid").val(parsed[0].id);   // $("#vendorid").val(parsed[Object.keys(parsed)[0]].id);

            // Now trigger the subdom select
            initializeSubDomsSelect(parsed[0].domain_id);
        }
    })
}

function initializeSubDomsSelect(domainId) {

    // Clear the select
    $("#subdomid").empty();

    // Set the hidden domainid field
    $("#domainid").val(domainId);

    $.ajax({
        url: baseUrlMain+'/core/ajax/main/subdomains.php',
        method: 'POST',
        data: {
            get_subdoms_by_domain: 1,
            domainid: domainId
        },
        datatype: 'json',
        success: function(data) {
            // alert(data);
            var parsed = JSON.parse(data);
            //console.log(parsed);
            $.each(parsed, function(key, value) {
                // console.log("key: ", key, "value: ", value.status_label);
                $("#subdomid").append(
                    "<option value=" + value.id +">" + value.name + "</option>"
                );
            });

            // Set the first element as selected
            $("#subdomid").val(parsed[0].id); 
        }
    })
}

function vendorChangeUpdateSubDomSelect( value ) {

    // Get the vendor's domain
    $.ajax({
        url: baseUrlMain+'/core/ajax/main/organizations.php',
        method: 'POST',
        data: {
            get_vendor_domain: 1,
            vendorid: value
        },
        datatype: 'json',
        success: function(data) {
            // alert(data);
            var parsed = JSON.parse(data);
            console.log(parsed);

            // Now trigger the subdom select
            initializeSubDomsSelect(parsed[0].domain_id);
        }
    })  
}

function subdomChangeUpdateSubDomSelect( value ) {
    // alert("subdom value changed to " + value);
    $("#subdomid").val(value); 
}

// import functionality
function importVProductCsv() {

    var vendorId = $("#vendorid").val();
    var subdomId = $("#subdomid").val();
    var domainId = $("#domainid").val();

    // alert("vendorId: " + vendorId + ", subdomId: " + subdomId + ", domainId: " + domainId );

    var brand               = [];
    var category            = [];
    var product_name_descr  = [];
    var feature             = [];
    var unit                = [];
    var lot                 = [];
    var qty_per_offer       = [];
    var offer_price         = [];

    $('.brand').each(function() {
        brand.push($(this).text());
    });

    $('.category').each(function() {
        category.push($(this).text());
    });

    $('.product_name_descr').each(function() {
        product_name_descr.push($(this).text());
    });

    $('.feature').each(function() {
        feature.push($(this).text());
    });

    $('.unit').each(function() {
        unit.push($(this).text());
    });

    $('.lot').each(function() {
        lot.push($(this).text());
    });

    $('.qty_per_offer').each(function() {
        qty_per_offer.push($(this).text());
    });

    $('.offer_price').each(function() {
        offer_price.push($(this).text());
    });

    $.ajax({
        url: baseUrlMain+'/core/ajax/main/vproducts.php',
        method: "post",
        data: {
            importVProductCsv: 1,
            vendor_id: vendorId,
            subdom_id: subdomId,
            domain_id: domainId,
            brand: brand,
            category: category,
            product_name_descr: product_name_descr,
            feature: feature,
            unit: unit,
            lot: lot,
            qty_per_offer: qty_per_offer,
            offer_price: offer_price,
        },
        success: function(response) {
            // alert(response);
            // console.log(response);
            $('#csv_vproducts_file_data').html('<div class="alert alert-success">Data Imported Successfully</div>');
        }
    });
}


/*
 * Manage Subdomain Users
 *
 */

function initializeUsersSelect() {

    $.ajax({
        url: baseUrlMain+'/core/ajax/main/users.php',
        method: 'POST',
        data: {
            get_all_users: 1
        },
        datatype: 'json',
        success: function(data) {
            // alert(data);
            var parsed = JSON.parse(data);
            // console.log(parsed);

            var domain_id = false;
            var user_id = false;

            if ($("#edit_userid").val() != '') {
                user_id = $("#edit_userid").val();
            }

            $.each(parsed, function(key, value) {
                // console.log("key: ", key, "value: ", value);
                $("#userid").append(
                    "<option value=" + value.id +">" + value.name +"</option>"
                );

                if (parseInt(user_id) === parseInt(value.id)) {
                    domain_id = value.domain;
                }
            });

            if (!domain_id || !user_id) {
                domain_id = parsed[0].domain;
                user_id = parsed[0].id;
            }
            
            // Set the first element as selected
            $("#userid").val(user_id);   // $("#vendorid").val(parsed[Object.keys(parsed)[0]].id);

            // Now trigger the subdom select
            initializeUserSubDomsSelect(domain_id);
        }
    });
}

function initializeUserSubDomsSelect(domainId) {

    // Clear the select
    $("#subdomid").empty();

    // Set the hidden domainid field
    $("#domainid").val(domainId);

    $.ajax({
        url: baseUrlMain+'/core/ajax/main/subdomains.php',
        method: 'POST',
        data: {
            get_subdoms_by_domain: 1,
            domainid: domainId
        },
        datatype: 'json',
        success: function(data) {
            // alert(data);
            var parsed = JSON.parse(data);
            // console.log(parsed);

            var subdom_id = false;

            if ($("#edit_subdomid").val() != '') {
                subdom_id = $("#edit_subdomid").val();
                //alert("subdom_id found: " + subdom_id);
            }

            $.each(parsed, function(key, value) {
                // console.log("key: ", key, "value: ", value.status_label);
                $("#subdomid").append(
                    "<option value=" + value.id +">" + value.name + "</option>"
                );
            });

            if (!subdom_id) {
                // Set the first element as selected
                $("#subdomid").val(parsed[0].id);
            }
            else {
                $("#subdomid").val(subdom_id); 
            }
        }
    })
}

function userChangeUpdateSubDomSelect( value ) {

    // Get the vendor's domain
    $.ajax({
        url: baseUrlMain+'/core/ajax/main/users.php',
        method: 'POST',
        data: {
            get_user_domain: 1,
            userid: value
        },
        datatype: 'json',
        success: function(data) {
            // alert(data);
            var parsed = JSON.parse(data);
            // console.log(parsed);

            // Now trigger the subdom select
            initializeUserSubDomsSelect(parsed[0].domain);
        }
    })  
}

function manageSubDomUser(form_data) {
    
    // Validate inputs // TODO: include validation for name and password rules
    // if ($("#name").val() === "") {  // Not necessary
    //     alert("Name is Required");
    // }
    // else {

        start_load();

        // add the method name
        form_data.push({ name: 'manageSubDomUser', value: 1 }); 

        $.ajax({
            url: baseUrlMain+'/core/ajax/main/subdom_users.php?action=manage_subdom_user',  // spin it up a little, for variation
            method: 'POST',                           
            dataType: 'json',             
            data: form_data,
            success: function(response) {
                end_load();

                // console.log(response);
                // response = JSON.parse(response); // No need since accepting json already
                //alert("code: " + response.code + ", message: " + response.message);

                // Reset the form
                $("#manage_subdom_user_form").trigger("reset");                // the jquery way

                // Update any UI element
                //$("#get_category").html(rsp);

                // Prepare and send a notification
                var status, msg;

                if (response.code == 0) {
                    status = "success";
                    msg = "Subdomain User successfully saved";

                    // Notification using helper function 'flash' in utilities (redirect)
                    $.ajax({
                        // Send notification
                        url: `${baseUrlMain}/core/security.php`,
                        method: "POST",
                        data: { "send_notification": 1, "status": status, "msg": msg},                
                        success: function(resp) {
                            // alert(resp);
                        }
                    });

                    // Do a redirect to list roles
                    window.location = `${baseUrlMain}/main.php?dir=subdom_users&page=list_subdom_users`;
                }
                else {
                    status = "error";
                    msg = response.message;

                    // Notification using sweetalert lib
                    swalert_notify(status, msg, status);

                    // setTimeout(function(){
                    //     //location.replace('dashboard.php?dir=users&page=list_users')
                    //     window.location = `${baseUrl}/main.php?dir=users&page=list_users`;
                    // }, 750)
                }
            }
        });
    // }
} 

function deleteSubDomUser(id) {

    start_load()

    $.ajax({
    	url:  baseUrlMain+'/core/ajax/main/subdom_users.php?action=delete_subdom_user',
    	method:'POST',
    	data:{id: id},
    	success:function(response){

            end_load()

            // alert(response);
            response = JSON.parse(response);
            // alert("code: " + response.code + ", message: " + response.message);

            // Prepare and send a notification
            var status, msg;

            if (response.code == 0) {
                status = "success";
                msg = "User successfully deleted";

                // Notification using helper function 'flash' in utilities (redirect)
                $.ajax({
                    // Send notification
                    url: `${baseUrlMain}/core/security.php`,
                    method: "POST",
                    data: { "send_notification": 1, "status": status, "msg": msg},                
                    success: function(resp) {
                        // alert(resp);
                    }
                });

                window.location.reload();
            }
            else {
                status = "error";
                msg = response.message;

                // Notification using sweetalert lib
                swalert_notify(status, msg, status);

                setTimeout(function(){
                    window.location.reload();
                }, 2000)
            }
    	}
    });
}



/*
 * Manage Vendor Purchase Requisitions
 *
 */

// function getPlatformCompanyDetails() {

//     $.ajax({
//         url: baseUrlMain+'/core/ajax/main/common.php', 
//         method: "POST",
//         dataType: "text",
//         data: { get_platform_company_details: 1 },
//         success: function(rsp) {
//             //alert(rsp);
//             var sys_settings = JSON.parse(rsp);

//             // add_preq.page
//             $("#preq_supplier").val(sys_settings.company_name);

//             // view_porder.page
//             $("#porder_supplier_company_name").html(sys_settings.company_name);
//             $("#porder_supplier_email").html(sys_settings.company_email);
//             $("#porder_supplier_address").html(sys_settings.company_address);
//         }
//     })
// };

function addNewVendorPurchaseRequisitionRow() {

    $.ajax({
        url: baseUrlMain+'/core/ajax/main/vendor_preqs.php', 
        method: "POST",
        data: { get_new_vendor_preq_item: 1 },
        success: function(response) {
            // alert(response);
            $("#vendor_preq_item").append(response);

            // set the number fields (auto-incrementing)
            var n = 0;
            $(".number").each(function() {
                $(this).html(++n);  
            });

            // set the hidden input's id field programmatically
            n = 0;
            $(".vproduct_id").each(function() {
                ++n; 
                $(this).attr('id',   'vproduct_' + n); 
            });

            // set the select button's data-xdata attribute field
            n = 0;
            $(".select_vproduct").each(function() {
                $(this).attr('data-xdata', ++n); 
            });
        }
    })
}
    
function vendorPurchaseRequisitionItemChangeUpdate(elem) {

    // TODO: Ensure that the product id is NOT repeated

    var vproduct_id = $(elem).val(); 
    var tr = $(elem).parent().parent();

    // $(".overlay").show();

    $.ajax({
        url: `${baseUrlMain}/core/ajax/main/vendor_preqs.php`,
        method: "POST",
        dataType: "json",
        data: { get_vendor_preq_item_details: 1, id: vproduct_id },   // get_order_requisition_item_details
        success: function(response) {
            // console.log(response);
            tr.find(".vproduct_name").val(response["product_name"]);
            tr.find(".vproduct_supplier_id").val(response["vendor_id"]);

            tr.find(".vproduct_supplier").html(response["vendor"]);
            tr.find(".vproduct_supplier").val(response["vendor"]);

            tr.find(".vproduct_descr").html(response["product_name_descr"]);
            tr.find(".vproduct_descr").val(response["product_name_descr"]);

            tr.find(".vproduct_rate").val(response["offer_price"]);
            tr.find(".vproduct_qty").val(1);
            tr.find(".vproduct_total").val( tr.find(".vproduct_qty").val() * tr.find(".vproduct_rate").val() );
            //calculate_vendor_preq(0, 0, 0);
        }
    });
}

function calculate_vendor_preq(_discount, _paid, _shipping) {

    var sub_total = 0;
    var vat = 0;
    var total_amt = 0;
    var discount = _discount ? _discount : 0.0;
    var shipping = _shipping ? _shipping : 0.0;
    var grand_total = 0;
    var paid_amt = _paid ? _paid : 0.0;
    var due = 0;

    $(".product_total").each(function() {
        sub_total = sub_total + ($(this).val() * 1);
    });

    vat = 0.075 * sub_total;
    vat = vat.toFixed(2);
    total_amt = sub_total + parseFloat(vat); 
    total_amt = total_amt - parseFloat(discount);
    total_amt = total_amt.toFixed(2);
    grand_total = parseFloat(total_amt) + parseFloat(shipping);
    paid_amt = parseFloat(paid_amt).toFixed(2);
    grand_total = parseFloat(grand_total).toFixed(2);
    due = grand_total - paid_amt;
    due = parseFloat(due).toFixed(2);

    $("#preq_subtotal").val(sub_total);
    $("#preq_vat").val(vat);
    $("#preq_discount").val(discount);
    $("#preq_total_amt").val(total_amt);
    $("#preq_shipping").val(shipping);
    $("#preq_grand_total").val(grand_total);
    $("#preq_paid_amount").val(paid_amt);
    $("#preq_due_amount").val(due);
    $("#preq_payment_status").val("PENDING");
}

function validateVendorPreqProductQty(elem) {
    var qty = $(elem);
    var tr = $(elem).parent().parent();
    // alert(tr.find(".vproduct_qty").val());
    if (isNaN(qty.val())) {
        alert("Please enter a valid quantity");
        qty.val(1);
    }
    else {
        tr.find(".vproduct_total").val(qty.val() * tr.find(".vproduct_rate").val());
        calculate_customer_preq(0, 0, 0);
    }

    // var qty = $(this);
    // var tr = $(this).parent().parent();
    // //alert(tr.find(".vproduct_qty").val());

    // if (isNaN(qty.val())) {
    //     alert("Please enter a valid quantity");
    //     qty.val(1);
    // }
    // else {
    //     tr.find(".vproduct_total").val(qty.val() * tr.find(".vproduct_rate").val());
    // }
}

function getTableRowCount(tableId) {
    // table row count with plain javascript
    // var table = document.getElementById("tableId");
    // var totalRowCount = table.rows.length; 
    // var tbodyRowCount = table.tBodies[0].rows.length; 
    // table row count with jquery
    // "$('tableName').find('tr').length" or better "$('#tableId tbody tr').length"
    totalRowCount = $('#add_vendor_preq_list tbody tr').length;
    return totalRowCount;
}

function isValidLineItemInputs(tableId) {
    var isValid = true;
    $(tableId).find('tr .vproduct_qty').each(function(index, vprod_qty) {
        if (($(vprod_qty).val()) == '') {
            //console.log("Invalid Quantity");
            isValid = false;
        } 
        else {
            //console.log($(vprod_qty).val());
        }
    });
    return isValid;
}

function createVendorPurchaseRequisition(form_data) {

    // console.log(form_data);

    if ($("#picker").val() === "") {
        alert("Please enter the date"); // not necessary
    }
    else if ($("#vendor_preq_descr").val() === "") {
        alert("Please enter the purchase requisition description");
    }
    else if (!isValidLineItemInputs("#add_vendor_preq_list")) {
        alert("Line Inputs are not valid");
    }
    else {
        // add the method name
        form_data.push({ name: 'createVendorPurchaseRequisition', value: 1 });

        $.ajax({
            url: `${baseUrlMain}/core/ajax/main/vendor_preqs.php`,
            method: "POST",
            data: form_data,
            success: function(response) {
                // console.log(response);
                response = JSON.parse(response);

                if (response.code !== 0) {
                    // Notification using sweetalert lib
                    swalert_notify("Failed", 'Failed to create the vendor requisition', 'error');
                }
                else {
                    $("#vendor_preq_form").trigger("reset");

                    // Prepare and send a notification
                    var status, msg;
                    status = "success";
                    msg = "Vendor requisition successfully created";
                    
                    // Notification using helper function 'flash' in utilities (redirect)
                    $.ajax({
                        // Send notification
                        url: `${baseUrlMain}/core/security.php`,
                        method: "POST",
                        data: { "send_notification": 1, "status": status, "msg": msg},                
                        success: function(resp) {
                            // alert(resp);
                        }
                    });

                    // Do a redirect to list roles
                    window.location = `${baseUrlMain}/main.php?dir=vendor_reqs&page=list_preqs`;
                }
            }
        });
    }    
}

function displayStatus(status) {
    status_str = "";
    if (status === "0") { 
        status_str = "<span class='badge badge-secondary p-2'>PROCESSING</span>";
    } else if (status === "1") { 
        status_str =  "<span class='badge badge-warning p-2'>PENDING</span>";
    } else if (status === "2") { 
        status_str =  "<span class='badge badge-primary p-2'>APPROVED</span>";
    } else if (status === "3") { 
        status_str =  "<span class='badge badge-success p-2'>COMPLETED</span>";
    } else if (status === "4") { 
        status_str =  "<span class='badge badge-danger p-2'>REJECTED</span>";
    } else { 
        status_str =  "<span class='badge badge-warning p-2'>UNKNOWN</span>";
    } 
    $("#status_indicator").html(status_str);
}

function approveVendorPurchaseRequisition(form_data) {
    //alert("Approve button clicked");

    if ($("#vendor_preq_approver_notes").val() === "") {
        alert("Please enter approver notes");
    }
    else {
        form_data.push({name: "vendor_preq_approval", value: 2});

        $.ajax({
            url: `${baseUrlMain}/core/ajax/main/vendor_preqs.php`,
            method: "POST",
            data: form_data,                
            success: function(response) {
                // alert(response);
                response = JSON.parse(response);

                if (response.code !== 0) {
                    // Notification using sweetalert lib
                    swalert_notify("Failed", 'Failed to approve the vendor requisition', 'error');
                }
                else {
                    $("#vendor_preq_view_create_order_form").trigger("reset");

                    // Prepare and send a notification
                    var status, msg;
                    status = "success";
                    msg = "Vendor requisition successfully approved";
                    
                    // Notification using helper function 'flash' in utilities (redirect)
                    $.ajax({
                        // Send notification
                        url: `${baseUrlMain}/core/security.php`,
                        method: "POST",
                        data: { "send_notification": 1, "status": status, "msg": msg},                
                        success: function(resp) {
                            // alert(resp);
                        }
                    });

                    // Do a redirect to list roles
                    window.location = `${baseUrlMain}/main.php?dir=vendor_reqs&page=list_preqs`;
                }
            }
        });
    }   
}

function rejectVendorPurchaseRequisition(form_data) {
    // alert("Reject button clicked");

    form_data.push({name: "vendor_preq_approval", value: 4});  // reject (4)
    $.ajax({
        url: `${baseUrlMain}/core/ajax/main/vendor_preqs.php`,
        method: "POST",
        data: form_data,                
        success: function(response) {
            // alert(response);
            response = JSON.parse(response);
            if (response.code !== 0) {
                // Notification using sweetalert lib
                swalert_notify("Failed", 'Failed to reject the vendor requisition', 'error');
            }
            else {
                $("#vendor_preq_view_create_order_form").trigger("reset");

                // Prepare and send a notification
                var status, msg;
                status = "success";
                msg = "Vendor requisition successfully rejected";
                
                // Notification using helper function 'flash' in utilities (redirect)
                $.ajax({
                    // Send notification
                    url: `${baseUrlMain}/core/security.php`,
                    method: "POST",
                    data: { "send_notification": 1, "status": status, "msg": msg},                
                    success: function(resp) {
                        // alert(resp);
                    }
                });

                // Do a redirect to list roles
                window.location = `${baseUrlMain}/main.php?dir=vendor_reqs&page=list_preqs`;
            }
        }
    });
}

/*
 * Manage Vendor Purchase Order
 *
 */

function printVendorPorderInvoice(porderId) {
    window.location.href = `${baseUrlMain}/core/services/invoice_bill.php?vpo_id=${porderId}`;
}

function getVendorById() {
    var vid = $("#vendor_porder_vid").val();
    $.ajax({
        url: `${baseUrlMain}/core/ajax/main/vendors.php`, 
        method: "POST",
        dataType: "text",
        data: { get_vendor_by_id: 1, vendorid: vid },
        success: function(response) {
            // alert(response);
            response = JSON.parse(response);
            $("#vendor_porder_supplier").val(response.name);
        }
    })
};

function calculate_vendor_porder(_discount, _paid, _shipping) {

    var sub_total = 0;
    var vat = 0;
    var total_amt = 0;
    var discount = _discount ? _discount : 0.0;
    var shipping = _shipping ? _shipping : 0.0;
    var grand_total = 0;
    var paid_amt = _paid ? _paid : 0.0;
    var due = 0;

    $(".product_total").each(function() {
        sub_total = sub_total + (parseFloat($(this).text().replace(",", "")));
    });

    vat = 0.075 * sub_total;
    vat = vat.toFixed(2);
    total_amt = sub_total + parseFloat(vat); 
    total_amt = total_amt - parseFloat(discount);
    total_amt = total_amt.toFixed(2);
    grand_total = parseFloat(total_amt) + parseFloat(shipping);
    paid_amt = parseFloat(paid_amt).toFixed(2);
    grand_total = parseFloat(grand_total).toFixed(2);
    due = grand_total - paid_amt;
    due = parseFloat(due).toFixed(2);

    $("#vendor_porder_subtotal").val(sub_total);
    $("#vendor_porder_vat").val(vat);
    $("#vendor_porder_discount").val(discount);
    $("#vendor_porder_total_amt").val(total_amt);
    $("#vendor_porder_shipping").val(shipping);
    $("#vendor_porder_grand_total").val(grand_total);
    $("#vendor_porder_paid_amount").val(paid_amt);
    $("#vendor_porder_due_amount").val(due);
    $("#vendor_porder_payment_status").val("PENDING");
}

function validateVendorPorderDiscount(elem) {
    var discount = $(elem).val();
    var paid = $("#vendor_porder_paid_amount").val();
    var shipping = $("#vendor_porder_shipping").val();
    calculate_vendor_porder(discount, paid, shipping);
}

function validateVendorPorderPaidAmount(elem) {
    var paid = $(elem).val();
    var discount = $("#vendor_porder_discount").val();
    var shipping = $("#vendor_porder_shipping").val();
    calculate_vendor_porder(discount, paid, shipping);
}

function validateVendorPorderShipping(elem) {
    var shipping = $(elem).val();
    var paid = $("#vendor_porder_paid_amount").val();
    var discount = $("#vendor_porder_discount").val();
    calculate_vendor_porder(discount, paid, shipping);
}

function createVendorPurchaseOrder(form_data) {

    console.log(form_data);

    if ($("#picker").val() === "") {
        alert("Please enter the date"); // not necessary
    }
    else if ($("#vendor_porder_descr").val() === "") {
        alert("Please enter purchase order description");
    }
    else if ($("#vendor_porder_issuer_notes").val() === "") {
        alert("Please enter purchase order issuer notes");
    }
    else if ($("#vendor_porder_paid_amount").val() === "") {
        alert("Please enter paid amount");
    }
    else {
        // add the method name
        form_data.push({ name: 'createPurchaseOrder', value: 1 });

        $.ajax({
            url: `${baseUrlMain}/core/ajax/main/vendor_porders.php`,
            method: "POST",
            data: form_data,                                    // $("#vendor_porder_form").serialize(),
            success: function(response) {
                // alert(response);
                response = JSON.parse(response);
                if (response.code !== 0) {
                    // Notification using sweetalert lib
                    swalert_notify("Failed", 'Failed to create new vendor purchase order', 'error');
                }
                else {
                    $("#vendor_porder_form").trigger("reset");
    
                    // Prepare and send a notification
                    var status, msg;
                    status = "success";
                    msg = "Vendor purchase order successfully rejected";
                    
                    // Notification using helper function 'flash' in utilities (redirect)
                    $.ajax({
                        // Send notification
                        url: `${baseUrlMain}/core/security.php`,
                        method: "POST",
                        data: { "send_notification": 1, "status": status, "msg": msg},                
                        success: function(resp) {
                            // alert(resp);
                        }
                    });
    
                    // Do a redirect to list roles
                    window.location = `${baseUrlMain}/main.php?dir=vendor_pos&page=list_porders`;
                }
            }
        });
    }      
}



/*
 * Manage Inline Customer Order
 *
 */

function addNewInlineOrderItemRow() {
    $.ajax({
        url: baseUrlMain+'/core/ajax/main/customer_iorders.php', 
        method: "POST",
        data: { get_new_iorder_item: 1 },
        success: function(response) {
            //alert(response);
            $("#inline_order_item").append(response);

            // set the number fields (auto-incrementing)
            var n = 0;
            $(".number").each(function() {
                $(this).html(++n);  
            });

            // set the hidden input's id field programmatically
            n = 0;
            $(".product_id").each(function() {
                ++n; 
                $(this).attr('id', 'product_' + n); 
            });

            // set the select button's data-xdata attribute field
            n = 0;
            $(".select_product").each(function() {
                $(this).attr('data-xdata', ++n); 
            });
        }
    })
}
    
function inlineOrderItemChangeUpdate(elem) {

    // TODO: Ensure that the product id is NOT repeated
        
    var product_id = $(elem).val(); 
    var tr = $(elem).parent().parent();

    // $(".overlay").show();

    $.ajax({
        url: baseUrlMain+'/core/ajax/main/customer_iorders.php',
        method: "POST",
        dataType: "json",
        data: { get_iorder_item_details: 1, id: product_id },
        success: function(response) {
            // alert(response);
            
            tr.find(".product_name").val(response["product_name"]);

            tr.find(".product_brand_id").val(response["brand_id"]);
            tr.find(".product_brand").html(response["brand"]);
            tr.find(".product_brand").val(response["brand"]);

            tr.find(".product_category_id").val(response["category_id"]);
            tr.find(".product_category").html(response["category"]);
            tr.find(".product_category").val(response["category"]);

            tr.find(".product_descr").html(response["short_descr"]);
            tr.find(".product_descr").val(response["short_descr"]);

            tr.find(".product_unit").val(response["unit"]);
            tr.find(".product_qty").val(1);
            tr.find(".product_rate").val(response["unit_price"]);
            tr.find(".product_total").val( tr.find(".product_qty").val() * tr.find(".product_rate").val() );
            calculate_inline_order(0, 0, 0);
        }
    }); 
}

function calculate_inline_order(_discount, _paid, _shipping) {

    var sub_total = 0;
    var vat = 0;
    var total_amt = 0;
    var discount = _discount ? _discount : 0.0;
    var shipping = _shipping ? _shipping : 0.0;
    var grand_total = 0;
    var paid_amt = _paid ? _paid : 0.0;
    var due = 0;

    $(".product_total").each(function() {
        sub_total = sub_total + ($(this).val() * 1);
    });

    vat = 0.075 * sub_total;
    vat = vat.toFixed(2);
    total_amt = sub_total + parseFloat(vat); 
    total_amt = total_amt - parseFloat(discount);
    total_amt = total_amt.toFixed(2);
    grand_total = parseFloat(total_amt) + parseFloat(shipping);
    paid_amt = parseFloat(paid_amt).toFixed(2);
    grand_total = parseFloat(grand_total).toFixed(2);
    due = grand_total - paid_amt;
    due = parseFloat(due).toFixed(2);

    $("#iorder_subtotal").val(sub_total);
    $("#iorder_vat").val(vat);
    $("#iorder_discount").val(discount);
    $("#iorder_total_amt").val(total_amt);
    $("#iorder_shipping").val(shipping);
    $("#iorder_grand_total").val(grand_total);
    $("#iorder_paid_amount").val(paid_amt);
    $("#iorder_due_amount").val(due);
    $("#iorder_payment_status").val("PENDING");
}

function validateInlineOrderProductQty(elem) {
    var qty = $(elem);
    var tr = $(elem).parent().parent();
    //alert(tr.find(".product_qty").val());
    if (isNaN(qty.val())) {
        alert("Please enter a valid quantity");
        qty.val(1);
    }
    else {
        tr.find(".product_total").val(qty.val() * tr.find(".product_rate").val());
        calculate_inline_order(0, 0, 0);
    }
}

function recalculateInlineOrderDiscount(elem) {
    var discount = $(elem).val();
    var paid = $("#iorder_paid_amount").val();
    var shipping = $("#iorder_shipping").val();
    calculate_inline_order(discount, paid, shipping);
}

function recalculateInlineOrderPaidAmt(elem) {
    var paid = $(this).val();
    var discount = $("#iorder_discount").val();
    var shipping = $("#iorder_shipping").val();
    calculate_inline_order(discount, paid, shipping);
}

function recalculateInlineOrderShipping(elem) {
    var shipping = $(this).val();
    var paid = $("#iorder_paid_amount").val();
    var discount = $("#iorder_discount").val();
    calculate_inline_order(discount, paid, shipping);
}

function createInlineOrder(form_data) {
    // console.log(form_data);

    if ($("#picker").val() === "") {
        alert("Please enter the date"); // not necessary
    }
    else if ($("#iorder_descr").val() === "") {
        alert("Please enter order description");
    }
    else if ($("#iorder_notes").val() === "") {
        alert("Please enter order notes");
    }
    else if ($("#iorder_paid_amount").val() === "") {
        alert("Please enter paid amount");
    }
    else {
        // add the method name
        form_data.push({ name: 'createInlineOrder', value: 1 });
        
        $.ajax({
            url: baseUrlMain+'/core/ajax/main/customer_iorders.php',
            method: "POST",
            data: form_data,
            success: function(response) {
                alert(response);
                // response = JSON.parse(response);

                // if (response.code !== 0) {
                //     // Notification using sweetalert lib
                //     swalert_notify("Failed", 'Failed to create the requisition', 'error');
                // }
                // else {
                //     $("#preq_form").trigger("reset");
    
                //     // Prepare and send a notification
                //     var status, msg;
                //     status = "success";
                //     msg = "Customer purchase requisition successfully created";
                    
                //     // Notification using helper function 'flash' in utilities (redirect)
                //     $.ajax({
                //         // Send notification
                //         url: `${baseUrlMain}/core/security.php`,
                //         method: "POST",
                //         data: { "send_notification": 1, "status": status, "msg": msg},                
                //         success: function(resp) {
                //             // alert(resp);
                //         }
                //     });
    
                //     // Do a redirect to list roles
                //     window.location = `${baseUrlMain}/main.php?dir=customer_reqs&page=list_preqs`;
                // }
            }
        });
    }   
}