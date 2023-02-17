<?= $this->extend('panel/index') ?>
<?= $this->section('content') ?>
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <a href="<?= site_url('transaksi/penjualan'); ?>" class="btn btn-danger btn-sm"> Kembali </a>
                    </div>
                    <?= form_open('transaksi/penjualan/temp', ['class' => 'form-input-temp']); ?>
                    <?= getCsrfToken(); ?>
                    <div class="my-1">
                        <h3>Form Input Produk</h3>
                        <label class="form-label">Pilih Produk</label>
                        <select class="form-select select2 product-select" name="product_id" required>
                            <option value="">.: Pilih Produk :.</option>
                            <?php
                            array_walk($products, function ($product) {
                                $params = json_encode($product);
                                echo "<option data-params='{$params}' value='{$product->product_id}'>{$product->product_name}</option>";
                            })
                            ?>
                        </select>
                    </div>
                    <div class="product-detail hidden">
                        <div>
                            <label class="form-label">Kategori</label>
                            <input class="form-control" name="category_name" readonly>
                        </div>
                        <div class="input-group mt-1">
                            <span class="input-group-text">Rp</span>
                            <input type="text" class="form-control" name="price" readonly placeholder="Harga">
                            <span class="input-group-text">,-</span>
                        </div>
                        <div class="input-group mt-1">
                            <span class="input-group-text">Quantity</span>
                            <input type="number" class="form-control" name="quantity" placeholder="Quantity">
                            <span class="input-group-text product-unit"></span>
                        </div>
                        <div class="input-group my-1">
                            <span class="input-group-text">Diskon Rp.</span>
                            <input type="number" class="form-control" name="discount" value="0" placeholder="Diskon">
                        </div>
                        <button class="btn btn-primary">
                            <i data-feather='save'></i> Simpan
                        </button>
                    </div>
                    <?= form_close(); ?>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5>Data Produk</h5>
                    <a href="<?= site_url('transaksi/penjualan?reset=true'); ?>" class="btn btn-warning btn-sm">
                        Reset Data Transaksi
                    </a>
                </div>
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table table-bordered" style="width: 100%">
                            <thead class="text-center">
                            <tr>
                                <th width="5%">No</th>
                                <th>Nama</th>
                                <th>Kategori</th>
                                <th>Harga</th>
                                <th>Quantity</th>
                                <th>Diskon</th>
                                <th>Total</th>
                                <th>#</th>
                            </tr>
                            </thead>
                            <tbody class="table-temporary">
                            <?php
                            $totalBuy = 0;
                            foreach ($detailsTemp as $i => $detail) {
                                $totalBuy += $detail->transaction_detail_total;
                                ?>
                                <tr>
                                    <td><?= $i + 1; ?></td>
                                    <td><?= $detail->product_name; ?></td>
                                    <td><?= $detail->category_name; ?></td>
                                    <td class="text-end"><?= formatUang($detail->transaction_detail_price); ?></td>
                                    <td class="text-center"><?= $detail->transaction_detail_quantity . ' ' . $detail->product_unit; ?></td>
                                    <td class="text-end"><?= $detail->transaction_detail_discount; ?></td>
                                    <td class="text-end"><?= formatUang($detail->transaction_detail_total); ?></td>
                                    <td>
                                        <button data-id="<?= $detail->detail_id; ?>"
                                                class="btn btn-danger btn-sm btn-delete">
                                            <i data-feather='trash'></i>
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
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>Data Penjualan</h5>
                </div>
                <div class="card-body">
                    <?= form_open('transaksi/penjualan', ['class' => 'form-input-temp']); ?>
                    <?= getCsrfToken(); ?>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-1">
                                <label>Pegawai</label>
                                <select class="form-select" name="employee_id" required>
                                    <option value="">.: Pilih Pegawai :.</option>
                                    <?php
                                    array_walk($employees, function ($employee) {
                                        echo "<option value='{$employee->employee_id}'>{$employee->employee_name}</option>";
                                    })
                                    ?>
                                </select>
                            </div>
                            <div class="mb-1">
                                <label>Tanggal :</label>
                                <input type="date" class="form-control" name="transaction_date"
                                       value="<?= date('Y-m-d'); ?>"
                                       required>
                            </div>
                            <div class="mb-1">
                                <label>Diskripsi</label>
                                <textarea class="form-control" name="transaction_desc" placeholder="Keterangan"
                                          required></textarea>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-1">
                                <label>No. HP</label>
                                <input class="form-control customer-phone" name="customer_phone" placeholder="No HP"
                                       required>
                                <div class="valid-feedback">Pelanggan sudah Terdaftar.</div>
                            </div>
                            <div class="mb-1">
                                <label>Nama</label>
                                <input class="form-control" name="customer_name" placeholder="Nama Pelanggan" required>
                            </div>
                            <div class="mb-1">
                                <label>Alamat</label>
                                <input class="form-control" name="customer_address" placeholder="Alamat" required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mt-2">
                                <label>Total :
                                    <span class="total fw-bold"> <?= formatUang($totalBuy, rp: true, decimals: 2); ?></span>
                                </label>
                            </div>
                            <div class="mb-1">
                                <label>Terbilang :
                                    <p class="total fw-bold"><?= moneyToWord($totalBuy); ?></p>
                                </label>
                            </div>
                            <div class="row">
                                <div class="d-grid col-md-12 mb-1">
                                    <button type="submit" class="btn btn-primary waves-effect waves-float waves-light">
                                        Simpan Transaksi
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?= form_close();?>
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
        $(document).ready(function () {
            $("table").DataTable()
            $('.select2').select2()
        })


        $(".product-select").change(function () {
            const params = $(this).find('option:selected').data('params');
            if (params) {
                $('input[name="category_name"]').val(params.uti_product_category_name)
                $('input[name="price"]').val(params.product_price)
                $('.product-unit').text(params.product_unit)
                $('.product-detail').removeClass('hidden')
            } else {
                $('input[name="category_name"]').val('')
                $('input[name="price"]').val('')
                $('input[name="quantity"]').val('')
                $('input[name="discount"]').val(0)
                $('.product-unit').text('')
                $('.product-detail').addClass('hidden')
            }
        })

        $('.customer-phone').change(async function () {
            const phone = $(this).val();
            const loadData = await loadCustomers({phone});
            const getData = loadData.data;
            console.log(getData.length)
            if (getData.length > 0) {
                $(this).addClass('is-valid');
                $('input[name="customer_name"]').val(getData[0].customer_name).prop('readonly', true);
                $('input[name="customer_address"]').val(getData[0].customer_address).prop('readonly', true);
            } else {
                $(this).removeClass('is-valid');
                $('input[name="customer_name"]').val('').prop('readonly', false);
                $('input[name="customer_address"]').val('').prop('readonly', false);
            }
        })

        $('.btn-delete').click(function () {
            const detail_id = $(this).data('id');
            const token = $('#token').val();
            console.log(token)
            swalAction({
                url: siteUrl(`transaksi/penjualan/temp/${detail_id}`),
                method: 'delete',
            })
        })

        // $('.form-input-temp').submit(function () {
        //     $.ajax({
        //         type: "POST",
        //         url: $(this).attr('action'),
        //         data: $(this).serialize(),
        //         cache: false,
        //         dataType: 'JSON',
        //         beforeSend: () => {
        //             $('.btn-save-temp').html(`<i class="fa fa-spin fa-spinner"></i> Loading . . .`)
        //         },
        //         complete: () => {
        //             $('.btn-save-temp').html(`<i class="fa fa-save"></i> Simpan`);
        //             $('.product-select').val('').trigger("change")
        //         },
        //         success: function (result) {
        //             Toast.fire({
        //                 icon: result.status ? 'success' : 'error',
        //                 title: result.message
        //             })
        //             window.location.reload();
        //         },
        //         error: (xhr, thrownError) => {
        //             Toast.fire({
        //                 icon: 'error',
        //                 title: xhr.responseText
        //             })
        //         }
        //     });
        //     return false;
        // })
        //
        // const tableTemp = async () => {
        //     const loadTemp = await loadTransactionDetailTemp();
        //     const dataTemp = loadTemp.data;
        //     let htmls = '';
        //     dataTemp.forEach((item, i) => {
        //         htmls += `<tr>
        //                     <td width="5%">${i + 1}</td>
        //                     <td>${item.product_name}</td>
        //                     <td>${item.category_name}</td>
        //                     <td class="text-end">${item.transaction_detail_price}</td>
        //                     <td class="text-center">${item.transaction_detail_quantity} ${item.product_unit}</td>
        //                     <td class="text-end">${item.transaction_detail_discount}</td>
        //                     <td class="text-end">${item.transaction_detail_total}</td>
        //                     <td></td>
        //                  </tr>`
        //     })
        //     $('.table-temporary').html(htmls);
        // }
        //
        // const loadTransactionDetailTemp = (params = {}) => $.getJSON(siteUrl('transaksi/penjualan/load-detail-temporary'), params);
        const loadCustomers = (params = {}) => $.getJSON(siteUrl('pelanggan/load-pelanggan'), params);
    </script>
<?= $this->endSection() ?>