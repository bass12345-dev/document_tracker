<!DOCTYPE html>
<html lang="en">

<head>
    <?php  $this->load->view('includes/meta'); ?>
    <?php  $this->load->view('includes/css'); ?>
</head>

<body class="nav-fixed">
    <?php $this->load->view('includes/navbar'); ?>
   
       
            <main class="mt-4">
            <?php  $this->load->view('includes/header') ?>
                <!-- Main page content-->
                <div class="container-xl px-4 mt-n10">
                 
                
                    <div class="card mb-4">
                        <div class="container-fluid px-4">
                        <div class="page-header-content">
                            <div class="row align-items-center justify-content-between pt-3">
                                <div class="col-auto mb-3">
                                    
                                </div>
                                <div class="col-12 col-xl-auto mb-3">
                                   
                                    <a class="btn btn-sm btn-light text-primary add-department " href="<?php echo base_url() ?>my-documents">
                                            <i class="me-1" data-feather="arrow-left"></i>
                                            Back
                                        </a>
                                </div>
                            </div>
                        </div>
                    </div>
                        <div class="card-body">
                <div class="container-xl px-4 mt-4">
                    <form id="add_doc_form" >
                    <div class="row">
                       
                        <div class="col-xl-12">
                           
                            <div class="card mb-4">
                                <div class="card-header">Document Details</div>
                                <input type="hidden" name="doc_id" value="<?php echo $_GET['doc-id'] ?>">
                                <div class="card-body">                                       
                                         <div class="mb-3">
                                             <select class="form-select" aria-label="Default select example" name="type_id" id="inputState" required>
                                                    <option value="" selected=""  disabled="">Select Document Type</option>                                                  
                                                        <?php

                                                    foreach ($types as $row) {

                                                      ?>
                                                      <option value="<?php echo $row['type_id'] ?>"><?php echo $row['type_name']; ?></option>
                                                    <?php
                                                      }

                                                    ?>
                                                   
                                            </select>
                                                   
                                                   
                                        </div>

                                        <div id="add_doc_inputs" style="display: none;">

                                         <div class="row gx-3 mb-3">
                                            
                                           <!--  <div class="col-md-6">
                                                <label class="small mb-1" for="inputFirstName"></label>
                                                <input class="form-control"  type="text" name="first_name" placeholder="Enter first name"   />
                                            </div> -->
                                            
                                            <div class="col-md-12">
                                                <label class="small mb-1" for="inputLastName">Charges</label>
                                                <input class="form-control"  type="text" name="middle_name" placeholder="Enter middle name" value=""  />
                                            </div>
                                           
                                        </div>


                                        <div class="row gx-3 mb-3">
                                            
                                            
                                            
                                            <div class="col-md-4">
                                                <label class="small mb-1" for="inputLastName">Function</label>
                                                <input class="form-control"  type="text" name="middle_name" placeholder="Enter middle name" value=""  />
                                            </div>
                                               <div class="col-md-4">
                                                <label class="small mb-1" for="inputLastName">Allotment Class</label>
                                                <input class="form-control"  type="text" name="middle_name" placeholder="Enter middle name" value=""  />
                                            </div>


                                            <div class="col-md-4">
                                                <label class="small mb-1" for="inputFirstName">Expense Code</label>
                                                <input class="form-control"  type="text" name="first_name" placeholder="Enter first name"   />
                                            </div>
                                           
                                        </div>



                                    </div>
                                        <button class="btn btn-primary making" type="submit">Update Document</button>
                                    
                                </div>
                            </div>
                        </div>
                    </div>

                    </form>
                </div>
                        </div>
                    </div>
                </div>
            </main>
          
            <?php $this->load->view('includes/footer') ?>
      
   
   <?php $this->load->view('includes/js'); ?>

   <script type="text/javascript">
          $('#add_doc_form').on('submit', function(e){
                    e.preventDefault();


            $('.making').html('Making...');
            $('.making').attr('disabled',true);

             $.ajax({
                    method : 'POST',
                    url :  BASE_URL + 'Web/AddDoc',
                    data : $(this).serialize(),
                    dataType : 'json',
                    success :  function(data){

                         // window.location.href = BASE_URL + 'documents?action=print-document'

                        $('.making').attr('disabled',false);
                        $('.making').html('Make Document');
                             
                            if (data.response) {
                               
                        
                                $('#add_doc_form')[0].reset();
                                var message = 'Data Saved Successfully';
                                toast_message_success(message);

                                // let total = 0;

                                //  let number = $('span.received').html();

                                //   console.log(number + 1)
                                    // total = number =+ 1;
                                    // console.log(total)
                                    // $('.received').text(total);
                                    

                                // Swal.fire({
                                //           title: '',
                                //           showCancelButton: true,
                                          
                                //           confirmButtonText: 'Print Tracking Slip',
                                         
                                //         }).then((result) => {
                                //           /* Read more about isConfirmed, isDenied below */
                                //           if (result.isConfirmed) {
                                //               window.location.href = BASE_URL + 'documents?action=print-tracking-slip&&tracking-code='+data.tracking_code+'&&user-id='+data.user_id;
                                //           } else if (result.isDenied) {
                                //             Swal.fire('Changes are not saved', '', 'info')
                                //           }
                                //         })
                                

                                
                            
                            }else {

                                var message = 'Something Wrong';
                               message_error(message);
                            }


                    }

                })

                  

        })


          $('#inputState').on('change', function (e){
             var x = $("#inputState :selected").val();
                    if(x == '') {
                        alert('Please choose status')
                    }else {

                        $('#add_doc_inputs').show();
                    }
          });




// Class Initialization
jQuery(document).ready(function () {
   
   var doc_id = $('input[name=doc_id]').val();
   Process.load_document_data(doc_id);


   
});







   </script>
</body>

</html>