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
                 <?php  $this->load->view('includes/header') ?>
              <!-- Main page content-->
                <div class="container-xl px-4 mt-n10 ">
                    <div class="card mb-4 animate__bounceIn">
                        <div class="container-fluid px-4">
                        <div class="page-header-content">
                            <div class="row align-items-center justify-content-between pt-3">
                                <div class="col-auto mb-3">
                                    
                                </div>
                                <div class="col-12 col-xl-auto mb-3">
                                   
                                    <a class="btn btn-sm btn-light text-primary add-department p-3 rounded-pill" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"  style="font-size: 15px" href="<?php echo base_url() ?>admin/users?action=add-user">
                                            <i class="me-1" data-feather="plus"></i>
                                            Add Role


                                        </a>
                                </div>
                            </div>
                        </div>
                    </div>
                        <div class="card-body ">
                        
                            <table id="table" class="table table-striped table-responsive table-bordered table-hover table-checkable dt-responsive nowrap" style="width: 100% ">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                       <th>Roles</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                           
                            </table>
                        </div>
                    </div>
                </div>
                
            </main>
          
            </footer> -->
            <?php $this->load->view('includes/footer') ?>
        </div>
    </div>
   
   <?php $this->load->view('admin/off_canvas/add/add_role'); ?>
   <?php $this->load->view('includes/js'); ?>
   <script type="text/javascript">




    var table = $('#table').DataTable({
    
        
         ajax: {
                url: BASE_URL + 'web/getRoles',
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
                    data: 'role_id',
                    render: function(data, type, row, meta){ 
                        return meta.row + meta.settings._iDisplayStart +1;
                    }
                },
                 {data: 'role'},
              
                {
                    render : function(data, type, row, meta){
                      

                        return '<div class=" dropstart">\
                                <i class="fa fa-cog" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"></i>\
                              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" >\
                                            <a class="btn btn-light dropdown-item border-bottom mb-1" style="font-size: 30px;"><i class="fa fa-pen" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"></i></a>\
                                             <a class="btn btn-light dropdown-item" style="font-size: 30px;"><i class="fa fa-trash" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"></i></a>\
                                            \
                                     </div>\
                            </div>';
                    }
                }
                
// <a class="dropdown-item view-doc" data-code="'+row.role_id+'"  href="javascript:;">View Info</a>\

              
              
                
            ],      
       
    });



         $('#add_role_form').on('submit', function(e){
        e.preventDefault();


            $('.save').attr('disabled',true);
            $('.save').html('saving...');
                $.ajax({
                        method : 'POST',
                        url :  BASE_URL + 'Web/addRole',
                        data : $(this).serialize(),
                        dataType : 'json',

                           beforeSend: function(){                                     
                                        let timerInterval
                                        Swal.fire({
                                          title: 'Please Wait!',
                                          
                                          allowOutsideClick: false,
                                          didOpen: () => {
                                            Swal.showLoading()
                                            
                                          },
                                          
                                        })
                                       
                                    },
                      
                        success :  function(data){

                            
                             
                            if (data.response) {
                                Swal.close();
                                $('.save').attr('disabled',false);
                                $('.save').html('Save');   
                                $('#table').DataTable().ajax.reload();
                                $('#add_role_form')[0].reset();
                                var message = 'Saved Successfully';
                                toast_message_success(message);
                                
                                
                            
                            }else {

                                var message = 'Something Wrong';
                                message_error(message);

                            }

                           
                           
                        }

                    })
  

   })

      
   </script>
</body>

</html>