@extends('layouts.app')

@section('content')
    <div class="block-header">
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card">
                    <div class="tab-content mt-3">
                        <x-panel-schedule :user="$user" :schedules="$schedulesArray" />
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
