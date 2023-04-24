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
                                   
                                    <a class="btn btn-sm btn-light text-primary add-department p-3 rounded-pill" style="font-size: 15px" href="<?php echo base_url() ?>admin/users?action=add-user">
                                            <i class="me-1" data-feather="plus"></i>
                                            Add User


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
                                        <th>Name</th>
                                        <th>Username</th>
                                        <th>Office</th>
                                        <th>Role</th>
                                        <th>Joined Date</th>
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
   
   <?php $this->load->view('includes/js'); ?>
   <script type="text/javascript">


       $(document).ready(function (){
    var table = $('#table').DataTable({
    
        
         ajax: {
                url: BASE_URL + 'Web/getUsers',
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
                    data: 'user_id',
                    render: function(data, type, row, meta){ 
                        return meta.row + meta.settings._iDisplayStart +1;
                    }
                },
                 {data: 'name'},
                 {data: 'username'},
                 {data: 'office'},
                   {
                    data: 'user_id',
                    render: function(data, type, row, meta){ 
                    
                        var d = '';

                        if (row.role.length > 0) {

                            for (var i = 0; i < row.role.length ; i++) {
                                d += '<button style="margin: 2px;" class="btn btn-primary round-pill p-1 ">'+row.role[i].role+'</button>';
                            }
                           
                        }

                        return d + ' ';

                      
                    }
                },
                  {data: 'created'}, 
                 

                {
                    render : function(data, type, row, meta){
                      

                        return '<div class=" dropstart">\
                                <i class="fa fa-cog" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"></i>\
                              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">\
                                             <a class="dropdown-item update-user" href="javascript:;" data-id="'+row.user_id+'"   >Update</a><hr>\
                                            <a class="dropdown-item delete-user" data-id="'+row.user_id+'" href="javascript:;">Delete</a>\
                                     </div>\
                            </div>';
                    }
                }
                


              
              
                
            ],      
       
    });



});


      
   </script>
</body>

</html>