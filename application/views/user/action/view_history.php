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
                        <div class="container-fluid px-4">
                        <div class="page-header-content">
                            <div class="row align-items-center justify-content-between pt-3">
                                <div class="col-auto mb-3">
                                  <h1>#<?php echo $_GET['tracking-number']; ?></h1>
                                </div>

                                <div class="col-12 col-xl-auto mb-3">

                                 <!--     <a class="btn btn-sm btn-light text-primary print-table p-3 rounded-pill"   style="font-size: 15px" href="javascript:;">
                                            <i class="me-1" data-feather="printer"></i>
                                            Print Table


                                        </a> -->
                                   
                                      <a class="btn btn-sm btn-light text-primary add-department p-3 rounded-pill"   style="font-size: 15px" href="<?php echo base_url() ?>documents?action=print-tracking-slip&&tracking-number=<?php echo $_GET['tracking-number'] ?>&&user-id=<?php echo $_GET['user-id']  ?>">
                                            <i class="me-1" data-feather="printer"></i>
                                            Print Tracking Slip


                                        </a>

                                          <a class="btn btn-sm btn-light text-primary add-department p-3 rounded-pill"   style="font-size: 15px" href="<?php echo base_url() ?>documents?action=print-document&&tracking-number=<?php echo $_GET['tracking-number'] ?>&&user-id=<?php echo $_GET['user-id']  ?>">
                                            <i class="me-1" data-feather="printer"></i>
                                            Print Document


                                        </a>


                                         <a class="btn btn-sm btn-light text-primary download_image p-3 rounded-pill"   style="font-size: 15px" data-qr="<?php echo $_GET['tracking-number'] ?>" href="javascript:;">
                                            <i class="me-1" data-feather="download"></i>
                                            Download Qr


                                        </a>


                                        


                                       

                                         
                                </div>
                            </div>
                        </div>
                    </div>
                        <div class="card-body">
                        <input type="hidden" value="<?php echo $_GET['tracking-number'] ?>" name="tracking_number">

                            <table id="table" class=" table table-striped table-responsive table-bordered table-hover table-checkable dt-responsive nowrap" style="width:100%">
                                <thead>
                                    
                                    <tr>
                                        <th>#</th>
                                      <!--   <th>Tracking Number</th> -->
                                        <th>Date Released</th>
                                        <th>Office</th>
                                       <!--  <th>User</th> -->
                                         <th>Date Received</th>
                                        <th>Office</th>
                                       <!--  <th>User</th> -->
                                         <th>Duration</th>
                                       
                                    </tr>
                                </thead>
                         
                            </table>


                                  <h1 id="total_duration" style="color: red"></h1>
                               
                        </div>
                    </div>
                </div>
            </main>
          
            <?php $this->load->view('includes/footer') ?>
       

   
   <?php $this->load->view('includes/js'); ?>

   <script type="text/javascript">


    
      var tracking_number = $('input[name=tracking_number]').val();

      

    var table = $('#table').DataTable({
    
         dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
         ajax: {
                url: BASE_URL + 'Web/getHistory',
                type: 'POST',
                data : {'tracking_number' : tracking_number},
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
                // {data: 'tracking_number'},
                {data: 'date_released'},
                
                {data: 'office1',className: "text-center"},
                  // {data: 'user1',className: "text-center"},
                  {data: 'date_received',className: "text-center"},
                  {data: 'office2'},
                  // {data: 'user2'},
                  {data: 'duration'},
                 
                 

                


              
              
                
            ],      
       
    });



    $('.print-table').on('click', function(e) {
            e.preventDefault();
            table.button(0).trigger();
        });



       $(document).on('click','.download_image',function(e){
        var imagePath = BASE_URL+'uploads/qr_codes/'+$(this).data('qr');
        var fileName = $(this).data('qr');
        saveAs(imagePath, fileName); // This is a function please download the file from the link
        //Download file from this link  
        // https://raw.githubu

    });




         $(document).ready(function (){

        Process.history_duration(tracking_number)

        })




   </script>
</body>

</html>