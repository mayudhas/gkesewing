<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Point Of Sales Gereja Kalimantan Evangelis Sewing">
    <meta name="keywords" content="Gereja Kalimantan Evangelis,GKE, Gereja Kalimantan Evangelis Sewing, GKE Sewing">
    <meta name="author" content="Shelter Digital">
    <title>GKE Sewing</title>
    <link rel="shortcut icon" type="image/x-icon"
          href="<?= base_url('asset-landing/assets/img/logo_gke.png') ?>">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600" rel="stylesheet">

    <link rel="stylesheet" href="<?= base_url('asset-landing/assets/css/bootstrap.css') ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
          integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet" href="<?= base_url('asset-landing/assets/css/hero-slider.css') ?>">
    <link rel="stylesheet" href="<?= base_url('asset-landing/assets/css/owl-carousel.css') ?>">
    <link rel="stylesheet" href="<?= base_url('asset-landing/assets/css/templatemo-style.css') ?>">
    <link rel="stylesheet" href="<?= base_url('asset-landing/assets/css/custom.css') ?>">
    <link rel="stylesheet" href="<?= base_url('app-assets/vendors/css/extensions/sweetalert2.min.css') ?>">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">

    <style>
        .collapse > body {
            overflow: hidden !important;
        }

        .margin-alert {
            margin-top: -10px
        }

        .alert {
            margin-bottom: 0px !important;
        }
    </style>

    <script src="<?= base_url('asset-landing/assets/js/vendor/modernizr-2.8.3-respond-1.4.2.min.js') ?>"></script>
</head>

<body>
<button type="button" class="btn btn-warning btn-floating btn-lg btn-circle" id="btn-back-to-top">
    <i class="fa fa-arrow-up"></i>
</button>
<section class="banner" id="top">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="left-banner-content">
                    <div class="text-content">
                        <img class="hidden-md hidden-lg"
                             src="<?= base_url('asset-landing/assets//img//logo_gke.png') ?>" width="50">
                        <h6 class="hidden-md hidden-lg">P O S - GKE SEWING</h6>
                        <h1>Point Of Sales - GKE Sewing</h1>
                        <div class="row col-lg-12 center-sm-div center-md-div">
                            <a href="#" class="scroll-link" data-id="best-offer-section">
                                <div class="white-border-button col-xs-3 ml-50 mr-50">Tentang</div>
                            </a>
                            <a href="#" class="scroll-link" data-id="contact">
                                <div class="white-border-button col-xs-3 ml-50 mr-50">Masuk POS - GKE SEWING</div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 hidden-xs hidden-sm">
                <div class="right-banner-content">
                    <div class="logo" style="margin-top: 20%;">
                        <a href="#"><img alt="" src="<?= base_url('asset-landing/assets//img//logo_gke.png') ?>"
                                         width="300"></a>
                    </div>
                    <h2>Gereja Kalimantan Evangelis</h2>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="best-offer" id="best-offer-section">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 hidden-xs hidden-sm">
                <div class="best-offer-left-content">
                    <div class="icon"><img
                                src="<?= base_url('asset-landing/assets//img//best-offer-icon.png') ?>" alt=""
                                width="30%"></div>
                    <h4>Tentang</h4>
                </div>
            </div>
            <div class="col-md-8">
                <div class="best-offer-right-content">
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <h2><em>P O S - GKE SEWING</em></h2>
                            <h5 style="line-height: 1.5;">
                                <b>GKE SEWING</b> is simply dummy text of the printing and typesetting industry. Lorem
                                Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown
                                printer took a galley of type and scrambled it to make a type specimen book. It has
                                survived not only five centuries, but also the leap into electronic typesetting,
                                remaining essentially unchanged. It was popularised in the 1960s with the release of
                                Letraset sheets containing Lorem Ipsum passages, and more recently with desktop
                                publishing software like Aldus PageMaker including versions of Lorem Ipsum
                            </h5>
                            <div class="pink-button">
                                <a href="#" class="scroll-link" data-id="contact">Masuk POS - GKE Sewing</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="contact-us" id="contact-section">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <?= form_open(uri_string(), ['class' => 'form-login', 'id' => 'contact']); ?>
                <br/>
                <br/>
                <br/>
                <br/>
                <?= getCsrfToken(); ?>
                <div class="row">
                    <div class="col-md-12">
                        <fieldset>
                            <input name="username" type="text" class="form-control" placeholder="Username"
                                   required="">
                        </fieldset>
                    </div>
                    <div class="col-md-12">
                        <fieldset>
                            <input name="password" type="password" class="form-control" placeholder="Password"
                                   required="">
                        </fieldset>
                    </div>
                    <div class="col-md-6">
                        <fieldset>
                            <button type="submit" id="form-submit" class="btn btn-sign-in" value="Login">Login</button>
                        </fieldset>
                    </div>
                    <div class="col-md-12">
                        <div class="text-center mt-2">
                        </div>
                    </div>
                </div>
                <?= form_close(); ?>
            </div>
            <div class="col-md-4 hidden-xs hidden-sm">
                <div class="contact-right-content">
                    <div class="icon"><img
                                src="<?= base_url('asset-landing/assets//img//map-marker-icon.png') ?>" alt=""
                                width="40%"></div>
                    <h4>Masuk POS - GKE SEWING</h4>
                </div>
            </div>
        </div>
    </div>
</section>

<footer>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <p>POS PENJAHIT GKE &copy; 2022 - Shelter Digital</p>
            </div>
        </div>
    </div>
</footer>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="<?= base_url('asset-landing/assets/js/plugins.js') ?>"></script>
<script src="<?= base_url('asset-landing/assets/js/main.js') ?>"></script>
<script src="<?= base_url('asset-landing/assets/js/vendor/bootstrap.js') ?>"></script>
<script src="<?= base_url('app-assets/vendors/js/extensions/sweetalert2.all.min.js') ?>"></script>
<script type="text/javascript">
    $(document).ready(function () {
        let mybutton = document.getElementById("btn-back-to-top");
        window.onscroll = function () {
            scrollFunction();
        };

        function scrollFunction() {
            if (
                document.body.scrollTop > 20 ||
                document.documentElement.scrollTop > 20
            ) {
                mybutton.style.display = "block";
            } else {
                mybutton.style.display = "none";
            }
        }

        mybutton.addEventListener("click", backToTop);

        function backToTop() {
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;
        }

        $('.scroll-link').on('click', function (event) {
            event.preventDefault();
            var sectionID = $(this).attr("data-id");
            console.log(sectionID);
            scrollToID('#' + sectionID, 750);
        });
        $('.scroll-top').on('click', function (event) {
            event.preventDefault();
            $('html, body').animate({
                scrollTop: 0
            }, 'slow');
        });
        $('#nav-toggle').on('click', function (event) {
            event.preventDefault();
            $('#main-nav').toggleClass("open");
        });

        $('.form-login').submit(function () {
            $.ajax({
                type: "POST",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                cache: false,
                dataType: 'JSON',
                beforeSend: () => {
                    $('.btn-sign-in').html(`Loading . . .`).prop('disabled', true)
                },
                complete: () => {
                    $('.btn-sign-in').html(`Sign in`).prop('disabled', false)
                },
                success: function (result) {
                    if (result.status === true) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            html: result.message,
                            timer: 2500,
                            showConfirmButton: false,
                            onBeforeOpen: () => {
                                Swal.showLoading();
                            }
                        }).then((result) => {
                            location.href = '<?=site_url('dashboard');?>'
                        });
                    }
                },
                error: function (jqXHR, error, errorThrown) {
                    const jsonValue = JSON.parse(jqXHR.responseText);
                    Swal.fire({
                        icon: 'error',
                        title: 'Failed !!!',
                        html: jsonValue.message,
                        timer: 2200,
                        showConfirmButton: false,
                    });
                }
            });
            return false;
        })
    });

    function scrollToID(id, speed) {
        var offSet = 0;
        var targetOffset = $(id).offset().top - offSet;
        var mainNav = $('#main-nav');
        $('html,body').animate({
            scrollTop: targetOffset
        }, speed);
        if (mainNav.hasClass("open")) {
            mainNav.css("height", "1px").removeClass("in").addClass("collapse");
            mainNav.removeClass("open");
        }
    }

    if (typeof console === "undefined") {
        console = {
            log: function () {
            }
        };
    }
</script>
</body>

</html>