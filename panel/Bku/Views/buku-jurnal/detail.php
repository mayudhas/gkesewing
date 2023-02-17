<?= $this->extend('panel/index') ?>
<?= $this->section('content') ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <?= form_open(site_url('bku/buku-jurnal')); ?>
                <?= getCsrfToken(); ?>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="">
                                <label>Pos Akun Rekening :</label>
                                <select class="form-select select-post-modal" name="post_id" required>
                                    <option disabled selected value="">Pos Akun :</option>
                                    <?php array_walk($posts, function ($post) {
                                        echo "<option data-post_id='$post->uti_account_post_id' value='$post->uti_account_post_id'>$post->uti_account_post_name</option>";
                                    }) ?>
                                </select>
                            </div>
                            <div class="input-group mt-1">
                                <span class="input-group-text">Nomor :</span>
                                <input type="number" class="form-control" name="ledger_number"
                                       value="<?= count($ledgers) + 1; ?>" placeholder="Nomor Bukti">
                            </div>
                            <div class="mt-1">
                                <label>Transaksi (Optional)</label>
                                <select class="form-select select2 select-transaction" name="transaction">
                                    <option value="">.: Pilih Transaksi :.</option>
                                </select>
                            </div>
                            <div class="input-group mt-1">
                                <span class="input-group-text">Tanggal :</span>
                                <input type="date" class="form-control" name="ledger_date"
                                       placeholder="Tanggal Bukti" value="<?= dateNow(); ?>">
                            </div>
                            <div class="mt-1">
                                <label>Keterangan :</label>
                                <textarea class="form-control" rows="3" name="ledger_desc" required></textarea>
                                <input type="hidden" class="form-control" name="ledger_name">
                            </div>

                            <div class="mt-1">
                                <label>Nama (Optional) :</label>
                                <input type="text" class="form-control" name="ledger_name">
                            </div>
                            <div class="input-group mt-1">
                                <span class="input-group-text">Saldo Transaksi Rp. </span>
                                <input type="number" class="form-control" name="ledger_score">
                                <span class="input-group-text">,-</span>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <button type="button" data-accounts='<?= json_encode($accounts); ?>'
                                    data-posts='<?= json_encode($posts); ?>'
                                    class="btn btn-primary btn-rekening">
                                <i data-feather="plus"></i> Rekening
                            </button>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead class="text-center">
                                    <tr>
                                        <th>Rekening</th>
                                        <th>POS</th>
                                        <th>Belanja</th>
                                        <th width="5%">#</th>
                                    </tr>
                                    </thead>
                                    <tbody class="tr-account">
                                    <tr>
                                        <td>
                                            <select class="form-select select-account" name="account_code[]" required>
                                                <option disabled selected value="">Rekening :</option>
                                                <?php array_walk($accounts, function ($account) {
                                                    echo "<option value='{$account->account_code}'>{$account->account_name}</option>";
                                                }) ?>
                                            </select>
                                        </td>
                                        <td>
                                            <select class="form-select select-account" name="uti_account_post_id[]"
                                                    required>
                                                <option disabled selected value="">POS :</option>
                                                <?php array_walk($posts, function ($post) {
                                                    echo "<option value='{$post->uti_account_post_id}'>{$post->uti_account_post_name}</option>";
                                                }) ?>
                                            </select>
                                        </td>
                                        <td>
                                            <div class="input-group">
                                                <span class="input-group-text">Rp. </span>
                                                <input type="number" class="form-control" name="ledger_detail_score[]">
                                                <span class="input-group-text">,-</span>
                                            </div>
                                        </td>
                                        <td></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary">
                        <i data-feather='save'></i> Simpan
                    </button>
                </div>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>

<?= $this->section('css') ?>
    <link rel="stylesheet" type="text/css"
          href="<?= base_url('app-assets/vendors/css/forms/select/select2.min.css') ?>">
<?= $this->endSection() ?>

<?= $this->section('js') ?>
    <script src="<?= base_url('app-assets/vendors/js/forms/select/select2.full.min.js') ?>"></script>
    <script>
        $(document).ready(function () {
            $(".select2").select2();
        })

        $('.btn-rekening').click(function () {
            const accounts = $(this).data('accounts');
            let selectAccount = `<option disabled selected value="">Rekening :</option>`;
            accounts.forEach(function (account) {
                selectAccount += `<option value="${account.account_code}">${account.account_name}</option>`;
            })

            const posts = $(this).data('posts');
            let selectPost = `<option disabled selected value="">POS :</option>`;
            posts.forEach(function (post) {
                selectPost += `<option value="${post.uti_account_post_id}">${post.uti_account_post_name}</option>`;
            })
            $('.tr-account').append(`<tr>
                                            <td>
                                                <select class="form-select select-account" name="account_code[]">${selectAccount}</select>
                                            </td>
                                            <td>
                                                <select class="form-select select-account" name="uti_account_post_id[]">${selectPost}</select>
                                            </td>
                                            <td>
                                            <div class="input-group">
                                                <span class="input-group-text">Rp. </span>
                                                <input type="number" class="form-control" name="ledger_detail_score[]">
                                                <span class="input-group-text">,-</span>
                                            </div>
                                            </td>
                                            <td>
                                            <button type="button" class="btn btn-danger btn-sm btn-delete-account">Hapus</button>
                                            </td>
                                     </tr>`)

        });

        $(document).on('click', '.btn-delete-account', function () {
            $(".tr-account").children().last().remove()
            // $(this).find(`tr:last`).remove()
            // $('.tr-account:last').remove()
        })

        $('.btn-delete').click(function () {
            const ledger_id = $(this).data('id');
            swalAction({
                url: siteUrl(`bku/buku-jurnal/${ledger_id}`),
                method: 'delete',
            })
        })

        $('.select-post-modal').change(async function () {
            $('.post-change').removeClass('hidden')
            const postID = $(this).find('option:selected').data('post_id')
            let getDataTransaksi = [];
            const loadDataRekening = await loadRekeningPos(postID);
            const getDataRekening = loadDataRekening.data;
            let htmlsTransaksi = "<option value=''>.: Pilih Transaksi :.</option>";
            if (postID === 1) {
                const loadDataPengeluaran = await loadPengeluaranNoLedger();
                getDataTransaksi = loadDataPengeluaran.data;
                getDataTransaksi.forEach(function (itemTrans) {
                    htmlsTransaksi += `<option data-score='${itemTrans.spending_total}' data-name='${itemTrans.supplier_name}' data-desc='${itemTrans.spending_desc}' value='${itemTrans.spending_id}'>${itemTrans.spending_desc}</option>`;
                })
            } else {
                const loadDataPenjualan = await loadPenjualanNoLedger();
                getDataTransaksi = loadDataPenjualan.data;
                getDataTransaksi.forEach(function (itemTrans) {
                    htmlsTransaksi += `<option data-score='${itemTrans.total}' data-name='${itemTrans.customer_name}' data-desc='${itemTrans.transaction_desc}' value='${itemTrans.transaction_code}'>${itemTrans.transaction_desc}</option>`;
                })

            }
            $('.select-transaction').html(htmlsTransaksi);
        })

        $('.select-transaction').change(function () {
            const score = $(this).find('option:selected').data('score');
            const desc = $(this).find('option:selected').data('desc');
            const name = $(this).find('option:selected').data('name');
            if ($(this).val()) {
                $('input[name=ledger_score]').val(score).prop('readonly', true)
                $('input[name=ledger_name]').val(name).prop('readonly', true)
                $('textarea[name=ledger_desc]').text(desc).prop('readonly', true)
            } else {
                $('input[name=ledger_score]').val('').prop('readonly', false)
                $('input[name=ledger_name]').val('').prop('readonly', false)
                $('textarea[name=ledger_desc]').text('').prop('readonly', false)
            }
        });

        const loadPengeluaranNoLedger = (params = {}) => $.getJSON(siteUrl('transaksi/pengeluaran/load-pengeluaran-no-ledger'), params);
        const loadPenjualanNoLedger = (params = {}) => $.getJSON(siteUrl('transaksi/penjualan/load-penjualan-no-ledger'), params);
        const loadRekeningPos = (postID) => $.getJSON(siteUrl('rekening/load-rekening-pos'), {post_id: postID});

    </script>
<?= $this->endSection() ?>