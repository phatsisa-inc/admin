<div id="editDriver_Modal" role="dialog" tabindex="-1" class="modal fade">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document"> 
        <div class="modal-content">
            <form method="post" id="dvrUpdateForm"> 
                <div class="modal-header">
                    <h4 class="modal-title">Edit Driver</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group"><label>Firstname*</label><input id="user_fname" name="user_fname" type="text" class="form-control"/></div>
                            <div class="form-group"><label>Lastname*</label><input id="user_lname" name="user_lname" type="text" class="form-control" /></div>
                            <div class="form-group"><label>Email*</label><input id="user_email" name="user_email" type="email" class="form-control" /></div>
                            <div class="form-group"><label>Phone number*</label><input id="user_phone" name="user_phone" class="form-control" type="number" /></div>
                            <div class="form-group">
                                <label>Status*</label>
                                <select class="dvrtom-select form-control" id="user_status">
                                    <option value="1">Active</option>
                                    <option value="0">Deactivated</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group"><label>Password*</label><input id="user_password" name="user_password" type="password" class="form-control" /></div>
                            <div class="form-group">
                                <label for="user_region">Region*</label>
                                <input id="user_region" name="user_region" type="text" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label for="user_constituency">Constituency*</label>
                                <input id="user_constituency" name="user_constituency" type="text" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label for="user_chiefdom">Chiefdom*</label>
                                <input id="user_chiefdom" name="user_chiefdom" type="text" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label for="user_near_facility">Near Facility*</label>
                                <input id="user_near_facility" name="user_near_facility" class="form-control"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="user_id" id="user_id" />  
                    <input type="submit" name="dvrUpdate" id="dvrUpdate" class="btn btn-info" value="Edit" />  
                    <button class="btn btn-danger" type="button" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>