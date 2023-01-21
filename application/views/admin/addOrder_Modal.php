<div id="addOrder_Modal" role="dialog" tabindex="-1" class="modal fade">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form method="post" id="order_form"> 
                <div class="modal-header">
                    <h4 class="modal-title">Add Order</h4><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <div id="action_feedback"></div>
                    <div class="input-group mb-3">
                        <input name="cus_phone" id="cus_phone" type="text" class="form-control" placeholder="Find Customer By Phone Number">
                        <div class="input-group-append">
                            <a href="#" class="btn btn-info findCustomer"><i class="fa fa-search"></i></a>
                        </div>
                    </div>
                    <div id="addview_customer"></div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-info" type="submit" >Save</button>
                    <button class="btn btn-danger" type="button" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>