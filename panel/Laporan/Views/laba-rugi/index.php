<?= $this->extend('panel/index') ?>
<?= $this->section('content') ?>
<?php
$spaci = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
?>
    <div class="row">
        <div class="col-6 col-md-6">
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
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <div class="text-center">
                        <p>Laporan Laba Rugi</p>
                    </div>
                    <table class="table table-sm ">
                        <tbody>
                        <tr>
                            <td colspan="3" class="fw-bold">Pendapatan</td>
                        </tr>
                        <?php
                        $totalPendapatan = 0;
                        foreach ($pendapatans as $pendapatan) {
                            $totalPendapatan += $pendapatan->total;
                            ?>
                            <tr>
                                <td><?= $spaci . ' ' . $pendapatan->account_name; ?></td>
                                <td class="text-end">Rp. <?= formatUang($pendapatan->total); ?></td>
                                <td></td>
                            </tr>
                            <?php
                        }
                        ?>
                        <tr>
                            <td><?= $spaci ?> Total Pendapatan</td>
                            <td></td>
                            <td class="text-end">Rp. <?= formatUang($totalPendapatan); ?></td>
                        </tr>
                        <tr>
                            <td colspan="3"  class="fw-bold">Beban</td>
                        </tr>
                        <?php
                        $totalBeban = 0;
                        foreach ($bebans as $beban) {
                            $totalBeban += $beban->total;
                            ?>
                            <tr>
                                <td><?= $spaci . ' ' . $beban->account_name; ?></td>
                                <td class="text-end">Rp. <?= formatUang($beban->total); ?></td>
                                <td></td>
                            </tr>
                            <?php
                        }
                        ?>
                        <tr>
                            <td><?= $spaci ?> Total Beban</td>
                            <td></td>
                            <td class="text-end">Rp. <?= formatUang($totalBeban); ?></td>
                        </tr>

                        <tr>
                            <td class="fw-bold">Laba / Rugi</td>
                            <td></td>
                            <td class="text-end fw-bold">Rp. <?= formatUang($totalPendapatan - $totalBeban); ?></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>