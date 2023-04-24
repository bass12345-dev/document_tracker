<nav class="topnav navbar navbar-expand shadow justify-content-between justify-content-sm-start navbar-light bg-white" id="sidenavAccordion">
        <!-- Sidenav Toggle Button-->
      



                <?php
        if (isset($_GET['action'])) {

                 if ($_GET['action'] === 'add-user'  ) {

                    echo '  <button class="btn btn-icon btn-transparent-dark order-1 order-lg-0 me-2 ms-lg-2 me-lg-0" id="adminback"><i data-feather="arrow-left"></i></button>';

                 }
             }else {

                     echo '  <button class="btn btn-icon btn-transparent-dark order-1 order-lg-0 me-2 ms-lg-2 me-lg-0" id="sidebarToggle"><i data-feather="menu"></i></button>';

                 }
         ?>
      
        
        <a class="navbar-brand pe-3 ps-4 ps-lg-2" href="<?php echo base_url() ?>admin/dashboard">Hello World</a>
        <!-- Navbar Search Input-->
        <!-- * * Note: * * Visible only on and above the lg breakpoint-->
        <form class="form-inline me-auto d-none d-lg-block me-3">
            <div class="input-group input-group-joined input-group-solid">
                <input class="form-control pe-0" type="search" placeholder="Search" aria-label="Search" />
                <div class="input-group-text"><i data-feather="search"></i></div>
            </div>
        </form>


         <ul class="navbar-nav align-items-center ms-auto">
           
          
            <li class="nav-item dropdown no-caret dropdown-user me-3 me-lg-4">
                
                    
                    <a class="dropdown-item" href="<?php echo base_url(); ?>">
                        <div class="dropdown-item-icon"><i data-feather="x"></i></div>
                       
                    </a>
                </div>
            </li>
        </ul>
   
    </nav>