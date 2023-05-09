<?php require base_path('views/partials/dashboard/head.php'); ?>
<!-- Layout wrapper -->

<!-- Content wrapper -->
<div class="content-wrapper">

    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        
        <h4 class="fw-bold py-3 mb-2">Dashboard Home</h4>

        <!-- Role cards -->
        <div class="row g-4">
            <div class="col-xl-4 col-lg-6 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-end">
                            <div class="role-heading">
                                <h4 class="mb-1">Top up</h4>
                                <a href="/topup" class="role-edit-modal">
                                    <small>View</small></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-end">
                            <div class="role-heading">
                                <h4 class="mb-1">Withdraw</h4>
                                <a href="/withdraw" class="role-edit-modal">
                                    <small>View</small></a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-end">
                            <div class="role-heading">
                                <h4 class="mb-1">Top up Transactions</h4>
                                <a href="/topup-transactions" class="role-edit-modal">
                                    <small>View</small></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-end">
                            <div class="role-heading">
                                <h4 class="mb-1">Customers</h4>
                                <a href="/customers" class="role-edit-modal">
                                    <small>View</small></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-end">
                            <div class="role-heading">
                                <h4 class="mb-1">Bulk Withdraw</h4>
                                <a href="/withdraw-bulk" class="role-edit-modal">
                                    <small>View</small></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-end">
                            <div class="role-heading">
                                <h4 class="mb-1">Withdraw Transactions</h4>
                                <a href="/withdraw-transactions" class="role-edit-modal">
                                    <small>View</small></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ Role cards -->

    </div>
    <!-- / Content -->

<?php require base_path('views/partials/dashboard/foot.php'); ?>