<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-3 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg">
            <a href="<?= base_url('construction/cancellationReport/' . $customer['id_customer']); ?>" class="btn btn-sm btn-danger mb-3 ml-1 float-right btn-confirm-rejected"><i class="fas fa-times text-white mr-1"></i> Rejected</a>
            <a href="<?= base_url('construction/energize/' . $customer['id_customer']); ?>" class="btn btn-sm btn-success mb-3 float-right btn-confirm-energize"><i class="fas fa-bolt text-white mr-1"></i> Go Energize!</a>
            <div class="col-lg-6 float-left">
                <?= $this->session->flashdata('message'); ?>
            </div>

            <?php echo form_open_multipart('construction/uploadReportConstruction/' . $customer['id_customer'], array('id' => 'uploadReportCons')); ?>
            <div class="card col-lg">
                <div class="card-body col-lg-9">
                    <input type="hidden" name="id_karyawan" id="id_karyawan" value="<?php echo $user['id_user']; ?>">
                    <input type="hidden" name="id_customer" id="id_customer" value="<?= $customer['id_customer']; ?>">

                    <div class="form-group row">
                        <label for="customer" class="col-sm-2 col-form-label-sm">Customer</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control form-control-sm" id="customer" name="customer" value="<?= $customer['name_customer']; ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="report_reason" class="col-sm-2 col-form-label-sm">Keterangan</label>
                        <div class="col-sm-10">
                            <textarea class="form-control form-control-sm" name="report_reason" id="report_reason" cols="30" rows="7" value="<?= set_value('report_reason'); ?>"></textarea>
                            <?= form_error('report_reason', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="images" class="col-sm-2 col-form-label-sm">Image</label>
                        <div class="col-sm-10">
                            <div class="custom-file">
                                <input type="file" class="form-control custom-file-input" id="images" name="images[]" multiple>
                                <label class="custom-file-label" for="images">Choose file</label>
                            </div>
                            <?= form_error('images[]', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-group row justify-content-end">
                        <div class="col-sm-10">
                            <button class="btn btn-sm btn-primary" type="button" name="save" id="save" data-toggle="modal" data-target="#modalReportCons">
                                Save
                                <i class="fas fa-save ml-1 text-white"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <?php form_close() ?>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Central Modal Medium Info -->
<div class="modal fade" id="modalReportCons" name="modalReportCons" tabindex="-1" role="dialog" aria-labelledby="modalReportCons" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <!--Content-->
        <div class="modal-content">
            <!--Header-->
            <div class="modal-header bg-gradient-primary">
                <h5 class="modal-title lead text-white" id="modalReportConsLabel" name="modalReportConsLabel">Add Visit Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!--Body-->
            <div class="modal-body">
                <div class="text-center">
                    <i class="fas fa-question fa-4x mb-3 animated tada infinite" style="color:#007bff;"></i>
                    <p class="font-weight-bold text-dark">Are you sure you want to add the following data? If this is correct, click the save button.
                        If not, click the cancel button</p>
                </div>
            </div>

            <!--Footer-->
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary animated lightSpeedIn" id="confirm-submit-cons" name="confirm-submit-cons">Save data <i class="fas fa-save ml-1 text-white"></i></button>
            </div>
        </div>
        <!--/.Content-->
    </div>
</div>