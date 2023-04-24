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
                <div class="container-xl px-4 mt-n10">
                                   
                            <div class="card h-100">
                                <div class="card-body h-100 p-5">

                                     <div class="row gx-3 mb-3">
                                            
                                            <div class="col-md-12">
                                                <div class="form-inline me-auto  d-lg-block  mb-2">
                                        <div class="input-group input-group-joined input-group-solid" style="border: 1px solid;" >
                                            <input class="form-control pe-0" type="search" placeholder="Search and Press Enter" aria-label="Search" name="tracking_code" />
                                            <div class="input-group-text"><i data-feather="search"></i></div>
                                        </div>
                                    </div>
                                            </div>
                                            
                                           
                                           
                                        </div>

                                         <div class="col-md-12 d-grid gap-2 scans">
                                               <button class="btn btn-primary " data-bs-toggle="offcanvas" data-bs-target="#offcanvasTop" aria-controls="offcanvasTop">Scan QR Code</button>
                                            </div>
                                
                                    
                                </div>

                                   
                                
                                <div class="card-body">
                                    <div class="timeline timeline-xl tracking_history">
                                   
                                    </div>
                                </div>
                      
                            </div>
                </div>
            </main>
          
            <?php $this->load->view('includes/footer') ?>
        </div>
    </div>
   <?php $this->load->view('user/off_canvas/scan/scan_qr'); ?>
   <?php $this->load->view('includes/js'); ?>

   <script type="text/javascript">
    

        $(document).keypress(function(e) {
    if(e.which == 13) {

       var tracking_code = $('input[name=tracking_code]').val();
       get_history(tracking_code);
       
        
    }
});



        function get_history(tracking_code){
             $.ajax({
                        method : 'POST',
                        url :  BASE_URL + 'Web/doc_history',
                        data : {tracking_code : tracking_code },
                        dataType : 'json',
                        success : function(data){
                            var html = '';

                            var color = '';
                            if (data.length > 0) {
                                for(var count = 0; count < data.length; count++){

                                  if (data[count].status == 'hold') {
                                    color = 'bg-yellow';
                                  }else if (data[count].status == 'completed') {

                                    color = 'bg-red';

                                  }else{

                                    color = 'bg-green';

                                  }

                                  var me = '';
                                  var clor = '';


                                  if (data[count].last_rec) {
                                    clor = 'bg-green';
                                  }




                                  if (data[count].user) {
                                    me = 'Your'
                                  }


                                    html += '<div class="timeline-item">';
                                    html += '<div class="timeline-item-marker" >\
                                                <div class="timeline-item-marker-indicator '+clor+'" ><img class="img-fluid" src="'+BASE_URL+'assets/office.png"></div>\
                                            </div>';

                                        if (data[count].status == 'hold') {

                                             html += '<div class="timeline-item-content">\
                                                <span>Your document <a href="">#'+data[count].tracking_code+'</a> is on hold in the '+data[count].department_name+'</span>  \
                                                <p>Hold By: <b>'+data[count].received_by+'</b></p>\
                                                  <a  data-bs-toggle="collapse" href="#'+data[count].i+'" role="button" aria-expanded="false" aria-controls="collapseExampe">\
                                                    Click here to see remarks\
                                                  </a>\
                                                </p>\
                                                <div class="collapse" id="'+data[count].i+'">\
                                                  <div class="card card-body">\
                                                           '+data[count].remarks+'   \
                                                  </div>\
                                                </div>\
                                            </div>';

                                        }else if (data[count].status == 'completed') {
                                             html += '<div class="timeline-item-content">\
                                                <span>'+me+' document <a href="">#'+data[count].tracking_code+'</a> is in the '+data[count].department_name+'</span>  \
                                                <p>Received By: <b>'+data[count].received_by+'</b></p>\
                                                 <p>Status : <b>completed</b></p>';

                                          //        if (data[count].remarks != null) {
                                          //        html +='<a  data-bs-toggle="collapse" href="#'+data[count].i+'" role="button" aria-expanded="false" aria-controls="collapseExampe">\
                                          //           Click here to see remarks\
                                          //         </a><div class="collapse" id="'+data[count].i+'">\
                                          //         <div class="card card-body">\
                                          //                  '+data[count].remarks+'   \
                                          //         </div>\
                                          //       </div>';
                                           
                                          // }else{

                                          // }
                                          html += ' </div>';


                                        }else{
                                    html += '<div class="timeline-item-content">\
                                                <span>'+me+' document <a href="">#'+data[count].tracking_code+'</a> is in the '+data[count].department_name+'</span>  \
                                                <p>Received By: <b>'+data[count].received_by+'</b></p>';

                                          //        if (data[count].remarks != null) {
                                          //        html +='<a  data-bs-toggle="collapse" href="#'+data[count].i+'" role="button" aria-expanded="false" aria-controls="collapseExampe">\
                                          //           Click here to see remarks\
                                          //         </a><div class="collapse" id="'+data[count].i+'">\
                                          //         <div class="card card-body">\
                                          //                  '+data[count].remarks+'   \
                                          //         </div>\
                                          //       </div>';
                                           
                                          // }else{

                                          // }
                        




                                            html += '</div>';
                                   

                                    }

                                     html += '</div>';
                                }

                                $('.tracking_history').html(html);
                            }else{
                                var message = 'Something Wrong';
                                message_error(message);
                            }

                          


                        }

                    })
       }



       $(document).on('click','.scans',function(e){
        
       var html5QrcodeScanner = new Html5QrcodeScanner(
    "reader", { fps: 10, qrbox: 250 });
html5QrcodeScanner.render(onScanSuccess, onScanError);

    });


       function onScanSuccess(qrCodeMessage) {
    // document.getElementById('result').innerHTML = '<span class="result">'+qrCodeMessage+'</span>';
 let closeCanvas = document.querySelector('[data-bs-dismiss="offcanvas"]');
closeCanvas.click();
    get_history(qrCodeMessage)

    // console.log(qrCodeMessage);
}
function onScanError(errorMessage) {
  //handle scan error
}



   </script>
</body>

</html>s