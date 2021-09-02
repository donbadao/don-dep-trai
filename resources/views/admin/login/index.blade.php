<html>
    <head>
        <title>Đăng nhập hệ thống - G5R Entertaiment</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous" />
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <!-- <script src="https://www.google.com/recaptcha/api.js"></script> -->
        <style>
            body {
                background: #f8f9fd;
            }
            .loginWrapper {
                padding: 7em 0;
            }
            .loginContent {
                position: relative;
                background: #fff;
                border-radius: 10px;
                -webkit-box-shadow: 0px 10px 34px -15px rgb(0 0 0 / 24%);
                -moz-box-shadow: 0px 10px 34px -15px rgba(0, 0, 0, 0.24);
                box-shadow: 0px 10px 34px -15px rgb(0 0 0 / 24%);
            }
        </style>
    </head>
    <body>
        <section class="loginWrapper">
            <div class="container">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="loginForm" id="loginForm">
                        <div class="row justify-content-center">
                            <div class="col-xl-5 col-sm-12">
                                <div class="loginContent p-4 p-5">
                                    <h3 class="text-center mb-5">Đăng nhập hệ thống</h3>
                                    <div class="form-group mb-3"><input type="text" class="form-control" id="username" name="username" placeholder="Tài khoản đăng nhập..." /></div>
                                    <div class="form-group mb-3"><input type="password" class="form-control" id="password" name="password" placeholder="Mật khẩu đăng nhập..." /></div>
                                    <div class="form-check mb-3"><input class="form-check-input" type="checkbox" value="" id="remember" name="remember" /><label class="form-check-label" for="remember">Ghi nhớ</label></div>
                                    <!-- <div name="g-recaptcha" id="g-recaptcha" class="g-recaptcha mb-3" data-sitekey="6LcEBcQaAAAAAOWxj1YA4W2sHKMnyWH4yF-UWC2n"></div> -->
                                    @csrf
                                    <div><input type="submit" class="form-control btn btn-primary rounded submit px-3" value="Đăng nhập" /></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
        <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
