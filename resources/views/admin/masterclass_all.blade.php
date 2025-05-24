@extends('admin.app')

@section('content')

    <!-- jQuery UI Datepicker -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

    <script>
        var $j = jQuery.noConflict();
        $j(document).ready(function () {
            $j(".datepicker").datepicker({
                dateFormat: "yy-mm-dd",
                changeMonth: true,
                changeYear: true,
                showButtonPanel: true,
                onClose: function (dateText, inst) {
                    $j(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
                }
            });
        });
    </script>

    <div class="row my-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-secondary">
                    <h4 class="card-title text-white">All Free Master Class Attendees</h4>

                    <form method="post" action="{{ route('masterclass.export') }}">
                        @csrf
                        <div class="d-flex flex-wrap gap-3">
                            <div class="flex-fill" style="min-width: 180px;">
                                <input name="date_from" type="date" class="form-control" placeholder="Start Date" required>
                            </div>
                            <div class="flex-fill" style="min-width: 180px;">
                                <input name="date_to" type="date" class="form-control" placeholder="End Date" required>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-danger">Export to CSV</button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="my-table" class="display table table-striped table-hover">
                            <thead>
                            <tr>
                                <th>S/N</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Interested In</th>
                                <th>Gender</th>
                                <th>Career</th>
                                <th>Location</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php $i = 1; @endphp
                            @foreach($attendees as $attendee)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $attendee->first_name }}</td>
                                    <td>{{ $attendee->last_name }}</td>
                                    <td>{{ $attendee->email }}</td>
                                    <td>{{ $attendee->intrested_in }}</td>
                                    <td>{{ $attendee->gender }}</td>
                                    <td>{{ $attendee->career }}</td>
                                    <td>{{ $attendee->location }}</td>
                                </tr>
                            @endforeach
                            @if(count($attendees) === 0)
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
