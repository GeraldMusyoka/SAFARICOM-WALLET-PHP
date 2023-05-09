<?php require base_path('views/partials/dashboard/head.php'); ?>

<!-- Content wrapper -->
<div class="content-wrapper">
    
    <!-- Content -->
    
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Bulk Withdraw</span>
        </h4>
        
        <!-- Sticky Actions -->
        <div class="row">
            <!-- Activity Timeline -->
            <div class="col-md-12 col-lg-6 order-4 order-lg-3 ">
                <div class="card">
                    <div class="card-header sticky-element bg-label-secondary d-flex
                        justify-content-sm-between align-items-sm-center flex-column flex-sm-row">
                        <h5 class="card-title mb-sm-0 me-2">Withdraw Tariffs</h5>
                    </div>
                    <div class="card-body mt-3">
                        <!-- Activity Timeline -->
                        <ul class="timeline">
                            <?php if (!empty($tariffs)) : ?>
                                <?php foreach ($tariffs as $tariff) : ?>
                                    <li class="timeline-item timeline-item-transparent">
                                        <span class="timeline-point timeline-point-primary"></span>
                                        <div class="timeline-event">
                                            <div class="timeline-header mb-1">
                                                <h6 class="mb-0"><?= $tariff['min'] ?> - <?= $tariff['max'] ?></h6>
                                                <small class="text-muted">KES <?= $tariff['tariff'] ?></small>
                                            </div>
                                        </div>
                                    </li>
                                <?php endforeach ?>
                            <?php else : ?>
                                <li class="timeline-item timeline-item-transparent">
                                    <span class="timeline-point timeline-point-primary"></span>
                                    <div class="timeline-event">
                                        <div class="timeline-header mb-1">
                                            <h6 class="mb-0">No Tariffs</h6>
                                        </div>
                                    </div>
                                </li>
                            <?php endif; ?>
                        </ul>
                        <!-- /Activity Timeline -->
                    </div>
                </div>
            </div>
            <!--/ Activity Timeline -->

            <div class="col-md-12 col-lg-6 order-4 order-lg-3 ">
                <div class="card">
                    <div class="card-header sticky-element bg-label-secondary d-flex
                        justify-content-sm-between align-items-sm-center flex-column flex-sm-row">
                        <h5 class="card-title mb-sm-0 me-2">Withdraw to Customers</h5>
                    </div>
                    <div class="card-body mt-3">
                        <div class="row">
                            <?php if (!empty($errors)) : ?>
                                <div class="alert alert-danger">
                                    <ul>
                                        <?php foreach ($errors as $error) : ?>
                                            <?php if (is_array($error)) : ?>
                                                <?php foreach ($error as $message) : ?>
                                                    <li><?= $message ?></li>
                                                <?php endforeach; ?>
                                            <?php else : ?>
                                                <li><?= $error ?></li>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            <?php endif; ?>
                            <?php if (isset($success)) : ?>
                                <div class="alert alert-success mt-2">
                                    <?= $success ?>
                                </div>
                            <?php endif; ?>
                            <?php if (isset($error)) : ?>
                                <div class="alert alert-warning mt-2">
                                    <?= $error ?>
                                </div>
                            <?php endif; ?>
                            <form class="col-lg-8 mx-auto" method="POST" action="/withdraw-bulk">
                                <input type="hidden" name="client" value="<?= $_SESSION['user']['id']; ?>">
                                <?php if (!empty($customers)) : ?>
                                    <?php foreach ($customers as $customer) : ?>
                                        <div class="row g-3 p-2">
                                            <div class="col-md-6">
                                                <input type="checkbox" class="form-check-input" name="customers[<?= $customer['id']; ?>][id]" value="<?= $customer['id']; ?>" id="customer-<?= $customer['id']; ?>" />
                                                <label class="form-check-label" for="customer-<?= $customer['id']; ?>">
                                                    <?= $customer['name']; ?>
                                                </label>

                                            </div>
                                            <div class="col-md-6">
                                                <div class="input-group input-group-merge">
                                                    <input class="form-control" type="number" name="customers[<?= $customer['id']; ?>][amount]" id="amount-<?= $customer['id']; ?>" placeholder="1000" />
                                                </div>
                                                <?php if (
                                                    isset($_POST['customers'][$customer['id']]['id'])
                                                    && empty($_POST['customers'][$customer['id']]['id'])
                                                ) : ?>
                                                    <p class="text text-danger">
                                                        Please select this customer
                                                    </p>
                                            </div>
                                        <?php elseif (
                                                    isset($_POST['customers'][$customer['id']]['amount'])
                                                    && empty($_POST['customers'][$customer['id']]['amount'])
                                                ) : ?>
                                            <p class="text text-danger">
                                                Please enter an amount for this customer
                                            </p>
                                        <?php endif; ?>
                                        </div>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <div>
                                        <p>No customers found</p>
                                    </div>
                                <?php endif; ?>
                                <div class=" justify-content-end mt-3">
                                    <?php if (!empty($customers)) : ?>
                                        <button type="submit" class="btn btn-primary">
                                            Submit
                                        </button>
                                    <?php endif; ?>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Sticky Actions -->
    </div>
    
    <!-- / Content -->

    <?php require base_path('views/partials/dashboard/foot.php'); ?>