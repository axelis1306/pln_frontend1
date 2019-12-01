<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg">

            <?= $this->session->flashdata('message'); ?>

            <div class="card text-left">
                <div class="card-header">
                    <!-- Nav Tabs -->
                    <ul class="nav nav-pills card-header-tabs" role="tablist" id="myTab">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" role="tab" href="#profileCustomer">Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" role="tab" href="#File">All File</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" role="tab" href="#Energize">File Energize</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" role="tab" href="#report">Report</a>
                        </li>
                        <!-- <li class="nav-item">
                            <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                        </li> -->
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
                                    <td><span class="badge <?= $customer['badge']; ?>"><?= $customer['type_of_service']; ?></span></td>
                                </tr>
                                <tr>
                                    <td>Status</td>
                                    <td>:</td>
                                    <td><span class="badge <?= $customer['badge_status']; ?>"><?= $customer['status']; ?></span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="tab-pane fane" id="File" name="File">
                        <h6 class="card-title text-uppercase text-dark font-weight-bold">Application Letter</h6>
                        <table class="table table-sm table-hover col-lg-9 ">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">File Name</th>
                                    <th scope="col">Uploaded on</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $file_app_letter = glob('assets/berkas/' . $customer['name_customer'] . '/appLetter' . '/*.*');
                                // print_r($user_closing);
                                $idx = 1;
                                ?>
                                <?php if (sizeof($file_app_letter) > 0) { ?>
                                    <?php foreach ($file_app_letter as $al) { ?>
                                        <?php $name = explode('/', $al); ?>
                                        <tr>

                                            <th scope="row"><?= $idx; ?></th>
                                            <td><?= $name[sizeof($name) - 1]; ?></td>
                                            <td><?= date('d F Y H:i', strtotime($user_closing['app_letter'])); ?></td>
                                            <td><a class="btn btn-sm btn-primary" target="_blank" href="<?= base_url($al); ?>">View</a> </td>
                                        </tr>
                                    <?php $idx = $idx + 1;
                                        } ?>
                                <?php } else { ?>
                                    <tr>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td colspan="8" style="text-align:center; height:10px; vertical-align:middle;">Not Yet Available</td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                    </tr>
                                <?php } ?>

                            </tbody>
                        </table>
                        <br>
                        <h6 class="card-title text-uppercase text-dark font-weight-bold">Reksis and SLD</h6>
                        <table class="table table-sm table-hover col-lg-9 ">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">File Name</th>
                                    <th scope="col">Uploaded on</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $file_reksis_sld = glob('assets/berkas/' . $customer['name_customer'] . '/Reksis+SLD' . '/*.*');
                                // print_r($user_closing);
                                $idx = 1;
                                ?>
                                <?php if (sizeof($file_reksis_sld) > 0) { ?>
                                    <?php foreach ($file_reksis_sld as $rs) { ?>
                                        <?php $name = explode('/', $rs); ?>
                                        <tr>

                                            <th scope="row"><?= $idx; ?></th>
                                            <td><?= $name[sizeof($name) - 1]; ?></td>
                                            <td><?= date('d F Y H:i', strtotime($user_closing['reksis_sld'])); ?></td>
                                            <td><a class="btn btn-sm btn-primary" target="_blank" href="<?= base_url($rs); ?>">View</a> </td>
                                        </tr>
                                    <?php $idx = $idx + 1;
                                        } ?>
                                <?php } else { ?>
                                    <tr>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td colspan="8" style="text-align:center; height:10px; vertical-align:middle;">Not Yet Available</td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                        <br>
                        <h6 class="card-title text-uppercase text-dark font-weight-bold">SPJBTL</h6>
                        <table class="table table-sm table-hover col-lg-9 ">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">File Name</th>
                                    <th scope="col">Uploaded on</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $file_spjbtl = glob('assets/berkas/' . $customer['name_customer'] . '/SPJBTL' . '/*.*');
                                // print_r($user_closing);
                                $idx = 1;
                                ?>
                                <?php if (sizeof($file_spjbtl) > 0) { ?>
                                    <?php foreach ($file_spjbtl as $cl) { ?>
                                        <?php $name = explode('/', $cl); ?>
                                        <tr>
                                            <th scope="row"><?= $idx; ?></th>
                                            <td><?= $name[sizeof($name) - 1]; ?></td>
                                            <td><?= date('d F Y H:i', strtotime($user_closing['spjbtl'])); ?></td>
                                            <td><a class="btn btn-sm btn-primary" target="_blank" href="<?= base_url($cl); ?>">View</a> </td>
                                        </tr>
                                    <?php $idx = $idx + 1;
                                        } ?>
                                <?php } else { ?>
                                    <tr>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td colspan="8" style="text-align:center; height:10px; vertical-align:middle;">Not Yet Available</td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                        <br>
                        <h6 class="card-title text-uppercase text-dark font-weight-bold">Contract Letter</h6>
                        <table class="table table-sm table-hover col-lg-9 ">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">File Name</th>
                                    <th scope="col">Uploaded on</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $file_contract_letter = glob('assets/berkas/' . $customer['name_customer'] . '/Contract Letter' . '/*.*');
                                // print_r($user_closing);
                                $idx = 1;
                                ?>
                                <?php if (sizeof($file_contract_letter) > 0) { ?>
                                    <?php foreach ($file_contract_letter as $cl) { ?>
                                        <?php $name = explode('/', $cl); ?>
                                        <tr>
                                            <th scope="row"><?= $idx; ?></th>
                                            <td><?= $name[sizeof($name) - 1]; ?></td>
                                            <td><?= date('d F Y H:i', strtotime($user_closing['contract_letter'])); ?></td>
                                            <td><a class="btn btn-sm btn-primary" target="_blank" href="<?= base_url($cl); ?>">View</a> </td>
                                        </tr>
                                    <?php $idx = $idx + 1;
                                        } ?>
                                <?php } else { ?>
                                    <tr>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td colspan="8" style="text-align:center; height:10px; vertical-align:middle;">Not Yet Available</td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                        <br>
                        <h6 class="card-title text-uppercase text-dark font-weight-bold">Working Order for Construction</h6>
                        <table class="table table-sm table-hover col-lg-9 ">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">File Name</th>
                                    <th scope="col">Uploaded on</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $file_WO = glob('assets/berkas/' . $customer['name_customer'] . '/Working Order' . '/*.*');
                                // print_r($user_closing);
                                $idx = 1;
                                ?>
                                <?php if (sizeof($file_WO) > 0) { ?>
                                    <?php foreach ($file_WO as $wo) { ?>
                                        <?php $name = explode('/', $wo); ?>
                                        <tr>
                                            <th scope="row"><?= $idx; ?></th>
                                            <td><?= $name[sizeof($name) - 1]; ?></td>
                                            <td><?= date('d F Y H:i', strtotime($user_closing['working_order_cons'])); ?></td>
                                            <td><a class="btn btn-sm btn-primary" target="_blank" href="<?= base_url($wo); ?>">View</a> </td>
                                        </tr>
                                    <?php $idx = $idx + 1;
                                        } ?>
                                <?php } else { ?>
                                    <tr>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td colspan="8" style="text-align:center; height:10px; vertical-align:middle;">Not Yet Available</td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="tab-pane fane" id="Energize" name="Energize">
                        <table class="table table-sm table-responsive col-lg ">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">BA Pemasangan ACO</th>
                                    <th scope="col">BA Penyambungan</th>
                                    <th scope="col">Surat Perintah Kerja</th>
                                    <th scope="col">Dokumentasi</th>
                                    <th scope="col">Catatan Khusus</th>
                                    <th scope="col">Uploaded on</th>
                                    <th scope="col">Uploaded By</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $file_ba_aco = glob('assets/berkas/' . $customer['name_customer'] . '/BA ACO' . '/*.*');
                                $file_ba_penyambungan = glob('assets/berkas/' . $customer['name_customer'] . '/BA Penyambungan' . '/*.*');
                                $file_surat_pk = glob('assets/berkas/' . $customer['name_customer'] . '/Surat Perintah Kerja' . '/*.*');
                                $file_dokumentasi = glob('assets/berkas/' . $customer['name_customer'] . '/Dokumentasi Energize' . '/*.*');

                                if (!empty($file_ba_aco)) {
                                    $name_ba_aco = explode('/', $file_ba_aco[0]);
                                    $name_ba_penyambungan = explode('/', $file_ba_penyambungan[0]);
                                    $name_surat_pk = explode('/', $file_surat_pk[0]);
                                }

                                // print_r($user_closing);

                                $map = directory_map($file_dokumentasi);
                                $idx = 1;
                                ?>
                                <?php if (sizeof($file_ba_aco) > 0) { ?>
                                    <tr>
                                        <th scope="row"><?= $idx; ?></th>
                                        <td><a target="_blank" href="<?= base_url($file_ba_aco); ?>"><?= $name_ba_aco[sizeof($name_ba_aco) - 1]; ?></a> </td>
                                        <td><a target="_blank" href="<?= base_url($file_ba_penyambungan); ?>"><?= $name_ba_aco[sizeof($name_ba_aco) - 1]; ?></a> </td>
                                        <td><a target="_blank" href="<?= base_url($file_surat_pk); ?>"><?= $name_surat_pk[sizeof($name_surat_pk) - 1]; ?></a> </td>
                                        <td>
                                            <?php foreach ($file_dokumentasi as $docs) : ?>
                                                <?php $file_docs = explode('/', $docs) ?>
                                                <a class="thumbnail transferImg" href="javascript:void(0)" data-image-id="" data-toggle="modal" data-title="" data-image="<?= base_url($docs); ?>" data-target="#image-gallery">
                                                    <img style="width:30%;height:auto;" class="img-thumbnail" src="<?= base_url($docs); ?>" alt="Another alt text">
                                                </a>

                                            <?php endforeach; ?>
                                            <div class="modal fade" id="image-gallery" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title" id="image-gallery-title"></h4>
                                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-bodyX overflow-auto">
                                                            <img style="width: 50%;height:auto;margin-left: 25%" id="image-gallery-image" class="img-responsive" src="">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary float-left" id="show-previous-image"><i class="fa fa-arrow-left"></i>
                                                            </button>

                                                            <button type="button" id="show-next-image" class="btn btn-secondary float-right"><i class="fa fa-arrow-right"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td><?= $user_energize['catatan_khusus']; ?></td>
                                        <td><?= date('d F Y H:i', strtotime($user_energize['last_submit'])); ?></td>
                                        <td><?= $user_energize['name']; ?></td>
                                    </tr>
                                <?php } else { ?>
                                    <tr>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td colspan="8" style="text-align:center; height:100px; vertical-align:middle;">Not Yet Available</td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                    </tr>
                                <?php } ?>
                                <!--  -->

                            </tbody>
                        </table>
                    </div>

                    <div class="tab-pane fade" id="report" name="report">
                        <table id="detailReportTable" class="table table-hover " style="width:100%">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Reporter</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Reason</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Action</th>

                                </tr>
                            </thead>
                            <tbody>

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
<script src="<?= base_url('assets/'); ?>js/gallery.js"></script>
<script>
    var ling = "<?= base_url() ?>";
    var id = window.location.href.split("/").pop();
    // console.log(id);
    $(document).ready(function() {
        $('#detailReportTable').DataTable({
            'destroy': true,
            "pageLength": 5,
            "scrollX": true,
            "ajax": {
                url: ling + 'manager/getDetailCustomerData/' + id,
                type: 'GET'
            },
            'columns': [{
                    'data': 'no'
                },
                {
                    'data': 'name'
                },
                {
                    'data': 'role_type'
                },
                {
                    'data': 'report_reason'
                },
                {
                    'data': 'report_time'
                },
                {
                    'data': 'btn'
                },

            ],

        });

        $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
            $($.fn.dataTable.tables(true)).css('width', '100%');
            $($.fn.dataTable.tables(true)).DataTable().columns.adjust().draw();
        });
    });
</script>