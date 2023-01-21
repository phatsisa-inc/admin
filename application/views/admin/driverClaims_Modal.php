<div id="driverClaims_Modal" role="dialog" tabindex="-1" class="modal fade">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document"> 
        <div class="modal-content">
            <form id="claims" method="post"> 
            </form>
        </div>
    </div>
</div>
<script>
    /*Claim Orders Function*/
    $(document).on('click', '.claimBtn', function () {
        event.preventDefault();
        var user_id = $(this).attr("id");
        var tdfee = $('#totalDFee').val();
        if (tdfee != 0) {
            $.ajax({
                url: "<?php echo base_url(); ?>claimorders",
                method: "POST",
                data: {user_id: user_id, tdfee: tdfee},
                error: function (data) {
                    toastr.error(data);
                },
                success: function (data) {
                    toastr.success(data);
                    $('#claims')[0].reset();
                    $('#driverClaims_Modal').modal('hide');
                }
            });
        } else {
            toastr.error('Empty Claims!');
            $('#claims')[0].reset();
            $('#driverClaims_Modal').modal('hide');
        }
    });
</script>