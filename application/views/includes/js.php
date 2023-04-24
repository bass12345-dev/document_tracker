    <script type="text/javascript"> var BASE_URL = '<?php echo base_url(); ?>';</script>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="<?php echo base_url(); ?>assets/js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js" crossorigin="anonymous"></script>
<!--     <script src="<?php echo base_url(); ?>assets/demo/chart-area-demo.js"></script>
    <script src="<?php echo base_url(); ?>assets/demo/chart-bar-demo.js"></script> -->
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.11.5/datatables.min.js"></script>
<!--     <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.bootstrap.js"></script> -->

    <script src="https://cdn.jsdelivr.net/npm/litepicker/dist/bundle.js" crossorigin="anonymous"></script>
    <script src="<?php echo base_url(); ?>assets/js/litepicker.js"></script>

<!--     <script src="https://assets.startbootstrap.com/js/sb-customizer.js"></script> -->
<!--     <sb-customizer project="sb-admin-pro"></sb-customizer> -->
    <script defer src="https://static.cloudflareinsights.com/beacon.min.js/v652eace1692a40cfa3763df669d7439c1639079717194" integrity="sha512-Gi7xpJR8tSkrpF7aordPZQlW2DLtzUlZcumS8dMQjwDHEnw9I7ZLyiOj/6tZStRBGtGgN6ceN6cMH8z7etPGlw==" data-cf-beacon='{"rayId":"6eaac9e4acc634ff","token":"6e2c2575ac8f44ed824cef7899ba8463","version":"2021.12.0","si":100}'
        crossorigin="anonymous"></script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="<?php echo base_url(); ?>assets/js/node_modules/jquery-toast-plugin/src/jquery.toast.js"></script>
    <script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>assets/js/typed.js/typeahead.jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/instascan.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/moment/moment.js"></script>
    <!-- <script src="<?php echo base_url(); ?>assets/js/qr.js"></script> -->
    <script src="<?php echo base_url(); ?>assets/js/htmlqr.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
     <script src="<?php echo base_url() ?>assets/js/download.js"></script>

    <script type="text/javascript">


    

    class process{

        constructor(){

        }


        load_document_data(id){

             $.ajax({
                        method : 'GET',
                        url :  BASE_URL + 'Web/GetDocument?id='+id,
                        dataType : 'json',
                        success :  function(data){
                            $('select[name=type_id]').val(data.type_id);
                        }


                    })

        }


        load_user_data(){



            $.ajax({
                    method : 'POST',
                    url :  BASE_URL + 'Web/load_user_data',
                    dataType : 'json',
                    success :  function(data){

                      $('.profile').attr('src', data[0].pic);
                      $('#login_name').text(data[0].name);
                      $('#login_office_name').text(data[0].office);

                    }

                })


        }


        count(){

                 $.ajax({
                    method : 'POST',
                    url :  BASE_URL + 'Web/count',
                    dataType : 'json',
                    success :  function(data){

                      $('.count-documents').text(data.documents);
                      $('.count-received').text(data.received);
                      $('.count-incoming').text(data.incoming);
                      $('.count-outgoing').text(data.outgoing);

                      //Admin Dashboard

                      
                    }

                })

        }


        history_duration(tracking_number){


            $.ajax({
                    method : 'POST',
                    url :  BASE_URL + 'Web/total_duration',
                    data : {tracking_number:tracking_number},
                    dataType : 'json',
                    success :  function(data){

                        $('#total_duration').text('TOTAL DURATION : ' + data.total_duration)
                    

                    }

                })

        }

    }

    let Process = new process(); 





function delete_item(id,url){

    Swal.fire({
              
                  title: 'Are you sure?',
                  text: "You won't be able to revert this!",
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Yes, delete it!',
                  reverseButtons: true
            }).then(function (result) {
                if (result.value) {
                    $.ajax({
                        url: BASE_URL + url,
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
                            }else{
                                alert('error')
                            }


                           
                            $('#table').DataTable().ajax.reload();
                        },
                        error: function (xhr , status, error) {
                            // error here ... 
                            console.info(xhr.responsetext); 
                        },
                    });
                } 
            });
}


function show_loader(){
    var html = 'PLease Wait ...<div class="spinner-border text-secondary" role="status">\
                <span class="sr-only">Loading...</span>\
            </div>';  
        Swal.fire({
                                          
            title: html,
            showConfirmButton: false,
            allowOutsideClick: false,

        })

    }





function toast_message_success(message){


                                    $.toast({
                                        heading: message,
                                        text: '',
                                        position: 'top-right',
                                        showHideTransition: 'slide',
                                        icon: 'success'
                                    })

}

function message_error(message){
                                Swal.fire({
                                          position: 'top-end',
                                          icon: 'info',
                                          title: message,
                                          showConfirmButton: false,
                                          timer: 1500
                                        })
}



function capitalizeFirstLetter(string) {
        return string.charAt(0).toUpperCase() + string.slice(1);
    }

        $('input[name="search_department"]').typeahead({
            hint: true,
            // highlight: true,
            minLength: 1,
            itemselected: function (val) {
                // $this.$element.val(val)
                console.info(123)
            },
        }, {
            limit: 10,
            async: true,
            source: function (query, process, processAsync) {
                return $.ajax({
                    url: BASE_URL + 'Web/search_office?key=' + $('input[name="search_department"]').val(),
                    type: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        processAsync($.map(data, function (row) {
                            office = capitalizeFirstLetter(row.office);

                            return [{
                                'office_id': row.office_id,
                                'office': office
                            }];
                        }));
                    },
                    error: function (jqXHR, except) {
                        console.info(jqXHR.responseText)
                    }
                });
            },
            name: 'office',
            displayKey: 'office',
            templates: {
                empty: [
                    '<div class="tt-suggestion tt-selectable">No Record <i class="far fa-sad-tear"></i> </div>'
                ].join('\n'),
                suggestion: function (data) {
                    return '<li>' + data.office + '</li>'
                }
            },
        }, )
        .bind('typeahead:selected', function (obj, data, name) {
            console.info(data)
            $('input[name="search_department"]').val(data.office)
            $('input[name="department_id"]').val(data.office_id);

        })
        .on('typeahead:cursorchanged', function (e, data, name) {
            try {
                 $('input[name="search_department"]').val(data.office)
                $('input[name="department_id"]').val(data.office_id);
            } catch (error) {
                // console.info(error)
            }
        });






        $('input[name="search_department1"]').typeahead({
            hint: true,
            // highlight: true,
            minLength: 1,
            itemselected: function (val) {
                // $this.$element.val(val)
                console.info(123)
            },
        }, {
            limit: 10,
            async: true,
            source: function (query, process, processAsync) {
                return $.ajax({
                    url: BASE_URL + 'Web/search_office?key=' + $('input[name="search_department1"]').val(),
                    type: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        processAsync($.map(data, function (row) {
                            office = capitalizeFirstLetter(row.office);

                            return [{
                                'office_id': row.office_id,
                                'office': office
                            }];
                        }));
                    },
                    error: function (jqXHR, except) {
                        console.info(jqXHR.responseText)
                    }
                });
            },
            name: 'office',
            displayKey: 'office',
            templates: {
                empty: [
                    '<div class="tt-suggestion tt-selectable">No Record <i class="far fa-sad-tear"></i> </div>'
                ].join('\n'),
                 suggestion: function (data) {
                    return '<li>' + data.office + '</li>'
                }
            },
        }, )
        .bind('typeahead:selected', function (obj, data, name) {
            console.info(data)
            $('input[name="search_department1"]').val(data.office)
            $('input[name="department_id1"]').val(data.office_id);

        })
        .on('typeahead:cursorchanged', function (e, data, name) {
            try {
                 $('input[name="search_department1"]').val(data.office)
                $('input[name="department_id1"]').val(data.office_id);
            } catch (error) {
                // console.info(error)
            }
        });




 $('input[name="search_user"]').typeahead({
            hint: true,
            // highlight: true,
            minLength: 1,
            itemselected: function (val) {
                // $this.$element.val(val)
                console.info(123)
            },
        }, {
            limit: 10,
            async: true,
            source: function (query, process, processAsync) {
                return $.ajax({
                    url: BASE_URL + 'Web/search_user?key=' + $('input[name="search_user"]').val(),
                    type: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        processAsync($.map(data, function (row) {
                           first_name = capitalizeFirstLetter(row.first_name);
                            middle_name = capitalizeFirstLetter(row.middle_name);
                            last_name = capitalizeFirstLetter(row.last_name);
                            extension = capitalizeFirstLetter(row.extension);
                            full_name = first_name + ' ' + middle_name + ' ' + last_name + ' ' + extension;
                            return [{
                                'user_id': row.user_id,
                                'full_name': full_name
                            }];
                        }));
                    },
                    error: function (jqXHR, except) {
                        console.info(jqXHR.responseText)
                    }
                });
            },
            name: 'user',
            displayKey: 'full_name',
            templates: {
                empty: [
                    '<div class="tt-suggestion tt-selectable">No Record <i class="far fa-sad-tear"></i> </div>'
                ].join('\n'),
                 suggestion: function (data) {
                    return '<li>' + data.full_name + '</li>'
                }
            },
        }, )
        .bind('typeahead:selected', function (obj, data, name) {
            console.info(data)
            $('input[name="search_user"]').val(data.full_name)
            $('input[name="user_id"]').val(data.user_id);

        })
        .on('typeahead:cursorchanged', function (e, data, name) {
            try {
                 $('input[name="search_user"]').val(data.full_name)
            $('input[name="user_id"]').val(data.user_id);
            } catch (error) {
                // console.info(error)
            }
        });




$(document).on('click','button#bck',function(e){window.location.href = BASE_URL + 'documents';})
$(document).on('click','button#bckr',function(e){window.location.href = BASE_URL + 'received';})
$(document).on('click','button#bcka',function(e){window.location.href = BASE_URL + 'my-documents';});
$(document).on('click','button#adminback',function(e){window.location.href = BASE_URL + 'admin/users';});
$(document).on('click','a.admin-panel',function(e){window.location.href = BASE_URL + 'admin/dashboard';})
$(document).ready(function (){Process.load_user_data();Process.count();})























            
    </script>
    
