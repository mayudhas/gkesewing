<?= $this->extend('panel/index') ?>
<?= $this->section('content') ?>
    <div class="row">
        <div class="col-sm-3 col-12">
            <form id="formCustomer" action="<?= base_url('pemasok') ?>" method="post"
                  class="form form-vertical"
                  enctype="multipart/form-data">
                <div class="card">
                    <div class="card-header">
                        <h5>Form Pemasok</h5>
                    </div>
                    <div class="card-body">
                        <input type="hidden" name="_method" value="post">
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label">Perusahaan<small class="text-danger">*</small></label>
                                    <input type="text" class="form-control" name="supplier_company"
                                           placeholder="Perusahaan" required/>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label">Nama Kotak<small class="text-danger">*</small></label>
                                    <input type="text" class="form-control" name="supplier_name"
                                           placeholder="Nama Kotak" required/>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label">Nomor Telepon<small class="text-danger">*</small></label>
                                    <input type="text" class="form-control" name="supplier_phone"
                                           placeholder="Nomor Telepon" required/>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label">Alamat<small class="text-danger">*</small></label>
                                    <textarea class="form-control" name="supplier_address"
                                              placeholder="Alamat" required rows="4"></textarea>
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
                    <h5>Data Pemasok</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" style="width: 100%">
                            <thead class="text-center">
                            <tr>
                                <th></th>
                                <th>Perusahaan</th>
                                <th>Nama Kotak</th>
                                <th>No HP</th>
                                <th>Alamat</th>
                                <th>#</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($suppliers as $i => $supplier) { ?>
                                <tr>
                                    <td class="text-center" style="max-width: 15px"><?= $i + 1 ?></td>
                                    <td><?= $supplier->supplier_company ?></td>
                                    <td><?= $supplier->supplier_name ?></td>
                                    <td><?= $supplier->supplier_phone ?></td>
                                    <td><?= $supplier->supplier_address ?></td>
                                    <td class="text-center">
                                        <button onclick="showModalDelete('<?= base_url('pemasok/' . $supplier->supplier_id . '?_method=delete') ?>')"
                                                class="btn btn-danger btn-sm btn-icon"><i data-feather='trash-2'></i>
                                        </button>
                                        <button onclick="setFormEdit('<?= $supplier->supplier_company ?>', '<?= $supplier->supplier_name ?>', '<?= $supplier->supplier_phone ?>', '<?= $supplier->supplier_address ?>', '<?= $supplier->supplier_id ?>')"
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
<?= $this->endSection() ?>

<?= $this->section('js') ?>
    <script src="<?= base_url('app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js') ?>"></script>
    <script src="<?= base_url('app-assets/vendors/js/tables/datatable/dataTables.bootstrap5.min.js') ?>"></script>
    <script>$("table").DataTable()</script>
    <script>
        function setFormEdit(supplier_company, supplier_name, supplier_phone, supplier_address, supplier_id) {
            $("#formCustomer").attr('action', `<?= base_url('pemasok') ?>/${supplier_id}`)
            $("#formCustomer input[name=_method]").val('put')
            $("#formCustomer input[name=supplier_company]").val(supplier_company)
            $("#formCustomer input[name=supplier_name]").val(supplier_name)
            $("#formCustomer input[name=supplier_phone]").val(supplier_phone)
            $("#formCustomer textarea[name=supplier_address]").val(supplier_address)
        }

        function resetForm() {
            $("#formCustomer input[name=_method]").val('post')
            $("#formCustomer").attr('action', '<?= base_url('pemasok') ?>')
        }
    </script>
<?= $this->endSection() ?>