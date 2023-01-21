<div id="editOrder_Modal" role="dialog" tabindex="-1" class="modal fade">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document"> 
        <div class="modal-content">
            <form method="post" id="ordUpdateForm"> 
                <div class="modal-header">
                    <h4 class="modal-title">Edit Order</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group"><label>Order List*</label><textarea id="ord_list" name="ord_list" type="text" class="form-control" rows="8"></textarea></div>
                            <div class="form-group"><label>Order Destination*</label><input id="ord_destination" name="ord_destination" type="text" class="form-control" /></div>
                            <div class="form-group">
                                <label>Status*</label>
                                <select class="dvrtom-select form-control" id="ord_status">
                                    <option value="1">Initiated</option>
                                    <option value="2">Bought</option>
                                    <option value="3">Delivered</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group"><label>Service Fee*</label><input id="ord_service_fee" name="ord_service_fee" type="number" class="form-control" /></div>
                            <div class="form-group"><label>Order Fee*</label><input id="ord_price" name="ord_price" class="form-control" type="number" /></div>
                            <div class="form-group"><label>Delivery Fee*</label><input id="ord_delivery_fee" name="ord_delivery_fee" class="form-control" type="number" /></div>
                            <div class="form-group"><label>Customer ID*</label><input id="cus_id" name="cus_id" class="form-control" type="number" disabled/></div>
                            <div class="form-group"><label>Driver ID*</label><input id="drv_id" name="drv_id" class="form-control" type="text" disabled/></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="ord_id" id="ord_id" />  
                    <input type="submit" name="ordUpdate" id="ordUpdate" class="btn btn-info" value="Edit" />  
                    <button class="btn btn-danger" type="button" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>