<?php require base_path('views/partials/dashboard/head.php'); ?>

<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Customers</span>
        </h4>
        <?php if (isset($success)): ?>
            <div class="alert alert-success">
                <?= $success ?>
            </div>
        <?php endif; ?>
        <!-- Sticky Actions -->
        <div class="row">
            <!-- Activity Timeline -->
            <div class="col-md-12 col-lg-6 order-4 order-lg-3 ">
                <div class="card">
                    <div class="card-header sticky-element bg-label-secondary d-flex
                        justify-content-sm-between align-items-sm-center flex-column flex-sm-row">
                        <h5 class="card-title mb-sm-0 me-2">Customer List</h5>
                    </div>
                    <div class="card-body mt-3">
                        <div class="card-datatable table-responsive">
                            <table class="invoice-list-table table border-top"
                                aria-label="Customer List">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th class="cell-fit">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    <?php if(!empty($customers)): ?>
                                        <?php foreach($customers as $customer): ?>
                                            <tr>
                                                <td>
                                                    <?php static $i = 1; echo $i++; ?>
                                                </td>
                                                <td><?= $customer['name'] ?></td>
                                                <td><?= $customer['email'] ?></td>
                                                <td><?= $customer['phone'] ?></td>
                                                <td>
                                                    <div class="col">
                                                        <form method="POST">
                                                            <input type="hidden" name="_method" value="DELETE">
                                                            <input type="hidden" name="id"
                                                                value="<?= $customer['id'] ?>">
                                                            <button class="btn btn-danger" type="submit">
                                                                Delete
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="5" class="text-center">No Customer Found</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ Activity Timeline -->

            <div class="col-md-12 col-lg-6 order-4 order-lg-3 ">
                <div class="card">
                    <div class="card-header sticky-element bg-label-secondary d-flex
                        justify-content-sm-between align-items-sm-center flex-column flex-sm-row">
                        <h5 class="card-title mb-sm-0 me-2">Add Customer</h5>
                    </div>
                    <div class="card-body mt-3">
                        <div class="row">
                            <div class="col-lg-8 mx-auto">
                                <form method="POST">
                                    <div class="row g-3">
                                        <div class="col-md-12">
                                            <label class="form-label" for="name">Name</label>
                                            <input class="form-control" type="text" id="name"
                                                name="name" placeholder="Customer Name" aria-label="name"
                                                    value="<?= (isset($errors['name'])) ? $_POST['name'] : '' ?>"
                                                    aria-describedby="name" />
                                            <?php if (isset($errors['name'])): ?>
                                                <div class="text-danger">
                                                    <?= $errors['name'] ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="col-md-12">
                                            <label class="form-label" for="email">Email</label>
                                            <input class="form-control" type="email" id="email" name="email"
                                                placeholder="Customer email" aria-label="email"
                                                    value="<?= (isset($errors['email'])) ? $_POST['email'] : '' ?>"
                                                    aria-describedby="email" />
                                            <?php if (isset($errors['email'])): ?>
                                                <div class="text-danger">
                                                    <?= $errors['email'] ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="col-md-12">
                                            <label class="form-label" for="phone">Phone</label>
                                            <input class="form-control" type="text" id="phone" name="phone"
                                                placeholder="Customer phone" aria-label="phone"
                                                    value="<?= (isset($errors['phone'])) ? $_POST['phone'] : '' ?>"
                                                    aria-describedby="phone" />
                                            <?php if (isset($errors['phone'])): ?>
                                                <div class="text-danger">
                                                    <?= $errors['phone'] ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
    
                                    <div class="row justify-content-end mt-3">
                                        <button type="submit" class="btn btn-primary">
                                            Add
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Sticky Actions -->
</div>
<!-- / Content -->

<?php require base_path('views/partials/dashboard/foot.php'); ?>