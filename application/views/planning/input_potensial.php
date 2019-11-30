<!-- Begin Page Content -->
<div class="container-fluid">
    <link type="text/css" rel="stylesheet" href="<?= base_url('assets/'); ?>css/tail.select-default.min.css" />
    <script type="text/javascript" src="<?= base_url('assets/'); ?>js/tail.select-full.min.js"></script>
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="row">
        <div class="col-lg">
            <button class="btn btn-sm btn-facebook mb-3 input-file-potential" type="button" data-toggle="modal" data-target="#modalInputFilePotential">
                <i class="fas fa-plus-circle text-white mr-2"></i>
                Input Data With Excel</button>
            
            <div class="row">
                <div class="col-lg-4">
                    <?= $this->session->flashdata('message'); ?>
                </div>
            </div>
            <?= form_open_multipart('planning/addPotencial'); ?>

            <div class="card col-lg">
                <div class="card-body col-lg-11">
                    <div class="form-group row">
                        <label for="cust-name" class="col-sm-2 col-form-label col-form-label-sm">Customer Name *</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control form-control-sm" id="cust-name" name="cust-name" placeholder="Customer's Name" value="<?= set_value('cust-name'); ?>">
                            <?= form_error('cust-name', '<small class="text-danger pl-1">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cust-id" class="col-sm-2 col-form-label col-form-label-sm">ID Customer *</label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control form-control-sm" id="cust-id" name="cust-id" placeholder="ID Customer's" value="<?= set_value('cust-id'); ?>">
                            <?= form_error('cust-id', '<small class="text-danger pl-1">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tariff" class="col-sm-2 col-form-label col-form-label-sm">Tarif *</label>
                        <div class="col-sm-2">
                            <select id="tariff" name="tariff" class="form-control custom-select-sm">
                                <?php foreach ($tariff as $tarif) { ?>
                                <option value="<?= $tarif['id_tariff'] ?>" <?= set_select('tariff', $tarif['id_tariff']); ?>><?= $tarif['tariff'] ?></option>
                                <?php } ?>
                            </select>
                            <?= form_error('tariff', '<small class="text-danger pl-1">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="power" class="col-sm-2 col-form-label col-form-label-sm">Daya *</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control form-control-sm" id="power" name="power" value="<?= set_value('power'); ?>">
                            <?= form_error('power', '<small class="text-danger pl-1">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cust-address" class="col-sm-2 col-form-label col-form-label-sm">Address *</label>
                        <div class="col-sm-8">
                            <textarea class="form-control form-control-sm" name="cust-address" id="cust-address" cols="30" rows="4" placeholder="Address Customer's" value="<?= set_value('cust-address'); ?>"><?= set_value('cust-address'); ?></textarea>
                            <?= form_error('cust-address', '<small class="text-danger pl-1">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="substation" class="col-sm-2 col-form-label col-form-label-sm">Substation *</label>
                        <div class="col-sm-8">
                            <!-- <input type="text" class="form-control form-control-sm" id="substation" name="substation"> -->
                            <select id="substation" name="substation" class="form-control custom-select-sm" value="<?= set_value('substation'); ?>">
                                <?php foreach ($substation as $subs) { ?>
                                <option value="<?= $subs['id_substation'] ?>" <?= set_select('substation', $subs['id_substation']); ?>><?= $subs['name_substation'] ?></option>
                                <?php } ?>
                            </select>
                            <?= form_error('substation', '<small class="text-danger pl-1">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="feeder-substation" class="col-sm-2 col-form-label col-form-label-sm">Feeder Substation *</label>
                        <div class="col-sm-8">
                            <!-- <input type="text" class="form-control form-control-sm" id="feeder-substation" name="feeder-substation"> -->
                            <select id="feeder-substation" name="feeder-substation" class="form-control custom-select-sm" value="<?= set_value('feeder-substation'); ?>">
                                <?php foreach ($feeder_substation as $fsubs) { ?>
                                <option value="<?= $fsubs['id_feeder_substation'] ?>" <?= set_select('feeder-substation', $fsubs['id_feeder_substation']); ?>><?= $fsubs['name_feeder_substation'] ?></option>
                                <?php } ?>
                            </select>
                            <?= form_error('feeder-substation', '<small class="text-danger pl-1">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="subsistem" class="col-sm-2 col-form-label col-form-label-sm">Subsistem *</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control form-control-sm" id="subsistem" name="subsistem" value="<?= set_value('subsistem'); ?>">
                            <?= form_error('subsistem', '<small class="text-danger pl-1">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="bep-value" class="col-sm-2 col-form-label col-form-label-sm">BEP Value *</label>
                        <div class="col-sm-8">
                            <input type="number" step="any" class="form-control form-control-sm" id="bep-value" name="bep-value" value="<?= set_value('bep-value'); ?>">
                            <?= form_error('bep-value', '<small class="text-danger pl-1">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="recommend-service" class="col-sm-2 col-form-label col-form-label-sm">Service Recommendation*</label>
                        <div class="col-sm-8">
                            <select id="recommend-service" name="recommend-service" class="form-control custom-select-sm">
                                <?php foreach ($service as $down) { ?>
                                <option value="<?= $down['id_type_of_service'] ?>" <?= set_select('recommend-service', $down['id_type_of_service']); ?>><?= $down['type_of_service'] ?></option>
                                <?php } ?>
                            </select>
                            <?= form_error('recommend-service', '<small class="text-danger pl-1">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-group row justify-content-end">
                        <div class="col-sm-10">
                            <button class="btn btn-sm btn-primary" type="submit" name="save" id="save">Input Data*</button>
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

<!-- Modal -->
<div class="modal fade" id="modalInputFilePotential" tabindex="-1" role="dialog" aria-labelledby="modalInputFilePotentialTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#1a94aa;">
                <h5 class="modal-title text-white" style="font-size:normal;" id="modalInputFilePotentialTitle">Input
                    Data Potential With Excel</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>
            <div class="modal-body mt-3">
                <form action="<?= base_url('planning/ajax_add') ?>" method="post" enctype="multipart/form-data">
                    <div class="form-group row">
                        <label for="file_excel" class="col-sm-2 col-form-label">File</label>
                        <div class="col-sm-10">
                            <div class="custom-file">
                                <input type="file" class="form-control custom-file-input" id="file_excel" name="file_excel">
                                <label class="custom-file-label" for="file_excel">Choose file</label>
                            </div>
                            <div class="label font-italic mt-1" style="font-size:small;">
                                * Must use an Existing Template (.xlsx)
                            </div>
                            <?= form_error('file_excel', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-sm btn-primary " id="input-potential-file"><i class="fas fa-cloud-upload-alt text-white mr-1"></i> Upload File</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    tail.select("#tariff", {
        search: true,
        deselect: true,
        width: 100,
        searchMinLength: 0,
        placeholder: 'Choose Tariff...'
    });

    tail.select("#substation", {
        search: true,
        deselect: true,
        width: 200,
        placeholder: 'Choose Substation...'
    });

    tail.select("#feeder-substation", {
        search: true,
        deselect: true,
        width: 200,
        placeholder: 'Choose Feeder Substation...'
    });


    tail.select("#recommend-service", {
        search: true,
        deselect: true,
        width: 200,
        placeholder: 'Choose Service...'
    });

    // var rupiah = document.getElementById('bep-value');
    // rupiah.addEventListener('keyup', function(e) {
    //     // tambahkan 'Rp.' pada saat form di ketik
    //     // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
    //     rupiah.value = formatRupiah(this.value, 'Rp. ');
    // });
</script>
