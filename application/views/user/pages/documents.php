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

                        <?php 

                        $role = $this->session->userdata('role');
                        $rids = explode(" ", $role);
                        $r = [];
                        foreach ($rids as $r_row) {
                                $where = array('role_id' => $r_row);
                            
                            $rr = $this->RoleModel->get_role($this->role_table,$where)->result_array();

                           

                                foreach ($rr as $rrow) {

                                        if ($rrow['role'] == 'Maker'  ) {

                                            echo ' <div class="container-fluid px-4">
                                                    <div class="page-header-content">
                                                        <div class="row align-items-center justify-content-between pt-3">
                                                            <div class="col-auto mb-3">
                                                                
                                                            </div>
                                                            <div class="col-12 col-xl-auto mb-3">
                                                               
                                                                  <a class="btn btn-sm btn-light text-primary add-department p-3 rounded-pill"   style="font-size: 15px" href="'.base_url().'documents?action=add-document">
                                                                        <i class="me-1" data-feather="plus"></i>
                                                                        Add Document


                                                                    </a>

                                                                     
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>';
                                            # code...
                                        }

                                }

                          }


                       




                         ?>

                       
                        <div class="card-body">
                            <table id="table" class=" table table-striped table-responsive table-bordered table-hover table-checkable dt-responsive nowrap" style="width: 100% ">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Tracking Number</th>
                                        <th>Document Type</th>
                                        <th>Date</th>
                                        <th>Time</th>
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
   
   <?php $this->load->view('includes/js'); ?>

   <script type="text/javascript">
           $(document).ready(function (){
    var table = $('#table').DataTable({
    
        
         ajax: {
                url: BASE_URL + 'web/getMyDocs',
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
                    data: 'document_id',
                    render: function(data, type, row, meta){ 
                        return meta.row + meta.settings._iDisplayStart +1;
                    }
                },
                 {data: 'tracking_number'},
                  {data: 'document_type'},
                 // {data: 'document_name'},
                 // {data: 'document_description'},
                 {data: 'created'},
                  {data: 'time'},
                 

                    {
                    render : function(data, type, row, meta){
                      

                        return '<a class="btn '+row.color+' rounded-pill" href="javascript:;">'+row.status+'</a>';
                    }

                },

                {
                    render : function(data, type, row, meta){


                        var action = '';

                        action += '<div class=" dropstart">';
                        action += '<i class="fa fa-cog" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"></i>';
                        action += '<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">';
                        action += ' <a class="dropdown-item print-tracking-slip" data-user-id = "'+row.user_id+'" data-tracking-number="'+row.tracking_number+'" href="javascript:;">Print Tracking Slip</a><hr>\
                                            <a class="dropdown-item track" data-user-id = "'+row.user_id+'" data-tracking-number="'+row.tracking_number+'" href="javascript:;">Track </a><hr>\
                                            <a class="dropdown-item download_image" data-qr="'+row.qr_code+'" data-user-id = "'+row.user_id+'" data-tracking-code="'+row.tracking_number+'" href="javascript:;">Download QR code</a>';
                       if (row.upde === true) {

                             action += '';

                        }else{
                           

                              action += ' <hr><a class="dropdown-item update-doc" href="javascript:;" data-id="'+row.document_id+'" >Update</a><hr>\
                                            <a class="dropdown-item delete-doc" data-id="'+row.document_id+'" href="javascript:;">Delete</a>';
                        }

                        action += '</div>';
                        action += '</div>';


                        return action;
                      

                        // return '<div class=" dropstart">\
                        //         <i class="fa fa-cog" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"></i>\
                        //       <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">\
                        //                     <a class="dropdown-item print-tracking-slip" data-user-id = "'+row.user_id+'" data-tracking-number="'+row.tracking_number+'" href="javascript:;">Print Tracking Slip</a><hr>\
                        //                     <a class="dropdown-item track" data-user-id = "'+row.user_id+'" data-tracking-number="'+row.tracking_number+'" href="javascript:;">Track </a><hr>\
                        //                     <a class="dropdown-item download_image" data-qr="'+row.qr_code+'" data-user-id = "'+row.user_id+'" data-tracking-code="'+row.tracking_number+'" href="javascript:;">Download QR code</a><hr>\
                        //                      <a class="dropdown-item update-department" href="javascript:;" data-id="'+row.department_id+'" data-department-name = "'+row.department_name+'" data-status="'+row.status+'"  data-bs-toggle="modal" data-bs-target="#updateModal" data-bs-whatever="@mdo" >Update</a><hr>\
                        //                     <a class="dropdown-item delete-department" data-id="'+row.department_id+'" href="javascript:;">Delete</a>\
                        //              </div>\
                        //     </div>';
                    }
                }
                


              
              
                
            ],      
       
    });



        $(document).on('click','.track',function(e){



       window.open(BASE_URL + 'documents?action=view-history&&tracking-number=' +$(this).data('tracking-number')+'&&user-id='+$(this).data('user-id'), '_self' )

     })


        $(document).on('click','.print-tracking-slip',function(e){



       window.open(BASE_URL + 'documents?action=print-tracking-slip&&tracking-number=' +$(this).data('tracking-number')+'&&user-id='+$(this).data('user-id'), '_blank' )

     })

             $(document).on('click','.download_image',function(e){
        var imagePath = BASE_URL+'uploads/qr_codes/'+$(this).data('qr');
        var fileName = $(this).data('qr');
        saveAs(imagePath, fileName); // This is a function please download the file from the link
        //Download file from this link  
        // https://raw.githubusercontent.com/eligrey/FileSaver.js/master/dist/FileSaver.js
    });





        $(document).on('click','.update-doc',function(e){



      window.location.href = BASE_URL + 'documents?action=update-doc&&doc-id=' + $(this).data('id');

     })



$(document).on('click','.delete-doc',function(e){
        
        e.preventDefault();

        var id = $(this).data('id');
        var url = 'Web/delete_document';

        delete_item(id,url);

    });



});
   </script>
</body>

</html>