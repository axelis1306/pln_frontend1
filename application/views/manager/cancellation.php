<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="row">
        <div class="col col-lg">

            <div class="card">
                <div class="card-body">
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
                            <td>Layanan</td>
                            <td>:</td>
                            <td><span class="badge <?= $customer['badge']; ?>"><?= $customer['type_of_service']; ?></span></td>
                            </tr>
                            <tr>
                                <td>Cancellation Reason</td>
                                <td>:</td>
                                <td class="text-break"><?= $user_cancellation['cancellation_reason']; ?></td>
                            </tr>
                            <tr>
                                <td>Image</td>
                                <td>:</td>
                                <td>
                                    <?php
                                    $folder = open_folder_cancellation($customer['name_customer']);
                                    $map = directory_map($folder);
                                    if (count($map) > 0) { ?>
                                    <?php foreach ($map as $value) { ?>
                                    <a class="thumbnail transferImg" href="javascript:void(0)" data-image-id="" data-toggle="modal" data-title="" data-image="<?= base_url() . $folder . $value; ?>" data-target="#image-gallery">
                                        <img style="width:10%;height:auto;" class="img-thumbnail" src="<?= base_url() . $folder . $value; ?>" alt="Another alt text">
                                    </a>
                                    <?php } ?>
                                    <?php } else { ?>
                                    <p>No Image</p>
                                    <?php } ?>
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
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td><a href="<?= base_url('manager/addConfirmCancel/' . $customer['id_customer']); ?>" class="btn btn-sm btn-danger mb-3 ml-1 btn-confirm-rejected"><i class="fas fa-times text-white"></i> Confirm to Cancel</a></td>
                            </tr>
                        </tbody>
                    </table>
                    <hr>

                </div>
            </div>

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->
    <script src="<?= base_url('assets/'); ?>js/gallery.js"></script>