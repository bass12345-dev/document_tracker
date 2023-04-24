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
                                            Add Type


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
                                        <th>Type Name</th>
                                        
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

<?php $this->load->view('admin/modals/update_modals/update_flow') ?> 
<?php $this->load->view('admin/off_canvas/add/add_type'); ?>
<?php $this->load->view('admin/off_canvas/add/arrange_file_destination'); ?>

<?php $this->load->view('includes/js'); ?>

<script>


      $(document).ready(function (){
    var table = $('#table').DataTable({
    
        
         ajax: {
                url: BASE_URL + 'Web/get_types',
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
                    data: 'type_id',
                    render: function(data, type, row, meta){ 
                        return meta.row + meta.settings._iDisplayStart +1;
                    }
                },
                 {data: 'type_name'},
                 

                {
                    render : function(data, type, row, meta){
                      

                        return '<div class=" dropstart">\
                                <i class="fa fa-cog" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"></i>\
                              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">\
                                             <a class="dropdown-item update-type" href="javascript:;" data-id="'+row.type_id+'" data-type-name = "'+row.type_name+'"  data-bs-toggle="modal" data-bs-target="#updateModal" data-bs-whatever="@mdo" >Update</a><hr>\
                                             <a class="dropdown-item update-type" href="javascript:;" data-id="'+row.type_id+'" data-type-name = "'+row.type_name+'"  onclick="load_flow('+row.type_id+')" >Update Document Destination</a><hr>\
                                            <a class="dropdown-item delete" data-id="'+row.type_id+'" href="javascript:;">Delete</a>\
                                     </div>\
                            </div>';
                    }
                }
                


              
              
                
            ],      
       
    });


});
    

       $('#add_type_form').on('submit', function(e){
        e.preventDefault();

            $('.save').html('saving...');
            $('.save').attr('disabled',true);

             $.ajax({
                    method : 'POST',
                    url :  BASE_URL + 'Web/AddType',
                    data : $(this).serialize(),
                    dataType : 'json',
                    success :  function(data){
                            
                            
                            if (data.response) {
                                Swal.close();    
                                    $('.save').attr('disabled',false);
                                    $('.save').html('Save');                         
                                    $('#table').DataTable().ajax.reload();
                                    var message = 'Saved Successfully';
                                    toast_message_success(message);
                                    $('#add_type_form')[0].reset();


                                    Swal.fire({
                                          title: '',
                                          showDenyButton: true,                                         
                                          confirmButtonText: 'Arrange Document Destination',
                                          denyButtonText: `Later`,
                                         
                                        }).then((result) => {
                                          /* Read more about isConfirmed, isDenied below */
                                          if (result.isConfirmed) {
                                             Swal.close();    
                                            
                                              
                                            var myOffcanvas = document.getElementById('offcanvasRight')
                                            var bsOffcanvas = new bootstrap.Offcanvas(myOffcanvas)
                                            bsOffcanvas.hide();

                                          load_flow(data.type_id);

                                    

                                          } else if (result.isDenied) {
                                          
                                             Swal.close();    
                                          }
                                        })
                                                                
                                    }else {
                                        var message = 'Something Wrong';
                                        message_error(message);

                                    }

                                   
                                   
                                }

                            })

        })



       function load_flow(type_id){

    var myOffcanvas = document.getElementById('offcanvasRight1')
    var bsOffcanvas = new bootstrap.Offcanvas(myOffcanvas)
    bsOffcanvas.show();
    $('input[name=type_id]').val(type_id);

    $.ajax({
                        method : 'GET',
                        url :  BASE_URL + 'Web/GetFlow?type_id='+type_id,
                        dataType : 'json',
                          beforeSend: function(){
                                       var html = 'PLease Wait ...<div class="spinner-border text-secondary" role="status">\
                                          <span class="sr-only">Loading...</span>\
                                        </div>';  
                                        Swal.fire({
                                          
                                          title: html,
                                          showConfirmButton: false,

                                        })
              
                                       
                                    },
                        success :  function(data){

                            console.log(data)
                             Swal.close();

                            if (data.length > 0) {



                               

                                var html  = '';
                                for(var count = 0; count < data.length; count++){

                                    html += '<div class="timeline-item">\
                                           <div class="timeline-item-marker">\
                                                 <div class="timeline-item-marker-indicator bg-gree"><img class="img-fluid" src="'+BASE_URL+'assets/office.png"></div>\
                                            </div>\
                                             <div class="timeline-item-content">';
                                    html += ' <p> <b>'+data[count].department_name+'</b></p>';
                                    if (data[count].x != true) {


                                    html += '<a href="javascript:;" data-type-id="'+data[count].type_id+'" data-id="'+data[count].flow_id+'" class="btn btn-danger delete-flow" ><i class="fas fa-trash"></i></a>\
                                                <a href="javascript:;" data-type-id="'+data[count].type_id+'" data-id="'+data[count].flow_id+'" class="btn btn-primary update-department-flow" data-bs-toggle="modal" data-bs-target="#update_flow" data-bs-whatever="@mdo"><i class="fas fa-pen"></i></a>';


                                    }

                                    html +='</div></div>';


                                

                                }

                                $('.destination').html(html);

                            }


                                            





                   }

            })



}



    $('#add_flow_form').on('submit', function(e){
        e.preventDefault(); 

         $('.save').html('Updating...');
        $('.save').attr('disabled',true);

        var type_id = $('input[name=type_id]').val()

        $.ajax({
                        method : 'POST',
                        url :  BASE_URL + 'Web/update_flow',
                        data : $(this).serialize(),
                        dataType : 'json',
                        
                        success :  function(data){

                             
                            if (data.response) {
                                
                                $('.save').attr('disabled',false);
                                $('.save').html('Add');   
                                    
                                var message = 'Added Successfully';
                                toast_message_success(message);
                                load_flow(data.type_id);

                            
                            }else {

                              var message = 'Something Wrong';
                              message_error(message);

                            }

                           
                           
                        }

                    })
        
    });



    $(document).on('click','.update-department-flow',function(e){

    var id = $(this).data('id');
    $('input[name=update_flow_id]').val(id);
    $('input[name=update_type_id]').val($(this).data('type-id'));


})




       $('#update_department_flow').on('submit', function(e){
        e.preventDefault(); 

         $('.save1').html('Updating...');
        $('.save1').attr('disabled',true);

        var type_id =  $('input[name=update_type_id]').val();




        

        $.ajax({
                        method : 'POST',
                        url :  BASE_URL + 'Web/update_office_flow',
                        data : $(this).serialize(),
                        dataType : 'json',
                        
                        success :  function(data){

                             
                            if (data.response) {
                                
                                $('.save1').attr('disabled',false);
                                $('.save1').html('Update');   
                                    
                                var message = 'Updated Successfully';
                                toast_message_success(message);
                                load_flow(type_id);
                            
                            }else {
                               $('.save1').attr('disabled',false);
                                $('.save1').html('Update');   
                              var message = 'Something Wrong';
                              message_error(message);

                            }

                           
                           
                        }

                    })
        
    });




               $(document).on('click','.delete-flow',function(e){
        
        e.preventDefault();

        var id = $(this).data('id');
        var type_id =  $(this).data('type-id');
        var url = 'web/Api/delete_flow';
        // delete_item(id,url);

 

         Swal.fire({
              
                  title: 'Are you sure?',
                  text: "",
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Yes!',
                  reverseButtons: true
            }).then(function (result) {
                if (result.value) {
                    $.ajax({
                        url: BASE_URL + 'Web/delete_flow',
                        method: "POST",
                        data: {'id':id},
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
                            Swal.fire({
                                    title: 'Deleted Successfully',
                                    // text: 'dasd',
                                     text : 'success',
                                    icon: 'success',
                                   
                                })

                            load_flow(type_id);
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