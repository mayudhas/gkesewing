<?= $this->extend('panel/index') ?>
<?= $this->section('content') ?>
    <div class="row">
        <div class="col-12 col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5>Pilih Periode Awal dan Akhir</h5>
                </div>
                <div class="card-body">
                    <form action="" method="get">
                        <div class="row">
                            <div class="col-12 col-md-5">
                                <div class="form-group">
                                    <input type="date" class="form-control" name="start" value="<?= $start ?>" required>
                                </div>
                            </div>
                            <div class="col-12 col-md-5">
                                <div class="form-group">
                                    <input type="date" class="form-control" name="end" value="<?= $end ?>" required>
                                </div>
                            </div>
                            <div class="col-12 col-md-2">
                                <div class="form-group">
                                    <button class="btn btn-gradient-primary">Tampilkan</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Nama Akun/Tanggal</th>
                            <th>Transaksi</th>
                            <th>Nomor</th>
                            <th>Keterangan</th>
                            <th>Debit</th>
                            <th>Kredit</th>
                            <th>Saldo</th>
                            <th>Tags</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if (!(count($laporan) > 0)) { ?>
                            <tr>
                                <td colspan="8" class="fw-bolder text-center">Data Kosong</td>
                            </tr>
                        <?php } else { ?>
                        <?php foreach ($laporan as $val) { ?>
                            <tr>
                                <td colspan="8" class="fw-bolder">(<?= $val->account_code ?>
                                    ) <?= $val->account_name ?></td>
                            </tr>
                            <?php foreach ($val->detail as $detail) { ?>
                                <tr>
                                    <td><?= $detail->ledger_date ?></td>
                                    <td>Sales Invoice</td>
                                    <td><?= $detail->ledger_number ?></td>
                                    <td><?= $detail->ledger_desc ?></td>
                                    <td class="text-end"><?= $detail->uti_account_post_id == 1 ? formatUang($detail->ledger_detail_score) : 0 ?></td>
                                    <td class="text-end"><?= $detail->uti_account_post_id == 2 ? formatUang($detail->ledger_detail_score) : 0 ?></td>
                                    <td class="text-end"><?= formatUang($detail->total) ?></td>
                                    <td></td>
                                </tr>
                            <?php } ?>
                            <tr>
                                <td colspan="4" class="text-end">((<?= $val->account_code ?>) <?= $val->account_name ?>)
                                    | Saldo Akhir
                                </td>
                                <td class="text-end fw-bolder"><?= formatUang($val->debit) ?></td>
                                <td class="text-end fw-bolder"><?= formatUang($val->kredit) ?></td>
                                <td class="text-end fw-bolder"><?= formatUang($val->debit + $val->kredit) ?></td>
                                <td></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                        <?php } ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>