<!DOCTYPE html>
<html lang="tr">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Ay-soft</title>
    <!-- Custom fonts for this template-->
    <link href="/public/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="/public/css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body class="bg-gradient-primary">

<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-xl-6 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <!--  <div class="col-lg-6 d-none d-lg-block bg-login-image"></div> -->
                        <div class="col-lg-12">
                            <div class="p-5">
                                <div class="text-center">
                                    <div class="sidebar-brand-icon ">
                                        <img src="//cdn.yemeksepeti.com/CategoryImages/TR_ADANA/zeki_usta_kebap_big.gif" class="img-fluid">
                                    </div>
                                    <h1 class="h4 text-gray-900 mb-4 mt-2">Admin Giriş </h1>
                                </div>
                                <form class="user" action="giris" method="post">
                                    <?php echo e(csrf_field()); ?>

                                    <div class="form-group">
                                        <input type="email" class="form-control form-control-user" id="exampleInputEmail" name="email" aria-describedby="emailHelp" placeholder="E-mail ">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user" id="exampleInputPassword" name="password" placeholder="Parola">
                                    </div>
                                    <div class="form-group">
                                        <!-- <div class="custom-control custom-checkbox small">
                                          <input type="checkbox" class="custom-control-input" id="customCheck">
                                          <label class="custom-control-label" for="customCheck">Remember Me</label>
                                        </div> -->
                                    </div>
                                    <button class="btn btn-primary btn-user btn-block">
                                        Giriş Yap
                                    </button>
                                    <hr>

                                </form>

                                <!-- <div class="text-center">
                                  <a class="small" href="forgot-password.html">Parolami unuttum</a>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>


</body>

</html>
<?php /**PATH C:\Users\BoraaacaY\Desktop\zeki-usta-laravel\resources\views/admin/login.blade.php ENDPATH**/ ?>