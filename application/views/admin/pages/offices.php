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
                        <div class="container-fluid px-4">
                        <div class="page-header-content">
                            <div class="row align-items-center justify-content-between pt-3">
                                <div class="col-auto mb-3">
                                    
                                </div>
                                <div class="col-12 col-xl-auto mb-3">
                                   
                                    <a class="btn btn-sm btn-light text-primary add-department p-3 rounded-pill" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"  style="font-size: 15px" href="<?php echo base_url() ?>admin/users?action=add-user">
                                            <i class="me-1" data-feather="plus"></i>
                                            Add Office


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
                                        <th>Offices</th>
                                        <th>Status</th>
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


<?php $this->load->view('admin/off_canvas/add/add_office'); ?>
<?php $this->load->view('admin/off_canvas/update/update_office'); ?>
<?php $this->load->view('includes/js'); ?>

   <script type="text/javascript">

    $(document).ready(function (){
    var table = $('#table').DataTable({
    
        
         ajax: {
                url: BASE_URL + 'web/getOffices',
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
                    data: 'office_id',
                    render: function(data, type, row, meta){ 
                        return meta.row + meta.settings._iDisplayStart +1;
                    }
                },
                 {data: 'office'},
                 {
                    render: function(data, type, row, meta){ 
                        return ' <div class="badge '+row.color+' text-white rounded-pill p-2 px-4"  ><span class="fs-6">'+row.status+'</span></div>';
                    }
                },

                {
                    render : function(data, type, row, meta){
                      

                        return '<div class=" dropstart">\
                                <i class="fa fa-cog" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"></i>\
                              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">\
                                             <a class="dropdown-item update-department" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight1" aria-controls="offcanvasRight" href="javascript:;" data-id="'+row.office_id+'" data-department-name = "'+row.office+'" data-status="'+row.status+'"   >Update</a><hr>\
                                            <a class="dropdown-item delete-department" data-id="'+row.office_id+'" href="javascript:;">Delete</a>\
                                     </div>\
                            </div>';
                    }
                }
                


              
              
                
            ],      
       
    });

    
    $(document).on('click','.update-department',function(e){

        $('input[name=update_office_name]').val($(this).data('department-name'));
        $('select[name=update_status]').val($(this).data('status'));
        $('input[name=office_id]').val($(this).data('id'));
    })  

    $('#update_office_form').on('submit', function(e){
        e.preventDefault();


        $('.update').html('Updating...');
        $('.update').attr('disabled',true);

        $.ajax({
                        method : 'POST',
                        url :  BASE_URL + 'Web/updateOffice',
                        data : $(this).serialize(),
                        dataType : 'json',
                        success :  function(data){
                          
                            if (data.response) {
                                Swal.close();
                                $('.update').attr('disabled',false);
                                $('.update').html('Update');   
                                $('#table').DataTable().ajax.reload();
                
                                var message = 'Update Successfully';
                                 toast_message_success(message);
                                
                                
                            
                            }else {

                               var message = 'Something Wrong';
                               message_error(message);
                            }

                           
                           
                        }

                    })
        
    })
    

    $(document).on('click','.delete-department',function(e){
        
        e.preventDefault();

        var id = $(this).data('id'); 
        var url = 'Web/delete_office';
        delete_item(id,url);


      

    });

   


       $('#add_office_form').on('submit', function(e){
        e.preventDefault();

        var x = $("#inputState :selected").val();

        console.log(x)


        if(x == '') {
            alert('Please choose status')
        }else {


            $('.save').attr('disabled',true);
            $('.save').html('saving...');
                $.ajax({
                        method : 'POST',
                        url :  BASE_URL + 'Web/addOffice',
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
                                $('#add_office_form')[0].reset();
                                var message = 'Saved Successfully';
                                toast_message_success(message);
                                
                                
                            
                            }else {

                                var message = 'Something Wrong';
                                message_error(message);

                            }

                           
                           
                        }

                    })

        }     

   })


});



   </script>
</body>

</html>