
    <!-- Modal -->
    <div class="modal fade" id="pay_{{$pay->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
  <form action="{{route('user.lock', $pay->id)}}" method="post">
   @csrf
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-danger" id="exampleModalLabel">User Lock</h5>
        
      </div>
      <div class="modal-body">
        Are You Sure You want to Lock this user Account
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        <button type="submit" name="lock" class="btn btn-danger btn-sm">Lock Account</button>
        <button type="submit" name="unlock" class="btn btn-success btn-sm">Unlock Account</button>
      </div>
    </div>
    </form>
  </div>
</div>


    <!-- Modal -->
    <div class="modal fade" id="pay_complete_{{$pay->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
  <form action="{{route('payment.resolution', $pay->id)}}" method="post">
   @csrf
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-danger" id="exampleModalLabel">Payment Completion</h5>
        
      </div>
      <div class="modal-body">
        Are You Sure You want to Complete this Payment
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        <button type="submit" name="unlock" class="btn btn-success btn-sm">Complete Payment</button>
      </div>
    </div>
    </form>
  </div>
</div>
