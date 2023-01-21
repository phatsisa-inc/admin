<section class="mt-2 mb-2">
    <div class="container-fluid">
        <p><a href="">Dashboard </a> / Reports</p>
        <div class="row">
            <div class="col-2 p-0 border-right border-top">
                <p class="mb-0 bg-light p-2 rounded">
                    <b>Reports</b>
                </p>
                <button class="btn btn-primary rounded-0 btn-block mt-2" data-toggle="modal" data-target="#addAdmin_Modal" type="button"><i class="fa fa-plus mr-1"></i> Add Admin</button>
            </div>
            <div class="col-10">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#unclaimedOrders">Unclaimed Orders</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#claimedOrders">Claimed Orders</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#deletedOrders">Deleted Orders</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane container active" id="unclaimedOrders">
                        <div class="container-fluid mt-3">
                            <div class="mb-2 d-flex justify-content-end" style="width:100%">
                                <button id="unclaimedBtn" class="btn btn-info" type="submit">Export File <i class="fa fa-download ml-1"></i></button>
                            </div>
                            <table id="tbl_unclaimed" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>DATE</th>
                                        <th>ORDER</th>
                                        <th>SERVICE</th>
                                        <th>DELIVERY</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>DATE</th>
                                        <th>ORDER</th>
                                        <th>SERVICE</th>
                                        <th>DELIVERY</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane container fade" id="claimedOrders">
                        <div class="container-fluid mt-3">
                            <div class="mb-2 d-flex justify-content-end" style="width:100%">
                                <button id="claimedBtn" class="btn btn-info" type="submit">Export File <i class="fa fa-download"></i></button>
                            </div>
                            <table id="tbl_claimed" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>DATE</th>
                                        <th>ORDER</th>
                                        <th>SERVICE</th>
                                        <th>DELIVERY</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>DATE</th>
                                        <th>ORDER</th>
                                        <th>SERVICE</th>
                                        <th>DELIVERY</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane container fade" id="deletedOrders">
                        <div class="container-fluid mt-3">
                            <div class="mb-2 d-flex justify-content-end" style="width:100%">
                                <button id="deletedBtn" class="btn btn-info">Export File <i class="fa fa-download" type="submit"></i></button>
                            </div>
                            <table id="tbl_deleted" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>DATE</th>
                                        <th>ORDER</th>
                                        <th>SERVICE</th>
                                        <th>ACTION</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>DATE</th>
                                        <th>ORDER</th>
                                        <th>SERVICE</th>
                                        <th>ACTION</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    $(document).ready(function () {

        $('#tbl_unclaimed').DataTable({
            "ajax": {
                url: "<?php echo base_url(); ?>fetchunclaimed",
                type: 'GET'
            }
        });

        $('#tbl_claimed').DataTable({
            "ajax": {
                url: "<?php echo base_url(); ?>fetchclaimed",
                type: 'GET'
            }
        });
        $('#tbl_deleted').DataTable({
            "ajax": {
                url: "<?php echo base_url(); ?>fetchdeleted",
                type: 'GET'
            }
        });
        /*Export Unclaimed Function*/
        $(document).on('click', '#unclaimedBtn', function () {
            window.location.href = "<?php echo base_url(); ?>exportunclaimed";
        });

        /*Export Claimed Function*/
        $(document).on('click', '#claimedBtn', function () {
            window.location.href = "<?php echo base_url(); ?>exportclaimed";
        });

        /*Export Deleted Function*/
        $(document).on('click', '#deletedBtn', function () {
            window.location.href = "<?php echo base_url();  ?>exportdeleted";
        });

        /*Delete Customer Function*/
        $(document).on('click', '.restoreBtn', function () {
            var ord_id = $(this).attr("id");
            var tbl_deleted = $('#tbl_deleted').DataTable();
            if (confirm("Restore this order?"))
            {
                $.ajax({
                    url: "<?php echo base_url(); ?>restoreorder",
                    method: "POST",
                    data: {ord_id: ord_id},
                    success: function (data)
                    {
                        toastr.success(data);
                        tbl_deleted.ajax.reload();
                    }
                });
            } else
            {
                return false;
            }
        });
         /*Add Admin Function*/
        $(document).on('submit', '#user_form', function (event) {
            event.preventDefault();
            var usr_fname = $('#usr_fname').val();
            var usr_lname = $('#usr_lname').val();
            var usr_email = $('#usr_email').val();
            var usr_phone = $('#usr_phone').val();
            var usr_region = $('#usr_region').val();
            var usr_constituency = $('#usr_constituency').val();
            var usr_chiefdom = $('#usr_chiefdom').val();
            var usr_near_facility = $('#usr_near_facility').val();
            if (usr_fname != '' && usr_lname != '' && usr_email != '' && usr_phone != '' && usr_region != '' && usr_constituency != '' && usr_chiefdom != '' && usr_near_facility != '')
            {
                $.ajax({
                    url: '<?php echo base_url(); ?>addadmin',
                    type: 'POST',
                    data: {usr_fname: usr_fname, usr_lname: usr_lname, usr_email: usr_email, usr_phone: usr_phone, usr_region: usr_region, usr_constituency: usr_constituency, usr_chiefdom: usr_chiefdom, usr_near_facility: usr_near_facility},
                    error: function (data) {
                        toastr.success(data);
                    },
                    success: function (data) {
                        toastr.success(data);
                        $('#user_form')[0].reset();
                        $('#addAdmin_Modal').modal('hide');
//                        dataTable.ajax.reload();
                    }
                });
            } else
            {
                toastr.error("All Fields are Required");
            }
        });
    });
</script>