<!-- DETAIL REPORT -->

<h5 class="card-title text-uppercase text-dark font-weight-bold"><?= $report_row['name_customer']; ?></h5>
<table class="table table-sm table-borderless col-lg-7">
    <tbody>
        <tr>
            <td>Name</td>
            <td>:</td>
            <td><?= $report_row['name']; ?></td>
            <!-- <button class="buton">Pencet</button> -->
        </tr>
        <tr>
            <td>Reason</td>
            <td>:</td>
            <td class="text-break"><?php
                                    $folder = open_folder($report_row['name_customer'], $report_row['report_time']);
                                    $map = directory_map($folder);
                                    print_r($map);
                                    ?></td>
        </tr>
        <tr>
            <td>Date</td>
            <td>:</td>
            <td><?= $report_row['report_time']; ?></td>
        </tr>
        <tr>
            <td>Image</td>
            <td>:</td>
            <td>
                <?php
                $folder = open_folder($report_row['name_customer'], $report_row['report_time']);
                $map = directory_map($folder);

                foreach ($map as $value) { ?>
                <a class="thumbnail transferImg" href="javascript:void(0)" data-image-id="" data-toggle="modal" data-title="" data-image="<?= base_url() . $folder . $value; ?>" data-target="#image-gallery">
                    <img class="img-thumbnail" src="<?= base_url() . $folder . $value; ?>" alt="Another alt text">
                </a>
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
    </tbody>
</table>

<!-- END DETAIL REPORT -->

<script src="<?= base_url('assets/'); ?>js/gallery.js"></script>