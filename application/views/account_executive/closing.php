<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="row">
        <div class="col col-lg">
            <?= $this->session->flashdata('message'); ?>
            <?= form_open_multipart('accountexecutive/uploadclosing', array('id' => 'uploadClosing')); ?>
            <div class="card">
                <div class="card-body">
                    <input type="hidden" name="id_karyawan" id="id_karyawan" value="<?php echo $user['id_user']; ?>">
                    <input type="hidden" name="id_customer" id="id_customer" value="<?= $customer['id_customer']; ?>">
                    <div class="form-group row">
                        <label for="appLetter" class="col-sm-2 col-form-label-sm">Application Letter Customer</label>
                        <div class="col-sm-6">
                            <div class="custom-file">
                                <input type="file" class="form-control custom-file-input" id="appLetter" name="appLetter[]" multiple>
                                <label class="custom-file-label" for="appLetter">Choose file</label>
                            </div>
                            <?= form_error('appLetter[]', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-group row justify-content-end">
                        <div class="col-sm-10">
                            <button class="btn btn-sm btn-primary" type="submit" name="uploadAppLetter" id="uploadAppLetter">
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

<!-- <script>
    Dropzone.options.uploadAppLetter = {
        autoProcessQueue: false,
        acceptedFiles: "image/*,application/pdf",
        addRemoveLinks: true,
        maxFilesize: 6,
        init: function() {
            let submitButton = document.querySelector('#submitAppLetter');
            dropzoneAppLetter = this;
            submitButton.addEventListener("click", function() {
                dropzoneAppLetter.processQueue();
            });
            this.on("sending", function() {
                console.log('asu');
            })
            this.on("complete", function() {
                if (this.getQueuedFiles().length == 0 && this.getUploadingFiles().length == 0) {
                    let _this = this;
                    _this.removeAllFiles();

                }
            });
        }
    };
</script> -->