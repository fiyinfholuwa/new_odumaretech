
    <!-- Modal -->
    <div class="modal fade" id="applied_{{$ap->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
  <form action="{{route('applied.user.update', $ap->id)}}" method="post">
   @csrf
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-danger" id="exampleModalLabel">Update Applied Student Cohort</h5>


      </div>
      <div class="modal-body">
      <div class="form-group">
        <label for="email2">Cohort Category</label>
        <select class="form-control" name="cohort_id" id="validationCustom02"  required>
        <option disabled selected >Select Cohort Category</option>
        @if(count($cohorts) > 0)
        @foreach($cohorts as $cohort)
        <option value="{{$cohort->id}}" {{$cohort->id== $ap->cohort_id ? "selected" : ""}}>{{$cohort->name}}</option>
        @endforeach
        @else
        <option disabled>No Cohort</option>
        @endif
        </select>
    </div>

          <div class="form-group">
              <label for="email2">Course Category</label>
              <select class="form-control" name="course_id" id="validationCustom02"  required>
                  <option disabled selected >Select Course Category</option>
                  @if(count($courses) > 0)
                      @foreach($courses as $course)
                          <option value="{{$course->id}}" {{$course->id== $ap->course_id ? "selected" : ""}}>{{$course->title}}</option>
                      @endforeach
                  @else
                      <option disabled>No Cohort</option>
                  @endif
              </select>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-secondary">Update</button>
      </div>
    </div>
    </form>
  </div>
</div>
