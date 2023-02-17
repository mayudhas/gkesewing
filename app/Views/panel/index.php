<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="keywords"
          content="Provinsi Kalimantan Selatan, Badan Perencanaan Pembangunan">
    <meta name="author" content="Bappeda Provinsi Kalimantan Selatan">
    <title>Panel Admin - <?= esc($page_title) ?></title>
    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url('app-assets/images/ico/favicon.ico') ?>">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600"
          rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?= base_url('app-assets/vendors/css/vendors.min.css') ?>">
    <?= $this->renderSection('css') ?>
    <link rel="stylesheet" type="text/css" href="<?= base_url('app-assets/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('app-assets/css/bootstrap-extended.min.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('app-assets/css/colors.min.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('app-assets/css/components.min.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('app-assets/css/themes/dark-layout.min.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('app-assets/css/themes/bordered-layout.min.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('app-assets/css/themes/semi-dark-layout.min.css') ?>">
    <link rel="stylesheet" type="text/css"
          href="<?= base_url('app-assets/css/core/menu/menu-types/vertical-menu.min.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/style.css') ?>">
    <style>
        .feather-16 {
            width: 16px;
            height: 16px;
        }

        .feather-24 {
            width: 24px;
            height: 24px;
        }

        .feather-32 {
            width: 32px;
            height: 32px;
        }
    </style>
</head>
<body class="vertical-layout vertical-menu-modern  navbar-floating footer-static  " data-open="click"
      data-menu="vertical-menu-modern" data-col="">

<?= $this->include('panel/navbar') ?>
<?= $this->include('panel/sidebar') ?>


<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-start mb-0"><?= esc($page_title) ?></h2>
                        <?php if (isset($breadcrumbs)) { ?>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
                                        <li class="breadcrumb-item <?= !isset($breadcrumb['href']) ? 'active' : '' ?>">
                                            <?php if (isset($breadcrumb['href'])) { ?>
                                                <a href=""><?= esc($breadcrumb['title']) ?></a>
                                            <?php } else { ?>
                                                <?= esc($breadcrumb['title']) ?>
                                            <?php } ?>
                                        </li>
                                    <?php } ?>
                                </ol>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <?= $this->renderSection('content') ?>
        </div>
    </div>
</div>

<div class="sidenav-overlay"></div>
<div class="drag-target"></div>
<?= $this->include('panel/footer') ?>

<button class="btn btn-primary btn-icon scroll-top" type="button"><i data-feather="arrow-up"></i></button>

<div class="modal fade modal-danger text-start" id="modalHapus" tabindex="-1" data-bs-backdrop="static"
     aria-labelledby="myModalHapusLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-xs modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalHapusLabel">Hapus Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="post">
                <input type="hidden" name="_method" value="DELETE"/>
                <div class="modal-body text-center text-body">
                    <h4>Tekan <strong>"Ok"</strong> untuk melanjutkan</h4>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button type="submit" class="btn btn-danger">Ok</button>
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="<?= base_url('app-assets/vendors/js/vendors.min.js') ?>"></script>
<?= $this->renderSection('js') ?>
<script src="<?= base_url('app-assets/js/core/app-menu.min.js') ?>"></script>
<script src="<?= base_url('app-assets/js/core/app.min.js') ?>"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(window).on('load', function () {
        if (feather) {
            feather.replace({width: 14, height: 14});
        }
    })

    const siteUrl = (dataUrl) => {
        return `<?=site_url();?>${dataUrl}`;
    };
    const baseUrl = (dataUrl) => {
        return `<?=base_url();?>${dataUrl}`;
    };

    const swalAction = ({url, data, method = 'POST', textBtn = 'Delete', title = 'Apa anda yakin ?',}) => {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        })
        return swalWithBootstrapButtons.fire({
            title: title ?? `Apa anda yakin ?`,
            text: `Silahkan Klik Tombol ${textBtn} Untuk melakukan Aksi`,
            icon: 'info',
            showCancelButton: true,
            confirmButtonText: textBtn,
            cancelButtonText: 'Cancel',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: method,
                    url: url,
                    dataType: 'json',
                    data: data,
                    success: (res) => {
                        // Toast.fire({
                        //     icon: res.status ? 'success' : 'error',
                        //     title: res.message,
                        //     timer: 2500
                        // }).then(() => {
                        //     window.location.reload();
                        // })
                        window.location.reload();
                    },
                });
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                swalWithBootstrapButtons.fire('Cancel', `Tidak ada aksi ${textBtn} data`, 'error')
            }
        })
    }

    $(document).on('select2:open', () => {
        document.querySelector('.select2-search__field').focus();
    });

    function showModalDelete(url) {
        const myModal = new bootstrap.Modal(document.getElementById('modalHapus'))
        $("#modalHapus form").attr('action', url)
        myModal.show()
    }
</script>
<script>
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 2000
    })
</script>
<?php if (session()->getFlashdata('success')) { ?>
    <script>
        Toast.fire({
            icon: 'success',
            title: "<?= session()->getFlashdata('success')?>"
        })
    </script>
<?php } elseif (session()->getFlashdata('error')) { ?>
    <script>
        Toast.fire({
            icon: 'error',
            title: "<?= session()->getFlashdata('error')?>"
        })
    </script>
<?php } ?>
</body>
</html>