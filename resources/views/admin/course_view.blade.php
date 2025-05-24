@extends('admin.app')

@section('content')

            <div class="row" style="margin:10px">
                <div class="col-md-11">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Add Course</div>
                        </div>
                        <div class="card-body">
                           <form action="{{route('course.add')}}" method="post" enctype="multipart/form-data">
                               @csrf
                           <div class="form-group">
                                <label for="email2">Course Title</label>
                                <input type="text" class="form-control" id="email2" required name="title" placeholder="Enter  Course Title">
                                <small style="color:red; font-weight:500">
                                @error('title')
                                {{$message}}
                                @enderror
                                </small>

                            </div>
                            <div class="form-group">
                                <select class="form-control" name="category" id="validationCustom02"  required>
                                <option disabled selected >Select Course Category</option>
                                @if(count($categories) > 0)
                                @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                                @else
                                <option disabled>No Category</option>
                                @endif
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="email2">Description</label>
                                <textarea rows="5" type="text" class="form-control" id="email2" required name="description" placeholder="Enter Course Description"></textarea>
                                <small style="color:red; font-weight:500">
                                @error('description')
                                {{$message}}
                                @enderror
                                </small>
                            </div>

                               <div class="form-group">
                                   <label for="email2">Description Corporate</label>
                                   <textarea rows="5" type="text" class="form-control" id="email2" required name="description_corp" placeholder="Enter Course Description Corporate"></textarea>
                                   <small style="color:red; font-weight:500">
                                       @error('description')
                                       {{$message}}
                                       @enderror
                                   </small>
                               </div>


                               <div class="form-group">
                                <label for="email2">Certification</label>
                                <textarea rows="5" type="text" class="form-control" id="email2" required name="certification" placeholder="Enter Course Certification"></textarea>
                                <small style="color:red; font-weight:500">
                                @error('certification')
                                {{$message}}
                                @enderror
                                </small>
                            </div>

                            <div class="form-group">
                                <label for="email2">Experience</label>
                                <textarea rows="5" type="text" class="form-control" id="email2" required name="experience" placeholder="Enter Course Experience"></textarea>
                                <small style="color:red; font-weight:500">
                                @error('experience')
                                {{$message}}
                                @enderror
                                </small>
                            </div>

                            <div class="form-group">
                                <label for="email2">Support</label>
                                <textarea rows="5" type="text" class="form-control" id="email2" required name="support" placeholder="Enter Course Support"></textarea>
                                <small style="color:red; font-weight:500">
                                @error('support')
                                {{$message}}
                                @enderror
                                </small>

                            </div>

                            <div class="row">
                                <div class="col-lg-4">
                                <div class="form-group">
                                <label for="email2">Course Level</label>
                                    <select class="form-control" name="level" id="validationCustom02"  required>
                                    <option disabled selected >Select Course Level</option>
                                    <option value="Beginner">Beginner</option>
                                    <option value="Intermediate">Intermediate</option>
                                    <option value="Expert">Expert</option>
                                    </select>
                                </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="form-group">
                                    <label for="email2">Course Duration in (weeks)</label>
                                        <input class="form-control" type="number" name="duration"  placeholder=" Course Duration"/>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                    <label for="email2">Course Language</label>
                                        <input class="form-control" type="text" name="language"  placeholder="Course Language"/>
                                    </div>
                                </div>

                            </div>


                               <div class="row">

                                   <div class="col-lg-6">
                                       <div class="form-group">
                                           <label for="email2">Corporate Course Display</label>
                                           <input class="form-control" type="checkbox" name="corporate_display" value="yes"/>
                                       </div>
                                   </div>
                                   <div class="col-lg-4">
                                       <div class="form-group">
                                           <label for="email2">Normal Course Display</label>
                                           <input class="form-control" type="checkbox" name="normal_display" value="yes"/>
                                       </div>
                                   </div>

                               </div>

                            <div class="row">
                                <div class="col-lg-6">
                                <div class="form-group">
                                <label for="email2">Course Cohort</label>
                                <select class="form-control" name="cohort" id="validationCustom02"  required>
                                <option disabled selected >Select Course Cohort</option>
                                @if(count($cohorts) > 0)
                                @foreach($cohorts as $cohort)
                                <option value="{{$cohort->id}}">{{$cohort->name}}</option>
                                @endforeach
                                @else
                                <option disabled>No Cohort</option>
                                @endif
                                </select>
                            </div>

                            </div>


                                <div class="col-lg-6">
                                    <div class="form-group">
                                    <label for="email2">Course Start Date</label>
                                        <input class="form-control" type="date" name="start_date" required  placeholder="Course Start Date"/>
                                    </div>
                                </div>

                            </div>


                            <div class="row">
                                <div class="col-lg-4">
                                <div class="form-group">
                                <label for="email2">Course Price in Naira</label>
                                <input class="form-control" type="number" name="price"  placeholder=" Course Price"/>
                                </div>
                            </div>

                                <div class="col-lg-4">
                                    <div class="form-group">
                                    <label for="email2">Course Price Discount (%)</label>
                                        <input class="form-control" type="number" name="discount"  placeholder=" Course Price Discount"/>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                    <label for="email2">Course Lecture Time</label>
                                        <input class="form-control" type="text" name="lecture"  placeholder="Course Lecture Time"/>
                                    </div>
                                </div>

                            </div>


                            <div class="form-group">
                                <label for="email2">Course Poster Image</label>
                                <input type="file" class="form-control" id="email2" accept="image/*" required name="image" >
                                <small style="color:red; font-weight:500">
                                @error('image')
                                {{$message}}
                                @enderror
                                </small>

                            </div>

                        </div>
                        <div class="card-action">
                            <button class="btn btn-primary">Add Course</button>

                        </div>
                           </form>
                    </div>

                </div>

            </div>

@endsection
