@extends('user.app')
@section('content')

<div class="card shadow-sm">
    <div class="card-header bgc-primary text-white">
        <h4 class="mb-0">Payout History</h4>
    </div>
    <div class="card-body">
        <table  id="basic-datatables" class="table table-bordered table-hover">
            <thead class="table-light">
                <tr>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Requested On</th>
                </tr>
            </thead>
            <tbody>
                @forelse($payouts as $tx)
                    <tr>
                        <td>${{ number_format($tx->amount, 2) }}</td>
                        <td>
                            <span class="badge 
                                @if($tx->status == 'approved') bg-success 
                                @elseif($tx->status == 'rejected') bg-danger 
                                @else bg-warning text-dark @endif">
                                {{ ucfirst($tx->status) }}
                            </span>
                        </td>
<td>{{ $tx->created_at->format('d M Y, h:i A') }}</td>
                    </tr>
                @empty
                                    <div class="text-center">No payout history available.</div>

                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
