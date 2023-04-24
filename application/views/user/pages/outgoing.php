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
                                        <<!-- th>Document</th> -->
                                        <th>Office</th>
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
                url: BASE_URL + 'Web/getOutgoingDocs',  
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
               // {data: 'document_name'},
               {data: 'office'},
               {data: 'sender'},
                {
                    render : function(data, type, row, meta){
                      

                        return '<div class=" dropstart">\
                                <i class="fa fa-cog" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"></i>\
                              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">\
                              <a class="dropdown-item receive-doc" data-code="'+row.t_number+'"  href="javascript:;">Receive Document</a><hr>\
                                             <a class="dropdown-item update-department" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight" href="javascript:;"  >Update</a><hr>\
                                            <a class="dropdown-item view-doc" data-code="'+row.t_number+'"  href="javascript:;">View Info</a>\
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