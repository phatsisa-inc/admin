<section class="mt-2">
    <div class="container-fluid">
        <p><a href="">Dashboard </a> / Order</p>
        <div class="row">
            <div class="col-2 p-0 border-right border-top">
                <p class="mb-0 bg-light p-2 rounded">
                    <b>Order <i class="fa fas-arrow"></i></b>
                </p>
                <button class="btn btn-primary rounded-0 btn-block mt-2" data-toggle="modal" data-target="#addOrder_Modal" type="button">
                    <i class="fa fa-plus mr-2"></i> Add Order
                </button>
            </div>
            <div class="col-10">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#home">New Order List</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#menu1">Attended Order Lists</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane container active" id="home">
                        <div class="container-fluid mt-3">
                            <div class="row">
                                <div class="col-12">
                                    <table id="tbl_newOrders" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>DATE</th>
                                                <th>STATUS</th>
                                                <th>ASSIGN DRIVER</th>
                                                <th>ACTION</th>
                                            </tr>
                                        </thead>
                                        <tbody id="newOrders">
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>ID</th>
                                                <th>DATE</th>
                                                <th>STATUS</th>
                                                <th>ASSIGN DRIVER</th>
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
                                    <table id="attendedOrders" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>DATE</th>
                                                <th>ORDER FEE</th>
                                                <th>DELIVERY FEE</th>
                                                <th>ACTIONS</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>ID</th>
                                                <th>DATE</th>
                                                <th>ORDER FEE</th>
                                                <th>DELIVERY FEE</th>
                                                <th>ACTIONS</th>
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
<div id="assignDriver_Modal" role="dialog" tabindex="-1" class="modal fade">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document"> 
        <div class="modal-content">
            <form method="post" id="ordDriver"> 
                <div class="modal-header">
                    <h4 class="modal-title">Assign Driver</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Choose Driver*</label>
                        <select class="dvrtom-select form-control" id="assign_driver">
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="order_id" id="order_id" />  
                    <input type="submit" name="assignOrder" id="assignOrder" class="btn btn-success" value="Save" />  
                    <button class="btn btn-light" type="button" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {

        $('#tbl_newOrders').DataTable({
            "ajax": {
                url: "<?php echo base_url(); ?>loadneworder",
                type: 'GET'
            }
        });

        $('#attendedOrders').DataTable({
            "ajax": {
                url: "<?php echo base_url(); ?>loadattendedorder",
                type: 'GET'
            }
        });
        $(document).on('click', '.findCustomer', function () {
            var flag = 0;

            var cus_phone = $('#cus_phone').val();

            if (cus_phone == '' || cus_phone == undefined) {
                $('#cus_phone').css('border', '1px solid red');
                flag = 1;
            }
            if (flag == 0) {
                $.ajax({
                    url: '<?php echo base_url(); ?>getcustomer',
                    type: 'POST',
                    data: {cus_phone: cus_phone},
                    success: function (data) {
                        $("#addview_customer").prepend(data);
                    }
                });
            } else {
                toastr.error('Enter customer number!');
            }
        });

        /*Add Order Function*/
        $(document).on('submit', '#order_form', function (event) {
            event.preventDefault();
            var flag = 0;
            var ord_list = $('#ord_list').val();
            var ord_destination = $('#ord_destination').val();
            var cus_id = $('#cus_id').val();
            var ord_delivery_fee = $('#ord_delivery_fee').val();
            var tbl_newOrders = ('#tbl_newOrders').DataTable();

            if (ord_list == '' || ord_list == undefined) {
                $('#ord_list').css('border', '1px solid red');
                flag = 1;
            }

            if (ord_destination == '' || ord_destination == undefined) {
                $('#ord_destination').css('border', '1px solid red');
                flag = 2;
            }

            if (ord_delivery_fee == '' || ord_delivery_fee == undefined) {
                $('#ord_delivery_fee').css('border', '1px solid red');
                flag = 3;
            }

            if (flag == 0) {
                $.ajax({
                    url: '<?php echo base_url(); ?>addorder',
                    type: 'POST',
                    data: {ord_list: ord_list, ord_destination: ord_destination, cus_id: cus_id, ord_delivery_fee: ord_delivery_fee},
                    error: function () {
                        toastr.error('Error creating an order!');
                    },
                    success: function (data) {
                        $('#addOrder_Modal').modal('hide');
                        $('#order_form')[0].reset();
                        toastr.success('Order added successfully!');
                        tbl_newOrders.ajax.reload();
                    }
                });
            } else {
                toastr.error('Fill in all required fields!');
            }
        });
        /*Fetch Order Function*/
        $(document).on('click', '.ordEdit', function () {
            event.preventDefault();
            var ord_id = $(this).attr("id");
            $.ajax({
                url: "<?php echo base_url(); ?>fetchorder",
                method: "POST",
                data: {ord_id: ord_id},
                dataType: "json",
                success: function (data)
                {
                    $('#ord_price').val(data.ord_price);
                    $('#ord_list').val(data.ord_list);
                    $('#ord_create_date').val(data.ord_create_date);
                    $('#ord_status').val(data.ord_status);
                    if (data.ord_status == 1) {
                        $('#ord_status').val('1');
                    } else if (data.ord_status == 2) {
                        $('#ord_status').val('2');
                    } else {
                        $('#ord_status').val('3');
                    }
                    $('#ord_delivery_fee').val(data.ord_delivery_fee);
                    $('#ord_destination').val(data.ord_destination);
                    $('#ord_service_fee').val(data.ord_service_fee);
                    $('#ord_id').val(data.ord_id);
                    $('#cus_id').val(data.cus_id);
                    $('#drv_id').val(data.cus_id);
                    $('#editOrder_Modal').modal('show');
                }
            });
        });
        /*Edit Order Function*/
        $(document).on('click', '#ordUpdate', function () {
            event.preventDefault();
            var ord_id = $('#ord_id').val();
            var ord_list = $('#ord_list').val();
            var ord_price = $('#ord_price').val();
            var ord_destination = $('#ord_destination').val();
            var ord_status = $('#ord_status').val();
            var ord_delivery_fee = $('#ord_delivery_fee').val();
            var ord_service_fee = $('#ord_service_fee').val();
            var cus_id = $('#cus_id').val();
            var drv_id = $('#drv_id').val();
            var tbl_newOrders = $('#tbl_newOrders').DataTable();
            $.ajax({
                url: "<?php echo base_url(); ?>editorder",
                method: "POST",
                data: {ord_id: ord_id, ord_list: ord_list, ord_price: ord_price, ord_destination: ord_destination, ord_status: ord_status, ord_delivery_fee: ord_delivery_fee, ord_service_fee: ord_service_fee, cus_id: cus_id, drv_id: drv_id},
                error: function (data) {
                    toastr.success(data);
                },
                success: function (data) {
                    toastr.success(data);
                    $('#ordUpdateForm')[0].reset();
                    $('#editOrder_Modal').modal('hide');
                    tbl_newOrders.ajax.reload();
                }
            });
        });
        /*Delete Customer Function*/
        $(document).on('click', '.ordDelete', function () {
            event.preventDefault();
            var ord_id = $(this).attr("id");
            var tbl_newOrders = $('#tbl_newOrders').DataTable();
            if (confirm("Are you sure you want to delete this?"))
            {
                $.ajax({
                    url: "<?php echo base_url(); ?>deleteorder",
                    method: "POST",
                    data: {ord_id: ord_id},
                    success: function (data)
                    {
                        toastr.success(data);
                        tbl_newOrders.ajax.reload();
                    }
                });
            } else
            {
                return false;
            }
        });
        /*View Order Function*/
        $(document).on('click', '.ordView', function () {
            event.preventDefault();
            var ord_id = $(this).attr("id");
            $('#viewOrder_Modal').modal('show');
            $.ajax({
                url: "<?php echo base_url(); ?>fetchorder",
                method: "POST",
                data: {ord_id: ord_id},
                dataType: "json",
                success: function (data)
                {
                    $('#ordr_price').val(data.ord_price);
                    $('#ordr_list').val(data.ord_list);
                    $('#ordr_create_date').val(data.ord_create_date);
                    $('#ordr_status').val(data.ord_status);
                    if (data.ord_status == 1) {
                        $('#ordr_status').val('1');
                    } else if (data.ord_status == 2) {
                        $('#ordr_status').val('2');
                    } else {
                        $('#ordr_status').val('3');
                    }
                    $('#ordr_delivery_fee').val(data.ord_delivery_fee);
                    $('#ordr_destination').val(data.ord_destination);
                    $('#ordr_service_fee').val(data.ord_service_fee);
                    $('#ordr_id').val(data.ord_id);
                    $('#cusr_id').val(data.cus_id);
                    $('#drvr_id').val(data.cus_id);
                    $('#viewOrder_Modal').modal('show');
                }
            });
        });
        /*View Attened Order Function*/
        $(document).on('click', '.ordAttendedView', function () {
            var ord_id = $(this).attr("id");
            $.ajax({
                url: "<?php echo base_url(); ?>fetchattendedorder",
                method: "POST",
                data: {ord_id: ord_id},
                dataType: "json",
                success: function (data)
                {
                    $('#ordr_price').val(data.ord_price);
                    $('#ordr_list').val(data.ord_list);
                    $('#ordr_create_date').val(data.ord_create_date);
                    $('#ordr_status').val(data.ord_status);
                    if (data.ord_status == 1) {
                        $('#ordr_status').val('1');
                    } else if (data.ord_status == 2) {
                        $('#ordr_status').val('2');
                    } else {
                        $('#ordr_status').val('3');
                    }
                    $('#ordr_delivery_fee').val(data.ord_delivery_fee);
                    $('#ordr_destination').val(data.ord_destination);
                    $('#ordr_service_fee').val(data.ord_service_fee);
                    $('#ordr_id').val(data.ord_id);
                    $('#cusr_id').val(data.cus_id);
                    $('#drvr_id').val(data.cus_id);
                    $('#viewOrder_Modal').modal('show');
                }
            });
        });

        /*View Order Function*/
        $(document).on('click', '.assignBtn', function () {
            var ord_id = $(this).attr("id");
            $.ajax({
                url: "<?php echo base_url(); ?>assigndriver",
                method: "POST",
                data: {ord_id: ord_id},
                dataType: "json",
                success: function (data)
                {
                    $('#order_id').val(ord_id);
                    $('#assign_driver').prepend(data);
                    $('#assignDriver_Modal').modal('show');
                }
            });
        });
        /*Assigned Driver Function*/
        $(document).on('click', '#assignOrder', function () {
            event.preventDefault();

            var ord_id = $('#order_id').val();
            var drv_id = $('#assign_driver').val();

            $.ajax({
                url: "<?php echo base_url(); ?>orderdriver",
                method: "POST",
                data: {ord_id: ord_id, drv_id: drv_id},
                error: function (data) {
                    toastr.success(data);
                },
                success: function (data) {
                    toastr.success(data);
                    $('#ordDriver')[0].reset();
                    $('#assignDriver_Modal').modal('hide');
                    dataTable.ajax.reload();
                }
            });
        });
    });
</script>

