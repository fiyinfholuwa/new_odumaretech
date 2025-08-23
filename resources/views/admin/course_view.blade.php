@extends('admin.app')

@section('content')
    <div class="row" style="margin:10px">
        <div class="col-md-11">
            <div class="card">
                <div class="card-header  bgc-primary">
                    <div class="card-title"><h3 class="bgc-primary-text" style="text-align: left;">Add Course</h3></div>
                </div>
                <div class="card-body">
                    <form action="{{route('course.add')}}" method="post" enctype="multipart/form-data">
                        @csrf

                        <!-- Course Title -->
                        <div class="form-group">
                            <label for="title">Course Title</label>
                            <input type="text" class="form-control" id="title" required name="title"
                                   placeholder="Enter Course Title" value="{{ old('title') }}">
                            @error('title')
                            <small style="color:red; font-weight:500">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Course Category -->
                        <div class="form-group">
                            <label for="category">Course Category</label>
                            <select class="form-control" name="category" id="category" required>
                                <option disabled selected>Select Course Category</option>
                                @if(count($categories) > 0)
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}"
                                            {{ old('category') == $category->id ? 'selected' : '' }}>
                                            {{$category->name}}
                                        </option>
                                    @endforeach
                                @else
                                    <option disabled>No Category</option>
                                @endif
                            </select>
                            @error('category')
                            <small style="color:red; font-weight:500">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Course Description -->
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea rows="5" class="form-control" id="myTextarea3"  name="description"
                                      placeholder="Enter Course Description">{{ old('description') }}</textarea>
                            @error('description')
                            <small style="color:red; font-weight:500">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Admission Requirements -->
                        <div class="form-group">
                            <label for="description_corp">Admission Requirements</label>
                            <textarea rows="5" class="form-control" id="myTextarea4"  name="requirement"
                                      placeholder="Enter Course Admission Requirements">{{ old('requirement') }}</textarea>
                            @error('requirement')
                            <small style="color:red; font-weight:500">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Course Outline -->
                        <div class="form-group">
                            <label for="certification">Course Outline</label>
                            <textarea rows="5" class="form-control" id="myTextarea"  name="course_outline"
                                      placeholder="Enter Course Outline">{{ old('course_outline') }}</textarea>
                            @error('course_outline')
                            <small style="color:red; font-weight:500">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Career Outcome -->
                        <div class="form-group">
                            <label for="experience">Career Outcome</label>
                            <textarea rows="5" class="form-control" id="myTextarea2"  name="career_outcome"
                                      placeholder="Enter Course Outcome">{{ old('career_outcome') }}</textarea>
                            @error('career_outcome')
                            <small style="color:red; font-weight:500">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Course Level, Duration, Language -->
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="level">Course Level</label>
                                    <select class="form-control" name="level" id="level" required>
                                        <option disabled selected>Select Course Level</option>
                                        <option value="Beginner" {{ old('level') == 'Beginner' ? 'selected' : '' }}>Beginner</option>
                                        <option value="Intermediate" {{ old('level') == 'Intermediate' ? 'selected' : '' }}>Intermediate</option>
                                        <option value="Expert" {{ old('level') == 'Expert' ? 'selected' : '' }}>Expert</option>
                                    </select>
                                    @error('level')
                                    <small style="color:red; font-weight:500">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="duration">Course Duration (weeks)</label>
                                    <input class="form-control" type="number" name="duration" id="duration" required
                                           placeholder="Course Duration" value="{{ old('duration') }}"/>
                                    @error('duration')
                                    <small style="color:red; font-weight:500">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="language">Course Language</label>
                                    <input class="form-control" type="text" name="language" id="language" required
                                           placeholder="Course Language" value="{{ old('language') }}"/>
                                    @error('language')
                                    <small style="color:red; font-weight:500">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <style>
                            .switch {
                                position: relative;
                                display: inline-block;
                                width: 60px;
                                height: 30px;
                                margin-top: 5px;
                            }

                            .switch input {
                                opacity: 0;
                                width: 0;
                                height: 0;
                            }

                            /* Slider base */
                            .slider {
                                position: absolute;
                                cursor: pointer;
                                background-color: #ccc;
                                transition: 0.4s;
                                top: 0;
                                left: 0;
                                right: 0;
                                bottom: 0;
                                border-radius: 34px;
                            }

                            /* Slider circle */
                            .slider::before {
                                position: absolute;
                                content: "";
                                height: 22px;
                                width: 22px;
                                left: 4px;
                                bottom: 4px;
                                background-color: white;
                                transition: 0.4s;
                                border-radius: 50%;
                            }

                            /* When checked */
                            input:checked + .slider {
                                background-color: navy; /* Fancy green */
                            }

                            input:checked + .slider::before {
                                transform: translateX(30px);
                            }

                            /* Optional: Add box-shadow for fancy look */
                            .slider.round {
                                box-shadow: 0 0 5px rgba(0,0,0,0.2);
                            }

                        </style>
                        <!-- Display Options and Certification -->
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="corporate_display">Corporate Course Display</label>
                                    <label class="switch">
                                        <input type="checkbox" name="corporate_display" id="corporate_display" value="yes"
                                            {{ old('corporate_display') == 'yes' ? 'checked' : '' }}>
                                        <span class="slider round"></span>
                                    </label>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="normal_display">Normal Course Display</label>
                                    <label class="switch">
                                        <input type="checkbox" name="normal_display" id="normal_display" value="yes"
                                            {{ old('normal_display') == 'yes' ? 'checked' : '' }}>
                                        <span class="slider round"></span>
                                    </label>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="certificate">Certification</label>
                                    <input class="form-control" type="text" name="certification" id="certificate"
                                           placeholder="Certificate Title" value="{{ old('certification') }}"/>
                                    @error('certificate')
                                    <small style="color:red; font-weight:500">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Cohort and Start Date -->
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="cohort">Course Cohort</label>
                                    <select class="form-control" name="cohort" id="cohort" required>
                                        <option disabled selected>Select Course Cohort</option>
                                        @if(count($cohorts) > 0)
                                            @foreach($cohorts as $cohort)
                                                <option value="{{$cohort->id}}"
                                                    {{ old('cohort') == $cohort->id ? 'selected' : '' }}>
                                                    {{$cohort->name}}
                                                </option>
                                            @endforeach
                                        @else
                                            <option disabled>No Cohort</option>
                                        @endif
                                    </select>
                                    @error('cohort')
                                    <small style="color:red; font-weight:500">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="start_date">Course Start Date</label>
                                    <input class="form-control" type="date" name="start_date" id="start_date" required
                                           placeholder="Course Start Date" value="{{ old('start_date') }}"/>
                                    @error('start_date')
                                    <small style="color:red; font-weight:500">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Price, Discount, Lecture Time -->
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="price">Course Price (Naira)</label>
                                    <input class="form-control" type="number" name="price" id="price" required
                                           placeholder="Course Price" value="{{ old('price') }}"/>
                                    @error('price')
                                    <small style="color:red; font-weight:500">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="discount">Course Price Discount (%)</label>
                                    <input class="form-control" type="number" name="discount" id="discount" min="0" max="100"
                                           placeholder="Course Price Discount" value="{{ old('discount') }}"/>
                                    @error('discount')
                                    <small style="color:red; font-weight:500">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="lecture">Course Lecture Time</label>
                                    <input class="form-control" type="text" name="lecture" id="lecture" required
                                           placeholder="Course Lecture Time" value="{{ old('lecture') }}"/>
                                    @error('lecture')
                                    <small style="color:red; font-weight:500">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Course Poster Image -->
                        <div class="form-group">
                            <label for="image">Course Poster Image</label>
                            <input type="file" class="form-control" id="image" accept="image/*" required name="image">
                            @error('image')
                            <small style="color:red; font-weight:500">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="card-action">
                            <button type="submit" class="btn btn-primary">Add Course</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
