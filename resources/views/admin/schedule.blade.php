@extends('layouts.app')

@section('content')
<div class="block-header">
    <div class="clearfix mb-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.subjects') }}">Learnify.id</a></li>
                <li class="breadcrumb-item active" aria-current="page">Kelola Jadwal Pelajaran</li>
            </ol>
        </nav>
        <h1 class="color-blue-2 font-weight-bold my-4" style="font-size: 1.8rem;">Kelola Jadwal Pelajaran</h1>
    </div>
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <ul class="nav nav-tabs">
                @foreach ($schedules['data'] as $key => $class)
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#addSubject">{{ $class['classroom']['code'] }}</a></li>
                @endforeach
                    <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#mapel">Mapel</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#addSubject">Tambah Mapel</a></li>

                </ul>
                <div class="tab-content mt-0">
                    <div class="tab-pane show active" id="mapel">
                        <div class="row my-3">
                            <div class="col-lg-8 col-md-12 col-sm-12"></div>
                            <div class="col-lg-4 col-md-12 col-sm-12">
                                <div class="input-group">
                                    <input type="search" class="form-control bg-white rounded text-dark" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
                                    <button type="button" class="btn btn-outline-primary"><i class="icon-magnifier"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover table-custom spacing8">
                                <thead>
                                    <tr>
                                        <th>Senin</th>
                                        <th>Selasa</th>
                                        <th>Rabu</th>
                                        <th>Kamis</th>
                                        <th>Jumat</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($schedules['data'] as $key => $schedule)

                                    <tr>
                                        @if($schedule['days'] == 'Senin')

                                        <td>
                                            <div>
                                                <div class="d-flex gap-2">
                                                    <p>{{ \Carbon\Carbon::parse($schedule['time_start'])->format('h:m') }}</p>
                                                    <p> - </p>
                                                    <p>{{ \Carbon\Carbon::parse($schedule['time_end'])->format('h:m') }}</p>
                                                </div>
                                                <div class="d-flex gap-2">
                                                    <p>{{ $schedule['subject']['name'] }}</p>
                                                    <p> - </p>
                                                    <p>{{ $schedule['classroom']['code'] }}</p>
                                                    <p>{{ $schedule['days'] }}</p>
                                                </div>
                                            </div>
                                        </td>

                                        @endif
                                        @if($schedule['days'] === 'Selasa')
                                        <td>
                                            <div>
                                                <div class="d-flex gap-2">
                                                    <p>{{ \Carbon\Carbon::parse($schedule['time_start'])->format('h:m') }}</p>
                                                    <p> - </p>
                                                    <p>{{ \Carbon\Carbon::parse($schedule['time_end'])->format('h:m') }}</p>
                                                </div>
                                                <div class="d-flex gap-2">
                                                    <p>{{ $schedule['subject']['name'] }}</p>
                                                    <p> - </p>
                                                    <p>{{ $schedule['classroom']['code'] }}</p>

                                                </div>
                                            </div>
                                        </td>
                                        @endif
                                        @if($schedule['days'] === 'Rabu')
                                        <td>
                                            <div>
                                                <div class="d-flex gap-2">
                                                    <p>{{ \Carbon\Carbon::parse($schedule['time_start'])->format('h:m') }}</p>
                                                    <p> - </p>
                                                    <p>{{ \Carbon\Carbon::parse($schedule['time_end'])->format('h:m') }}</p>
                                                </div>
                                                <div class="d-flex gap-2">
                                                    <p>{{ $schedule['subject']['name'] }}</p>
                                                    <p> - </p>
                                                    <p>{{ $schedule['classroom']['code'] }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        @endif
                                        @if($schedule['days'] === 'Kamis')
                                        <td>
                                            <div>
                                                <div class="d-flex gap-2">
                                                    <p>{{ \Carbon\Carbon::parse($schedule['time_start'])->format('h:m') }}</p>
                                                    <p> - </p>
                                                    <p>{{ \Carbon\Carbon::parse($schedule['time_end'])->format('h:m') }}</p>
                                                </div>
                                                <div class="d-flex gap-2">
                                                    {{-- <p>{{ $schedule['subject']['name'] }}</p> --}}
                                                    <p> - </p>
                                                    <p>{{ $schedule['classroom']['code'] }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        @endif
                                        @if($schedule['days'] === 'Jumat')
                                        <td>
                                            <div>
                                                <div class="d-flex gap-2">
                                                    <p>{{ \Carbon\Carbon::parse($schedule['time_start'])->format('h:m') }}</p>
                                                    <p> - </p>
                                                    <p>{{ \Carbon\Carbon::parse($schedule['time_end'])->format('h:m') }}</p>
                                                </div>
                                                <div class="d-flex gap-2">
                                                    <p>{{ $schedule['subject']['name'] }}</p>
                                                    <p> - </p>
                                                    <p>{{ $schedule['classroom']['code'] }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        @endif
                                        {{-- <td>{{$schedule['teacher_details'] ? $schedule['teacher_details_string'] : 'Belum dipilih'}}</td> --}}
                                        {{-- <td>
                                            <button type="button" class="btn btn-sm btn-default" title="Edit" data-toggle="modal" onclick="openAssignModal('{{$subject['name']}}', '{{$subject['id']}}', '{{$subject['subject_teacher']['id']}}', '{{$key}}')"><i class="icon-user"></i></button>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-default" title="Edit" data-toggle="modal" onclick="openEditModal('{{$subject['name']}}', '{{$subject['id']}}')"><i class="fa fa-edit"></i></button>
                                        </td> --}}
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="addSubject">
                        <div class="body mt-2">
                            <form method="POST" action="{{url('/subjects')}}">
                                @csrf
                                <div class="form-group">
                                    <label>Mata Pelajaran</label>
                                    <input type="text" class="form-control text-dark" name="subject_name">
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
    {{-- @include('layouts.admin._modal_edit_subject') --}}
    {{-- @include('layouts.admin._modal_edit_assign_subject') --}}
</div>
@endsection
