@extends('external_instructor.app')

@section('content')
<div class="row" style="margin:10px">
    <div class="col-md-11">
        <div class="card">
            <div class="card-header bgc-primary">
                <div class="card-title">
                    <h3 class="bgc-primary-text" style="text-align: left;">Set Curriculum ({{ $course->title }})</h3>
                </div>
            </div>
            <div class="card-body">
                @php
                    $existing = json_decode($course->curriculum, true) ?? [];
                @endphp

                <form action="{{ route('in.course.saveCurriculum', $course->id) }}" method="post">
                    @csrf

                    <div id="curriculum-wrapper">
                        @foreach($existing as $index => $item)
                            <div class="outline-item mb-4 border rounded p-3">
                                <div class="form-group">
                                    <label>Outline Title</label>
                                    <input type="text" name="curriculum[{{ $index }}][title]" class="form-control" value="{{ $item['title'] }}" required>
                                </div>

                                <label class="mt-2">Points</label>
                                <div class="points-list">
                                    @foreach($item['points'] as $pIndex => $point)
                                        <div class="point-group d-flex gap-2 mb-1">
                                            <input type="text" name="curriculum[{{ $index }}][points][{{ $pIndex }}][text]" class="form-control" value="{{ $point['text'] ?? $point }}" placeholder="Point text" required>
                                            <input type="url" name="curriculum[{{ $index }}][points][{{ $pIndex }}][url]" class="form-control" value="{{ $point['url'] ?? '' }}" placeholder="Point URL" required>
                                        </div>
                                    @endforeach
                                </div>
                                <button type="button" class="btn btn-sm btn-secondary add-point">+ Add Point</button>
                                <button type="button" class="btn btn-sm btn-danger remove-outline float-end">Remove Section</button>
                            </div>
                        @endforeach
                    </div>

                    <button type="button" class="btn btn-outline-primary my-3" id="add-outline">+ Add Outline Section</button>

                    <div class="card-action">
                        <a href="{{ route('in.course.all') }}" class="btn btn-danger">Go Back</a>
                        <button type="submit" class="btn btn-primary">Save Curriculum</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
let outlineCount = {{ count($existing) }};

document.getElementById('add-outline').addEventListener('click', function () {
    const wrapper = document.getElementById('curriculum-wrapper');
    const div = document.createElement('div');
    div.classList.add('outline-item', 'mb-4', 'border', 'rounded', 'p-3');
    div.innerHTML = `
        <div class="form-group">
            <label>Outline Title</label>
            <input type="text" name="curriculum[${outlineCount}][title]" class="form-control" required>
        </div>

        <label class="mt-2">Points</label>
        <div class="points-list">
            <div class="point-group d-flex gap-2 mb-1">
                <input type="text" name="curriculum[${outlineCount}][points][0][text]" class="form-control" placeholder="Point text" required>
                <input type="url" name="curriculum[${outlineCount}][points][0][url]" class="form-control" placeholder="Point URL" required>
            </div>
        </div>
        <button type="button" class="btn btn-sm btn-secondary add-point">+ Add Point</button>
        <button type="button" class="btn btn-sm btn-danger remove-outline float-end">Remove Section</button>
    `;
    wrapper.appendChild(div);
    outlineCount++;
});

document.addEventListener('click', function (e) {
    if (e.target.classList.contains('add-point')) {
        const pointsList = e.target.previousElementSibling;
        const pointIndex = pointsList.querySelectorAll('.point-group').length;
        const div = document.createElement('div');
        div.classList.add('point-group', 'd-flex', 'gap-2', 'mb-1');
        div.innerHTML = `
            <input type="text" name="${pointsList.querySelector('input').name.replace(/\[\d+\]\[text\]$/, '')}[${pointIndex}][text]" class="form-control" placeholder="Point text" required>
            <input type="url" name="${pointsList.querySelector('input').name.replace(/\[\d+\]\[text\]$/, '')}[${pointIndex}][url]" class="form-control" placeholder="Point URL" required>
        `;
        pointsList.appendChild(div);
    }

    if (e.target.classList.contains('remove-outline')) {
        e.target.closest('.outline-item').remove();
    }
});
</script>
@endsection
