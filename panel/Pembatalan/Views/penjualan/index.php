<?= $this->extend('panel/index') ?>
<?= $this->section('content') ?>
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header border-bottom">
                    <h5>Form Pembatalan Penjualan</h5>
                </div>
                <div class="card-body my-1">
                    <?= form_open(uri_string(), ['method' => 'get']); ?>
                    <div class="mb-1">
                        <label>Masukan Kode Transaksi</label>
                        <input class="form-control" name="code">
                    </div>
                    <button class="btn btn-primary">Cari</button>
                    <?= form_close(); ?>
                </div>
            </div>
        </div>
        <?php if ($code) { ?>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <?php
                        if ($transaction) {
                            ?>
                            <div class="table-responsive">
                                <table class="table table-borderless table-sm">
                                    <tbody>
                                    <tr>
                                        <td width="20%">Kode</td>
                                        <td width="3%">:</td>
                                        <td><?= $transaction->transaction_code; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Keterangan</td>
                                        <td>:</td>
                                        <td><?= $transaction->transaction_desc; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal</td>
                                        <td>:</td>
                                        <td><?= dateIndoNumber($transaction->transaction_date); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Pelanggan</td>
                                        <td>:</td>
                                        <td><?= $transaction->customer_phone; ?></td>
                                    </tr>
                                    </tbody>
                                </table>

                            </div>
                            <div class="table-responsive mb-1">
                                <table class="table table-bordered table-sm">
                                    <thead>
                                    <tr>
                                        <th width="3%">No</th>
                                        <th>Produk</th>
                                        <th>Harga</th>
                                        <th>Qty</th>
                                        <th>Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    foreach ($transactionDetails as $i => $detail) {
                                        ?>
                                        <tr>
                                            <td><?= $i + 1; ?></td>
                                            <td><?= $detail->product_name; ?></td>
                                            <td class="text-center"><?= formatUang($detail->transaction_detail_price); ?></td>
                                            <td class="text-center"><?= $detail->transaction_detail_quantity . ' ' . $detail->product_unit; ?></td>
                                            <td class="text-end"><?= formatUang($detail->transaction_detail_total); ?></td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                            <button data-code="<?= $code; ?>" class="btn btn-danger btn-cancel"><i data-feather="x"></i>
                                Batalkan
                            </button>
                        <?php } else { ?>
                            <h3>Transaksi yang dipilih tidak ada dalam database.</h3>
                            <?php
                        } ?>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
<?= $this->endSection() ?>

<?= $this->section('css') ?>
<?= $this->endSection() ?>

<?= $this->section('js') ?>
    <script>
        $('.btn-cancel').click(function () {
            const code = $(this).data('code')
            swalAction({
                url: siteUrl('pembatalan/penjualan/cancel'),
                data: {code},
                textBtn: 'Batal',
                urlBack: '/pembatalan/penjualan'
            })
        })
    </script>
<?= $this->endSection() ?>