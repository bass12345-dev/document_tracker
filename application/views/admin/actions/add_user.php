<!DOCTYPE html>
<html lang="en">

<head>
    <?php  $this->load->view('includes/meta'); ?>
    <?php  $this->load->view('includes/css'); ?>
</head>

<body class="nav-fixed">
     <?php $this->load->view('admin/includes/navbar'); ?>

       
       
            <main>
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
                                   
                                    <a class="btn btn-sm btn-light text-primary add-department " href="<?php echo base_url() ?>admin/users">
                                            <i class="me-1" data-feather="arrow-left"></i>
                                            Back
                                        </a>
                                </div>
                            </div>
                        </div>
                    </div>
                        <div class="card-body">
                <div class="container-xl px-4 mt-4">
                    <form id="add_user_form" >
                    <div class="row">
                        <div class="col-xl-4">
                           
                            <div class="card mb-4 mb-xl-0">
                                <div class="card-header">Profile Picture</div>
                                <div class="card-body text-center">
                                   
                                    <img class="img-account-profile rounded-circle mb-2 " style="width: 17rem; height: 17rem" src="<?php echo base_url() ?>assets/empty.png" alt=""  />
                                   
                                    
                                    <div class="row gx-3 mb-3">
                                            <!-- Form Group (first name)-->
                                            <div class="col-md-12">
                                               
                                                <input class="form-control"  type="file" name="userfile" placeholder="Enter first name" onchange="ValidateSingleInput(this);"   />
                                            </div>
                                           
                                        </div>

                                    
                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-8">
                           
                            <div class="card mb-4">
                                <div class="card-header">User Details</div>
                                <div class="card-body">
                                   
                                       
                                         <div class="mb-3">
                                            <label class="small mb-1" for="inputEmailAddress">Employee ID number</label>
                                            <input class="form-control"  type="text" name="employee_id" placeholder="Enter Employee ID number" value="" required />
                                        </div>
                                        <div class="row gx-3 mb-3">
                                            
                                            <div class="col-md-6">
                                                <label class="small mb-1" for="inputFirstName">First name</label>
                                                <input class="form-control"  type="text" name="first_name" placeholder="Enter first name"  required />
                                            </div>
                                            
                                            <div class="col-md-6">
                                                <label class="small mb-1" for="inputLastName">Middle name</label>
                                                <input class="form-control"  type="text" name="middle_name" placeholder="Enter middle name" value=""  />
                                            </div>
                                           
                                        </div>

                                        <div class="row gx-3 mb-3">
                                            
                                            <div class="col-md-6">
                                                <label class="small mb-1" for="inputLastName">Last name</label>
                                                <input class="form-control"  type="text" name="last_name" placeholder="Enter last name" value="" required />
                                            </div>
                                            <div class="col-md-6">
                                                <label class="small mb-1" for="inputLastName">Extension</label>
                                                <input class="form-control"  type="text" name="extension" placeholder="Ext." value=""  />
                                            </div>
                                          
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label class="small mb-1" for="inputEmailAddress">Email address</label>
                                            <input class="form-control"  type="email" name="email" placeholder="Enter email address" value="" required />
                                        </div>
                                        

                                        

                                        <div class="mb-3">
                                             <label class="small mb-1">Role</label><br>

                                            <?php

                                                    foreach ($roles as $row) {

                                                      ?>
                                                      <div class="form-check form-check-inline">
                                                          <input class="form-check-input" type="checkbox" id="inlineCheckbox1" name="check_list[]" value="<?php echo $row['role_id'] ?>">
                                                          <label class="form-check-label" for="inlineCheckbox1"><?php echo  $row['role']; ?></label>
                                                        </div>
                                                    <?php
                                                      }

                                                    ?>
                                    
                                        </div>


                                        
                                     

                                         <div class="mb-3">
                                            <label class="small mb-1">Office</label>
                                            <select class="form-select" aria-label="Default select example" name="office_id" required>
                                                    <option selected="" disabled="">Select Office:</option>

                                                    <?php

                                                    foreach ($offices as $row) {

                                                      ?>
                                                      <option value="<?php echo $row['office_id'] ?>"><?php echo $row['office']; ?></option>
                                                    <?php
                                                      }

                                                    ?>
                                                   
                                                </select>
                                        </div>

                                        <div class="mb-3">
                                            <label class="small mb-1" for="inputEmailAddress">Username</label>
                                            <input class="form-control"  type="text" name="username" placeholder="Enter Username" value="" />
                                        </div>

                                        <div class="mb-3">
                                            <label class="small mb-1" for="inputEmailAddress">Password</label>
                                            <input class="form-control"  type="text" name="password" placeholder="Enter Password" value="" />
                                        </div>
                                        
                                        <button class="btn btn-primary" type="submit">Add user</button>
                                    
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
    $(document).ready(function() {
    $('.js-example-basic-multiple').select2();
});

       $('#add_user_form').on('submit', function(e){
        e.preventDefault();

      


            $('.save').attr('disabled',true);
        
                    $.ajax({
                        method : 'POST',
                        url :  BASE_URL + 'web/addUser',
                        data: new FormData(this),
                        processData: false,  // tell jQuery not to process the data
                        contentType: false,  // tell jQuery not to set contentType
                        dataType : 'json',
                        beforeSend: function(){                                     
                                        var html = 'PLease Wait ...<div class="spinner-border text-secondary" role="status">\
                                            <span class="sr-only">Loading...</span>\
                                        </div>';  
                                    Swal.fire({
                                                                      
                                        title: html,
                                        showConfirmButton: false,
                                        allowOutsideClick: false,

                                    })
                                       
                                    },
                        success :  function(data){

                             $('.save').attr('disabled',false);
                             
                            if (data.response) {
                                Swal.close();
                                 
                              
                                $('#add_user_form')[0].reset();
                                var message = 'Saved Successfully';
                                toast_message_success(message);
                                
                                
                            
                            }else {

                                  var message = 'Something Wrong';
                                        message_error(message);

                            }

                           
                           
                        }

                    })

    




});



    function readURL(oInput) {


                                    if (oInput.files && oInput.files[0]) {
                                        var reader = new FileReader();

                                        reader.onload = function (e) {
                                            $('.img-account-profile').attr('src', e.target.result);
                                        }

                                        reader.readAsDataURL(oInput.files[0]);
                                    }
                                }
 

 var _validFileExtensions = [".jpg", ".jpeg", ".bmp", ".gif", ".png"];  


      
    function ValidateSingleInput(oInput) {
    if (oInput.type == "file") {
        
       
        // $('#slider_pic_preview')[0].src = (window.URL ? URL : webkitURL).createObjectURL(oInput.files[0]);
        var sFileName = oInput.value;
         if (sFileName.length > 0) {
             

            var blnValid = false;
            for (var j = 0; j < _validFileExtensions.length; j++) {
                var sCurExtension = _validFileExtensions[j];
                if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
                    blnValid = true;
                    break;
                }
            }
             
            if (!blnValid) {
                alert("Sorry, " + sFileName + " is invalid, allowed extensions are: " + _validFileExtensions.join(", "));
                oInput.value = "";
                return false;
            }
        }
    }
    readURL(oInput);
    return true;
}
   </script>
</body>

</html>