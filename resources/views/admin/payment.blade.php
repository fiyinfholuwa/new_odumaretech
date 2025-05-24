@extends('admin.app')

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
                                    <th>Bank Transfer Info</th>
                                    <th>Status</th>
{{--                                    <th>Action</th>--}}
                                    <th>Payment resolution</th>
                                    <th>Fix Error Payment</th>

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

                                 <td> @if($pay->payment === "bank transfer")
                                         <a href="#" data-toggle="modal" data-target="#bank_transfer_{{$pay->id}}" ><button class="badge bg-warning text-white"><i class="fas fa-eye"></i></button></a>

                                         <div class="modal fade" id="bank_transfer_{{$pay->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                             <div class="modal-dialog" role="document">
                                                 <form action="" method="">
                                                     @csrf
                                                     <div class="modal-content">
                                                         <div class="modal-header">
                                                             <h5 class="modal-title text-danger" id="exampleModalLabel">Bank Transfer Information</h5>

                                                         </div>
                                                         @php
                                                         $bank_info = json_decode($pay->bank_info, true);
                                                         @endphp
                                                         <div class="modal-body">
                                                             <h3>Amount Sent: <span style="color: #4d7cfe; font-weight: 800;"> &#163;{{$bank_info['amount_sent']}}</span></h3>
                                                             <h3>Bank Name: <span style="color: #4d7cf5; font-weight: 800;">{{$bank_info['bank_name']}}</span></h3>
                                                             <h3>Account Name: <span style="color: #4d7cf2; font-weight: 800;">{{$bank_info['account_name']}}</span></h3>
                                                         </div>
                                                         <div class="modal-footer">
                                                             <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
{{--                                                             <button type="submit"  class="btn btn-success btn-sm">Fix Payment</button>--}}
                                                         </div>
                                                     </div>
                                                 </form>
                                             </div>
                                         </div>
                                     @else
                                         <span class="btn btn-primary text-white btn-sm">Not Bank Payment</span>
                                     @endif
                                 </td>



                                 <td> @if($pay->status === "paid")
                                <span class="btn btn-success text-white btn-sm"> {{$pay->status}} </span>
                                @else
                                <span class="btn btn-warning text-white btn-sm"> {{$pay->status}} </span>
                                @endif
                             </td>



                            <td>
                                @if($pay->status == "paid")
                                <span class="badge bg-success-gradient text-white">Payment Complete</span>
                                @else
                                <a href="#" data-toggle="modal" data-target="#pay_complete_{{$pay->id}}" ><button class="badge bg-primary text-white"><i class="fas fa-lock"></i>Resolve/Complete Payment</button></a>
                                @endif
                            </td>
                             <td>
                                <span style="padding: 10px;">
                                     @if($pay->payment_type === "full" && $pay->status == 'paid')
                                        <span class="badge bg-success text-white">Full Payment</span>
                                    @elseif($pay->payment_type !== 'full' && $pay->admission_status == 'accepted')
                                        <a href="#" data-toggle="modal" data-target="#pay_resolve_{{$pay->id}}" ><button class="badge bg-warning"><i class="fas fa-lock"></i>Fix User Payment</button></a>
                                    @else
                                        <span class="badge bg-success text-white">No Error Captured</span>
                                @endif
                                </span>
                            </td>



                             @include('admin.modal.lockUser')

                                 <div class="modal fade" id="pay_resolve_{{$pay->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                     <div class="modal-dialog" role="document">
                                         <form action="{{route('admin.fix.payment', $pay->id)}}" method="post">
                                             @csrf
                                             <div class="modal-content">
                                                 <div class="modal-header">
                                                     <h5 class="modal-title text-danger" id="exampleModalLabel">Fix Erroneous Payment</h5>

                                                 </div>
                                                 <div class="modal-body">
                                                     <div class="form-group">
                                                         <label>Amount</label>
                                                         <input required name="amount" type="number" value="{{$pay->amount}}" placeholder="Amount" class="form-control"/>
                                                     </div>
                                                    <div class="form-group">
                                                         <label>Payment Type</label>
                                                         <select required class="form-control" name="payment_type">
                                                             <option value="{{$pay->payment_type}}">{{$pay->payment_type}}</option>
                                                             <option value="first installment">first installment</option>
                                                             <option value="second installment">second installment</option>
                                                             <option value="full">full</option>

                                                         </select>
                                                     </div>

                                                 </div>
                                                 <div class="modal-footer">
                                                     <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                                     <button type="submit"  class="btn btn-success btn-sm">Fix Payment</button>
                                                 </div>
                                             </div>
                                         </form>
                                     </div>
                                 </div>

                             @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
