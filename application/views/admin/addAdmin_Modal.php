<div id="addAdmin_Modal" role="dialog" tabindex="-1" class="modal fade">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document"> 
        <div class="modal-content">
            <form method="post" id="user_form"> 
                <div class="modal-header">
                    <h4 class="modal-title">Add Admin</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body"><div class="row">
                        <div class="col-6">
                            <div class="form-group"><label>Firstname*</label><input id="usr_fname" name="usr_fname" type="text" class="form-control"/></div>
                            <div class="form-group"><label>Lastname*</label><input id="usr_lname" name="usr_lname" type="text" class="form-control"/></div>
                            <div class="form-group"><label>Email*</label><input id="usr_email" name="usr_email" type="email" class="form-control"/></div>
                            <div class="form-group"><label>Phone number*</label><input id="usr_phone" name="usr_phone" class="form-control" type="number"/></div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="usr_region">Region*</label>
                                <select id="usr_region" class="form-control">
                                    <option value="1" selected="">Select Region</option>
                                    <option value="Manzini">Manzini</option>
                                    <option value="Hhohho">Hhohho</option>
                                    <option value="Lubombo">Lubombo</option>
                                    <option value="Shiselweni">Shiselweni</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="usr_constituency">Constituency*</label>
                                <select class="form-control" id="usr_constituency">
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="usr_chiefdom">Chiefdom*</label>
                                <input id="usr_chiefdom" name="usr_chiefdom" class="form-control"/>
                            </div>
                            <div class="form-group">
                                <label for="usr_near_facility">Near Facility*</label>
                                <input id="usr_near_facility" name="usr_near_facility" class="form-control"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer"> 
                    <input type="submit" name="action" id="action" class="btn btn-success" value="Add" />  
                    <button class="btn btn-light" type="button" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).on('change', '#usr_region', function () {
        const reg_manzini = ['Kukhanyeni', 'Mtfongwaneni', 'Mahlangatja', 'Mangcongco', 'Ludzeludze', 'Emkhiweni', 'Lobamba Lomdzala', 'Ntondozi', 'Lamgabhi', 'Mafutseni', 'Nhlambeni', 'Ngwempisi', 'Mhlambanyatsi', 'Manzini North', 'Manzini South', 'Kwaluseni'];
        const reg_hhohho = ['Sithobela', 'Mpholonjeni', 'Siphofaneni', 'Nkilongo', 'Matsanjeni North', 'Dvokodvweni', 'Lubuli', 'Hlane', 'Lomahasha', 'Mhlume', 'Lugongolweni'];
        const reg_lubombo = ['Timphisini', 'Ndzingeni', 'Mhlangatane', 'Ntfonjeni', 'Pigg’s Peak', 'Madlangampisi', 'Lobamba', 'Mbabane West', 'Mbabane East', 'Hhukwini', 'Maphalaleni', 'Motshane', 'Nkhaba', 'Mayiwane'];
        const reg_shiselweni = ['Sigwe', 'Ngudzeni', 'Khubuta', 'Mtsambama', 'Gege', 'Shiselweni II', 'Sandleni', 'Hosea', 'Zombodze', 'Shiselweni I', 'Nkwene', 'Maseyisini', 'Matsanjeni', 'Somntongo'];

        if ($('#usr_region').val() === 'Manzini') {
            $('#usr_constituency').empty();
            for (var index = 0; index < reg_manzini.length; index++) {
                $('#usr_constituency').append('<option value="' + reg_manzini[index] + '">' + reg_manzini[index] + '</option>');
            }
        } else if ($('#usr_region').val() === 'Hhohho') {
            $('#usr_constituency').empty();
            for (var index = 0; index < reg_hhohho.length; index++) {
                $('#usr_constituency').append('<option value="' + reg_hhohho[index] + '">' + reg_hhohho[index] + '</option>');
            }
        } else if ($('#usr_region').val() === 'Lubombo') {
            $('#usr_constituency').empty();
            for (var index = 0; index < reg_lubombo.length; index++) {
                $('#usr_constituency').append('<option value="' + reg_lubombo[index] + '">' + reg_lubombo[index] + '</option>');
            }
        } else if ($('#usr_region').val() === 'Shiselweni') {
            $('#usr_constituency').empty();
            for (var index = 0; index < reg_shiselweni.length; index++) {
                $('#usr_constituency').append('<option value="' + reg_shiselweni[index] + '">' + reg_shiselweni[index] + '</option>');
            }
        }
    });
</script>
