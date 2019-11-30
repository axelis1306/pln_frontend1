<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg">
            <a href="<?= base_url('construction/reportConstruction/' . $customer['id_customer']); ?>" class="btn btn-sm btn-primary mb-3 float-right btn-confirm-construct"><i class="fas fa-tools text-white mr-1"></i> Go Construct!</a>
            <?= $this->session->flashdata('message'); ?>

            <div class="card col-lg text-left">
                <div class="card-header">
                    <!-- Nav Tabs -->
                    <ul class="nav nav-tabs card-header-tabs" role="tablist" id="myTab">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" role="tab" href="#profileCustomer">Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" role="tab" href="#fileConstruction">File</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                        </li>
                    </ul>
                </div>

                <!-- Tab Panes -->
                <div class="card-body tab-content">
                    <div class="tab-pane active" id="profileCustomer" name="profileCustomer">
                        <h5 class="card-title text-uppercase text-dark font-weight-bold"><?= $customer['name_customer']; ?></h5>
                        <table class="table table-sm table-borderless col-lg-9 table-responsive">
                            <tbody>
                                <tr>
                                    <td>ID Pelanggan</td>
                                    <td>:</td>
                                    <td><?= $customer['id_customer']; ?></td>
                                </tr>
                                <tr>
                                    <td>Alamat</td>
                                    <td>:</td>
                                    <td><?= $customer['address_customer']; ?></td>
                                </tr>
                                <tr>
                                    <td>Tarif</td>
                                    <td>:</td>
                                    <td><?= $customer['tariff']; ?></td>
                                </tr>
                                <tr>
                                    <td>Daya</td>
                                    <td>:</td>
                                    <td><?= $customer['power']; ?> VA</td>
                                </tr>
                                <tr>
                                    <td>Substation</td>
                                    <td>:</td>
                                    <td><?= $customer['name_substation']; ?></td>
                                </tr>
                                <tr>
                                    <td style="min-width: 140px;">Feeder Substation</td>
                                    <td>:</td>
                                    <td><?= $customer['name_feeder_substation']; ?></td>
                                </tr>
                                <tr>
                                    <td>Layanan</td>
                                    <td>:</td>
                                    <td><?= $customer['type_of_service']; ?></td>
                                </tr>
                                <tr>
                                    <td>Status</td>
                                    <td>:</td>
                                    <td><span class="badge badge-warning"><?= $customer['status']; ?></span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="tab-pane fade" id="fileConstruction" name="fileConstruction">
                        <h5 class="card-title text-uppercase text-dark font-weight-bold">Reksis dan SLD</h5>
                        <table class="table table-sm table-borderless col-lg-9 ">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">File Name</th>
                                    <th scope="col">Uploaded on</th>
                                    <th scope="col">View</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $file_reksis = glob('assets/berkas/' . $customer['name_customer'] . '/Reksis+SLD' . '/*.*');
                                // print_r($user_closing);
                                $idx = 1;
                                ?>
                                <?php foreach ($file_reksis as $rs) { ?>
                                <?php $name = explode('/', $rs); ?>
                                <tr>

                                    <th scope="row"><?= $idx; ?></th>
                                    <td><?= $name[sizeof($name) - 1]; ?></td>
                                    <td><?= date('d F Y H:i', strtotime($user_closing['reksis_sld'])); ?></td>
                                    <td><a class="btn btn-sm btn-primary" target="_blank" href="<?= base_url($rs); ?>">view</a> </td>
                                </tr>
                                <?php $idx = $idx + 1;
                                } ?>
                            </tbody>
                        </table>
                        <br>
                        <h5 class="card-title text-uppercase text-dark font-weight-bold">Working Order</h5>
                        <table class="table table-sm table-borderless col-lg-9 ">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">File Name</th>
                                    <th scope="col">Uploaded on</th>
                                    <th scope="col">View</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $file_WO = glob('assets/berkas/' . $customer['name_customer'] . '/Working Order' . '/*.*');
                                // print_r($user_closing);
                                $idx = 1;
                                ?>
                                <?php foreach ($file_WO as $wo) { ?>
                                <?php $name = explode('/', $wo); ?>
                                <tr>

                                    <th scope="row"><?= $idx; ?></th>
                                    <td><?= $name[sizeof($name) - 1]; ?></td>
                                    <td><?= date('d F Y H:i', strtotime($user_closing['working_order_cons'])); ?></td>
                                    <td><a class="btn btn-sm btn-primary" target="_blank" href="<?= base_url($wo); ?>">view</a> </td>
                                </tr>
                                <?php $idx = $idx + 1;
                                } ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Modal -->

<!-- Modal -->
<div class="modal fade" name="detailReportModal" id="detailReportModal" tabindex="-1" role="dialog" aria-labelledby="detailReportModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailReportModalLabel"> Detail Report</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="modal-data"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>