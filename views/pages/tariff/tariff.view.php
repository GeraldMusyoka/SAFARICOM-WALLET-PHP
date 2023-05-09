<?php require base_path('views/partials/dashboard/head.php'); ?>

<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Tariffs</span>
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
                        <h5 class="card-title mb-sm-0 me-2">Tariff List</h5>
                    </div>
                    <div class="card-body mt-3">
                        <div class="card-datatable table-responsive">
                            <table class="invoice-list-table table border-top" aria-label="">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Min</th>
                                        <th>Max</th>
                                        <th>Amount</th>
                                        <th class="cell-fit">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    <?php if(!empty($tariffs)): ?>
                                        <?php foreach($tariffs as $tariff): ?>
                                            <tr>
                                                <td><?php static $i = 1; echo $i++; ?></td>
                                                <td><?= $tariff['min'] ?></td>
                                                <td><?= $tariff['max'] ?></td>
                                                <td><?= $tariff['tariff'] ?></td>
                                                <td>
                                                    <form action="/tariff" method="POST">
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <input type="hidden" name="id" value="<?= $tariff['id'] ?>">
                                                        <button class="btn btn-sm btn-danger">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="5" class="text-center">No Tariff Found</td>
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
                        <h5 class="card-title mb-sm-0 me-2">Withdraw Tariffs</h5>
                    </div>
                    <div class="card-body mt-3">
                        <div class="row">
                            <div class="col-lg-8 mx-auto">
                                <form action="/tariff" method="post">
                                    <div class="row g-3">
                                        <div class="col-md-12">
                                            <label class="form-label" for="name">Min</label>
                                            <input class="form-control" type="number" id="min" name="min"
                                                placeholder="Minimum Amount" />
                                            <?php if (isset($errors['min'])): ?>
                                                <div class="text-danger">
                                                    <?= $errors['min'] ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="col-md-12">
                                            <label class="form-label" for="max">Max</label>
                                            <input class="form-control" type="number" id="max" name="max"
                                                placeholder="Maximum Amount" />
                                            <?php if (isset($errors['max'])): ?>
                                                <div class="text-danger">
                                                    <?= $errors['max'] ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="col-md-12">
                                            <label class="form-label" for="amount">Tariff Amount</label>
                                            <input class="form-control" type="number" id="tariff" name="tariff"
                                                placeholder="Tariff Amount" />
                                            <?php if (isset($errors['tariff'])): ?>
                                                <div class="text-danger">
                                                    <?= $errors['tariff'] ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
    
                                    <div class="row justify-content-end mt-3">
                                        <button type="submit" class="btn btn-primary">
                                            Submit
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