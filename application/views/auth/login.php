<!DOCTYPE html>
<html lang="en" data-layout="horizontal" data-topbar="dark" data-sidebar-size="lg">

<head>
<?php $this->load->view('auth/meta') ?>
<?php $this->load->view('auth/css') ?>
</head>

<body>

 

    <div class="auth-page-wrapper pt-5">
        <!-- auth page bg -->
        <div class="auth-one-bg-position auth-one-bg" id="auth-particles">
            <div class="bg-overlay"></div>

            <div class="shape">
                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 1440 120">
                        <path d="M 0,36 C 144,53.6 432,123.2 720,124 C 1008,124.8 1296,56.8 1440,40L1440 140L0 140z"></path>
                    </svg>
            </div>
        </div>

        <!-- auth page content -->
        <div class="auth-page-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center mt-sm-5 mb-4 text-white-50">
                            <div>
                                <!-- <a href="index.html" class="d-inline-block auth-logo">
                                        <img src="assets/images/logo-light.png" alt="" height="20">
                                    </a> -->
                            </div>
                            <!-- <p class="mt-3 fs-15 fw-medium">Premium Admin & Dashboard Template</p> -->
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card mt-4">

                            <div class="card-body p-4">
                                <div class="text-center mt-2">
                                    <!-- <h5 class="text-primary">Welcome Back !</h5>
                                    <p class="text-muted">Sign in to continue to Velzon.</p> -->

                                </div>
                                <div class="p-2 mt-4">
                                    <form id="login-form" style="">
                   <center><img style="height:150px;width:150px"src="<?php echo base_url() ?>assets/Oroquieta.png"></center>
                                        <div class="mb-3">
                                            <label for="username" class="form-label">Username</label>
                                            <input type="text" class="form-control" name="username" id="username" placeholder="Enter username" required>
                                        </div>

                                        <div class="mb-3">
                                            <div class="float-end">
                                                <a href="auth-pass-reset-basic.html" class="text-muted">Forgot password?</a>
                                            </div>
                                            <label class="form-label" for="password-input">Password</label>
                                            <div class="position-relative auth-pass-inputgroup mb-3">
                                                <input type="password" class="form-control pe-5" placeholder="Enter password" id="password-input" name="password" required>
                                                <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted" type="button" id="password-addon"><i class="fas fa-key align-middle"></i></button>
                                            </div>


                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="auth-remember-check">
                                            <label class="form-check-label" for="auth-remember-check">Remember me</label>
                                        </div>

                                        <div class="mt-4">
                                            <button class="btn  w-100 login" style="background-color: #0061f2; color: #fff" type="submit">Sign In 
                                        </button>

                                        </div>

                                          <div class="mt-2">
                                            <button class="btn  w-100 track" style="background-color: #0061f2; color: #fff" type="button"> Track Documents
                                        </button>
                                        
                                        </div>

                                         <div class="text-center mt-2">
                                            
                                             <span class="text-danger error"></span>

                                        </div>

                                    </form>
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->
<!-- 
                        <div class="mt-4 text-center">
                            <p class="mb-0">Don't have an account ? <a href="auth-signup-basic.html" class="fw-semibold text-primary text-decoration-underline"> Signup </a> </p>
                        </div>
 -->
                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end auth page content -->

        <!-- footer -->
        <?php $this->load->view('auth/footer') ?>
        <!-- end Footer -->
    </div>
    <!-- end auth-page-wrapper -->


   

 <!-- JAVASCRIPT -->
    <?php $this->load->view('auth/js') ?>

    <script type="text/javascript">
        var BASE_URL = '<?php echo base_url(); ?>';
        
        $('#login-form').on('submit', function(e){
            e.preventDefault();

            $('.login').text(' ');
            $('.login').html('<div class="spinner-border text-light" role="status">\
                               <span class="visually-hidden">Loading...</span></div>');
            $('.login').attr('disabled',true);

            $.ajax({
                    url : BASE_URL + 'Web/verifyuser',
                    method : 'POST',
                    data : $(this).serialize(),
                    dataType : 'json',
                    success : function (data){

                          if (data.response) {

                            window.location.href = BASE_URL;

                          }else {
                            $('.login').attr('disabled',false);
                            $('.login').text('Sign In');
                            $('.error').text(data.message)

                          }

                     }
            })

        })

        $(document).on('click','.track', function(){

            window.location.href = BASE_URL + 'track';
        })



    </script>
   
</body>

</html>