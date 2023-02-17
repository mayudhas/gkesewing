<?php

use App\Helpers\CookieHelper;

?>
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
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#modalTambahPengeluaran">
                                <i data-feather='plus-square'></i> Tambah
                            </button>
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
                                   value="<?= $_GET['start'] ?? '' ?>" required>
                            <span class="input-group-text bg-gray">S/D</span>
                            <input type="date" class="form-control date-end" name="end"
                                   value="<?= $_GET['end'] ?? '' ?>" required>
                            <button class="btn btn-primary">Filter</button>
                        </div>
                        <?= form_close(); ?>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered" style="width: 100%">
                        <thead class="text-center">
                        <tr>
                            <th>#</th>
                            <th>Tanggal / Keterangan</th>
                            <th>Supplier</th>
                            <th>Total</th>
                            <th>Pembukuan</th>
                            <th>Operator</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($spendings as $i => $spending) { ?>
                            <tr>
                                <td class="text-center align-top"><?= $i + 1 ?></td>
                                <td>
                                    <div class="d-flex justify-content-start align-items-center user-name">
                                        <div class="avatar-wrapper">
                                            <div class="avatar avatar-lg me-3">
                                                <img src="<?= base_url($spending->spending_photo_path)?>" alt="Avatar"
                                                     class="rounded-circle">
                                            </div>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <?= $spending->spending_date ?><br><?= $spending->spending_desc ?>
                                        </div>
                                    </div>
                                </td>
                                <td class="<?= isset($spending->supplier->supplier_company) ? '' : 'text-center' ?>"><?= $spending->supplier->supplier_company ?? "-" ?></td>
                                <td class="text-end"><?= formatUang($spending->spending_total, true) ?></td>
                                <td class="text-center"><?= $spending->is_ledger === 1 ? '<span class="badge badge-light-success">Sudah</span>' : '<span class="badge badge-light-danger">Belum</span>' ?></td>
                                <td><?= $spending->employee->employee_name ?></td>
                                <td class="text-center">
                                    <button onclick="showModalDelete('<?= base_url('transaksi/pengeluaran/' . $spending->spending_id . '?_method=delete') ?>')"
                                            class="btn btn-danger btn-sm btn-icon"><i data-feather='trash-2'></i>
                                    </button>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<input type="hidden" name="_method" id="post">
<div class="modal fade" id="modalTambahPengeluaran" aria-labelledby="modalTambahPengeluaranLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalTambahPengeluaranLabel">Tambah Pengeluaran</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('/transaksi/pengeluaran') ?>" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-1">
                                <label class="form-label">Tanggal<small class="text-danger">*</small></label>
                                <input type="date" class="form-control" name="spending_date"
                                       placeholder="Tanggal" value="<?= date('Y-m-d') ?>" required/>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-1">
                                <label class="form-label">Keterangan<small class="text-danger">*</small></label>
                                <textarea class="form-control" name="spending_desc"
                                          placeholder="Keterangan" required rows="4"></textarea>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-1">
                                <label class="form-label">Total<small class="text-danger">*</small></label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp.</span>
                                    <input type="text" class="form-control" name="spending_total"
                                           placeholder="Total" required>
                                </div>
                                <small class="text-danger">*Isi tanpa tanda baca</small>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-1">
                                <label class="col-form-label">Foto Bukti / Kuitansi<small class="text-danger">*</small></label>
                                <input type="file" class="form-control" name="spending_photo_path" accept="image/*"
                                       required>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-1">
                                <label class="form-label">Supplier</label>
                                <select class="form-control select2" name="supplier_id">
                                    <option value="">-- Pilih Supplier --</option>
                                    <?php foreach ($suppliers as $supplier) { ?>
                                        <option value="<?= $supplier->supplier_id ?>"><?= $supplier->supplier_company ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <?php if (CookieHelper::getCookie()->user_level_id === 1) { ?>
                            <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label">Operator<small class="text-danger">*</small></label>
                                    <select class="form-control select2" name="employee_id" required>
                                        <option value="">-- Pilih Karyawan --</option>
                                        <?php foreach ($employees as $employee) { ?>
                                            <option value="<?= $employee->employee_id ?>"><?= $employee->employee_name ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-center">
                        <button type="button" class="btn btn-secondary me-1" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary ms-1">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('css') ?>
<link rel="stylesheet" type="text/css"
      href="<?= base_url('app-assets/vendors/css/tables/datatable/dataTables.bootstrap5.min.css') ?>">
<link rel="stylesheet" type="text/css"
      href="<?= base_url('app-assets/vendors/css/forms/select/select2.min.css') ?>">
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script src="<?= base_url('app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('app-assets/vendors/js/tables/datatable/dataTables.bootstrap5.min.js') ?>"></script>
<script src="<?= base_url('app-assets/vendors/js/forms/select/select2.full.min.js') ?>"></script>
<script>
    $("table").DataTable()
    $('.select2').select2()
</script>
<?= $this->endSection() ?>
