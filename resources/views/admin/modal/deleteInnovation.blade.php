
    <!-- Modal -->
<div class="modal fade" id="innovation_{{$innovation->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
  <form action="{{route('innovation.delete', $innovation->id)}}" method="post">
   @csrf
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-danger" id="exampleModalLabel">Innovation Delete</h5>

      </div>
      <div class="modal-body">
        Are You Sure You want to delete this innovation
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-danger">Delete</button>
      </div>
    </div>
    </form>
  </div>
</div>
