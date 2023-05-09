<?php require base_path('views/partials/dashboard/head.php'); ?>

<!-- Content wrapper -->
<div class="content-wrapper">

    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Top up Transactions</span>
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
                                    <th class="cell-fit">Amount</th>
                                    <th class="cell-fit">Date</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                <?php if(!empty($topuptransactions)) : ?>
                                    <?php foreach($topuptransactions as $transaction) : ?>
                                    <tr>
                                        <td>
                                            <?php static $i = 1; echo $i++; ?>
                                        </td>
                                        <td><?= $transaction['transaction_id'] ?? 'NULL' ?></td>
                                        <td><?= $transaction['phone_number'] ?></td>
                                        <td>
                                            <?php if($transaction['status'] == '1032') : ?>
                                                <span class="badge bg-label-info"> CANCELLED </span>
                                            <?php elseif($transaction['status'] != '0') :?>
                                                <span class="badge bg-label-danger"> Failed </span>
                                            <?php else: ?>
                                                <span class="badge bg-label-success"> SUCCESSFUL </span>
                                            <?php endif; ?>
                                        </td>
                                        <td><?= $transaction['amount'] ?></td>
                                        <td>
                                            <?= $transaction['created_at'] ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                <?php else: ?>
                                <tr>
                                    <td colspan="6" class="text-center">No Topup Transaction Found</td>
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