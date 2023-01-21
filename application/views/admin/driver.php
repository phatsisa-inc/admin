<section class="mt-2 mb-2">
    <div class="container-fluid">
        <p><a href="">Dashboard </a> / Driver</p>
        <div class="row">
            <div class="col-2 p-0 border-right border-top">
                <p class="mb-0 bg-light p-2 rounded">
                    <b>Driver <i class="fa fas-arrow"></i></b>
                </p>
                <button class="btn btn-primary rounded-0 btn-block mt-2" data-toggle="modal" data-target="#addDriver_Modal" type="button"><i class="fa fa-plus mr-1"></i> Add Driver</button>
            </div>
            <div class="col-10">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#home">Driver List</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#menu1">Driver Claims</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane container active" id="home">
                        <div class="container-fluid mt-3">
                            <div class="row">
                                <div class="col-12">
                                    <table id="tbl_drivers" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>NAME</th>
                                                <th>CONTACTS</th>
                                                <th>STATUS</th>
                                                <th>ACTION</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>ID</th>
                                                <th>NAME</th>
                                                <th>CONTACTS</th>
                                                <th>STATUS</th>
                                                <th>ACTION</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane container fade" id="menu1">
                        <div class="container-fluid mt-3">
                            <div class="row">
                                <div class="col-12">
                                    <table id="tbl_driverClaims" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>NAME</th>
                                                <th>CONTACTS</th>
                                                <th>STATUS</th>
                                                <th>ACTION</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>ID</th>
                                                <th>NAME</th>
                                                <th>CONTACTS</th>
                                                <th>STATUS</th>
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
        </div>
    </div>
</section>
<script>
    $(document).ready(function () {

        $('#tbl_drivers').DataTable({
            "ajax": {
                url: "<?php echo base_url(); ?>getdrivers",
                type: 'GET'
            }
        });
        $('#tbl_driverClaims').DataTable({
            "ajax": {
                url: "<?php echo base_url(); ?>getdriverclaims",
                type: 'GET'
            }
        });
        /*Add Driver Function*/
        $(document).on('submit', '#driver_form', function (event) {
            event.preventDefault();
            var usr_fname = $('#usr_fname').val();
            var usr_lname = $('#usr_lname').val();
            var usr_email = $('#usr_email').val();
            var usr_phone = $('#usr_phone').val();
            var usr_region = $('#usr_region').val();
            var usr_constituency = $('#usr_constituency').val();
            var usr_chiefdom = $('#usr_chiefdom').val();
            var usr_near_facility = $('#usr_near_facility').val();
            var tbl_drivers = $('#tbl_drivers').DataTable();
            if (usr_fname != '' && usr_lname != '' && usr_email != '' && usr_phone != '' && usr_region != '' && usr_constituency != '' && usr_chiefdom != '' && usr_near_facility != '')
            {
                $.ajax({
                    url: '<?php echo base_url(); ?>adddriver',
                    type: 'POST',
                    data: {usr_fname: usr_fname, usr_lname: usr_lname, usr_email: usr_email, usr_phone: usr_phone, usr_region: usr_region, usr_constituency: usr_constituency, usr_chiefdom: usr_chiefdom, usr_near_facility: usr_near_facility},
                    error: function (data) {
                        toastr.success(data);
                    },
                    success: function (data) {
                        toastr.success(data);
                        $('#driver_form')[0].reset();
                        $('#addDriver_Modal').modal('hide');
                        tbl_drivers.ajax.reload();
                    }
                });
            } else
            {
                toastr.error("All Fields are Required");
            }
        });
        /*Fetch Driver Function*/
        $(document).on('click', '.dvrEdit', function () {
            var user_id = $(this).attr("id");
            $.ajax({
                url: "<?php echo base_url(); ?>fetchdriver",
                method: "POST",
                data: {user_id: user_id},
                dataType: "json",
                success: function (data)
                {
                    $('#user_fname').val(data.usr_fname);
                    $('#user_lname').val(data.usr_lname);
                    $('#user_email').val(data.usr_email);
                    $('#user_phone').val(data.usr_phone);
                    if (data.usr_status == 1) {
                        $('#user_status').val('1');
                    } else {
                        $('#user_status').val('0');
                    }
                    $('#user_password').val(data.usr_password);
                    $('#user_id').val(data.usr_id);
                    $('#user_region').val(data.usr_region);
                    $('#user_constituency').val(data.usr_constituency);
                    $('#user_chiefdom').val(data.usr_chiefdom);
                    $('#user_near_facility').val(data.usr_near_facility);
                    $('#editDriver_Modal').modal('show');
                }
            });
        });
        /*Edit Driver Function*/
        $(document).on('click', '#dvrUpdate', function () {
            event.preventDefault();
            var user_id = $('#user_id').val();
            var user_fname = $('#user_fname').val();
            var user_lname = $('#user_lname').val();
            var user_email = $('#user_email').val();
            var user_phone = $('#user_phone').val();
            var user_status = $('#user_status').val();
            var user_password = $('#user_password').val();
            var user_region = $('#user_region').val();
            var user_constituency = $('#user_constituency').val();
            var user_chiefdom = $('#user_chiefdom').val();
            var user_near_facility = $('#user_near_facility').val();
            var tbl_drivers = $('#tbl_drivers').DataTable();
            $.ajax({
                url: "<?php echo base_url(); ?>editdriver",
                method: "POST",
                data: {user_id: user_id, user_fname: user_fname, user_lname: user_lname, user_email: user_email, user_phone: user_phone, user_status: user_status, user_password: user_password, user_region: user_region, user_constituency: user_constituency, user_chiefdom: user_chiefdom, user_near_facility: user_near_facility},
                error: function (data) {
                    toastr.success(data);
                },
                success: function (data) {
                    toastr.success(data);
                    $('#dvrUpdateForm')[0].reset();
                    $('#editDriver_Modal').modal('hide');
                    tbl_drivers.ajax.reload();
                }
            });
        });
        /*Delete Driver Function*/
        $(document).on('click', '.dvrDelete', function () {
            event.preventDefault();
            var user_id = $(this).attr("id");
            var tbl_drivers = $('#tbl_drivers').DataTable();
            if (confirm("Are you sure you want to delete this?"))
            {
                $.ajax({
                    url: "<?php echo base_url(); ?>deletedriver",
                    method: "POST",
                    data: {user_id: user_id},
                    success: function (data)
                    {
                        toastr.success(data);
                        tbl_drivers.ajax.reload();
                    }
                });
            } else
            {
                return false;
            }
        });
        /*View Driver Function*/
        $(document).on('click', '.dvrView', function () {
            var user_id = $(this).attr("id");
            $.ajax({
                url: "<?php echo base_url(); ?>fetchdriver",
                method: "POST",
                data: {user_id: user_id},
                dataType: "json",
                success: function (data)
                {
                    $('#fname').val(data.usr_fname);
                    $('#lname').val(data.usr_lname);
                    $('#email').val(data.usr_email);
                    $('#phone').val(data.usr_phone);
                    if (data.usr_status == 1) {
                        $('#status').val('Active');
                    } else {
                        $('#status').val('Deactivated');
                    }
                    $('#password').val(data.usr_password);
                    $('#region').val(data.usr_region);
                    $('#constituency').val(data.usr_constituency);
                    $('#chiefdom').val(data.usr_chiefdom);
                    $('#near_facility').val(data.usr_near_facility);
                    $('#viewDriver_Modal').modal('show');
                }
            });
        });
        /*View Email Function*/
        $(document).on('click', '.viewEmail', function () {
            event.preventDefault();
            $('.modal-title').text('Driver Email');
            $('.show_email').text($(this).attr("id"));
            $('#viewEmail_Modal').modal('show');
        });
        /*View Phone Function*/
        $(document).on('click', '.viewPhone', function () {
            event.preventDefault();
            $('.modal-title').text('Driver Phone');
            $('.show_phone').text('+268 ' + $(this).attr("id"));
            $('#viewPhone_Modal').modal('show');
        });
        /*View Claims Modal Function*/
        $(document).on('click', '.viewClaims', function () {
            event.preventDefault();
            var drv_id = $(this).attr("id");
            $.ajax({
                url: "<?php echo base_url(); ?>fetchdriverclaims",
                type: 'POST',
                data: {drv_id: drv_id},
                error: function (data) {
                    toastr.error(data);
                },
                success: function (data) {
                    $('#claims').html(data);
                    $('#driverClaims_Modal').modal('show');
                }
            });
        });
    });
</script>
