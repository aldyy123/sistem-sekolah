@php
    $kelas = [
        'I' => 'I',
        'II' => 'II',
        'III' => 'III',
        'IV' => 'IV',
        'V' => 'V',
        'VI' => 'VI',

        'VII' => 'VII',
        'VIII' => 'VIII',
        'IX' => 'IX',

        'X' => 'X',
        'XI' => 'XI',
        'XII' => 'XII',
    ]
@endphp
<div class="modal fade" id="modal-edit-account" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white">Edit Akun</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="resetValue()">
                    <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="idAccount">
                <div class="alert alert-success" id="update-alert" role="alert" style="display: none;">
                    Akun berhasil diedit!.
                </div>
                <div onclick="$(`#update-alert`).hide('fast');">
                    <div class="form-group">
                        <label for="name" class="col-form-label">Nama</label>
                        <input type="text" class="form-control text-dark" name="editName" id="name">
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-form-label">Email</label>
                        <input type="email" class="form-control text-dark" name="editEmail" id="email">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Status</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="editStatus" id="editStatusActive"
                                value="1">
                            <label class="form-check-label" for="editStatusActive">
                                Aktif
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="editStatus" id="editStatusNonActive"
                                value="0">
                            <label class="form-check-label" for="editStatusNonActive">
                                Non-Aktif
                            </label>
                        </div>
                    </div>
                    @if (request()->route('role') === 'STUDENT')
                        <div class="form-group">
                            <label for="editNis" class="col-form-label">NIS</label>
                            <input type="number" class="form-control text-dark" name="editNis" id="editNis">
                        </div>
                        <div class="form-group">
                            <label for="editKelas" class="col-form-label">Kelas</label>
                            <select name="editKelas" class="form-control show-tick text-dark" id="editKelas">
                                @foreach ($kelas as $degree)
                                <option value="{{ $degree }}">{{ $degree }}</option>
                            @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="editDegree" class="col-form-label">Pendidikan Terakhir</label>
                            <select name="editDegree" class="form-control show-tick text-dark" id="editDegree">
                                @foreach ($degrees as $degree)
                                    <option value="{{ $degree }}">{{ $degree }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="editBatch" class="col-form-label">Batch</label>
                            <select name="editBatch" class="form-control show-tick text-dark" id="editBatch">
                            </select>
                        </div>
                    @endif
                    @if (request()->route('role') === 'TEACHER')
                        <div class="form-group">
                            <label for="editNip" class="col-form-label">NIP</label>
                            <input type="number" class="form-control text-dark" name="editNip" id="editNip">
                        </div>
                        <div class="form-group">
                            <label for="editDegree" class="col-form-label">Pendidikan Terakhir</label>
                            <select name="editDegree" class="form-control show-tick text-dark" id="editDegree">
                                @foreach ($degrees as $degree)
                                    <option value="{{ $degree }}">{{ $degree }}</option>
                                @endforeach
                            </select>
                        </div>
                    @endif
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="update-button"
                    onclick="updateAccount()">Simpan</button>
            </div>
        </div>
    </div>
</div>
</div>
