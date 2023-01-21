<section class="mt-2">
    <div class="container-fluid">
        <form>
            <div class="row">
                <div class="col-xl-3 col-lg-3 col-md-3 text-center border-right">
                    <div class="card rounded-0">
                        <div class="card-body">
                            <img src="<?php echo base_url('images/img-user.png'); ?>" class="img-fluid img-circle mx-auto rounded-circle border"/>
                            <h6 id="acc_fullname" class="font-weight-bold mt-2"></h6>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckCheckedDisabled" checked disabled>
                                <label class="form-check-label" for="flexSwitchCheckCheckedDisabled">Disabled checked switch checkbox input</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-9 col-lg-9 col-md-9">
                    <div class="row">
                        <div class="col-xl-8 col-lg-8 col-md-12">
                            <div class="card rounded-0 mb-2">
                                <div class="card-body">
                                    <h6 class="font-weight-bold">Account Information</h6>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group"><label>Account Username</label><input type="text" id="acc_username" name="acc_username" class="form-control" readonly/></div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group"><label>Joined on:</label><input type="text" id="acc_create_date" name="acc_create_date" class="form-control" readonly/></div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group"><label>Account Status</label><input type="text" id="acc_status" name="acc_status" class="form-control" readonly/></div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group"><label>Account Type</label><input type="text" id="acc_type" name="acc_type" class="form-control" readonly/></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card rounded-0 mb-2">
                                <div class="card-body">
                                    <h6 class="font-weight-bold">Contact Information</h6>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group"><label>Email</label><input type="email" id="acc_email" name="acc_email" class="form-control" readonly/></div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group"><label>Phone Number</label><input type="text" id="acc_phone" name="acc_phone" class="form-control" readonly/></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card rounded-0 mb-2">
                                <div class="card-body">
                                    <h6 class="font-weight-bold">Residential Information</h6>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group"><label>Near Facility</label><input type="text" id="usr_near_facility" name="usr_near_facility" class="form-control" readonly/></div>
                                            <div class="form-group"><label>Chiefdom</label><input type="text" id="usr_chiefdom" name="usr_chiefdom" class="form-control" readonly/></div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group"><label>Constituency</label><input type="text" id="usr_constituency" name="usr_constituency" class="form-control" readonly/></div>
                                            <div class="form-group"><label>Region</label><input type="text" id="usr_region" name="usr_region" class="form-control" readonly/></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-12">
                            <div class="card rounded-0">
                                <div class="card-body">
                                    <h6 class="font-weight-bold">Reset Password</h6>
                                    <div class="row">
                                        <div class="col-lg-12 col-md-6"><div class="form-group"><label>Enter password</label><input type="password" id="password" name="password" class="form-control"/></div></div>
                                        <div class="col-lg-12 col-md-6"><div class="form-group"><label>Confirm password</label><input type="password" id="cpassword" name="cpassword" class="form-control"/></div></div>
                                        <div class="col-lg-12 col-md-6 offset-lg-0 offset-md-6"><div class="form-group"><button id="resetBtn" class="btn btn-info form-control">Reset Password</button></div></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
<script>
    $(document).ready(function () {
        $.ajax({
            url: "<?php echo base_url(); ?>fetchuser",
            method: "POST",
            dataType: "json",
            success: function (data)
            {

                $('#acc_fullname').prepend(data.usr_fname + ' ' + data.usr_lname);
                $('#acc_create_date').val(data.usr_create_date);
                $('#acc_username').val(data.usr_phone);
                if (data.usr_status == 1) {
                    $('#acc_status').val('Active');
                } else {
                    $('#acc_status').val('Deactivated');
                }

                if (data.usr_type == 3) {
                    $('#acc_type').val('Customer');
                } else if (data.usr_type == 2) {
                    $('#acc_type').val('Driver');
                } else {
                    $('#acc_type').val('Admin');
                }

                $('#acc_email').val(data.usr_email);
                $('#acc_phone').val(data.usr_phone);
                $('#usr_near_facility').val(data.usr_near_facility);
                $('#usr_chiefdom').val(data.usr_chiefdom);
                $('#usr_constituency').val(data.usr_constituency);
                $('#usr_region').val(data.usr_region);
            }
        });
        $(document).on('click', '#resetBtn', function () {
            event.preventDefault();
            var user_password = $('#password').val();
            var user_cpassword = $('#cpassword').val();
            if (user_password != '' && user_cpassword != '') {
                if (user_password === user_cpassword) {
                    $.ajax({
                        url: "<?php echo base_url(); ?>editpassword",
                        method: "POST",
                        data: {user_password: user_password},
                        error: function (data) {
                            toastr.success(data);
                        },
                        success: function (data) {
                            toastr.success(data);
                            $('#password').val(null);
                            $('#cpassword').val(null);
                        }
                    });
                } else
                {
                    toastr.error("Passwords do not match!");
                }
            } else
            {
                toastr.error("Both Fields are Required");
            }

        });
    });
</script>