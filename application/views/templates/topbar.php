<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

            <!-- Sidebar Toggle (Topbar) -->
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
            </button>



            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">

                <!-- Nav Item - Alerts -->
                <li class="nav-item dropdown no-arrow mx-auto">
                    <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-bell fa-fw"></i>
                        <!-- Counter - Alerts -->
                        <?php if (sizeof($notif) != 0) { ?>
                        <span class="badge badge-danger badge-counter">
                            <?php if (sizeof($notif) > 99) {
                                    echo '99+';
                                } else {
                                    echo sizeof($notif);
                                } ?>
                        </span>
                        <?php } ?>
                    </a>
                    <!-- Dropdown - Alerts -->
                    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown" style="max-width:350px;">
                        <h6 class="dropdown-header" style="background-color: #046b7b;">
                            Notifications
                        </h6>
                        <div style="overflow-y:scroll;max-height:300px">
                            <?php
                            $id = 0;
                            
                            foreach ($notif as $notifs) { ?>
                            <a class="dropdown-item d-flex align-items-center notifs" data-id="<?php echo $notifs[0]['id_notification_target'] ?>" href="<?= base_url("Notification/readNotif/" . $notifs[0]['id_notification_target'] . '/' . $notifs[0]['id_customer'] . '/' . $notifs[0]['id_type_notification']) ?>">
                                <div class="mr-3">
                                    <div class="icon-circle <?= $notifs[0]['bg_color']; ?>">
                                        <i class="<?= $notifs[0]['icon_notification']; ?> text-white"></i>
                                    </div>
                                </div>
                                <div>
                                    <div class="small text-gray-500"><?= date('d F Y H:i:s', strtotime($notifs[0]['created_at'])); ?></div>
                                    <span class="font-weight-bold"><?= $notifs[0]['title']; ?> : <?= $notifs[0]['details']; ?> </span>
                                </div>
                            </a>
                            <?php

                                $id = $id + 1;
                            } ?>
                        </div>

                        <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                    </div>
                </li>

                <div class="topbar-divider d-none d-sm-block"></div>

                <!-- Nav Item - User Information -->
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $user['name']; ?> (<?= $user['role_type']; ?>) </span>
                        <img class="img-profile rounded-circle" src="<?= base_url('assets/img/profile/') . $user['image']; ?>">
                    </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="<?= base_url('user/index'); ?>">
                            <i class="fas fa-user-tie fa-sm fa-fw mr-2 text-gray-400"></i>
                            My Profile
                        </a>
                        <a class="dropdown-item" href="<?= base_url('user/edit'); ?>">
                            <i class="fas fa-user-edit fa-sm fa-fw mr-2 text-gray-400"></i>
                            Edit Profile
                        </a>
                        <a class="dropdown-item" href="<?= base_url('user/changepassword'); ?>">
                            <i class="fas fa-key fa-sm fa-fw mr-2 text-gray-400"></i>
                            Change Password
                        </a>

                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?= base_url('auth/logout'); ?>" data-toggle="modal" data-target="#logoutModal">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Logout
                        </a>
                    </div>
                </li>

            </ul>

        </nav>
        <!-- End of Topbar -->
        <script>


        </script>