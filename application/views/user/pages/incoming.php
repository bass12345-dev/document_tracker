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

                        
                        <div class="card-body">
                          <table id="table" class="table table-striped table-responsive table-bordered table-hover table-checkable dt-responsive nowrap " style="width: 100% ">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Tracking Code</th>
                                        <th>Document Type</th>
                                        <th>From </th>
                                         <th>Sender</th>
                                         <!--  <th>Remarks</th> -->
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
                url: BASE_URL + 'Web/getIncomingDocs',  
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
               {data: 'office'},
               {data: 'sender'},
                {
                    render : function(data, type, row, meta){
                      
                      var action  = '';

                      action += '<div class=" dropstart">\
                                <i class="fa fa-cog" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"></i><div class="dropdown-menu" aria-labelledby="dropdownMenuButton">';
                       if (row.r_action) {
                        action += '<a class="dropdown-item receive-doc" data-number="'+row.t_number+'"  href="javascript:;">Receive Document</a><hr>';
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




    $(document).on('click','.receive-doc',function(e){

                                Swal.fire({
                                          title: '',
                                          confirmButtonText: 'Receive Document',
                                          showCancelButton: true,
                                        }).then((result) => {
                                          /* Read more about isConfirmed, isDenied below */
                                          if (result.isConfirmed) {

                                                        $.ajax({
                                                                method : 'POST',
                                                                url :  BASE_URL + 'Web/receive_doc',
                                                                data : {tracking_number : $(this).data('number') },
                                                                dataType : 'json',
                                                                success : function(data){

                                                                        if (data.response) {
                                                                            Swal.close();
                                                                            var message = data.message;
                                                                            toast_message_success(message);
                                                                            $('#table').DataTable().ajax.reload();
                                                                            Process.count();
                                    
                                                                        
                                                                        }else {
                                                                          var message = 'Something Wrong';
                                                                          message_error(message)

                                                                          

                                                                        }

                                                                }

                                         


                                                })


                                              
                                          } else if (result.isDenied) {
                                            Swal.fire('Cancelled', '', 'info')
                                          }
                                        })

    })




   </script>
</body>

</html>