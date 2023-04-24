<!DOCTYPE html>
<html lang="en">

<head>
    <?php  $this->load->view('includes/meta'); ?>
    <?php  $this->load->view('includes/css'); ?>
</head>

<body class="nav-fixed">
    <?php $this->load->view('includes/navbar'); ?>
    <div id="layoutSidenav">
        <?php $this->load->view('includes/sidebar'); ?> 
        <div id="layoutSidenav_content">
            <main>
             <?php  $this->load->view('includes/header') ?>
                <!-- Main page content-->
                    <!-- Main page content-->
                <div class="container-xl px-4 mt-n10">
                    <div class="row">
                       
                            <div class="card h-100">
                                <div class="card-body h-100 p-5">
                                    
                    <div class="row dashboard-items">
                       
                        <div class="col-lg-6 col-xl-3 mb-4">
                            <div class="card bg-dark text-white h-100">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="me-3">
                                            <div class="text-white-75 medium">Documents</div>
                                            <div class="text-lg fw-bold count-documents"></div>
                                        </div>
                                        <i class="feather-xl text-white-50" data-feather="file"></i>
                                    </div>
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between small">
                                    <a class="text-white stretched-link" href="<?php echo base_url() ?>my-documents">View</a>
                                    <div class="text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-xl-3 mb-4">
                            <div class="card bg-dark text-white h-100">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="me-3">
                                            <div class="text-white-75 medium">Received</div>
                                            <div class="text-lg fw-bold count-received"></div>
                                        </div>
                                        <i class="feather-xl text-white-50" data-feather="arrow-down"></i>
                                    </div>
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between small">
                                    <a class="text-white stretched-link" href="<?php echo base_url() ?>received">View </a>
                                    <div class="text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-xl-3 mb-4">
                            <div class="card bg-dark text-white h-100">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="me-3">
                                            <div class="text-white-75 medium">Incoming</div>
                                            <div class="text-lg fw-bold count-incoming"></div>
                                        </div>
                                       <i class="feather-xl text-white-50" data-feather="arrow-down-left"></i>
                                       
                                    </div>
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between small">
                                    <a class="text-white stretched-link" href="<?php echo base_url() ?>incoming">View </a>
                                    <div class="text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-xl-3 mb-4">
                            <div class="card bg-dark text-white h-100">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="me-3">
                                            <div class="text-white-75 small">Outgoing</div>
                                            <div class="text-lg fw-bold count-outgoing"></div>
                                        </div>
                            

                                        <i class="feather-xl text-white-50" data-feather="arrow-up-right"></i>
                                    </div>
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between small">
                                    <a class="text-white stretched-link" href="<?php echo base_url() ?>outgoing">View </a>
                                    <div class="text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>


                                </div>
                            </div>
                       
                      
                    </div>

                </div>
           
            </main>
          
            <?php $this->load->view('includes/footer') ?>
        </div>
    </div>
   
   <?php $this->load->view('includes/js'); ?>
</body>

</html>