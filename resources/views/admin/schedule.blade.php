@extends('layouts.app')

@section('content')
    <div class="block-header">
        <div class="clearfix mb-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.subjects') }}">Bimble Class</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Kelola Jadwal</li>
                </ol>
            </nav>
            <h1 class="color-blue-2 font-weight-bold my-4" style="font-size: 1.8rem;">Kelola Jadwal</h1>
        </div>
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card">
                    <ul class="nav nav-tabs">
                        @foreach ($classrooms['data'] as $key => $classroom)
                            <li class="nav-item">
                                <form action="{{ route('schedule') }}" method="GET">
                                    <input name="classroom_id" type="text" hidden value="{{ $classroom['id'] }}">
                                    <button
                                        class="nav-link tab-item {{ $classroom['id'] === $query ? ' active show' : '' }}">{{ $classroom['code'] }}</button>
                                </form>
                            </li>
                        @endforeach

                        <li class="nav-item">
                            <a class="nav-link tab-nav" data-toggle="tab" href="#addJadwal">
                                Tambah Jadwal
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content mt-3">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @foreach ($classrooms['data'] as $key => $classroom)
                            <div class="tab-pane {{ $classroom['code'] === 'I' ? 'show active' : '' }}" id="jadwal-k{{ $classroom['code'] }}">
                                <x-panel-schedule :user="$user" :schedules="$schedulesArray" />
                            </div>
                        @endforeach

                        <div class="tab-pane" id="addJadwal">
                            <div id="error-header" class="alert" role="alert"></div>
                            <div id="success-header" class="alert" role="alert"></div>
                            <div class="body mt-2">

                                <form id="form-schedule">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Jam mulai</label>
                                                <input type="time" id="start_time" name="time_start"
                                                    value="{{ old('start_time') }}" class="form-control text-dark"
                                                    name="start_periode">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Jam akhir</label>
                                                <input type="time" id="end_time" name="time_end"
                                                    value="{{ old('end_time') }}" class="form-control text-dark"
                                                    name="end_periode">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Mapel</label>
                                                <select class="custom-select" id="mapel" value="{{ old('mapel') }}"
                                                    name="mapel">
                                                    <option disabled>Select Mapel</option>
                                                    @foreach ($mapel['data'] as $subject)
                                                        <option value="{{ $subject['id'] }}">{{ $subject['name'] }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Hari</label>
                                                <select class="custom-select" id="days" value="{{ old('days') }}"
                                                    name="days">
                                                    <option disabled>Select Days</option>
                                                    <option value="Senin">Senin</option>
                                                    <option value="Selasa">Selasa</option>
                                                    <option value="Rabu">Rabu</option>
                                                    <option value="Kamis">Kamis</option>
                                                    <option value="Jumat">Jumat</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Kelas</label>
                                                <select class="custom-select" id="classroom" value="{{ old('classroom') }}"
                                                    name="classroom" aria-label="Default select example">
                                                    <option disabled>Select Kelas</option>
                                                    @foreach ($classrooms['data'] as $key => $classroom)
                                                        <option value="{{ $classroom['id'] }}">
                                                            {{ $classroom['code'] }}
                                                        </option>
                                                    @endforeach
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
        $('.tab-nav').on('click', function() {
            $('.tab-item').removeClass('active show')
        })

        const renderStatus = (errors) => {
            let text = ''
            $.each(errors, (i, value) => {
                text += `<li>${value}</li>`
            })

            $('#error-header').addClass('alert-danger alert')
            $('#error-header').html(text)
        }

        const storeSchedule = () => {
            const classroomId = $('#classroom').val()
            const startTime = $('#start_time').val()
            const endTime = $('#end_time').val()
            const mapel = $('#mapel').val()
            const days = $('#days').val()

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "{!! route('admin.schedule.store') !!}",
                method: 'POST',
                data: {
                    classroom_id: classroomId,
                    time_start: startTime,
                    time_end: endTime,
                    subject_id: mapel,
                    days: days
                },
                success: function(response) {
                    $('#success-header').addClass('alert-success alert')
                    $('#success-header').html(`
                        <p>${response.status} with mapel ${mapel} in day ${days}</p>
                    `)
                },
                error: function(error) {
                    renderStatus(error.responseJSON.errors)
                }
            })
        }

        $('#form-schedule').on('submit', function(e) {
            e.preventDefault()
            storeSchedule()
        })
    </script>
@endsection
