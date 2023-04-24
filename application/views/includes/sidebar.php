<div id="layoutSidenav_nav">
            <nav class="sidenav shadow-right sidenav-light">
                <div class="sidenav-menu">
                    <div class="nav accordion" id="accordionSidenav">

                          <a class="nav-link" href="<?php echo base_url() ?>">
                            <div class="nav-link-icon"><i data-feather="bar-chart"></i></div>
                            Dashboard
                        </a>

                      
                  
                        <a class="nav-link" href="<?php echo base_url() ?>my-documents">
                            <div class="nav-link-icon"><i data-feather="file"></i><span class="badge rounded-pill bg-light text-danger count-documents"></span></div>
                            My Documents
                           

                        </a>
                        <a class="nav-link" href="<?php echo base_url() ?>received">
                            <div class="nav-link-icon"><i data-feather="arrow-down"></i><span class="badge rounded-pill bg-light text-danger count-received"></span></div>
                            Received
                           
                        </a>
                        <a class="nav-link" href="<?php echo base_url() ?>incoming">
                            <div class="nav-link-icon"><i data-feather="arrow-down-left"></i><span class="badge rounded-pill bg-light text-danger count-incoming"></span></div>
                            Incoming 
                           
                        </a>
                        <a class="nav-link" href="<?php echo base_url() ?>outgoing">
                            <div class="nav-link-icon"><i data-feather="arrow-up-right"></i><span class="badge rounded-pill bg-light text-danger count-outgoing"></span></div>
                            Outgoing
                          
                        </a>

                         <!-- <a class="nav-link" href="<?php echo base_url() ?>hold">
                            <div class="nav-link-icon"><i data-feather="bar-chart"></i></div>
                            Hold
                          
                        </a> -->

                        <a class="nav-link" href="<?php echo base_url() ?>track-document">
                            <div class="nav-link-icon"><i data-feather="truck"></i></div>
                            Track Documents
                            
                        </a>



                        


                        
                    </div>
                </div>


                <?php 

                    $roles = '';

                        $role = $this->session->userdata('role');
                        $rids = explode(" ", $role);
                        $r = [];
                        foreach ($rids as $r_row) {
                                $where = array('role_id' => $r_row);
                            
                            $rr = $this->RoleModel->get_role('roles',$where)->result_array();

                           

                                foreach ($rr as $rrow) {

                                    $r[] = $rrow['role'];

                            }
                        }




                        ?>
                <!-- Sidenav Footer-->
               <div class="sidenav-footer">
                    <div class="sidenav-footer-content">
                        <div class="sidenav-footer-subtitle">Logged in as:</div>
                        <div class="sidenav-footer-title" id="login_name"></div>
                         <div class="sidenav-footer-title" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-content="<?php echo join(' , ', $r) ?>" id="login_office_name"></div>
                    </div>
                </div> 
            </nav>
        </div>