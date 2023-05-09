<?php require base_path('views/partials/dashboard/head.php'); ?>

<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Withdraw</span>
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
                                                <h6 class="mb-0">
                                                    <?= $tariff['min'] ;?> - <?= $tariff['max'] ; ?>
                                                </h6>
                                                <small class="text-muted">KES <?= $tariff['tariff'] ; ?></small>
                                            </div>
                                        </div>
                                    </li>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <li class="timeline-item timeline-item-transparent">
                                    <span class="timeline-point timeline-point-primary"></span>
                                    <div class="timeline-event">
                                        <div class="timeline-header mb-1">
                                            <h6 class="mb-0">No Tariff Added</h6>
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
                        <h5 class="card-title mb-sm-0 me-2">Withdraw from Wallet</h5>
                    </div>
                    <div class="card-body mt-3">
                        <div class="row">
                            <div class="col-lg-8 mx-auto">
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
                                <form class="row g-3" action="/withdraw" method="POST" />
                                <div class="col-md-12">
                                    <label class="form-label" for="phone">Phone</label>
                                    <input type="number" id="phone" class="form-control" placeholder="254712345678" name="phone" />
                                    <?php if (isset($errors['phone'])) : ?>
                                        <p class="text text-danger">
                                            <?= $errors['phone']; ?>
                                        </p>
                                    <?php endif; ?>

                                </div>
                                <div class="col-md-12">
                                    <label class="form-label" for="amount">Amount</label>
                                    <div class="input-group input-group-merge">
                                        <input class="form-control" type="number" id="amount" placeholder="1000" name="amount" />
                                    </div>
                                    <?php if (isset($errors['amount'])) : ?>
                                        <p class="text text-danger">
                                            <?= $errors['amount']; ?>
                                        </p>
                                    <?php endif; ?>
                                </div>
                                <div class="justify-content-end">
                                    <button type="submit" class="btn btn-primary">
                                        Submit
                                    </button>
                                </div>
                                </form>
                                <hr>
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