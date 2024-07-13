@extends('layouts.app')
@php
    $degrees = [
        'SD' => 'SD',
        'SMP' => 'SMP',
        'SMA' => 'SMA',
        'D3' => 'D3',
        'S1' => 'S1',
        'S2' => 'S2',
        'S3' => 'S3',
    ];
@endphp
@section('content')
    <div class="block-header">
        <div class="clearfix mb-3">
            {{-- if nya semnentara, nanti diganti. pokoknya ngambil role --}}
            @if (request()->route('role') === 'STUDENT')
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Bimble Class</a></li>
                        <li class="breadcrumb-item active">Kelola Akun</li>
                        <li class="breadcrumb-item active" aria-current="page">Akun Siswa</li>
                    </ol>
                </nav>
                <h1 class="color-blue-2 font-weight-bold my-4" style="font-size: 1.8rem;">Akun Siswa</h1>
            @endif
            @if (request()->route('role') === 'TEACHER')
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Bimble Class</a></li>
                        <li class="breadcrumb-item active">Kelola Akun</li>
                        <li class="breadcrumb-item active" aria-current="page">Akun Guru</li>
                    </ol>
                </nav>
                <h1 class="color-blue-2 font-weight-bold my-4" style="font-size: 1.8rem;">Akun Guru</h1>
            @endif
            @if (request()->route('role') === 'ADMIN')
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Bimble Class</a></li>
                        <li class="breadcrumb-item active">Kelola Akun</li>
                        <li class="breadcrumb-item active" aria-current="page">Akun Admin</li>
                    </ol>
                </nav>
                <h1 class="color-blue-2 font-weight-bold my-4" style="font-size: 1.8rem;">Akun Admin</h1>
            @endif
        </div>
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card">
                    <ul class="nav nav-tabs">
                        <li class="nav-item"><a class="nav-link active show" data-toggle="tab" id="index-account"
                                href="#Users">Akun</a></li>
                        <li class="nav-item"><a class="nav-link" data-toggle="tab" id="create-account"
                                href="#addUser">Tambah Akun</a></li>
                    </ul>
                    <div class="tab-content mt-0">
                        <div class="tab-pane show active" id="Users">
                            <div class="row my-3">
                                {{-- <div class="col-lg-8 col-md-12 col-sm-12">
                                    @if (request()->route('role') === 'STUDENT')
                                        <a class="btn btn-primary" href="{{ url('/export-excel-student') }}" target="_blank"
                                            rel="noopener noreferrer"><i class="icon-arrow-down mr-2"></i>Export Akun</a>
                                    @elseif(request()->route('role') === 'TEACHER')
                                        <a class="btn btn-primary" href="{{ url('/export-excel-teacher') }}" target="_blank"
                                            rel="noopener noreferrer"><i class="icon-arrow-down mr-2"></i>Export Akun</a>
                                    @endif
                                </div> --}}
                                <div class="col-lg-4 col-md-12 col-sm-12">
                                    <div class="input-group">
                                        <input type="search" class="form-control bg-white rounded text-dark"
                                            placeholder="Search" aria-label="Search" aria-describedby="search-addon"
                                            onkeyup="searchAccount(event)" onkeydown="searchAccount(event)"
                                            onchange="searchAccount(event)" />
                                        <button type="button" class="btn btn-outline-primary"><i
                                                class="icon-magnifier"></i></button>
                                    </div>
                                </div>
                            </div>
                            @include('admin.statistik._table')
                        </div>
                        <div class="tab-pane" id="addUser">
                            {{-- <div class="d-flex justify-content-between my-3">
                                <div></div>
                                @if (request()->route('role') === 'STUDENT' || request()->route('role') === 'TEACHER')
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#modal-import-account"><i class="icon-arrow-down mr-2"></i>Import
                                        Akun</button>
                                @endif
                            </div> --}}
                            @if (request()->route('role') === 'STUDENT')
                                @include('admin.statistik.forms.students')
                            @elseif(request()->route('role') === 'TEACHER')
                                @include('admin.statistik.forms.teachers')
                            @else
                                @include('admin.statistik._form')
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @csrf
        @include('layouts.admin._modal_import_account')
        @include('layouts.admin._modal_edit_account')
    </div>
@endsection

@section('script')
    <script src="{{ asset('assets/vendor/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/ui/dialogs.js') }}"></script>
    <script type="text/javascript">
        const role = "{{ request()->route('role') }}"
        let accounts = {}
        let batchs = {}

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(`#loading-${role}`).show('slow');
        $(`#panel-${role}`).hide('slow');
        $(`#empty-${role}`).hide('slow');
        getAccount()
        getBatchList()

        function getBatchList() {
            $.ajax({
                type: "get",
                url: "{{ url('/batchs/list') }}",
                success: function(response) {
                    batchs = response.data
                    renderBatchList(response)
                }
            });
        }

        function getAccount() {
            $.ajax({
                type: "get",
                url: "{{ url('account') }}",
                data: {
                    role
                },
                success: function(response) {
                    if (response.data.length === 0) {
                        $(`#empty-${role}`).show('fast');
                        $(`#loading-${role}`).hide('fast');
                        $(`#panel-${role}`).hide('fast');
                    } else {
                        accounts = response.data
                        renderAccount(response);
                    }
                }
            });
        }


        function renderBatchList(data) {
            let html = ``
            $.each(data.data, function(key, batch) {
                html +=
                    `<option value="${batch.id}">${batch.start_periode} - ${batch.end_periode} ${batch.year}</option>`
            });
            $(`select[name=editBatch]`).html(html);
            $(`select[name=${role}Batch_student]`).html(html);
        }

        function renderAccount(data) {

            let html = ``
            let no = 1
            $.each(data.data, function(key, account) {

                const studentData = account?.student
                const teacherData = account?.teacher
                const doubleRole = studentData || teacherData

                html += `
            <tr>
                <td class="width45">${no}</td>
                <td>
                    <h6 class="mb-0">${account.name}</h6>
                    <span>${account.email === null ? '-' : account.email}</span>
                </td>
                <td>${account.email}</td>
                ${role === 'STUDENT' && `<td>${studentData?.nis ?? '-'}</td>`}
                ${role === 'TEACHER' && `<td>${teacherData?.nip ?? '-'}</td>`}
                ${(role === 'TEACHER' || 'STUDENT' === role) && `<td>${doubleRole?.degree ?? '-'}</td>`}
                ${role === 'STUDENT' && `<td>${studentData?.classroom?.code ?? '-'}</td>`}
                <td>${account.username}</td>
                ${role === 'STUDENT' && `<td>${studentData?.batch?.start_periode ?? ''} - ${studentData?.batch?.end_periode ?? ''} ${studentData?.batch?.year ?? ''}</td>`}
                <td>${account.status === 1 ? 'Active' : 'Non Active'}</td>
                <td>
                    <button type="button" class="btn btn-sm btn-default" title="Edit" data-toggle="modal" data-target="#modal-edit-account" onclick="editAccount('${account.id}')">
                        <i class="fa fa-edit"></i>
                    </button>
                    <button type="button" class="btn btn-sm btn-primary js-sweetalert" title="Reset Password" data-type="reset-password" onclick="showResetPasswordMessage('${account.id}', '${account.username}')" title="Reset Password">
                        <i class="fa fa-lock text-white"></i>
                    </button>
                </td>
            </tr>
            `
                no++
            });

            $(`#render-accounts`).html(html);
            $(`#panel-${role}`).show('slow');
            $(`#loading-${role}`).hide('fast');
            $(`#empty-${role}`).hide('fast');
        }

        function resetValue() {
            $(`input[name=${role}Name]`).val('');
            $(`input[name=${role}Email]`).val('');
            $('input[name=editName]').val('')
            $('input[name=editEmail]').val('')
            $(`input[name=editStatus]`).prop('checked', false)
            if (role === 'STUDENT') {
                $(`input[name=${role}Nis]`).val('');
                $('input[name=editNis]').val('')
            }
        }

        function createAccount() {
            const name = $(`input[name=${role}Name]`).val();
            const email = $(`input[name=${role}Email]`).val();
            const phone = $(`input[name=${role}Phone]`).val();
            const address = $(`textarea[name=${role}Address]`).val();
            const username = $(`input[name=${role}Username]`).val();

            const data = {
                name,
                email,
                role,
                phone,
                address,
                username
            }

            if (role === 'STUDENT') {
                const nis = $(`input[name=${role}Nis]`).val();
                const grade = $(`select[name=${role}Grade]`).val();
                const lastEducation = $(`input[name=${role}Last_education]`).val();
                const degree = $(`select[name=${role}Degree]`).val();
                const batchValue = $(`select[name=${role}Batch_student]`).val()

                data['nis'] = nis
                data['grade'] = grade
                data['batch'] = batchValue
                data['degree'] = degree
                data['last_education'] = lastEducation
            }

            if(role === 'TEACHER') {
                const nip = $(`input[name=${role}Nip]`).val();
                const degree = $(`select[name=${role}Degree]`).val();
                const lastEducation = $(`input[name=${role}Last_education]`).val();

                data['nip'] = nip
                data['degree'] = degree
                data['last_education'] = lastEducation
            }

            const btnSubmit = $(`#${role}-submit`)

            $.ajax({
                type: "post",
                url: "{{ url('account') }}",
                data: data,
                beforeSend: function() {
                    btnSubmit.html('Menyimpan...')
                },
                success: function(response) {
                    btnSubmit.html('Tambah')
                    $(`#${role}-alert`).show('fast');
                    $(`#${role}-alert-danger`).hide('fast');
                    accounts.push(response)
                    // resetValue()
                    getAccount()
                },
                error: function(e) {
                    btnSubmit.html('Tambah')
                    $(`#${role}-alert`).hide('fast');
                    renderError(e.responseJSON.errors)
                }
            });
        }

        function renderError(data) {
            let html = ``
            $.each(data, function(key, value) {
                html += `<li>${value}</li>`
            });

            $(`#${role}-alert-danger`).html('');
            $(`#${role}-alert-danger`).html(`<ul>${html}</ul>`);
            $(`#${role}-alert-danger`).show('fast');
        }

        function renderErrorEdit(data) {
            let html = ``
            $.each(data, function(key, value) {
                html += `<li>${value}</li>`
            });

            $(`#edit-alert-danger`).html('');
            $(`#edit-alert-danger`).html(`<ul>${html}</ul>`);
            $(`#edit-alert-danger`).show('fast');
        }

        function editAccount(accountId) {
            let dataAccount = accounts.find(account => account.id === accountId);
            const batch = dataAccount?.student?.batch
            $('input[type=hidden][name=idAccount]').val(dataAccount.id)
            $('input[name=editName]').val(dataAccount.name)
            $('input[name=editEmail]').val(dataAccount.email)
            $(`input[name=editStatus][value=${dataAccount.status}]`).prop('checked', true)
            $(`input[name=editPhone]`).val(dataAccount.phone)

            if (role === 'STUDENT') {
                $('input[name=editNis]').val(dataAccount?.student?.nis)
                $(`select[name=editDegree] option[value=${dataAccount?.student?.degree ?? ''}]`).attr('selected',
                    'selected');
                $(`select[name=editBatch] option[value='${batch.start_periode} - ${batch.end_periode} ${batch.year}']`)
                    .attr('selected', 'selected');
                $(`select[name=editKelas] option[value=${dataAccount?.student?.classroom?.code ?? ''}]`).attr('selected',
                    'selected');
            }
            if (role === 'TEACHER') {
                $('input[name=editNip]').val(dataAccount?.teacher?.nip)
                $(`select[name=editDegree] option[value=${dataAccount?.teacher?.degree}]`).attr('selected', 'selected');
            }
        }

        function updateAccount() {
            let id = $('input[type=hidden][name=idAccount]').val()
            let name = $('input[name=editName]').val()
            let email = $('input[name=editEmail]').val()
            let status = $('input[name=editStatus]:checked').val()
            let data = {
                id,
                name,
                email,
                status,
                role
            }

            if (role === 'STUDENT') {
                let nis = $('input[name=editNis]').val()
                let grade = $('select[name=editGrade]').val()
                let degree = $('select[name=editDegree]').val()
                let batch = $('select[name=editBatch]').val()
                let kelas = $('select[name=editKelas]').val()

                data['nis'] = nis
                data['grade'] = grade
                data['degree'] = degree
                data['batch'] = batch
                data['kelas'] = kelas
            }

            if (role === 'TEACHER') {
                let nip = $('input[name=editNip]').val()
                let degree = $('select[name=editDegree]').val()

                data['nip'] = nip
                data['degree'] = degree
            }

            let button = $('#update-button')
            $.ajax({
                type: "patch",
                url: "{{ url('account') }}",
                data: data,
                beforeSend: function() {
                    button.html('Menyimpan...')
                },
                success: function(response) {
                    $(`#update-alert`).show('fast');
                    $(`#edit-alert-danger`).hide('fast');
                    $(`#global-username`).html(response.name);
                    setTimeout(function() {
                        $(`#update-alert`).hide('fast')
                        $('#modal-edit-account').modal('hide')
                    }, 1000);
                    button.html('Simpan')
                    getAccount()
                    resetValue()

                },
                error: function(e) {
                    button.html('Simpan')
                    renderErrorEdit(e.responseJSON.errors)
                    $(`#update-alert`).hide('fast');
                }
            });
        }

        function resetPassword(id, username) {
            $.ajax({
                type: "get",
                url: "{{ url('account-reset') }}",
                data: {
                    id,
                    username
                },
                success: function(response) {
                    swal("Berhasil mereset akun!");
                },
                error: function() {
                    swal("Gagal mereset akun!");
                }
            });
        }

        function searchAccount(e) {
            let value = e.currentTarget.value

            $('#render-accounts tr').each(function() {
                var found = 'false';
                $(this).each(function() {
                    if ($(this).text().toLowerCase().indexOf(value.toLowerCase()) >= 0) {
                        found = 'true';
                    }
                });
                if (found == 'true') {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        }

        $('#inputGroupFile04').on('change', (e) => {
            $('#input-excel-label').html(e.target.files[0].name);
        })
    </script>
@endsection
