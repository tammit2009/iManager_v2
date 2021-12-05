
<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="./index.php">
        <div class="sidebar-brand-icon">
            <i class="fas fa-server"></i>
        </div>
        <div class="sidebar-brand-text mx-3">iManager</div>
    </a>

    <hr class="sidebar-divider my-0">

    <!-- Dashboard Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseDashboard"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
        <div id="collapseDashboard" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-custom1 py-2 collapse-inner rounded">
                <a class="collapse-item" href="./dashboard.php">Default</a>
                <a class="collapse-item" href="./main.php?dir=stats&page=events">Events</a>
                <a class="collapse-item" href="./main.php?dir=stats&page=requests">Requests</a>
            </div>
        </div>
    </li>

    <hr class="sidebar-divider">

    <!-- Projects -->
    <li class="nav-item">
        <a class="nav-link" href="./dashboard.php?page=project_tasks">
            <i class="fas fa-fw fa-clipboard-check"></i>
            <span>Project</span></a>
    </li>

    <hr class="sidebar-divider">
    
    <!-- Messaging -->
    <li class="nav-item">
        <a class="nav-link" href="./messages.php?page=inbox">
            <i class="fas fa-fw fa-inbox"></i>
            <span>Messages</span>
        </a>
    </li>

    <!-- Notifications -->
    <li class="nav-item">
        <a class="nav-link" href="./notifications.php?page=notification_list">
            <i class="fas fa-fw fa-exclamation-triangle"></i>
            <span>Notifications</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    <!-- Catalogue Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCatalog"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cubes"></i>
            <span>Catalog</span>
        </a>
        <div id="collapseCatalog" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-custom1 py-2 collapse-inner rounded">
                <a class="collapse-item" href="./main.php?dir=brands&page=list_brands">Brands</a>
                <a class="collapse-item" href="./main.php?dir=categories&page=list_categories">Categories</a>
                <a class="collapse-item" href="./main.php?dir=products&page=list_products">Products</a>
            </div>
        </div>
    </li>

    <!-- Inventory Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseInventory"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-industry"></i>
            <span>Inventory</span>
        </a>
        <div id="collapseInventory" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-custom1 py-2 collapse-inner rounded">
                <a class="collapse-item" href="./main.php?dir=stats&page=stock_txns">Stock Transactions</a>
                <a class="collapse-item" href="./main.php?dir=stock&page=list_stock">Stock List</a>
                <a class="collapse-item" href="./main.php?dir=stock&page=sku_tool">SKU Tool</a>
            </div>
        </div>
    </li>

    <hr class="sidebar-divider">

    <!-- Organizations Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOrg"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-landmark"></i>
            <span>Organizations</span>
        </a>
        <div id="collapseOrg" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-custom1 py-2 collapse-inner rounded">
                <a class="collapse-item" href="./main.php?dir=domains&page=list_domains">Domains</a>
                <a class="collapse-item" href="./main.php?dir=orgs&page=list_organizations">Organizations</a>
                <a class="collapse-item" href="./main.php?dir=subdoms&page=list_subdoms">Subdomains</a>
                <a class="collapse-item" href="./main.php?dir=members&page=list_members">Members</a>
                <a class="collapse-item" href="./main.php?dir=subdoms&page=list_store_units">Store Units</a>
            </div>
        </div>
    </li>
    
    <!-- Vendors Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseVendor"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-store"></i>
            <span>Vendors</span>
        </a>
        <div id="collapseVendor" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-custom1 py-2 collapse-inner rounded">
                <a class="collapse-item" href="./main.php?dir=vendor_pos&page=list_porders">Purchase Orders</a>
                <a class="collapse-item" href="./main.php?dir=vendor_reqs&page=list_preqs">Purchase Requisitions</a>
                <a class="collapse-item" href="./main.php?dir=vproducts&page=list_vproducts">Vendor Products</a>
                <a class="collapse-item" href="./main.php?dir=vendors&page=list_vendors">Vendors</a>
            </div>
        </div>
    </li>

    <!-- Customers Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-users"></i>
            <span>Customers</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-custom1 py-2 collapse-inner rounded">
                <a class="collapse-item" href="./main.php?dir=customer_pos&page=list_iorders">Inline Order</a>
                <a class="collapse-item" href="./main.php?dir=customer_pos&page=list_porders">Purchase Orders</a>
                <a class="collapse-item" href="./main.php?dir=customer_reqs&page=list_preqs">Purchase Requisitions</a>
                <a class="collapse-item" href="./main.php?dir=store_reqs&page=list_requisitions">Store Requisitions</a>
                <a class="collapse-item" href="./main.php?dir=customers&page=list_customers">Customers</a>
            </div>
        </div>
    </li>    

    <hr class="sidebar-divider">

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseGroupsAndRoles"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-users-cog"></i>
            <span>Groups & Roles</span>
        </a>
        <div id="collapseGroupsAndRoles" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-custom1 py-2 collapse-inner rounded">
                <a class="collapse-item" href="./main.php?dir=pagrs&page=list_pagrs">Page Access Groups</a>
                <a class="collapse-item" href="./main.php?dir=groups&page=list_groups">Groups</a>
                <a class="collapse-item" href="./main.php?dir=roles&page=list_roles">Roles</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUsers"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-users"></i>
            <span>Users</span>
        </a>
        <div id="collapseUsers" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-custom1 py-2 collapse-inner rounded">
                <a class="collapse-item" href="./main.php?dir=doperators&page=list_doperators">Domain Operators</a>
                <a class="collapse-item" href="./main.php?dir=subdom_users&page=list_subdom_users">Subdomain Users</a>
                <a class="collapse-item" href="./main.php?dir=users&page=list_users">Users</a>
                
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSettings"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Settings</span>
        </a>
        <div id="collapseSettings" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-custom1 py-2 collapse-inner rounded">
                <a class="collapse-item" href="./main.php?dir=settings&page=access_control">Access Control</a>
                <a class="collapse-item" href="./main.php?dir=settings&page=settings">System Settings</a>
            </div>
        </div>
    </li>

    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->