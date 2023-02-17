<?= $this->extend('panel/index') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-sm-3 col-12">
        <form id="formEmployee" action="<?= base_url('karyawan') ?>" method="post" class="form form-vertical"
              enctype="multipart/form-data">
            <div class="card">
                <div class="card-header">
                    <h5>Form Karyawan</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <input type="hidden" name="_method" value="post">
                        <div class="col-12">
                            <div class="mb-1">
                                <label class="col-form-label">Nama<small class="text-danger">*</small></label>
                                <input type="text" class="form-control" name="employee_name" placeholder="Nama"
                                       required/>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-1">
                                <label class="col-form-label">Nomor HP<small class="text-danger">*</small></label>
                                <input type="text" class="form-control" name="employee_phone" placeholder="Nomor HP"
                                       required/>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-1">
                                <label class="col-form-label">Status<small class="text-danger">*</small></label>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-check form-check-inline">
                                            <input type="radio" id="employee_status_aktif" name="employee_status"
                                                   class="form-check-input" value="1" required checked/>
                                            <label class="form-check-label" for="employee_status_aktif">Aktif</label>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-check form-check-inline">
                                            <input type="radio" id="employee_status_tidak_aktif" name="employee_status"
                                                   class="form-check-input" value="0" required/>
                                            <label class="form-check-label" for="employee_status_tidak_aktif">Tidak
                                                Aktif</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="reset" onclick="resetForm()" class="btn btn-outline-secondary">Reset</button>
                </div>
            </div>
        </form>
    </div>
    <div class="col-sm-9 col-12">
        <div class="card">
            <div class="card-header">
                <h5>Data Karyawan</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" style="width: 100%">
                        <thead class="text-center">
                        <tr>
                            <th></th>
                            <th>Nama</th>
                            <th>No HP</th>
                            <th>Status</th>
                            <th>#</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($employees as $i => $employee) { ?>
                            <tr>
                                <td class="text-center"><?= $i + 1 ?></td>
                                <td><?= esc($employee->employee_name) ?></td>
                                <td><?= esc($employee->employee_phone) ?></td>
                                <td class="text-center"><?= $employee->employee_status === 1 ? '<span class="badge badge-light-success">Aktif</span>' : '<span class="badge badge-light-danger">Tidak Aktif</span>' ?></td>
                                <td class="text-center">
                                    <button onclick="showModalDelete('<?= base_url('karyawan/' . $employee->employee_id . '?_method=delete') ?>')"
                                            class="btn btn-danger btn-sm btn-icon"><i data-feather='trash-2'></i>
                                    </button>
                                    <button onclick="setFormEdit('<?= $employee->employee_name ?>', '<?= $employee->employee_phone ?>', <?= $employee->employee_status ?>, '<?= $employee->employee_id ?>')"
                                            class="btn btn-info btn-sm btn-icon"><i data-feather='edit-3'></i></button>
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
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script src="<?= base_url('app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('app-assets/vendors/js/tables/datatable/dataTables.bootstrap5.min.js') ?>"></script>
<script>$("table").DataTable()</script>
<script>
    function setFormEdit(name, hp, status, id) {
        $("#formEmployee").attr('action', `<?= base_url('karyawan') ?>/${id}`)
        $("#formEmployee input[name=_method]").val('put')
        $("#formEmployee input[name=employee_name]").val(name)
        $("#formEmployee input[name=employee_phone]").val(hp)
        if (status === 1)
            $("#formEmployee input[id=employee_status_aktif]").attr('checked', 'checked')
        else
            $("#formEmployee input[id=employee_status_tidak_aktif]").attr('checked', 'checked')
    }

    function resetForm() {
        $("#formEmployee input[name=_method]").val('post')
        $("#formEmployee").attr('action', '<?= base_url('karyawan') ?>')
    }
</script>
<?= $this->endSection() ?>
