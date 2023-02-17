<?= $this->extend('panel/index') ?>
<?= $this->section('content') ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>Data Transaksi</h5>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li>
                                <a href="<?= site_url(uri_string() . '/detail'); ?>"
                                   class="btn btn-primary">
                                    <i data-feather='plus-square'></i> Transaksi
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <?= form_open(uri_string(), ['method' => 'get']); ?>
                            <div class="input-group mb-1">
                                <input type="date" class="form-control date-start" name="start"
                                       value="<?= $date_start ?>">
                                <span class="input-group-text bg-gray">S/D</span>
                                <input type="date" class="form-control date-end" name="end" value="<?= $date_end ?>">
                                <button class="btn btn-primary">Filter</button>
                            </div>
                            <?= form_close(); ?>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered" style="width: 100%">
                            <thead class="text-center">
                            <tr>
                                <th width="3%">#</th>
                                <th width="10%">Tanggal</th>
                                <th width="13%">Pegawai</th>
                                <th width="13%">Pelanggan</th>
                                <th>Keterangan</th>
                                <th width="13%">Total</th>
                                <th width="5%">View</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $totalAll = 0;
                            foreach ($transactions as $i => $transaction) {
                                $totalAll += $transaction->total;
                                ?>
                                <tr>
                                    <td><?= $i + 1; ?></td>
                                    <td class="text-center"><?= dateIndoNumber($transaction->transaction_date); ?></td>
                                    <td><?= $transaction->employee_name; ?></td>
                                    <td><?= $transaction->customer_phone; ?></td>
                                    <td><?= $transaction->transaction_desc; ?></td>
                                    <td class="text-end"><?= formatUang($transaction->total); ?></td>
                                    <td class="text-center">
                                        <button class="btn btn-warning btn-sm">Print</button>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                            </tbody>
                            <tfoot>
                            <tr>
                                <td colspan="5">T O T A L</td>
                                <td class="text-end fw-bold"><?= formatUang($totalAll); ?></td>
                                <td></td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>

<?= $this->section('css') ?>
    <link rel="stylesheet" type="text/css"
          href="<?= base_url('app-assets/vendors/css/tables/datatable/dataTables.bootstrap5.min.css') ?>">
<?= $this->endSection() ?>

<?= $this->section('js') ?>
    <script src="<?= base_url('app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js') ?>"></script>
    <script src="<?= base_url('app-assets/vendors/js/tables/datatable/dataTables.bootstrap5.min.js') ?>"></script>
    <script>$("table").DataTable()</script>
<?= $this->endSection() ?>