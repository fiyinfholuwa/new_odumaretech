@extends('admin.app')

@section('content')

<link rel="stylesheet" href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<style>
    table.dataTable td {
        vertical-align: middle;
        white-space: nowrap;
        text-overflow: ellipsis;
        overflow: hidden;
        max-width: 180px;
    }

    td.wrap-text {
        white-space: normal !important;
        word-break: break-all;
    }

    .device-info-toggle {
        cursor: pointer;
        color: #007bff;
        text-decoration: underline;
    }

    .device-details {
        display: none;
        background: #f9f9f9;
        border-left: 3px solid #007bff;
        padding: 8px 12px;
        margin-top: 5px;
        border-radius: 6px;
    }

    .device-details small {
        display: block;
        margin-bottom: 4px;
    }

    @media (max-width: 768px) {
        table.dataTable td {
            max-width: 100px;
            white-space: normal;
        }
    }
</style>

<div class="row my-4">
    <div class="col-md-12">
        <div class="card shadow-sm">
            <div class="card-header bgc-primary text-white">
                <h4 class="mb-0 bgc-primary-text">All Visitors</h4>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table id="visitors-table" class="table table-striped table-bordered align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>IP Address</th>
                                <th>User Agent</th>
                                <th>Accepted</th>
                                <th>Page</th>
                                <th>Referrer</th>
                                <th>Device Info</th>
                                <th>Session ID</th>
                                <th>Created At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i = 1; @endphp
                            @foreach($visitors as $visitor)
                                @php
                                    $device = is_array($visitor->device_info)
                                        ? $visitor->device_info
                                        : json_decode($visitor->device_info, true);
                                @endphp
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $visitor->ip_address ?? 'N/A' }}</td>
                                    <td class="wrap-text"><small>{{ Str::limit($visitor->user_agent, 60, '...') }}</small></td>
                                    <td>
                                        @if($visitor->accepted)
                                            <span class="badge bg-success">Yes</span>
                                        @else
                                            <span class="badge bg-danger">No</span>
                                        @endif
                                    </td>
                                    <td class="wrap-text">
                                        <a href="{{ $visitor->page ?? '#' }}" target="_blank">
                                            {{ Str::limit($visitor->page, 40, '...') }}
                                        </a>
                                    </td>
                                    <td class="wrap-text">
                                        @if($visitor->referrer)
                                            <a href="{{ $visitor->referrer }}" target="_blank">
                                                {{ Str::limit($visitor->referrer, 40, '...') }}
                                            </a>
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td>
                                        @if($device)
                                            <span class="device-info-toggle" data-id="{{ $visitor->id }}">View Details</span>

                                            <div class="device-details" id="device-{{ $visitor->id }}">
                                                <small><strong>Vendor:</strong> {{ $device['vendor'] ?? 'N/A' }}</small>
                                                <small><strong>Platform:</strong> {{ $device['platform'] ?? 'N/A' }}</small>
                                                <small><strong>Language:</strong> {{ $device['language'] ?? 'N/A' }}</small>
                                                <small><strong>Screen:</strong> {{ $device['screen']['width'] ?? '?' }}×{{ $device['screen']['height'] ?? '?' }}</small>
                                                <small><strong>Viewport:</strong> {{ $device['viewport']['innerWidth'] ?? '?' }}×{{ $device['viewport']['innerHeight'] ?? '?' }}</small>
                                            </div>
                                        @else
                                            <em>No device info</em>
                                        @endif
                                    </td>
                                    <td>{{ $visitor->session_id ?? 'N/A' }}</td>
                                    <td>{{ $visitor->created_at ? $visitor->created_at->format('Y-m-d H:i') : 'N/A' }}</td>
                                </tr>
                            @endforeach

                            @if($visitors->count() === 0)
                                <tr>
                                    <td colspan="9" class="text-center text-muted">No visitors found</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#visitors-table').DataTable({
            pageLength: 10,
            order: [[0, 'desc']],
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search visitors..."
            }
        });

        // Toggle device info inline
        $(document).on('click', '.device-info-toggle', function() {
            const id = $(this).data('id');
            const details = $('#device-' + id);
            details.slideToggle(200);
        });
    });
</script>

@endsection
