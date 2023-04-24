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
                       
                        <div class="card-body">
                            <table id="table" class="table table-striped table-responsive table-bordered table-hover table-checkable dt-responsive nowrap " style="width: 100% ">
                               <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Tracking Code</th>
                                        <th>Document Type</th>
                                        <!-- <th>File Name</th>
                                        <th>Description</th> -->
                                        <th>Date</th>
                                        <th>Time</th>
                                       <!--  <th>Actions</th> -->
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
<?php $this->load->view('includes/js'); ?>

   <script type="text/javascript">



    $(document).ready(function (){
    var table = $('#table').DataTable({
    
        
         ajax: {
                url: BASE_URL + 'Web/getAllDocuments',
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
                    data: 'doc_id',
                    render: function(data, type, row, meta){ 
                        return meta.row + meta.settings._iDisplayStart +1;
                    }
                },
                 {data: 'tracking_code'},
                 {data: 'document_type'},
                 // {data: 'document_name'},
                 // {data: 'document_description'},
                 {data: 'created'},
                  {data: 'time'},

                // {
                //     render : function(data, type, row, meta){
                      

                //         return '<div class=" dropstart">\
                //                 <i class="fa fa-cog" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"></i>\
                //               <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">\
                //                            <a class="dropdown-item print-tracking-slip" data-user-id = "'+row.user_id+'" data-tracking-code="'+row.tracking_code+'" href="javascript:;">Print Tracking Slip</a><hr>\
                //                             <a class="dropdown-item delete-department" data-id="'+row.department_id+'" href="javascript:;">Delete</a>\
                //                      </div>\
                //             </div>';
                //     }
                // }
                


              
              
                
            ],      
       
    });

     $(document).on('click','.print-tracking-slip',function(e){



       window.open(BASE_URL + 'documents?action=print-tracking-slip&&tracking-code=' +$(this).data('tracking-code')+'&&user-id='+$(this).data('user-id'), '_blank' )

     })

    
    $(document).on('click','.update-department',function(e){

        $('input[name=update_department_name]').val($(this).data('department-name'));
        $('select[name=update_status]').val($(this).data('status'));
        $('input[name=department_id]').val($(this).data('id'));
    })  


   




});





   </script>
</body>

</html>