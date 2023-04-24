<!DOCTYPE html>
<html lang="en">

<head>
    <?php  $this->load->view('includes/meta'); ?>
    <?php  $this->load->view('includes/css'); ?>
</head>

<body class="nav-fixed">
    <?php $this->load->view('includes/navbar'); ?>

        
     
            <main class="mt-5">
            <?php  $this->load->view('includes/header') ?>
                <!-- Main page content-->
                
                 <div class="container-xl px-4 mt-n10 animate__bounceIn">
                 
                    <!-- Example Charts for Dashboard Demo-->
                   
                    <!-- Example DataTable for Dashboard Demo-->
                    <div class="card mb-4">
                       
                        <div class="card-body">
                      
                            <table id="table" class=" table table-striped table-responsive table-bordered table-hover table-checkable dt-responsive nowrap" style="width:100%">
                                <thead>
                                    
                                    <tr>
                                        <th>#</th>
                                        <th>Tracking Number</th>
                                         <th>Document Type</th>
                                         <th>Date Received</th>
                                        <th>Office</th>
                                        <th>User</th>
                                
                                       
                                    </tr>
                                </thead>
                         
                            </table>
                        </div>
                    </div>
                </div>
            </main>
          
            <?php $this->load->view('includes/footer') ?>
       

   
   <?php $this->load->view('includes/js'); ?>

   <script type="text/javascript">




            var table = $('#table').DataTable({
    
         dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
         ajax: {
                url: BASE_URL + 'Web/getReceivedDocs',
                type: 'POST',
                
            },  

           

            'processing': true,
        'language': {
            'loadingRecords': '&nbsp;',
            'processing': 'Loading...'
        },
       "scrollY": 200,
        "scrollX": true,

         columns: [
                {
                    data: 'document_id',
                    render: function(data, type, row, meta){ 
                        return meta.row + meta.settings._iDisplayStart +1;
                    }
                },
                {data: 'tracking_number'},
                {data: 'document_type',className: "text-center"},
                {data: 'date_received',className: "text-center"},
                {data: 'office'},
                {data: 'user'},
                 
                 

                


              
              
                
            ],      
       
    });



   </script>
</body>

</html>