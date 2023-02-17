<?= $this->extend('panel/index') ?>
<?= $this->section('content') ?>
<?php
$cookie = \App\Helpers\CookieHelper::getCookie();
?>
<div class="row">
    <div class="col-md-5">
        <div class="card card-congratulations">
            <div class="card-body text-center">
                <img src="<?= base_url('app-assets/images/elements/decore-left.png'); ?>"
                     class="congratulations-img-left"
                     alt="card-img-left"/>
                <img src="<?= base_url('app-assets/images/elements/decore-right.png'); ?>"
                     class="congratulations-img-right"
                     alt="card-img-right"/>
                <div class="avatar avatar-xl bg-primary shadow">
                    <div class="avatar-content">
                        <i data-feather="award" class="font-large-1"></i>
                    </div>
                </div>
                <div class="text-center">
                    <h1 class="mb-1 text-white"><?= $cookie->user_name; ?></h1>
                    <p class="card-text m-auto w-75">
                        Selamat datang di Aplikasi pembayaran.
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-7">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="input-group my-1">
                            <span class="input-group-text" id="basic-addon1">Tanggal :</span>
                            <input type="date" class="form-control" name="date" value="<?= dateNow(); ?>">
                            <button class="btn btn-primary">Filter</button>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card border-4 border-success">
                            <div class="card-header">
                                <div class="flex-column justify-content-between">
                                    <h3 class="">Rp. 300.000.000,-</h3>
                                    <div class="heading-elements">
                                        <h5 class="card-text">Penjualan</h5>
                                    </div>
                                </div>
                                <a href="<?= site_url('transaksi/penjualan/detail'); ?>"
                                   class="btn btn-primary">
                                    <i data-feather='plus-square'></i> Transaksi
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card border-4 border-warning">
                            <div class="card-header">
                                <div class="flex-column justify-content-between">
                                    <h3 class="">Rp. 10.000.000,-</h3>
                                    <div class="heading-elements">
                                        <h5 class="card-text">Pengeluaran</h5>
                                    </div>
                                </div>
                                <a href="<?= site_url('transaksi/pengeluaran'); ?>"
                                   class="btn btn-primary">
                                    <i data-feather='plus-square'></i> Pengeluaran
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<h1>Hello World!</h1>
<pre>
    <?= json_encode(session()->get(), 128); ?>
</pre>

<pre>
    <?= json_encode(\App\Helpers\CookieHelper::getCookie(), 128); ?>
</pre>
<?= $this->endSection() ?>

<?= $this->section('css') ?>
<link rel="stylesheet" href="">
<style></style>
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script></script>
<script src=""></script>
<?= $this->endSection() ?>
