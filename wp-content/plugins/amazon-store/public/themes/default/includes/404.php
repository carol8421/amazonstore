<div class="modal fade" id="404">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
			<div class="modal-body">
                <h1 class="text-danger text-center">No Product Found!</h1>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<script>
(function ($) {
    $("#404").on("hidden.bs.modal", function () {
        document.location.reload();
    });
}(jQuery))
</script>