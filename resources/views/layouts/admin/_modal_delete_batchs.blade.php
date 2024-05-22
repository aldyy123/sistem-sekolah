<div class="modal fade" id="modal-delete-batch" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white">Edit Batch</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>

            <form method="POST" action="{{ route('admin.batchs.delete') }}">
                @method('DELETE')
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <input type="text" hidden="true" name="batch_id" id="batch_id_delete">
                        <div class="col-12">
                            <p class="text-center">Are you sure you want to delete this batch?</p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>
