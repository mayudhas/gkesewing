<?= $this->extend('panel/index') ?>
<?= $this->section('content') ?>
<div class="row">
    <div class="col-12 col-sm-3">
        <form id="formUser" action="<?= base_url('pengguna') ?>" method="post" class="form form-vertical"
              enctype="multipart/form-data">
            <div class="card">
                <div class="card-header">
                    <h5>Form Kode Rekening</h5>
                </div>
                <div class="card-body">
                    <input type="hidden" name="_method" value="post">
                    <input type="hidden" name="user_level_id" value=<?= $user_level_id ?>>
                    <div class="row">
                        <?php if ($user_level_id === 2) { ?>
                            <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label">Pegawai<small class="text-danger">*</small></label>
                                    <select class="select2 form-select" name="employee_id" required>
                                        <option value="">-- Pilih --</option>
                                        <?php foreach ($employees as $employee) { ?>
                                            <option value="<?= $employee['employee_id'] ?>"><?= $employee['employee_name'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        <?php } ?>
                        <?php if ($user_level_id === 1) { ?>
                            <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label">Nama Pengguna<small class="text-danger">*</small></label>
                                    <input type="text" class="form-control" name="user_name"
                                           placeholder="Nama Pengguna" required/>
                                </div>
                            </div>
                        <?php } ?>
                        <div class="col-12">
                            <div class="mb-1">
                                <label class="form-label">Username<small class="text-danger">*</small></label>
                                <input type="text" class="form-control" name="user_username"
                                       placeholder="Username" required/>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-1">
                                <label class="form-label">Password<small class="text-danger">*</small></label>
                                <input type="password" class="form-control" name="user_password"
                                       placeholder="Password" required/>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-1">
                                <label class="form-label">Status Akun<small
                                            class="text-danger">*</small></label>
                                <select class="select2 form-select" name="user_is_active" required>
                                    <option value="">-- Pilih --</option>
                                    <option value=1>Aktif</option>
                                    <option value=0>Tidak Aktif</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="reset" onclick="resetForm()" class="btn btn-outline-secondary">Reset
                    </button>
                </div>
            </div>
        </form>
    </div>
    <div class="col-12 col-sm-9">
        <div class="card">
            <div class="card-header">
                <h5>Filter</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-sm-4">
                        <form action="" method="get">
                            <label class="form-label">Role<small class="text-danger">*</small></label>
                            <select class="select2 form-select" name="user_level_id" onchange="this.form.submit()"
                                    required>
                                <?php foreach ($userLevels as $userLevel) { ?>
                                    <option <?= $user_level_id === $userLevel->user_level_id ? 'selected' : '' ?>
                                            value="<?= $userLevel->user_level_id ?>"><?= "$userLevel->user_level_name" ?></option>
                                <?php } ?>
                            </select>
                        </form>
                    </div>
                    <div class="col-12 col-sm-8">
                        <div class="alert alert-danger alert-validation-msg" role="alert">
                            <div class="alert-body d-flex align-items-center">
                                <i data-feather='info' class="feather-32 me-1"></i>
                                <p>Filter level
                                    <b><?= $user_level_id === 1 ? 'Administrator' : 'Pegawai' ?></b>
                                    diterapkan. Silahkan pilih role user terlebih dahulu untuk
                                    melihat ataupun membuat data pengguna.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h5>Data Kode Rekening</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" style="width: 100%">
                        <thead class="text-center">
                        <tr>
                            <th></th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Role</th>
                            <th>Status Akun</th>
                            <th>#</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($users as $i => $user) { ?>
                            <tr>
                                <th class="text-center"><?= $i + 1 ?></th>
                                <td class="text-center"><?= $user->user_name ?></td>
                                <td><?= $user->user_username ?></td>
                                <td class="text-center"><?= $user->user_level_id ?></td>
                                <td>
                                    <form action="<?= base_url('pengguna/' . $user->user_id) ?>" method="post">
                                        <input type="hidden" name="_method" value="put">
                                        <div class="form-check form-check-inline d-flex justify-content-center">
                                            <input class="form-check-input me-1" type="checkbox"
                                                   id="user_is_active_<?= $user->user_level_id ?>"
                                                   name="user_is_active" <?= $user->user_is_active === 1 ? 'checked' : '' ?>
                                                   onchange="this.form.submit()">
                                            <label class="form-check-label"
                                                   for="user_is_active_<?= $user->user_level_id ?>"><?= $user->user_is_active === 1 ? 'Aktif' : 'Tidak Aktif' ?></label>
                                        </div>
                                    </form>
                                </td>
                                <td class="text-center">
                                    <button onclick="showModalDelete('<?= base_url('pengguna/' . $user->user_id . '?_method=delete') ?>')"
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
<script>
    function resetForm() {
        $("#formUser input[name=_method]").val('post')
        $("#formUser select[name=employee_id]").val("").trigger('change')
        $("#formUser select[name=user_is_active]").val("").trigger('change')
        $("#formUser").attr('action', '<?= base_url('pengguna') ?>')
    }
</script>
<?= $this->endSection() ?>
