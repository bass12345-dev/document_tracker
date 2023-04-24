<!DOCTYPE html>
<html lang="en">

<head>
    <?php  $this->load->view('includes/meta'); ?>
    <?php  $this->load->view('includes/css'); ?>
   
</head>

<body class="nav-fixed">
    <?php $this->load->view('admin/includes/navbar'); ?>
    <div id="layoutSidenav">
        <?php $this->load->view('admin/includes/sidebar'); ?> 
        <div id="layoutSidenav_content">
            <main>
                <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
                    <div class="container-xl px-4">
                        <div class="page-header-content pt-4">
                            <div class="row align-items-center justify-content-between">
                                <div class="col-auto mt-4">
                                    <h1 class="page-header-title">
                                        <div class="page-header-icon"><i data-feather="activity"></i></div>
                                        Dashboard
                                    </h1>
                                   <!--  <div class="page-header-subtitle">Example dashboard overview and content summary</div> -->
                                </div>
                                <!-- <div class="col-12 col-xl-auto mt-4">
                                    <div class="input-group input-group-joined border-0" style="width: 16.5rem">
                                        <span class="input-group-text"><i class="text-primary" data-feather="calendar"></i></span>
                                        <input class="form-control ps-0 pointer" id="litepickerRangePlugin" placeholder="Select date range..." />
                                    </div>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </header>
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
                                            <div class="text-lg fw-bold"><?php echo $count_all_documents; ?></div>
                                        </div>
                                        <i class="feather-xl text-white-50" data-feather="file"></i>
                                    </div>
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between small">
                                    <a class="text-white stretched-link" href="<?php echo base_url() ?>admin/documents">View</a>
                                    <div class="text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-xl-3 mb-4">
                            <div class="card bg-dark text-white h-100">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="me-3">
                                            <div class="text-white-75 medium">Users</div>
                                            <div class="text-lg fw-bold"><?php echo $count_all_user; ?></div>
                                        </div>
                                        <i class="feather-xl text-white-50" data-feather="users"></i>
                                    </div>
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between small">
                                    <a class="text-white stretched-link" href="<?php echo base_url() ?>admin/users">View </a>
                                    <div class="text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-xl-3 mb-4">
                            <div class="card bg-dark text-white h-100">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="me-3">
                                            <div class="text-white-75 medium">Offices</div>
                                            <div class="text-lg fw-bold"><?php echo $count_all_office; ?></div>
                                        </div>
                                        <i class=" feather-xl text-white-50 fas fa-sitemap"></i>
                                       
                                    </div>
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between small">
                                    <a class="text-white stretched-link" href="<?php echo base_url() ?>admin/offices">View </a>
                                    <div class="text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-xl-3 mb-4">
                            <div class="card bg-dark text-white h-100">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="me-3">
                                            <div class="text-white-75 small">Administrators</div>
                                            <div class="text-lg fw-bold"><?php echo  $count_all_admin; ?></div>
                                        </div>
                            

                            <i class=" feather-xl text-white-50 fas fa-user-lock"></i>
                                    </div>
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between small">
                                    <a class="text-white stretched-link" href="<?php echo base_url() ?>admin/administrators">View </a>
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
          
            </footer> -->
            <?php $this->load->view('includes/footer') ?>
        </div>
    </div>
   
   <?php $this->load->view('includes/js'); ?>
   <script type="text/javascript">

    var lazy_load = '';

       

       function lazy_loading(){


         for (var i = 0; i < 4; i++) {


            
            lazy_load += '<div class="col-lg-6 col-xl-3 mb-4">\
                            <div class="card backgrond  text-white h-100" id="background">\
                                <div class="card-body">\
                                    <div class="d-flex justify-content-between align-items-center">\
                                        <div class="me-3">\
                                            <div class="text-white-75 medium">Documents</div>\
                                            <div class="text-lg fw-bold">3</div>\
                                        </div>\
                                        <i class="feather-xl text-white-50" data-feather="file"></i>\
                                    </div>\
                                </div>\
                                <div class="card-footer d-flex align-items-center justify-content-between small">\
                                    <a class="text-white stretched-link" href="#!">View</a>\
                                    <div class="text-white"><i class="fas fa-angle-right"></i></div>\
                                </div>\
                            </div>\
                        </div>';



        }

        $('.dashboard-itms').html(lazy_load);

       }

       function load_dashboard_items(){

        lazy_loading();

        $.ajax({
                        method : 'POST',
                        url :  BASE_URL + 'admin/Dashboard/load_dashboard_items',
                        data : $(this).serialize(),
                        dataType : 'json',
                        success : function(data){
                            //  console.log(data.dashboard_items.length)
                            // // if (data.dashboard_items.length > 0) {
                            // //     console.log(data.dashboard_items.length)
                            // // }

                           

                        }

                    })
       }

       $(document).ready(function(e){

            load_dashboard_items();
            
       })



    

      
   </script>
</body>

</html>