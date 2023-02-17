<?= $this->extend('panel/index') ?>
<?= $this->section('content') ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row justify-content-between">
                        <div class="col-md-5">
                            <?= form_open(uri_string(), ['method' => 'get']); ?>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1">Periode :</span>
                                <select class="form-select" name="month">
                                    <?php
                                    array_walk($months, function ($month, $i) use ($params) {
                                        $selected = $params['month'] == $i ? 'selected' : '';
                                        echo "<option $selected value='$i'>$month</option>";
                                    })
                                    ?>
                                </select>
                                <select class="form-select" name="year">
                                    <?php
                                    for ($i = startYear(); $i <= date('Y'); $i++) {
                                        $selected = $params['year'] == $i ? 'selected' : '';
                                        echo "<option $selected value='$i'>$i</option>";
                                    }
                                    ?>
                                </select>
                                <button class="btn btn-primary">Filter</button>
                                <?= form_close(); ?>
                            </div>
                        </div>
                        <div class="col-md-2 d-grid">
                            <a href="<?= site_url(uri_string() . "/detail?month={$params['month']}&year={$params['year']}"); ?>"
                               class="btn btn-primary">
                                <i data-feather="plus"></i> Catat Buku
                            </a>
                        </div>
                    </div>
                    <?php
                    if ($params) { ?>
                        <div class="table-responsive mt-1">
                            <table class="table table-bordered" style="width: 100%">
                                <thead class="text-center">
                                <tr>
                                    <th rowspan="2">Tanggal</th>
                                    <th width="3%" class="text-center" rowspan="2">No.</th>
                                    <th rowspan="2">Keterangan</th>
                                    <th rowspan="2">Nama</th>
                                    <th rowspan="2">Kode</th>
                                    <th rowspan="2">Rekening</th>
                                    <th colspan="<?= count($posts); ?>">Belanja</th>
                                    <th rowspan="2">Sisa</th>
                                </tr>
                                <tr>
                                    <?php array_walk($posts, function ($post) {
                                        echo "<th>$post->uti_account_post_name</th>";
                                    }) ?>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $jmlDetails = 1;
                                $count = 1;
                                $totalDebit = 0;
                                $totalCredit = 0;
                                foreach ($ledgers as $ledger) {
                                    $totalDebit += $ledger->debit_score;
                                    $totalCredit += $ledger->kredit_score;
                                    $jml_row = $ledger->jml_row;
                                    if ($count === 1) {
                                        $saldo = $ledger->debit_score;
                                    } else {
                                        if ($ledger->debit_score != 0) {
                                            $saldo = $saldo + $ledger->debit_score;
                                        } else {
                                            $saldo = $saldo - $ledger->credit_score;
                                        }
                                    }
                                    ?>
                                    <tr>
                                        <?php if ($jmlDetails <= 1) { ?>
                                            <td rowspan="<?= $jml_row; ?>"><?= dateIndoNumber($ledger->ledger_date); ?></td>
                                            <td rowspan="<?= $jml_row; ?>"><?= sprintfNumber($ledger->ledger_number); ?></td>
                                            <td rowspan="<?= $jml_row; ?>"><?= $ledger->ledger_desc; ?></td>
                                            <td rowspan="<?= $jml_row; ?>"><?= $ledger->ledger_name; ?></td>
                                            <?php
                                            $jmlDetails = $jml_row;
                                        } else {
                                            $jmlDetails = $jmlDetails - 1;
                                        }
                                        ?>
                                        <td><?= $ledger->account_code; ?></td>
                                        <td><?= $ledger->account_name; ?></td>
                                        <td class="text-end"><?= formatUang($ledger->debit_score); ?></td>
                                        <td class="text-end"><?= formatUang($ledger->credit_score); ?></td>
                                        <td class="text-end"><?= formatUang($saldo); ?></td>
                                    </tr>
                                    <?php
                                    $count++;
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    <?php } else {
                        echo msgAlert('Pilih Periode.');
                    } ?>
                </div>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>

<?= $this->section('css') ?>

<?= $this->endSection() ?>

<?= $this->section('js') ?>
<?= $this->endSection() ?>