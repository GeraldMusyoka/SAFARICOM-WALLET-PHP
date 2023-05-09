<?php require base_path('views/partials/dashboard/head.php'); ?>

<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Top up</span>
        </h4>
        <!-- Sticky Actions -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header sticky-element bg-label-secondary d-flex
                        justify-content-sm-between align-items-sm-center flex-column flex-sm-row">
                        <h5 class="card-title mb-sm-0 me-2">Top up Wallet</h5>
                        <div class="action-btns">
                            <a href="/home" class="btn btn-label-primary me-3">
                                <span class="align-middle"> Home</span>
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
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
                                <!-- 1. Delivery Address -->
                                <form class="row g-3 mt-3" action="/topup" method="POST">
                                    <div class="col-md-12">
                                        <label class="form-label" for="phone">Phone</label>
                                        <input type="text" id="phone" class="form-control"
                                            placeholder="254712345678" name="phone" />
                                        <?php if (isset($errors['phone'])) : ?>
                                            <div class="text-danger">
                                                <?= $errors['phone'] ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label" for="amount">Amount</label>
                                        <div class="input-group input-group-merge">
                                            <input class="form-control" type="number" id="amount"
                                                name="amount" placeholder="1000" />
                                        </div>
                                        <?php if (isset($errors['amount'])) : ?>
                                            <div class="text-danger">
                                                <?= $errors['amount'] ?>
                                            </div>
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