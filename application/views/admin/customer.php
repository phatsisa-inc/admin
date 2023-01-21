<section class="mt-2">
    <div class="container-fluid">
        <div class="container-fluid d-flex">
            <p><a href="">Dashboard </a> / Customer</p>
        </div>
        <div class="row">
            <div class="col-2 p-0 border-right border-top">
                <p class="mb-0 bg-light p-2 rounded">
                    <b>Customer <i class="fa fas-arrow"></i></b>
                </p>
                <button class="btn btn-primary rounded-0 btn-block mt-2" data-toggle="modal" data-target="#addCustomer_Modal" type="button"><i class="fa fa-plus mr-1"></i> Add Customer</button>
            </div>
            <div class="col-10">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#home">Customer List</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane container active" id="home">
                        <div class="container-fluid mt-3">
                            <div class="row">
                                <div class="col-12">
                                    <table id="tbl_customer" class="table table-striped table-bordered" style="width:100%">
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
</div>
</section>
<script>
    $(document).ready(function () {
        /*Fetch Customer Function -  DataTable*/
        $('#tbl_customer').DataTable({
            "ajax": {
                url: "<?php echo base_url(); ?>getcustomers",
                type: 'GET'
            }
        });
        /*Add Customer Function*/
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
            var tbl_customer = $('#tbl_customer').DataTable();
            if (usr_fname != '' && usr_lname != '' && usr_email != '' && usr_phone != '' && usr_region != '' && usr_constituency != '' && usr_chiefdom != '' && usr_near_facility != '')
            {
                $.ajax({
                    url: '<?php echo base_url(); ?>addcustomer',
                    type: 'POST',
                    data: {usr_fname: usr_fname, usr_lname: usr_lname, usr_email: usr_email, usr_phone: usr_phone, usr_region: usr_region, usr_constituency: usr_constituency, usr_chiefdom: usr_chiefdom, usr_near_facility: usr_near_facility},
                    error: function (data) {
                        toastr.success(data);
                    },
                    success: function (data) {
                        toastr.success(data);
                        $('#user_form')[0].reset();
                        $('#addCustomer_Modal').modal('hide');
                        tbl_customer.ajax.reload();
                    }
                });
            } else
            {
                toastr.error("All Fields are Required");
            }
        });
        /*Fetch Customer Function*/
        $(document).on('click', '.cusEdit', function () {
            var user_id = $(this).attr("id");
            $.ajax({
                url: "<?php echo base_url(); ?>fetchcustomer",
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
                    $('#user_region').val(data.usr_region);
                    $('#user_constituency').val(data.usr_constituency);
                    $('#user_chiefdom').val(data.usr_chiefdom);
                    $('#user_near_facility').val(data.usr_near_facility);
                    $('#user_id').val(data.usr_id);
                    $('#editCustomer_Modal').modal('show');
                }
            });
        });
        /*Edit Customer Function*/
        $(document).on('click', '#cusUpdate', function () {
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
            var tbl_customer = $('#tbl_customer').DataTable();
            $.ajax({
                url: "<?php echo base_url(); ?>editcustomer",
                method: "POST",
                data: {user_id: user_id, user_fname: user_fname, user_lname: user_lname, user_email: user_email, user_phone: user_phone, user_status: user_status, user_password: user_password, user_region: user_region, user_constituency: user_constituency, user_chiefdom: user_chiefdom, user_near_facility: user_near_facility},
                error: function (data) {
                    toastr.success(data);
                },
                success: function (data) {
                    toastr.success(data);
                    $('#cusUpdateForm')[0].reset();
                    $('#editCustomer_Modal').modal('hide');
                    tbl_customer.ajax.reload();
                }
            });
        });
        /*Delete Customer Function*/
        $(document).on('click', '.cusDelete', function () {
            event.preventDefault();
            var user_id = $(this).attr("id");
            var tbl_customer = $('#tbl_customer').DataTable();
            if (confirm("Are you sure you want to delete this?"))
            {
                $.ajax({
                    url: "<?php echo base_url(); ?>deletecustomer",
                    method: "POST",
                    data: {user_id: user_id},
                    success: function (data)
                    {
                        toastr.success(data);
                        tbl_customer.ajax.reload();
                    }
                });
            } else
            {
                return false;
            }
        });
        /*View Customer Function*/
        $(document).on('click', '.cusView', function () {
            var user_id = $(this).attr("id");
            $.ajax({
                url: "<?php echo base_url(); ?>fetchcustomer",
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
                    $('#viewCustomer_Modal').modal('show');
                }
            });
        });
        /*View Send Email Function*/
        $(document).on('click', '.viewEmail', function () {
            event.preventDefault();
            $('.modal-title').text('Customer Email');
            $('.show_email').text($(this).attr("id"));
            $('#viewEmail_Modal').modal('show');
        });
        /*View Phone Function*/
        $(document).on('click', '.viewPhone', function () {
            event.preventDefault();
            $('.modal-title').text('Customer Phone');
            $('.show_phone').text('+268 ' + $(this).attr("id"));
            $('#viewPhone_Modal').modal('show');
        });
    });
</script>



