<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="row">
        <div class="col col-lg">
            <?= $this->session->flashdata('message'); ?>
            <?= form_open_multipart('construction/uploadEnergize', array('id' => 'uploadEnergize')); ?>
            <div class="card">
                <div class="card-body">
                    <input type="hidden" name="id_karyawan" id="id_karyawan" value="<?php echo $user['id_user']; ?>">
                    <input type="hidden" name="id_customer" id="id_customer" value="<?= $customer['id_customer']; ?>">

                    <div class="form-group row">
                        <label for="customer" class="col-sm-2 col-form-label-sm">Customer</label>
                        <div class="col-sm-6">
                            <input class="form-control" type="text" name="name_customer" id="name_customer" value="<?= $customer['name_customer']; ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="ba_aco" class="col-sm-2 col-form-label-sm">Berita Acara Pemasangan ACO</label>
                        <div class="col-sm-6">
                            <div class="custom-file">
                                <input type="file" accept="application/pdf" class="form-control custom-file-input" id="ba_aco" name="ba_aco[]" multiple>
                                <label class="custom-file-label" for="ba_aco">Choose file</label>
                            </div>
                            <p class="card-text"><small class="text-muted font-italic ml-1">* Format PDF only</small></p>
                            <?= form_error('ba_aco[]', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="ba_penyambungan" class="col-sm-2 col-form-label-sm">Berita Acara Penyambungan</label>
                        <div class="col-sm-6">
                            <div class="custom-file">
                                <input type="file" accept="application/pdf" class="form-control custom-file-input" id="ba_penyambungan" name="ba_penyambungan[]" multiple>
                                <label class="custom-file-label" for="ba_penyambungan">Choose file</label>
                            </div>
                            <p class="card-text"><small class="text-muted font-italic ml-1">* Format PDF only</small></p>
                            <?= form_error('ba_penyambungan[]', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="surat_pk" class="col-sm-2 col-form-label-sm">Surat Perintah Kerja</label>
                        <div class="col-sm-6">
                            <div class="custom-file">
                                <input type="file" accept="application/pdf" class="form-control custom-file-input" id="surat_pk" name="surat_pk[]" multiple>
                                <label class="custom-file-label" for="surat_pk">Choose file</label>
                            </div>
                            <p class="card-text"><small class="text-muted font-italic ml-1">* Format PDF only</small></p>
                            <?= form_error('surat_pk[]', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="dokumentasi" class="col-sm-2 col-form-label-sm">Dokumentasi Penyalaan</label>
                        <div class="col-sm-6">
                            <div class="custom-file">
                                <input type="file" class="form-control custom-file-input" id="dokumentasi" name="dokumentasi[]" multiple>
                                <label class="custom-file-label" for="dokumentasi">Choose file</label>
                            </div>
                            <p class="card-text"><small class="text-muted font-italic ml-1">* Format JPG, JPEG, PNG, PDF only</small></p>
                            <?= form_error('dokumentasi[]', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="catatan_khusus" class="col-sm-2 col-form-label-sm">Catatan Khusus</label>
                        <div class="col-sm-10">
                            <textarea class="form-control form-control-sm" name="catatan_khusus" id="catatan_khusus" cols="30" rows="7" value="<?= set_value('catatan_khusus'); ?>"></textarea>
                            <?= form_error('catatan_khusus', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-group row justify-content-end">
                        <div class="col-sm-10">
                            <button class="btn btn-sm btn-success" type="submit" name="uploadReksisSLD" id="uploadReksisSLD">
                                Upload Berkas Energize
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