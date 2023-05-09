<?php require base_path('views/partials/dashboard/head.php'); ?>

<!-- Content wrapper -->
<div class="content-wrapper">

    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Withdraw Transactions</span>
        </h4>

        <!-- Role cards -->
        <div class="row g-4">
            <div class="col-12">
                <!-- Role Table -->
                <div class="card">
                    <div class="card-datatable table-responsive">
                        <table class="datatables-basic table border-top">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>#</th>
                                    <th>TrxId</th>
                                    <th>Phone</th>
                                    <th>Status</th>
                                    <th>Amount</th>
                                    <th>Tariff</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                <?php if (!empty($withdrawtransactions)) : ?>
                                    <?php foreach ($withdrawtransactions as $withdrawtransaction) : ?>
                                        <tr>
                                            <td><?php static $i = 1; echo $i++ ?></td>
                                            <td><?= $withdrawtransaction['transaction_id'] ?? 'NULL' ?></td>
                                            <td><?= $withdrawtransaction['phone_number'] ?></td>
                                            <td>
                                                <?php if ($withdrawtransaction['status'] == 'pending' || $withdrawtransaction['status'] != '0') : ?>
                                                    <span class="badge bg-label-danger"> Failed </span>
                                                <?php else : ?>
                                                    <span class="badge bg-label-success"> Successful </span>
                                                <?php endif; ?>
                                            </td>
                                            <td><?= $withdrawtransaction['amount'] ?></td>
                                            <td><?= $withdrawtransaction['tariff'] ?></td>
                                            <td><?= $withdrawtransaction['created_at'] ?></td>
                                        </tr>
                                    <?php endforeach ?>
                                <?php else : ?>
                                    <tr>
                                        <td colspan="7" class="text-center">No Withdraw Transactions</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!--/ Role Table -->
            </div>
        </div>
        <!--/ Role cards -->

    </div>
    <!-- / Content -->

    <?php require base_path('views/partials/dashboard/foot.php'); ?>