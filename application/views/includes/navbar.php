<nav class="topnav navbar navbar-expand shadow justify-content-between justify-content-sm-start navbar-light bg-white" id="sidenavAccordion">
        <!-- Sidenav Toggle Button-->

        <?php
        if (isset($_GET['action'])) {

                 if ($_GET['action'] === 'view-history'  ) {

                    echo '  <button class="btn btn-icon btn-transparent-dark order-1 order-lg-0 me-2 ms-lg-2 me-lg-0" id="bck"><i data-feather="arrow-left"></i></button>';

                 }else if($_GET['action'] === 'history'){

                      echo '  <button class="btn btn-icon btn-transparent-dark order-1 order-lg-0 me-2 ms-lg-2 me-lg-0" id="bckr"><i data-feather="arrow-left"></i></button>';

                 }else if($_GET['action'] === 'add-document'){

                      echo '  <button class="btn btn-icon btn-transparent-dark order-1 order-lg-0 me-2 ms-lg-2 me-lg-0" id="bcka"><i data-feather="arrow-left"></i></button>';

                 }else if($_GET['action'] === 'update-doc'){

                      echo '  <button class="btn btn-icon btn-transparent-dark order-1 order-lg-0 me-2 ms-lg-2 me-lg-0" id="bcka"><i data-feather="arrow-left"></i></button>';

                 }

             }else {

                     echo '  <button class="btn btn-icon btn-transparent-dark order-1 order-lg-0 me-2 ms-lg-2 me-lg-0" id="sidebarToggle"><i data-feather="menu"></i></button>';

                 }
         ?>
      
        
        <a class="navbar-brand pe-3 ps-4 ps-lg-2" href="<?php echo base_url() ?>">Hello World</a>
        <!-- Navbar Search Input-->
        <!-- * * Note: * * Visible only on and above the lg breakpoint-->
        <form class="form-inline me-auto d-none d-lg-block me-3">
            <div class="input-group input-group-joined input-group-solid">
                <input class="form-control pe-0" type="search" placeholder="Search" aria-label="Search" />
                <div class="input-group-text"><i data-feather="search"></i></div>
            </div>
        </form>
        <!-- Navbar Items-->
        <ul class="navbar-nav align-items-center ms-auto">
           
          
            <li class="nav-item dropdown no-caret dropdown-user me-3 me-lg-4">
                <a class="btn btn-icon btn-transparent-dark dropdown-toggle" id="navbarDropdownUserImage" href="javascript:void(0);" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img class="img-fluid profile" src="" /></a>
                <div class="dropdown-menu dropdown-menu-end border-0 shadow animated--fade-in-up" aria-labelledby="navbarDropdownUserImage">
              <!--       <h6 class="dropdown-header d-flex align-items-center">
                        <img class="dropdown-user-img" src="<?php echo base_url() ?>uploads/profile_pic/<?php echo $userdata['profile_picture'] ?>" />
                        <div class="dropdown-user-details">
                            <div class="dropdown-user-details-name"><?php echo  $userdata['first_name'].' '.$userdata['middle_name'].' '.$userdata['last_name'].' '.$userdata['extension']; ?></div>
                            <div class="dropdown-user-details-email"></div>
                        </div>
                    </h6>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="<?php echo base_url(); ?>users?action=edit-my-profile&&id=<?php echo $userdata['user_id'] ?>">
                        <div class="dropdown-item-icon"><i data-feather="settings"></i></div>
                        Account
                    </a>
                    <?php
                    if ($admin_access) {

                        echo '<a class="dropdown-item admin-panel" href="javascript:;">
                        <div class="dropdown-item-icon "><i data-feather="settings"></i></div>
                        Admin Panel
                    </a>';
                        
                    }

                     ?> -->

                    <?php
                    if ($admin_access) {

                        echo '<a class="dropdown-item admin-panel" href="javascript:;">
                        <div class="dropdown-item-icon "><i data-feather="settings"></i></div>
                        Admin Panel
                    </a>';
                        
                    }

                     ?>
                    
                    <a class="dropdown-item" href="<?php echo base_url(); ?>Web/logout">
                        <div class="dropdown-item-icon"><i data-feather="log-out"></i></div>
                        Logout
                    </a>
                </div>
            </li>
        </ul>
    </nav>