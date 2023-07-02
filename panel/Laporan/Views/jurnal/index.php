<?= $this->extend('panel/index') ?>
<?= $this->section('content') ?>
    <div class="row">
        <div class="col-12 col-md-5">
            <div class="card">
                <div class="card-header">
                    <h5>Pilih Periode</h5>
                </div>
                <div class="card-body">
                    <div class="row justify-content-between">
                        <div class="col-12">
                            <?= form_open("", ['method' => 'get']); ?>
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
                                <button class="btn btn-primary">Tampilkan</button>
                                <?= form_close(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive mt-1">
                        <table class="table table-bordered" style="width: 100%">
                            <thead class="text-center">
                            <tr>
                                <th rowspan="2">Tanggal</th>
                                <th rowspan="2">Keterangan</th>
                                <th rowspan="2">Rekening</th>
                                <th colspan="<?= count($posts); ?>">Belanja</th>
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
                                ?>
                                <tr>
                                    <?php if ($jmlDetails <= 1) { ?>
                                        <td rowspan="<?= $jml_row; ?>"><?= dateIndoNumber($ledger->ledger_date); ?></td>
                                        <td rowspan="<?= $jml_row; ?>"><?= $ledger->ledger_desc; ?></td>
                                        <?php
                                        $jmlDetails = $jml_row;
                                    } else {
                                        $jmlDetails = $jmlDetails - 1;
                                    }
                                    ?>
                                    <td><?= $ledger->account_name; ?></td>
                                    <td class="text-end"><?= formatUang($ledger->debit_score, true); ?></td>
                                    <td class="text-end"><?= formatUang($ledger->credit_score, true); ?></td>
                                </tr>
                                <?php
                                $count++;
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>