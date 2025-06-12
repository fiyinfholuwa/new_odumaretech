<!-- Modal -->
<div class="modal fade" id="course_{{$course->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{route('course.delete', $course->id)}}" method="post">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-danger" id="exampleModalLabel">Course Delete</h5>

                </div>
                <div class="modal-body">
                    Are You Sure You want to delete this Course
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>
            </div>
        </form>
    </div>
</div>



<div class="modal fade" id="assignInstructorModal_{{ $course->id }}" tabindex="-1" aria-labelledby="assignInstructorLabel_{{ $course->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('course.assignInstructor') }}" method="POST">
            @csrf
            <input type="hidden" name="course_id" value="{{ $course->id }}">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="assignInstructorLabel_{{ $course->id }}">Assign Instructor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="instructor_id_{{ $course->id }}">Select Instructor</label>
                        <select name="instructor_id" class="form-control" id="instructor_id_{{ $course->id }}" required>
                            @foreach($instructors as $instructor)
                                <option value="{{ $instructor->id }}">{{ $instructor->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Assign</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>
