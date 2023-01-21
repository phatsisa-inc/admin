<section class="mt-2">
    <div class="container-fluid">
        <div class="row">
            <div class="col-2 p-0 border-right border-top">
                <p class="mb-0 bg-light p-2 rounded">
                    <b><i class="fa fa-home"></i> Dashboard</b>
                </p>
            </div>
            <div class="col-10">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-4">
                            <div class="card bg-warning rounded-0">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-6 d-md-flex justify-content-md-center align-items-md-center"><img src="<?php echo base_url('images/img-customers-sm.png'); ?>" /></div>
                                        <div class="col-6">
                                            <h3><?=$num_customers?></h3>
                                        </div>
                                        <div class="col-12">
                                            <p class="text-center mt-2 mb-0"><b>Customers</b></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="card bg-danger rounded-0">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-6 d-md-flex justify-content-md-center align-items-md-center"><img src="<?php echo base_url('images/img-orders-sm.png'); ?>" /></div>
                                        <div class="col-6">
                                            <h3><?=$num_orders?></h3>
                                        </div>
                                        <div class="col-12">
                                            <p class="text-center mt-2 mb-0"><b>Orders</b></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="card bg-primary rounded-0">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-6 d-md-flex justify-content-md-center align-items-md-center"><img src="<?php echo base_url('images/img-drivers-sm.png'); ?>" /></div>
                                        <div class="col-6">
                                            <h3><?=$num_drivers?></h3>
                                        </div>
                                        <div class="col-12">
                                            <p class="text-center mt-2 mb-0"><b>Drivers</b></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-6 mt-2">
                            </div>
                            <div class="col-6 mt-2">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

