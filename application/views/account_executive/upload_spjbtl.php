<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="row">
        <div class="col col-lg">
            <?= $this->session->flashdata('message'); ?>
            <?= form_open_multipart('accountexecutive/uploadSPJBTL', array('id' => 'uploadSPJBTL')); ?>
            <div class="card">
                <div class="card-body">
                    <input type="hidden" name="id_karyawan" id="id_karyawan" value="<?php echo $user['id_user']; ?>">
                    <input type="hidden" name="id_customer" id="id_customer" value="<?= $customer['id_customer']; ?>">

                    <div class="form-group row">
                        <label for="reksisSLD" class="col-sm-2 col-form-label-sm">Customer</label>
                        <div class="col-sm-6">
                            <input class="form-control" type="text" name="name_customer" id="name_customer" value="<?= $customer['name_customer']; ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="spjbtl" class="col-sm-2 col-form-label-sm">SPJBTL</label>
                        <div class="col-sm-6">
                            <div class="custom-file">
                                <input type="file" class="form-control custom-file-input" id="spjbtl" name="spjbtl[]" multiple>
                                <label class="custom-file-label" for="spjbtl">Choose file</label>
                            </div>
                            <?= form_error('reksisSLD[]', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="contract" class="col-sm-2 col-form-label-sm">Surat Kontrak</label>
                        <div class="col-sm-6">
                            <div class="custom-file">
                                <input type="file" class="form-control custom-file-input" id="contract" name="contract[]" multiple>
                                <label class="custom-file-label" for="contract">Choose file</label>
                            </div>
                            <?= form_error('reksisSLD[]', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="report_reason" class="col-sm-2 col-form-label-sm">Progress</label>
                        <div class="col-sm-10">
                            <textarea class="form-control form-control-sm" name="report_reason" id="report_reason" cols="30" rows="7" value="<?= set_value('report_reason'); ?>" required></textarea>
                            <?= form_error('report_reason', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-group row justify-content-end">
                        <div class="col-sm-10">
                            <button class="btn btn-sm btn-primary" type="submit" name="uploadReksisSLD" id="uploadReksisSLD">
                                Upload
                                <i class="fas fa-upload ml-1 text-white"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <?= form_close(); ?>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->