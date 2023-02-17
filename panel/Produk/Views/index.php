<?= $this->extend('panel/index') ?>
<?= $this->section('content') ?>
    <div class="row">
        <div class="col-sm-3 col-12">
            <form id="formProduct" action="<?= base_url('produk') ?>" method="post" class="form form-vertical"
                  enctype="multipart/form-data">
                <div class="card">
                    <div class="card-header">
                        <h5>Form Produk</h5>
                    </div>
                    <div class="card-body">
                        <input type="hidden" name="_method" value="post">
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label">Nama<small class="text-danger">*</small></label>
                                    <input type="text" class="form-control" name="product_name"
                                           placeholder="Nama" required/>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label">Satuan<small class="text-danger">*</small></label>
                                    <input type="text" class="form-control" name="product_unit"
                                           placeholder="Satuan" required/>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label">Harga Jual<small class="text-danger">*</small></label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp.</span>
                                        <input type="text" class="form-control" name="product_price"
                                               placeholder="Harga Jual" required>
                                    </div>
                                    <small class="text-danger">*Isi tanpa tanda baca</small>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label">Harga Beli<small class="text-danger">*</small></label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp.</span>
                                        <input type="text" class="form-control" name="product_buy"
                                               placeholder="Harga Beli" value="0" required>
                                    </div>
                                    <small class="text-danger">*Isi tanpa tanda baca</small>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label">Jenis Penanganan Produk<small
                                                class="text-danger">*</small></label>
                                    <select class="select2 form-select" name="uti_product_category_id" required>
                                        <option value="">-- Pilih Jenis --</option>
                                        <?php foreach ($utiProductCategories as $utiProductCategory) { ?>
                                            <option value="<?= $utiProductCategory->uti_product_category_id ?>"><?= $utiProductCategory->uti_product_category_name ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label">Status Produk<small class="text-danger">*</small></label>
                                    <div class="row">
                                        <div class="col-12 col-sm-6">
                                            <div class="form-check form-check-inline">
                                                <input type="radio" id="product_status_aktif" name="product_status"
                                                       class="form-check-input" value="1" required checked/>
                                                <label class="form-check-label"
                                                       for="product_status_aktif">Tampilkan</label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-check form-check-inline">
                                                <input type="radio" id="product_status_tidak_aktif"
                                                       name="product_status"
                                                       class="form-check-input" value="0" required/>
                                                <label class="form-check-label" for="product_status_tidak_aktif">Sembunyikan</label>
                                            </div>
                                        </div>
                                    </div>
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
        <div class="col-sm-9 col-12">
            <div class="card">
                <div class="card-header">
                    <h5>Data Produk</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" style="width: 100%">
                            <thead class="text-center">
                            <tr>
                                <th></th>
                                <th>Nama</th>
                                <th>Harga/Satuan</th>
                                <th>Harga Beli</th>
                                <th>Status Produk</th>
                                <th>#</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($producs as $i => $produc) { ?>
                                <tr>
                                    <td class="text-center" style="max-width: 15px"><?= $i + 1 ?></td>
                                    <td><?= $produc->product_name ?></td>
                                    <td class="text-end"><?= formatUang($produc->product_price) ?>
                                        /<?= $produc->product_unit ?></td>
                                    <td class="text-end"><?= formatUang($produc->product_buy) ?></td>
                                    <td class="text-center">
                                        <?php if ($produc->product_status === 1) { ?>
                                            <span class="badge bg-success"><i data-feather='eye'></i> Tampil</span>
                                        <?php } else { ?>
                                            <span class="badge bg-danger"><i data-feather='eye-off'></i> Sembunyi</span>
                                        <?php } ?>
                                    </td>
                                    <td class="text-center">
                                        <button onclick="showModalDelete('<?= base_url('produk/' . $produc->product_id . '?_method=delete') ?>')"
                                                class="btn btn-danger btn-sm btn-icon"><i data-feather='trash-2'></i>
                                        </button>
                                        <button onclick="setFormEdit('<?= $produc->product_id ?>', '<?= $produc->product_name ?>', '<?= $produc->product_unit ?>', <?= $produc->product_price ?>, <?= $produc->product_buy ?>, <?= $produc->uti_product_category_id ?>, <?= $produc->product_status ?>)"
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
        function setFormEdit(product_id, product_name, product_unit, product_price, product_buy, uti_product_category_id, product_status) {
            $("#formProduct").attr('action', `<?= base_url('produk') ?>/${product_id}`)
            $("#formProduct input[name=_method]").val('put')
            $("#formProduct input[name=product_name]").val(product_name)
            $("#formProduct input[name=product_unit]").val(product_unit)
            $("#formProduct input[name=product_price]").val(product_price)
            $("#formProduct input[name=product_buy]").val(product_buy)
            $("#formProduct select[name=uti_product_category_id]").val(uti_product_category_id).trigger('change')
            if (product_status === 1)
                $("#formProduct input[id=product_status_aktif]").attr('checked', 'checked')
            else
                $("#formProduct input[id=product_status_tidak_aktif]").attr('checked', 'checked')
        }

        function resetForm() {
            $("#formProduct input[name=_method]").val('post')
            $("#formProduct select[name=uti_product_category_id]").val("").trigger('change')
            $("#formProduct input[id=product_status_aktif]").attr('checked', 'checked')
            $("#formProduct").attr('action', '<?= base_url('produk') ?>')
        }
    </script>
<?= $this->endSection() ?>