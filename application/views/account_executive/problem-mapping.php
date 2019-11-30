<!-- Begin Page Content -->
<div class="container-fluid">
    <link type="text/css" rel="stylesheet" href="<?= base_url('assets/'); ?>css/tail.select-default.min.css" />
    <script type="text/javascript" src="<?= base_url('assets/'); ?>js/tail.select-full.min.js"></script>
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1><br>
    <div class="row">
        <div class="col-lg">
            <?php echo form_open_multipart('accountexecutive/problemMapping/' . $customer['id_customer'], array('id' => 'addProblemMapping')); ?>

            <input type="hidden" name="id_karyawan" id="id_karyawan" value="<?php echo $user['id_user']; ?>">

            <div class="row">
                <div class="col-lg-4">
                    <?= $this->session->flashdata('message'); ?>
                </div>
            </div>

            <h5 class="text-info font-weight-bold text">Rejuvenation Data</h5><br>
            <div class="card text-left">
                <div class="card-header">
                    <!-- Nav Tabs -->
                    <ul class="nav nav-pills card-header-pills" role="tablist" id="myTab">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" role="tab" href="#updateCustomerProfile">Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" role="tab" href="#updateCompanyProfile">Company Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" role="tab" href="#chiefInfo">Chief Info</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" role="tab" href="#financeAffairs">Finance Affairs</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" role="tab" href="#engineeringAffairs">Engineering Affairs</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" role="tab" href="#generalAffairs">General Affairs</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" role="tab" href="#techSpecification">Technical Specification</a>
                        </li>
                    </ul>
                </div>
                <!-- End Nav Tabs -->

                <!-- Tab Panes -->
                <div class="card-body tab-content col-lg-9">

                    <!-- Tab Pane Customer's Profile -->
                    <div class="tab-pane active" id="updateCustomerProfile" name="updateCustomerProfile">
                        <h5 class="text-dark font-weight-light">Customer's Profile</h5><br>
                        <div class="form-group row">
                            <label for="customer" class="col-sm-2 col-form-label-sm">Customer</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control form-control-sm" name="customer" id="customer" value="<?= $customer['name_customer']; ?>" readonly>
                                <?= form_error('customer', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="address-customer" class="col-sm-2 col-form-label-sm">Address</label>
                            <div class="col-sm-10">
                                <textarea class="form-control form-control-sm" name="address-customer" id="address-customer" cols="30" rows="4" placeholder="Address" value="<?= set_value('address-customer'); ?>"><?= $customer['address_customer']; ?></textarea>
                                <?= form_error('address-customer', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tariff" class="col-sm-2 col-form-label col-form-label-sm">Tarif *</label>
                            <div class="col-sm-3">
                                <select id="tariff" name="tariff" class="form-control custom-select-sm">
                                    <?php foreach ($tariff as $tarif) { ?>
                                    <option value="<?= $tarif['id_tariff'] ?>" <?php if ($customer['tariff'] == $tarif['tariff']) {
                                                                                        echo 'selected';
                                                                                    } ?>><?= $tarif['tariff'] ?></option>
                                    <?php } ?>
                                </select>
                                <?= form_error('tariff', '<small class="text-danger pl-1">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="power" class="col-sm-2 col-form-label-sm">Daya</label>
                            <div class="col-sm-3">
                                <input type="number" class="form-control form-control-sm" name="power" id="power" value="<?= $customer['power']; ?>">
                                <?= form_error('power', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="dropDown" class="col-sm-2 col-form-label-sm">Service</label>
                            <div class="col-sm-3">
                                <select id="dropDown" name="dropDown" class="form-control custom-select-sm">
                                    <option></option>
                                    <?php foreach ($dropDown as $down) { ?>
                                    <option value="<?= $down['id_type_of_service'] ?>" <?php if ($customer['type_of_service'] == $down['type_of_service']) {
                                                                                                echo 'selected';
                                                                                            } ?>><?= $down['type_of_service']; ?></option>
                                    <?php } ?>
                                </select>
                                <?= form_error('dropDown', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row justify-content-end">
                            <div class="col-sm-10">
                                <a class="btn btn-info btnNext text-white">Next</a>
                            </div>
                        </div>
                    </div>

                    <!-- Tab Pane Company's Profile -->
                    <div class="tab-pane fade" id="updateCompanyProfile" name="updateCompanyProfile">
                        <h5 class="text-dark font-weight-light">Company's Profile</h5><br>
                        <div class="form-group row">
                            <label for="company-name" class="col-sm-2 col-form-label-sm">Company</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control form-control-sm" name="company-name" id="company-name" placeholder="Company's Name" value="<?= set_value('company-name'); ?>">
                                <?= form_error('company-name', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="address-company" class="col-sm-2 col-form-label-sm">Address</label>
                            <div class="col-sm-10">
                                <textarea class="form-control form-control-sm" name="address-company" id="address-company" cols="30" rows="4" placeholder="Address Company" value="<?= set_value('address-company'); ?>"><?= set_value('address-company'); ?></textarea>
                                <?= form_error('address-company', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="phone-company" class="col-sm-2 col-form-label-sm">Phone Number</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control form-control-sm" name="phone-company" id="phone-company" value="<?= set_value('phone-company'); ?>">
                                <?= form_error('phone-company', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="facsimile" class="col-sm-2 col-form-label-sm">Facsimile</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control form-control-sm" name="facsimile" id="facsimile" value="<?= set_value('facsimile'); ?>">
                                <?= form_error('facsimile', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email-company" class="col-sm-2 col-form-label-sm">Email</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control form-control-sm" name="email-company" id="email-company" value="<?= set_value('email-company'); ?>">
                                <?= form_error('email-company', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="establishment" class="col-sm-2 col-form-label-sm">Establishment</label>
                            <div class="col-sm-3">
                                <input type="date" class="form-control form-control-sm" name="establishment" id="establishment" value="<?= set_value('establishment'); ?>">
                                <?= form_error('establishment', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row justify-content-end">
                            <div class="col-sm-10">
                                <a class="btn btn-info btnPrevious text-white">Previous</a>
                                <a class="btn btn-info btnNext text-white">Next</a>
                            </div>
                        </div>
                    </div>

                    <!-- Tab Pane Chief Info -->
                    <div class="tab-pane fade" id="chiefInfo" name="chiefInfo">
                        <h5 class="text-dark font-weight-light">Chief of The Company</h5><br>
                        <div class="form-group row">
                            <label for="company-leader-name" class="col-sm-2 col-form-label-sm">Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control form-control-sm" name="company-leader-name" id="company-leader-name" placeholder="Leader's Name" value="<?= set_value('company-leader-name'); ?>" required>
                                <?= form_error('company-leader-name', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="leader-position-company" class="col-sm-2 col-form-label-sm">Position</label>
                            <div class="col-sm-10">
                                <input class="form-control form-control-sm" name="leader-position-company" id="leader-position-company" placeholder="Leader's Position" value="<?= set_value('leader-position-company'); ?>" required>
                                <?= form_error('leader-position-company', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="phone-leader-company" class="col-sm-2 col-form-label-sm">Phone Number</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control form-control-sm" name="phone-leader-company" id="phone-leader-company" value="<?= set_value('phone-leader-company'); ?>">
                                <?= form_error('phone-leader-company', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email-leader-company" class="col-sm-2 col-form-label-sm">Email</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control form-control-sm" name="email-leader-company" id="email-leader-company" value="<?= set_value('email-leader-company'); ?>">
                                <?= form_error('email-leader-company', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row justify-content-end">
                            <div class="col-sm-10">
                                <a class="btn btn-info btnPrevious text-white">Previous</a>
                                <a class="btn btn-info btnNext text-white">Next</a>
                            </div>
                        </div>
                    </div>

                    <!-- Tab Pane Finance Affairs -->
                    <div class="tab-pane fade" id="financeAffairs" name="financeAffairs">
                        <h5 class="text-dark font-weight-light">Finance of The Company</h5><br>
                        <div class="form-group row">
                            <label for="company-finance-name" class="col-sm-2 col-form-label-sm">Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control form-control-sm" name="company-finance-name" id="company-finance-name" placeholder="Finance's Name" value="<?= set_value('company-finance-name'); ?>" required>
                                <?= form_error('company-finance-name', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="finance-position-company" class="col-sm-2 col-form-label-sm">Position</label>
                            <div class="col-sm-10">
                                <input class="form-control form-control-sm" name="finance-position-company" id="finance-position-company" placeholder="Finance's Position" value="<?= set_value('finance-position-company'); ?>" required>
                                <?= form_error('finance-position-company', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="phone-finance-company" class="col-sm-2 col-form-label-sm">Phone Number</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control form-control-sm" name="phone-finance-company" id="phone-finance-company" value="<?= set_value('phone-finance-company'); ?>">
                                <?= form_error('phone-finance-company', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email-finance-company" class="col-sm-2 col-form-label-sm">Email</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control form-control-sm" name="email-finance-company" id="email-finance-company" value="<?= set_value('email-finance-company'); ?>">
                                <?= form_error('email-finance-company', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row justify-content-end">
                            <div class="col-sm-10">
                                <a class="btn btn-info btnPrevious text-white">Previous</a>
                                <a class="btn btn-info btnNext text-white">Next</a>
                            </div>
                        </div>
                    </div>

                    <!-- Tab Pane Engineering Affairs -->
                    <div class="tab-pane fade" id="engineeringAffairs" name="engineeringAffairs">
                        <h5 class="text-dark font-weight-light">Engineering of The Company</h5><br>
                        <div class="form-group row">
                            <label for="company-engineering-name" class="col-sm-2 col-form-label-sm">Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control form-control-sm" name="company-engineering-name" id="company-engineering-name" placeholder="Engineer's Name" value="<?= set_value('company-engineering-name'); ?>" required>
                                <?= form_error('company-engineering-name', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="engineering-position-company" class="col-sm-2 col-form-label-sm">Position</label>
                            <div class="col-sm-10">
                                <input class="form-control form-control-sm" name="engineering-position-company" id="engineering-position-company" placeholder="Engineer's Position" value="<?= set_value('engineering-position-company'); ?>" required>
                                <?= form_error('engineering-position-company', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="phone-engineering-company" class="col-sm-2 col-form-label-sm">Phone Number</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control form-control-sm" name="phone-engineering-company" id="phone-engineering-company" value="<?= set_value('phone-engineering-company'); ?>">
                                <?= form_error('phone-engineering-company', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email-engineering-company" class="col-sm-2 col-form-label-sm">Email</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control form-control-sm" name="email-engineering-company" id="email-engineering-company" value="<?= set_value('email-engineering-company'); ?>">
                                <?= form_error('email-engineering-company', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row justify-content-end">
                            <div class="col-sm-10">
                                <a class="btn btn-info btnPrevious text-white">Previous</a>
                                <a class="btn btn-info btnNext text-white">Next</a>
                            </div>
                        </div>
                    </div>

                    <!-- Tab Pane General Affairs -->
                    <div class="tab-pane fade" id="generalAffairs" name="generalAffairs">
                        <h5 class="text-dark font-weight-light">General Affairs of The Company</h5><br>
                        <div class="form-group row">
                            <label for="company-general-name" class="col-sm-2 col-form-label-sm">Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control form-control-sm" name="company-general-name" id="company-general-name" value="<?= set_value('company-general-name'); ?>" required>
                                <?= form_error('company-general-name', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="general-position-company" class="col-sm-2 col-form-label-sm">Position</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control form-control-sm" name="general-position-company" id="general-position-company" value="<?= set_value('general-position-company'); ?>" required>
                                <?= form_error('general-position-company', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="phone-general-company" class="col-sm-2 col-form-label-sm">Phone Number</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control form-control-sm" name="phone-general-company" id="phone-general-company" value="<?= set_value('phone-general-company'); ?>">
                                <?= form_error('phone-general-company', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email-general-company" class="col-sm-2 col-form-label-sm">Email</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control form-control-sm" name="email-general-company" id="email-general-company" value="<?= set_value('email-general-company'); ?>">
                                <?= form_error('email-general-company', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row justify-content-end">
                            <div class="col-sm-10">
                                <a class="btn btn-info btnPrevious text-white">Previous</a>
                                <a class="btn btn-info btnNext text-white">Next</a>
                            </div>
                        </div>
                    </div>

                    <!-- Tab Pane Technical Specification -->
                    <div class="tab-pane fade" id="techSpecification" name="techSpecification">
                        <h5 class="text-dark font-weight-light">Technical Specification</h5><br>
                        <div class="form-group row">
                            <label for="captive-power" class="col-sm-2 col-form-label-sm">Captive Power</label>
                            <div class="col-sm-2">
                                <input type="number" class="form-control form-control-sm" name="captive-power" id="captive-power" value="<?= set_value('captive-power'); ?>">
                                <?= form_error('captive-power', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="amount-of-power" class="col-sm-2 col-form-label-sm">Amount of Power</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control form-control-sm" name="amount-of-power" id="amount-of-power" value="<?= set_value('amount-of-power'); ?>">
                                <?= form_error('amount-of-power', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="next-meeting" class="col-sm-2 col-form-label-sm">Next Meeting</label>
                            <div class="col-sm-3">
                                <input type="date" class="form-control form-control-sm" name="next-meeting" id="next-meeting" min="<?= date("Y-m-d"); ?>" max="<?= date("Y-m-d", strtotime('12/31')); ?>" value="<?= set_value('next-meeting'); ?>">
                                <?= form_error('next-meeting', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="suggestion" class="col-sm-2 col-form-label-sm">Suggestion</label>
                            <div class="col-sm-10">
                                <textarea type="text" class="form-control form-control-sm" name="suggestion" id="suggestion" cols="30" rows="4" value="<?= set_value('suggestion'); ?>"><?= set_value('suggestion'); ?></textarea>
                                <?= form_error('suggestion', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row justify-content-end">
                            <div class="col-sm-10">
                                <a class="btn btn-info btnPrevious text-white">Previous</a>
                                <button class="btn btn-primary" type="button" name="save" id="save" data-toggle="modal" data-target="#modalRejuvenateData">
                                    Save
                                    <i class="fas fa-save ml-1 text-white"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End of Tab Panes -->
            </div>
            <?= form_close(); ?>
        </div>
    </div>
    <br>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Central Modal Medium Info -->
<div class="modal fade" id="modalRejuvenateData" name="modalRejuvenateData" tabindex="-1" role="dialog" aria-labelledby="modalRejuvenateData" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <!--Content-->
        <div class="modal-content">
            <!--Header-->
            <div class="modal-header bg-gradient-primary">
                <h5 class="modal-title lead text-white" id="modalRejuvenateDataLabel" name="modalRejuvenateDataLabel">Add Rejuvenate Data</h5>
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
                <!-- <a type="button" class="btn btn-info text-white">Yes, sure. <i class="fas fa-save ml-1 text-white"></i></a>
                <a type="button" class="btn btn-outline-secondary" data-dismiss="modal">Not sure</a> -->
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary animated lightSpeedIn" id="confirm-submit-probing" name="confirm-submit-probing">Save data <i class="fas fa-save ml-1 text-white"></i></button>


            </div>
        </div>
        <!--/.Content-->
    </div>
</div>

<script type="text/javascript">
    tail.select("#tariff", {
        search: true,
        deselect: true,
        width: 150,
        searchMinLength: 0,
        placeholder: 'Choose Tariff...'
    });

    tail.select("#dropDown", {
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