<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="row">
        <div class="col-lg">
            <div class="col-lg-6">
                <?= $this->session->flashdata('message'); ?>
            </div>
            <table id="cust-potencial" class="table table-hover" style="width: 100%;">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama Pelanggan</th>
                        <th scope="col">ID</th>
                        <th scope="col">Tarif / Daya</th>
                        <th scope="col">Layanan</th>
                        <th scope="col">Status</th>
                        <th scope="col">Informasi</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<script>
    var ling = "<?= base_url() ?>";
    $(document).ready(function() {
        $('#cust-potencial').DataTable({
            'destroy': true,
            "pageLength": 10,
            "scrollX": true,
            "ajax": {
                url: ling + 'construction/getMonitoringList',
                type: 'GET'
            },
            'columns': [{
                    'data': 'no'
                },
                {
                    'data': 'name_customer'
                },
                {
                    'data': 'id_customer'
                },
                {
                    'data': 'tariff/daya'
                },
                {
                    'data': 'type_of_service'
                },
                {
                    'data': 'status'
                },
                {
                    'data': 'information'
                },
                {
                    'data': 'btn1/btn2'
                }

            ],

        });


    });
</script>