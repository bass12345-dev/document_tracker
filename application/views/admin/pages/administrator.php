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
                <div class="container-xl px-4 mt-n10 animate__bounceIn">
                 
                    <!-- Example Charts for Dashboard Demo-->
                   
                    <!-- Example DataTable for Dashboard Demo-->
                    <div class="card mb-4">
                        <?php 

                        if ($admin['admin_role'] === 'superadmin') {
                            # code...
                    

                        ?>
                        <div class="container-fluid px-4">
                        <div class="page-header-content">
                            <div class="row align-items-center justify-content-between pt-3">
                                <div class="col-auto mb-3">
                                    
                                </div>
                                <div class="col-12 col-xl-auto mb-3">
                                   
                                    <a class="btn btn-sm btn-light text-primary add-department p-3 rounded-pill" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"  style="font-size: 15px" href="javascript:;">
                                            <i class="me-1" data-feather="plus"></i>
                                            Add New Admin


                                        </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php 

                        }

                    ?>
                        <div class="card-body">
                            <table id="table" class="table table-striped table-responsive table-bordered table-hover table-checkable dt-responsive nowrap " style="width: 100% ">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Role</th>
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


<?php $this->load->view('admin/off_canvas/add/add_admin'); ?>
<?php $this->load->view('includes/js'); ?>

   <script type="text/javascript">


    $(document).ready(function (){
    var table = $('#table').DataTable({
    
        
         ajax: {
                url: BASE_URL + 'web/getAdmins',
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
                    data: 'id',
                    render: function(data, type, row, meta){ 
                        return meta.row + meta.settings._iDisplayStart +1;
                    }
                },
                 {data: 'name'},
                 {
                    render: function(data, type, row, meta){ 
                        return ' <div class="badge bg-primary text-white rounded-pill p-2 px-4"  ><span class="fs-6">'+row.role+'</span></div>';
                    }
                },

                {
                    render : function(data, type, row, meta){


                        var action = null;

                        if (!row.x && !row.y) {

                            action =   '<div class=" dropstart">\
                                <i class="fa fa-cog" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"></i>\
                              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">\
                                            <a class="dropdown-item delete-admin" data-id="'+row.id+'" href="javascript:;">Remove</a>\
                                     </div>\
                            </div>';

                        }
                      
                        return action;
                       
                    }
                }
                


              
              
                
            ],      
       
    });

});
   



    $('#add_admin_form').on('submit', function(e){
        e.preventDefault();


        $('.add').html('Processing...');
        $('.add').attr('disabled',true);

        $.ajax({
                        method : 'POST',
                        url :  BASE_URL + 'Web/addAdmin',
                        data : $(this).serialize(),
                        dataType : 'json',
                        success :  function(data){
                          
                            if (data.response) {
                                $('.add').attr('disabled',false);
                                $('.add').html('Add');   
                                $('#table').DataTable().ajax.reload();
                
                                var message = 'Added Successfully';
                                 toast_message_success(message);
                                
                                
                            
                            }else {
                                 $('.add').attr('disabled',false);
                                $('.add').html('Add');   
                               var message = 'Something Wrong';
                               message_error(message);
                            }

                           
                           
                        }

                    })
        
    })




        $(document).on('click','.delete-admin',function(e){
        
        e.preventDefault();

        var id = $(this).data('id'); 
        var url = 'Web/delete_admin';
        delete_item(id,url);


      

    });
    


   </script>
</body>

</html>