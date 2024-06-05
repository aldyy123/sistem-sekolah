<div class="modal fade" id="modal-edit-batch" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white">Edit Batch</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>

            <form method="POST" action="{{ route('admin.batchs.update') }}">
                @method('PATCH')
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <input type="text" hidden="true" name="batch_id" id="batch_id">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Year</label>
                                <input type="year" class="form-control text-dark" id="year" name="year">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Kloter</label>
                                <input type="number" class="form-control text-dark" id="cloter" name="cloter">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Start Periode</label>
                                <input type="month" class="form-control text-dark" id="start_periode"
                                    name="start_periode">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>End Periode</label>
                                <input type="month" class="form-control text-dark" id="end_periode"
                                    name="end_periode">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Status</label>
                                <select class="custom-select" id="status" name="status"
                                    aria-label="Default select example">
                                    <option selected>Select Status</option>
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
