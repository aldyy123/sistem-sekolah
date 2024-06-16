@php
    if (isset($schedules['data'][0])) {
    }
@endphp

<div class="tab-pane {{ $classroom['code'] === 'I' ? 'show active' : '' }}" id="jadwal-k{{ $classroom['code'] }}">
    <div class="row">
        <div class="col-md">
            <div class="card rounded" style="width: 100%!important; background-color: #17C2D7;">
                <div class="card-header">
                    <div class="font-weight-bold text-center">Senin</div>
                </div>

                <div class="card-body">
                    @foreach ($schedules['data'] as $key => $schedule)
                        @if ($schedule['days'] === 'Senin')
                            <div
                                class="{{ $loop->iteration === sizeof($schedules['data']) ? '' : 'border-bottom' }} mb-2 d-flex justify-content-between">
                                <div>
                                    <p>
                                        <span
                                            class="font-weight-bold">{{ isset($schedule['subject']['name']) ? $schedule['subject']['name'] : 'Belum Ada' }}</span>
                                        <span> - </span>
                                        <span>{{ $schedule['classroom']['code'] }}</span>
                                    </p>
                                    <p>
                                        <span>
                                            {{ \Carbon\Carbon::parse($schedule['time_start'])->format('h:m') }}
                                        </span>
                                        <span> - </span>
                                        <span>
                                            {{ \Carbon\Carbon::parse($schedule['time_end'])->format('h:m') }}
                                        </span>
                                    </p>
                                </div>
                                <div>
                                    <button class="btn btn-danger" type="button" data-toggle="modal"
                                        data-target="#delete-schedule-{{ $key }}">
                                        <i class="fa fa-trash"></i>
                                    </button>

                                    <div class="modal fade" id="delete-schedule-{{ $key }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Delete schedule</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Are you sure to delete schedule days {{ $schedule['days'] }} in
                                                        study
                                                        {{ isset($schedule['subject']['name']) ? $schedule['subject']['name'] : 'Belum Ada' }}?
                                                    </p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close</button>
                                                    <form method="POST"
                                                        action="{{ route('admin.schedule.destroy', $schedule['id']) }}">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger">Delete
                                                            Schedule</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>

            </div>
        </div>

        <div class="col-md">
            <div class="card rounded" style="width: 100%!important; background-color: #17C2D7;">
                <div class="card-header">
                    <div class="font-weight-bold text-center">Selasa</div>
                </div>
                <div class="card-body">
                    @foreach ($schedules['data'] as $key => $schedule)
                        @if ($schedule['days'] === 'Selasa')
                            <div
                                class="{{ $loop->iteration === sizeof($schedules['data']) ? '' : 'border-bottom' }} mb-2 d-flex justify-content-between">
                                <div>
                                    <p>
                                        <span
                                            class="font-weight-bold">{{ isset($schedule['subject']['name']) ? $schedule['subject']['name'] : 'Belum Ada' }}</span>
                                        <span> - </span>
                                        <span>{{ $schedule['classroom']['code'] }}</span>
                                    </p>
                                    <p>
                                        <span>{{ \Carbon\Carbon::parse($schedule['time_start'])->format('h:m') }}</span>
                                        <span> - </span>
                                        <span>
                                            {{ \Carbon\Carbon::parse($schedule['time_end'])->format('h:m') }}</span>
                                    </p>
                                </div>
                                <div>
                                    <button class="btn btn-danger" type="button" data-toggle="modal"
                                        data-target="#delete-schedule-{{ $key }}">
                                        <i class="fa fa-trash"></i>
                                    </button>

                                    <div class="modal fade" id="delete-schedule-{{ $key }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Delete schedule</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Are you sure to delete schedule days {{ $schedule['days'] }} in
                                                        study
                                                        {{ isset($schedule['subject']['name']) ? $schedule['subject']['name'] : 'Belum Ada' }}?
                                                    </p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close</button>
                                                    <form method="POST"
                                                        action="{{ route('admin.schedule.destroy', $schedule['id']) }}">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger">Delete
                                                            Schedule</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>

            </div>
        </div>

        <div class="col-md">
            <div class="card rounded" style="width: 100%!important; background-color: #17C2D7;">
                <div class="card-header">
                    <div class="font-weight-bold text-center">Rabu</div>
                </div>
                <div class="card-body">
                    @foreach ($schedules['data'] as $key => $schedule)
                        @if ($schedule['days'] === 'Rabu')
                            <div
                                class="{{ $loop->iteration === sizeof($schedules['data']) ? '' : 'border-bottom' }} mb-2 d-flex justify-content-between">
                                <div>
                                    <p>
                                        <span
                                            class="font-weight-bold">{{ isset($schedule['subject']['name']) ? $schedule['subject']['name'] : 'Belum Ada' }}</span>
                                        <span> - </span>
                                        <span>{{ $schedule['classroom']['code'] }}</span>
                                    </p>
                                    <p>
                                        <span>{{ \Carbon\Carbon::parse($schedule['time_start'])->format('h:m') }}</span>
                                        <span> - </span>
                                        <span>
                                            {{ \Carbon\Carbon::parse($schedule['time_end'])->format('h:m') }}</span>
                                    </p>
                                </div>
                                <div>
                                    <button class="btn btn-danger" type="button" data-toggle="modal"
                                        data-target="#delete-schedule-{{ $key }}">
                                        <i class="fa fa-trash"></i>
                                    </button>

                                    <div class="modal fade" id="delete-schedule-{{ $key }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Delete schedule</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Are you sure to delete schedule days {{ $schedule['days'] }} in
                                                        study
                                                        {{ isset($schedule['subject']['name']) ? $schedule['subject']['name'] : 'Belum Ada' }}?
                                                    </p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close</button>
                                                    <form method="POST"
                                                        action="{{ route('admin.schedule.destroy', $schedule['id']) }}">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger">Delete
                                                            Schedule</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>

            </div>
        </div>
        <div class="col-md">
            <div class="card rounded" style="width: 100%!important; background-color: #17C2D7;">
                <div class="card-header">
                    <div class="font-weight-bold text-center">Kamis</div>
                </div>
                <div class="card-body">
                    @foreach ($schedules['data'] as $key => $schedule)
                        @if ($schedule['days'] === 'Kamis')
                            <div
                                class="{{ $loop->iteration === sizeof($schedules['data']) ? '' : 'border-bottom' }} mb-2">
                                <p>
                                    <span
                                        class="font-weight-bold">{{ isset($schedule['subject']['name']) ? $schedule['subject']['name'] : 'Belum Ada' }}</span>
                                    <span> - </span>
                                    <span>{{ $schedule['classroom']['code'] }}</span>
                                </p>
                                <p>
                                    <span>{{ \Carbon\Carbon::parse($schedule['time_start'])->format('h:m') }}</span>
                                    <span> - </span>
                                    <span>
                                        {{ \Carbon\Carbon::parse($schedule['time_end'])->format('h:m') }}</span>
                                </p>
                            </div>
                        @endif
                    @endforeach
                </div>

            </div>
        </div>
        <div class="col-md">
            <div class="card rounded" style="width: 100%!important; background-color: #17C2D7;">
                <div class="card-header">
                    <div class="font-weight-bold text-center">Jumat</div>
                </div>
                <div class="card-body">
                    @foreach ($schedules['data'] as $key => $schedule)
                        @if ($schedule['days'] === 'Jumat')
                            <div
                                class="{{ $loop->iteration === sizeof($schedules['data']) ? '' : 'border-bottom' }} mb-2">
                                <p>
                                    <span
                                        class="font-weight-bold">{{ isset($schedule['subject']['name']) ? $schedule['subject']['name'] : 'Belum Ada' }}</span>
                                    <span> - </span>
                                    <span>{{ $schedule['classroom']['code'] }}</span>
                                </p>
                                <p>
                                    <span>{{ \Carbon\Carbon::parse($schedule['time_start'])->format('h:m') }}</span>
                                    <span> - </span>
                                    <span>
                                        {{ \Carbon\Carbon::parse($schedule['time_end'])->format('h:m') }}</span>
                                </p>
                            </div>
                        @endif
                    @endforeach
                </div>

            </div>
        </div>

    </div>
</div>
