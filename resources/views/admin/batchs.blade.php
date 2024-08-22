@extends('layouts.app')

@section('content')
    <div class="block-header">
        <div class="clearfix mb-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.subjects') }}">Bimble Class</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Kelola Angkatan</li>
                </ol>
            </nav>
            <h1 class="color-blue-2 font-weight-bold my-4" style="font-size: 1.8rem;">Kelola Angkatan</h1>
        </div>
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card">
                    <ul class="nav nav-tabs">
                        <li class="nav-item"><a class="nav-link active show btn-panel" data-toggle="tab"
                                href="#batch">Batch</a></li>
                        <li class="nav-item"><a class="nav-link btn-panel" data-toggle="tab" href="#addBatch">Tambah Periode
                                Angkatan</a></li>
                    </ul>
                    <div class="tab-content mt-0">

                        <div class="tab-pane show active" id="batch">

                            @if ($errors->any())
                                <div class="alert alert-danger" role="alert">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif


                            @if (session('success'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('success') }}
                                </div>
                            @endif

                            @if (session('error'))
                                <div class="alert alert-danger" role="alert">
                                    {{ session('error') }}
                                </div>
                            @endif

                            <div class="row my-3">
                                <div class="col-lg-8 col-md-12 col-sm-12"></div>
                                <div class="col-lg-4 col-md-12 col-sm-12">
                                    <div class="input-group">
                                        <input type="search" class="form-control bg-white rounded text-dark"
                                            placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
                                        <button type="button" class="btn btn-outline-primary"><i
                                                class="icon-magnifier"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover table-custom spacing8">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Status</th>
                                            <th>Year</th>
                                            <th>Periode</th>
                                            <th>Edit Batch</th>
                                            <th>Delete Batch</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($batchs['data'] as $key => $batch)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $batch['status'] }}</td>
                                                <td>{{ $batch['year'] }}</td>
                                                <td>{{ \Carbon\Carbon::parse($batch['start_periode'])->format('M') }} -
                                                    {{ \Carbon\Carbon::parse($batch['end_periode'])->format('M') }}</td>
                                                <td>
                                                    <button type="button" class="btn btn-sm btn-default" title="Edit"
                                                        data-toggle="modal"
                                                        onclick="openEditModal({{ json_encode($batch) }})">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-sm btn-default" title="Edit"
                                                        data-toggle="modal"
                                                        onclick="openDeleteModal({{ json_encode($batch) }})">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="tab-pane" id="addBatch">
                            <div class="body mt-2">
                                <div class="alert alert-danger" id="alert-danger" role="alert" style="display: none;">
                                </div>
                                <div class="alert alert-success" id="alert-success" role="alert" style="display: none;">
                                </div>

                                <form>
                                    <div class="row">
                                        {{-- <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Year</label>
                                                <input type="number" placeholder="YYYY" min="2017" max="2100" class="form-control text-dark" name="year">
                                            </div>
                                        </div> --}}
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Start Periode</label>
                                                <input type="month" value="{{ old('start_periode') }}"
                                                    class="form-control month text-dark" name="start_periode">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>End Periode</label>
                                                <input type="month" value="{{ old('end_periode') }}"
                                                    class="form-control text-dark" name="end_periode">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Kloter</label>
                                                <input type="number" value="{{ old('cloter') }}"
                                                    class="form-control text-dark" name="cloter">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Status</label>
                                                <select class="custom-select" value="{{ old('status') }}" name="status"
                                                    aria-label="Default select example">
                                                    <option selected>Select Status</option>
                                                    <option value="active">Active</option>
                                                    <option value="inactive">Inactive</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-end mt-3">
                                        <button type="submit" class="btn btn-primary">Tambah</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.admin._modal_edit_batchs')
        @include('layouts.admin._modal_delete_batchs')
    </div>
@endsection

@section('script')
    <script>
        //global variable


        let allSubjects = {!! json_encode($batchs) !!};

        $('form').submit(function(event) {
            event.preventDefault();

            const formData = new FormData(this);

            const dataStore = {
                year: formData.get('year') ?? null,
                cloter: formData.get('cloter') ?? null,
                status: formData.get('status') ?? null,
                start_periode: formData.get('start_periode') ?? null,
                end_periode: formData.get('end_periode') ?? null,
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "post",
                url: "{!! route('admin.batchs.store') !!}",
                data: dataStore,
                success: function(response) {
                    $('#alert-success').html(response.message);
                    $('#alert-success').show('fast');
                    $('#alert-danger').hide('fast');
                    setTimeout(() => {
                        location.reload();
                    }, 1000);
                },
                error: function(e) {
                    const errorsField = e.responseJSON.errors
                    const ul = document.createElement('ul');
                    for (let errors in errorsField) {
                        errorsField[errors].forEach(error => {
                            const li = document.createElement('li');
                            li.innerHTML = error;
                            ul.appendChild(li);
                        });
                    }
                    $('#alert-danger').html(ul.innerHTML);
                    $('#alert-danger').show('fast');
                    $('#alert-success').hide('fast');
                }
            });
        });


        function openEditModal(batch) {
            $('#modal-edit-batch').modal('show');
            $('#year').val(batch.year);
            $('#batch_id').val(batch.id);
            $('#year').val(batch.year);
            $('#cloter').val(batch.cloter);
            $('#status').val(batch.status);
            $('#start_periode').val(batch.start_periode);
            $('#end_periode').val(batch.end_periode);
        }

        function openDeleteModal(batch) {
            $('#modal-delete-batch').modal('show');
            $('#batch_id_delete').val(batch.id);
        }



        function reduceInput(el) {
            var teacherField = document.getElementsByClassName(el);
            if (teacherField.length > 0) {
                teacherField[teacherField.length - 1].remove();
            }
        }
    </script>
@endsection
