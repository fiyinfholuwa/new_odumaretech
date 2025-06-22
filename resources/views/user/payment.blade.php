@extends('user.app')

@section('content')
    <div class="row" style="margin:10px;">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">All Transactions</h4>
                    <div class="bg-white p-3   align-items-center">
                


                <div class="card-body">
                    <div class="table-responsive">
                        <table id="basic-datatables" class="display table table-striped table-hover" >
                            <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>ReferenceId</th>
                                    <th>Email</th>
                                    <th>Amount</th>
                                    <th>Course Title</th>
                                    <th>Payment Method</th>
                                    <th>Admission Status</th>
                                    <th>Payment Type</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                    
                                </tr>
                            </thead>
                           
                            <tbody>
                            <?php $i = 1; ?>
                             @foreach($payments as $pay)
                             <tr>
                             
                             <td>{{$i++;}}</td>
                             <td>{{$pay->referenceId}}</td>
                             <td>{{$pay->user_email}}</td>
                             <td>#{{$pay->amount}}</td>
                             <td>{{optional($pay->course_name)->title}}</td>
                             <td>{{$pay->payment}}</td>
                             <td> @if($pay->admission_status === "accepted")
                                <span class="btn btn-success text-white btn-sm">Accepted </span>
                                @else
                                <span class="btn btn-danger text-white btn-sm">Locked </span>
                                @endif
                             </td>

                             <td> @if($pay->payment_type === "full")
                                <span class="btn btn-success text-white btn-sm">Full </span>
                                @else
                                <span class="btn btn-warning text-white btn-sm">{{$pay->payment_type}}</span>
                                @endif
                             </td>

                             <td> @if($pay->status === "paid")
                                <span class="btn btn-success text-white btn-sm"> {{$pay->status}} </span>
                                @else
                                <span class="btn btn-warning text-white btn-sm"> {{$pay->status}} </span>
                                @endif
                             </td> 
                            
                            <td> @if($pay->payment_type === "full")
                                <span class="btn btn-success text-white btn-sm">Verifed</span>
                                @else
                                <a href="#" data-toggle="modal" data-target="#pay_{{$pay->id}}" ><button class="btn btn-info btn-sm"><i class="fas fa-lock"></i>Complete Payment</button></a>
                            </td>
                                @endif
                             </td>

                             @include('user.modal.completePayment')
                             @endforeach
                            </tbody>
                           
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection