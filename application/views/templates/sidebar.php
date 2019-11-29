<!-- Sidebar -->
<ul style="background-color: #046b7b;" class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="
    <?php
    $url = strtolower(str_replace(' ', '', $user['role_type']));
    if ($url == 'administrator') {
        echo base_url('admin');
    } else {
        echo base_url($url);
    }
    ?>">
        <div>
            <img src="<?= base_url('assets/img/logo/'); ?>Logo_PLN2.png" alt="Logo PLN" height="52.6" width="38.4">
            <!-- <i class="fas fa-bolt"></i> -->
        </div>
        <div class="sidebar-brand-text mx-3">Go! Premium</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Query Menu -->
    <?php
    $id_role = $this->session->userdata('id_role');
    $queryMenu = "SELECT `user_menu`.`id_user_menu`, `menu`
                FROM `user_menu` JOIN `user_access_menu` 
                ON `user_menu`.`id_user_menu` = `user_access_menu`.`id_user_menu`
                WHERE `user_access_menu`.`id_role` = $id_role ORDER BY `user_access_menu`.`id_user_menu` ASC 
                ";

    $menu = $this->db->query($queryMenu)->result_array();
    ?>

    <!-- LOOPING MENU -->
    <?php foreach ($menu as $m) : ?>
    <div class="sidebar-heading">
        <?= $m['menu']; ?>
    </div>

    <!-- SIAPKAN SUB MENU SESUAI SUB MENU -->
    <?php
        $id_user_menu = $m['id_user_menu'];
        $querySubMenu = "SELECT * FROM `user_sub_menu` 
                    WHERE `user_sub_menu`.`id_user_menu` = $id_user_menu 
                    AND `user_sub_menu`.`is_active_menu` = 1";

        $subMenu = $this->db->query($querySubMenu)->result_array();
        ?>

    <?php foreach ($subMenu as $sm) : ?>
    <?php if ($title == $sm['title']) : ?>
    <li class="nav-item active">
        <?php else : ?>
    <li class="nav-item">
        <?php endif; ?>
        <!-- Nav Item - Dashboard -->
        <a class="nav-link pb-0" href="<?= base_url($sm['url']); ?>">
            <i class="<?= $sm['icon']; ?>"></i>
            <span><?= ($sm['title']); ?> </span>
            <?php if (count_notif($sm['title']) != 0) : ?>
            <!-- <span class="badge badge-danger font-weight-bold align-items-stretch" style="display:inline; font-size:69%;"><?= count_notif($sm['title']) ?></span> -->
            <?php endif; ?>
            <?php if ($sm['title'] == "Notification") { ?>
            <?php if (sizeof($notif) != 0) { ?>
            <span class="badge badge-danger font-weight-bold align-items-stretch" style="display:inline; font-size:69%;">
                <?php
                                if (sizeof($notif) > 99) {
                                    echo '99+';
                                } else {
                                    echo sizeof($notif);
                                }
                                ?>
            </span>
            <?php  }
                    } ?>
        </a>
    </li>
    <?php endforeach ?>

    <!-- Divider -->
    <hr class="sidebar-divider mt-3">
    <?php endforeach; ?>

    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('auth/logout'); ?>">
            <i class="fas fa-fw fa-sign-out-alt"></i>
            <span>Log Out</span></a>
    </li>


    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->