@extends('admin.app')

@section('content')
<div class="row mx-2">
    <div class="col-md-12">
        <div class="card shadow-sm border-0">
            <div class="card-header bgc-primary">
                <h4 class="card-title bgc-primary-text mb-0">Current Masterclass Link</h5>
            </div>
            <div class="card-body">
    @if($masterclass_link)
        <div class="d-flex align-items-center p-3 shadow-sm rounded bg-light">
            
            {{-- Facilitator Image --}}
            <div class="me-3">
                <img src="{{ asset(($masterclass_link->image ?? 'https://coffective.com/wp-content/uploads/2018/06/default-featured-image.png.jpg')) }}"
                     alt="Facilitator"
                     class="rounded-circle border shadow-sm"
                     width="90" height="90"
                     style="object-fit: cover;">
            </div>

            {{-- Masterclass Info --}}
            <div class="flex-grow-1">
                <h5 class="mb-1">{{ $masterclass_link->title }}</h5>
                <p class="mb-1 text-muted">
                    <i class="bi bi-calendar-event me-1"></i> 
                    {{ \Carbon\Carbon::parse($masterclass_link->date)->format('d M Y') }}
                    &nbsp; | &nbsp;
                    <i class="bi bi-clock me-1"></i> 
                    {{ \Carbon\Carbon::parse($masterclass_link->time)->format('h:i A') }}
                </p>
                <p class="mb-1">
                    <span class="badge {{ $masterclass_link->visible == 'on' ? 'bg-success' : 'bg-danger' }}">
                        {{ $masterclass_link->visible == 'on' ? 'Visible' : 'Hidden' }}
                    </span>
                </p>
                @if(!empty($masterclass_link->info))
                    <p class="small text-muted mb-1">
                        {{ Str::limit($masterclass_link->info, 100) }}
                    </p>
                @endif
            </div>

            {{-- Action --}}
            <div>
                <a target="_blank" href="{{ $masterclass_link->link }}" 
                   class="btn btn-outline-primary btn-sm">
                    <i class="bi bi-box-arrow-up-right"></i> View
                </a>
            </div>
        </div>
    @else
        <p class="text-center text-muted">No Masterclass Link Found</p>
    @endif
</div>

        </div>
    </div>

    <div class="col-md-12">
    <div class="card shadow-sm border-0">
        <div class="card-header bgc-primary">
            <h4 class="card-title bgc-primary-text mb-0">
                {{ $masterclass_link ? 'Update Masterclass Link' : 'Add Masterclass Link' }}
            </h5>
        </div>
        <div class="card-body">
            <form action="{{ route('masterclass.link.add') }}" method="post" enctype="multipart/form-data">
                @csrf

                @if($masterclass_link)
                    <input type="hidden" name="id" value="{{ $masterclass_link->id }}">
                @endif

                {{-- Masterclass Link --}}
                <div class="form-group mb-3">
                    <label for="link">Master Class Link</label>
                    <input type="text" class="form-control" id="link" name="link"
                        value="{{ $masterclass_link->link ?? '' }}"
                        placeholder="Enter Master Class Link" required>
                    <small class="text-danger">@error('link') {{ $message }} @enderror</small>
                </div>

                {{-- Title + Date + Time in a row --}}
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="title">Master Class Title</label>
                        <input type="text" class="form-control" id="title" name="title"
                            value="{{ $masterclass_link->title ?? '' }}"
                            placeholder="Enter Title" required>
                    </div>
                    <div class="col-md-4">
                        <label for="date">Date</label>
                        <input type="date" class="form-control" id="date" name="date"
                            value="{{ $masterclass_link->date ?? '' }}" required>
                    </div>
                    <div class="col-md-4">
                        <label for="time">Time</label>
                        <input type="time" class="form-control" id="time" name="time"
                            value="{{ $masterclass_link->time ?? '' }}" required>
                    </div>
                </div>

                {{-- Visibility + Facilitator Image in a row --}}
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="visible">Visibility</label>
                        <select class="form-control" name="visible" required>
                            <option value="">Select Option</option>
                            <option value="on" {{ isset($masterclass_link) && $masterclass_link->visible == 'on' ? 'selected' : '' }}>Yes</option>
                            <option value="off" {{ isset($masterclass_link) && $masterclass_link->visible == 'off' ? 'selected' : '' }}>No</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="facilitator_image">Facilitator Image</label>
                        <input type="file" class="form-control" id="facilitator_image" name="image" accept="image/*">
                        @if(isset($masterclass_link->image))
                            <div class="mt-2">
                                <img src="{{ asset($masterclass_link->image) }}" 
                                     alt="Facilitator" class="img-thumbnail" width="120">
                            </div>
                        @endif
                    </div>
                    <div class="col-md-4">
                        <label for="facilitator_image">Master Class Image</label>
                        <input type="file" class="form-control" id="masterclass_image" name="masterclass_image" accept="image/*">
                        @if(isset($masterclass_link->image))
                            <div class="mt-2">
                                <img src="{{ asset($masterclass_link->masterclass_image) }}" 
                                     alt="Facilitator" class="img-thumbnail" width="120">
                            </div>
                        @endif
                    </div>
                </div>
                


                {{-- Info/Description --}}
                <div class="form-group mb-3">
                    <label for="info">Masterclass Info</label>
                    <textarea class="form-control" id="myTextarea" name="text_body" rows="4" placeholder="Enter details about the masterclass...">{{ $masterclass_link->text_body ?? '' }}</textarea>
                </div>
                {{-- Info/Description --}}
                <div class="form-group mb-3">
                    <label for="info">Facilitator Info</label>
                    <textarea class="form-control" id="myTextarea2" name="text_body_2" rows="4" placeholder="Enter details about the masterclass facilitator...">{{ $masterclass_link->text_body_2 ?? '' }}</textarea>
                </div>

                {{-- Submit --}}
                <div class="card-action">
                    <button class="btn {{ $masterclass_link ? 'btn-primary' : 'btn-success' }}">
                        {{ $masterclass_link ? 'Update Link' : 'Add Link' }}
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

</div>
@endsection
