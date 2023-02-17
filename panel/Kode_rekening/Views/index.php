<?= $this->extend('panel/index') ?>
<?= $this->section('content') ?>
<div class="row">
    <div class="col-12 col-sm-3">
        <form id="formAccountCode" action="<?= base_url('kode-rekening') ?>" method="post" class="form form-vertical"
              enctype="multipart/form-data">
            <div class="card">
                <div class="card-header">
                    <h5>Form Kode Rekening</h5>
                </div>
                <div class="card-body">
                    <input type="hidden" name="_method" value="post">
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-1">
                                <label class="form-label">Kode Rekening<small class="text-danger">*</small></label>
                                <input type="number" class="form-control" name="account_code"
                                       placeholder="Kode Rekening" required/>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-1">
                                <label class="form-label">Nama Rekening<small class="text-danger">*</small></label>
                                <input type="text" class="form-control" name="account_name"
                                       placeholder="Nama Rekening" required/>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-1">
                                <label class="form-label">Pos Saldo<small
                                            class="text-danger">*</small></label>
                                <select class="select2 form-select" name="uti_account_post_id" required>
                                    <option value="">-- Pilih --</option>
                                    <?php foreach ($utiAccountPosts as $utiAccountPost) { ?>
                                        <option value="<?= $utiAccountPost->uti_account_post_id ?>"><?= "{$utiAccountPost->uti_account_post_alias} ({$utiAccountPost->uti_account_post_name})" ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-1">
                                <label class="form-label">Grup Akun<small
                                            class="text-danger">*</small></label>
                                <select class="select2 form-select" name="uti_account_group_id" required>
                                    <option value="">-- Pilih --</option>
                                    <?php foreach ($utiAccountGroups as $utiAccountGroup) { ?>
                                        <option value="<?= $utiAccountGroup->uti_account_group_id ?>"><?= "{$utiAccountGroup->uti_account_group_alias} ({$utiAccountGroup->uti_account_group_name})" ?></option>
                                    <?php } ?>
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
                <h5>Data Kode Rekening</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" style="width: 100%">
                        <thead class="text-center">
                        <tr>
                            <th>Kode Rekening</th>
                            <th>Nama Rekening</th>
                            <th>Pos Saldo</th>
                            <th>Grup Akun</th>
                            <th>#</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($accountCodes as $accountCode) { ?>
                            <tr>
                                <td class="text-center"><?= $accountCode->account_code ?></td>
                                <td><?= $accountCode->account_name ?></td>
                                <td class="text-center"><?= $accountCode->uti_account_post->uti_account_post_alias ?></td>
                                <td class="text-center"><?= $accountCode->uti_account_group->uti_account_group_alias ?></td>
                                <td class="text-center">
                                    <button onclick="showModalDelete('<?= base_url('kode-rekening/' . $accountCode->account_code . '?_method=delete') ?>')"
                                            class="btn btn-danger btn-sm btn-icon"><i data-feather='trash-2'></i>
                                    </button>
                                    <button onclick="setFormEdit(<?= $accountCode->account_code ?>, '<?= $accountCode->account_name ?>', <?= $accountCode->uti_account_post_id ?>, <?= $accountCode->uti_account_group_id ?>)"
                                            class="btn btn-info btn-sm btn-icon"><i data-feather='edit-3'></i>
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
    function setFormEdit(account_code, account_name, uti_account_post_id, uti_account_group_id) {
        $("#formAccountCode").attr('action', `<?= base_url('kode-rekening') ?>/${account_code}`)
        $("#formAccountCode input[name=_method]").val('put')
        $("#formAccountCode input[name=account_code]").val(account_code)
        $("#formAccountCode input[name=account_name]").val(account_name)
        $("#formAccountCode select[name=uti_account_post_id]").val(uti_account_post_id).trigger('change')
        $("#formAccountCode select[name=uti_account_group_id]").val(uti_account_group_id).trigger('change')
    }

    function resetForm() {
        $("#formAccountCode input[name=_method]").val('post')
        $("#formAccountCode select[name=uti_account_post_id]").val("").trigger('change')
        $("#formAccountCode select[name=uti_account_group_id]").val("").trigger('change')
        $("#formAccountCode").attr('action', '<?= base_url('kode-rekening') ?>')
    }
</script>
<?= $this->endSection() ?>
