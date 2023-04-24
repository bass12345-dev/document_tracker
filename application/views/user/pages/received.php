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
                <div class="container-xl px-4 mt-n10 animate__bounceIn">
                 
                    <!-- Example Charts for Dashboard Demo-->
                   
                    <!-- Example DataTable for Dashboard Demo-->
                    <div class="card mb-4">

                        <div class="container-fluid px-4">
                        <div class="page-header-content">
                            <div class="row align-items-center justify-content-between pt-3">
                                <div class="col-auto mb-3">
                                    
                                </div>
                                <div class="col-12 col-xl-auto mb-3">
                                   
                                    <a class="btn btn-sm btn-light text-primary add-department " href="<?php echo base_url() ?>received?action=history">
                                            <i class="me-1" data-feather="eye"></i>
                                            View Received Documents
                                        </a>
                                </div>
                            </div>
                        </div>
                    </div>

                        
                        <div class="card-body">
                            <table id="table" class="table table-striped table-responsive table-bordered table-hover table-checkable dt-responsive nowrap " style="width: 100% ">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Tracking Code</th>
                                        
                                        
                                         <th>Document Type</th>
                                         <th>Date</th>
                                         <th>Time</th>
                                        
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                              
                            </table>
                        </div>
                    
                    </div>
                </div>
            </main>
          
            <?php $this->load->view('includes/footer') ?>
        </div>
    </div>
   <?php $this->load->view('user/off_canvas/update/release_doc') ?>
   <?php $this->load->view('includes/js'); ?>

   <script type="text/javascript">


     $(document).ready(function (){
    var table = $('#table').DataTable({
    
        
         ajax: {
                url: BASE_URL + 'Web/getMyRecDocs',
                type: 'POST',
                data: {
                    pagination: {
                        perpage: 50,
                    },
                },
            },  

            'processing': true,
        'language': {
            'loadingRecords': '&nbsp;',
            'processing': 'Loading...'
        },

          "scrollY": 200,
        "scrollX": true,


         columns: [
                // {'data': 'department_id'}, 
                {
                    data: 'history_id',
                    render: function(data, type, row, meta){ 
                        return meta.row + meta.settings._iDisplayStart +1;
                    }
                },
                 {data: 't_number'},
              
                {data: 'document_type'},
                {data: 'date'},
                {data: 'time'},    
                {
                    render : function(data, type, row, meta){


                        var action = '';

                      action += '<div class=" dropstart">\
                                <i class="fa fa-cog" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"></i><div class="dropdown-menu" aria-labelledby="dropdownMenuButton">';
                       if (row.r_action) {
                        action += '<a class="dropdown-item release-doc"  data-tracking-number="'+row.t_number+'" data-id="'+row.type_id+'" href="javascript:;"  >Release</a><hr>';
                      }
                      action += ' <a class="dropdown-item view-doc" data-code="'+row.t_code+'"  href="javascript:;">View Info</a>';

                     

                      action += '</div>\
                            </div>';


                        return action;
                      

                      
                    }
                }
                


              
              
                
            ],      
       
    });

});




         $(document).on('click','.release-doc',function(e){
        
        e.preventDefault();

        var tracking_number = $(this).data('tracking-number'); 
        var id = $(this).data('id'); 
    
            Swal.fire({
              
                  title: 'Are you sure?',
                  text: "",
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Release Document!',
                  reverseButtons: true
            }).then(function (result) {
                if (result.value) {
                    $.ajax({
                        url: BASE_URL + 'Web/releaseDoc',
                        method: "POST",
                        data: {'id':id , 'tracking_number' : tracking_number},
                        dataType: "json",
                        beforeSend: function(){
                                       var html = 'PLease Wait ...<div class="spinner-border text-secondary" role="status">\
                                          <span class="sr-only">Loading...</span>\
                                        </div>';  
                                        Swal.fire({
                                          
                                          title: html,
                                          showConfirmButton: false,

                                        })
              
                                       
                                    },
                        success: function (data) {
                           
                            if (data.response) {
                                var message = 'Released Successfully';
                                Swal.close();
                                toast_message_success(message);
                                $('#table').DataTable().ajax.reload();
                                Process.count();

                            }else{
                                alert('error')
                            }

                        },
                        error: function (xhr , status, error) {
                            // error here ... 
                            console.info(xhr.responsetext); 
                        },
                    });
                } 
            });

      

    });



   </script>
</body>

</html>