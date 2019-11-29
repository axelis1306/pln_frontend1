<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-9">
            <?php echo form_open_multipart('user/uploadReport'); ?>

            <input type="hidden" name="id_karyawan" id="id_karyawan" value="<?php echo $user['id_user']; ?>">

            <div class="row">
                <div class="col-lg-4">
                    <?= $this->session->flashdata('message'); ?>
                </div>
            </div>
            <div class="form-group row">
                <label for="report_reason" class="col-sm-2 col-form-label">Customer</label>
                <div class="col-sm-10">
                    <select id="dropDown" name="dropDown" class="form-control">
                        <option></option>
                        <?php foreach ($dropDown as $down) { ?>
                            <option value="<?= $down['id_customer'] ?>" N><?= $down['name_customer'] ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="report_reason" class="col-sm-2 col-form-label">Reason</label>
                <div class="col-sm-10">
                    <textarea class="form-control" name="report_reason" id="report_reason" cols="30" rows="7" placeholder="Type here..." required></textarea>
                    <!-- <input style="height: 150px;" type="textarea" class="form-control" name="report_reason" id="report_reason" placeholder="Type here..."> -->
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-2">Upload Images</div>
                <div class="col-sm-10">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="images" name="images[]" required multiple>
                        <label class="custom-file-label" for="image">Choose file</label>
                    </div>
                </div>
            </div>
            <div class="form-group row justify-content-end">
                <div class="col-sm-10">
                    <button class="btn btn-primary" type="submit" name="save" id="save">Save</button>
                </div>
            </div>
            </form>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->