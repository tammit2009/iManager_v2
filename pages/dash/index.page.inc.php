
<?php permit('ADMIN', true, false); ?>

<?php if (permit('ADMIN', false, false)): ?>
<div class="row mb-4">
    <div class="col-md-12">
        <div class="card-deck">
            <div class="card">
                <img class="card-img-top" src="./assets/imgs/blank_235x200.svg" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">Company A</h5>
                    <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                    <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                </div>
            </div>
            <div class="card">
                <img class="card-img-top" src="./assets/imgs/blank_235x200.svg" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">Company B</h5>
                    <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
                    <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                </div>
            </div>
            <div class="card">
                <img class="card-img-top" src="./assets/imgs/blank_235x200.svg" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">Company C</h5>
                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer content than the first to show that equal height action.</p>
                    <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>


<?php if (permit('DASHBOARD_COMPANY_A', false, false)): ?>
<div class="row mb-4">
    <div class="col-md-6">
        <div class="card text-center">
            <div class="card-header">
                <ul class="nav nav-pills card-header-pills">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Active</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" href="#">Disabled</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <h5 class="card-title">Company A</h5>
                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>


<?php if (permit('DASHBOARD_COMPANY_B', false, false)): ?>
<div class="row mb-4">
    <div class="col-md-4">
        <div class="card text-center">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Active</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" href="#">Disabled</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <h5 class="card-title">Company B</h5>
                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>


<?php if (permit('DASHBOARD_COMPANY_C', false, false)): ?>
<div class="row mb-4">
    <div class="col-md-8">
        <div class="card">
            <h5 class="card-header">Featured</h5>
            <div class="card-body">
                <h5 class="card-title">Company C</h5>
                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                <a href="#" class="btn btn-info">Read</a>
                <?php if (permit('ADMIN', false, false)): ?>
                    <a href="#" class="btn btn-primary">Create</a>
                    <a href="#" class="btn btn-secondary">Edit</a>
                    <a href="#" class="btn btn-warning">Delete</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>