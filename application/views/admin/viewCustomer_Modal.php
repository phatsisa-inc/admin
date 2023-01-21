<div id="viewCustomer_Modal" role="dialog" tabindex="-1" class="modal fade">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document"> 
        <div class="modal-content">
            <form method="post"> 
                <div class="modal-header">
                    <h4 class="modal-title">Customer View</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group"><label>Firstname*</label><input id="fname" name="fname" type="text" class="form-control"/></div>
                            <div class="form-group"><label>Lastname*</label><input id="lname" name="lname" type="text" class="form-control" /></div>
                            <div class="form-group"><label>Email*</label><input id="email" name="email" type="email" class="form-control" /></div>
                            <div class="form-group"><label>Phone number*</label><input id="phone" name="phone" class="form-control" type="number" /></div>
                            <div class="form-group">
                                <label>Status*</label>
                                <input id="status" name="status" class="form-control" type="text" />
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Password*</label>
                                <input id="password" name="password" type="text" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label for="user_region">Region*</label>
                                <input id="region" name="region" type="text" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label for="constituency">Constituency*</label>
                                <input id="constituency" name="constituency" type="text" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label for="chiefdom">Chiefdom*</label>
                                <input id="chiefdom" name="chiefdom" type="text" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label for="near_facility">Near Facility*</label>
                                <input id="near_facility" name="near_facility" class="form-control"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" type="button" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>