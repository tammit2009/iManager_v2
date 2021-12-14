
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

    <!-- Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="./dashboard.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <!-- Profile -->
    <li class="nav-item">
        <a class="nav-link" href="./messages.php?page=inbox">
            <i class="fas fa-fw fa-inbox"></i>
            <span>My Profile</span>
        </a>
    </li>
    
    <!-- Messaging -->
    <li class="nav-item">
        <a class="nav-link" href="./messages.php?page=inbox">
            <i class="fas fa-fw fa-inbox"></i>
            <span>Messages</span>
        </a>
    </li>

    <!-- Stores -->
    <li class="nav-item">
        <a class="nav-link" href="./messages.php?page=inbox">
            <i class="fas fa-fw fa-inbox"></i>
            <span>My Stores</span>
        </a>
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

    <!-- Notifications -->
    <li class="nav-item mb-4">
        <a class="nav-link" href="./notifications.php?page=notification_list">
            <i class="fas fa-fw fa-exclamation-triangle"></i>
            <span>Contact Support</span>
        </a>
    </li>

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->