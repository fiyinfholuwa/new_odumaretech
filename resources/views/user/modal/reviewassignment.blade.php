
    <!-- Modal -->
    <div class="modal fade" id="review_{{$assignment->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
  <form >

    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-danger" id="exampleModalLabel">View Assignment Comment</h5>

      </div>
      <div class="modal-body">
        {{$assignment->review}}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>
    </div>
    </form>
  </div>
</div>
