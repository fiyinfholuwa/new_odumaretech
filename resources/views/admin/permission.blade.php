@extends('admin.app')

@section('content')
    <div class="row" style="margin:10px">

        <section class="section">
            <div class="row">
                @if($role->permission == NULL)
                    <div class="col-lg-8">

                        <div class="card">
                            <div class="card-body">
                                {{--              <h5 class="card-title">Set Permission for  <span class="text-danger">{{$role->name}}</span></h5>--}}
                                <div class="">

                                    <form action="{{route('role.permission.set', $role->id)}}" method="post" class="row g-3">
                                        @csrf
                                        <div class="col-md-12 col-lg-12">

                                            <div class="mt-1">
                                                <label for="checkbox">Manage Applications:</label>
                                                <input type="checkbox" value="manage_applications" id="checkbox" name="permission[]">
                                            </div>

                                            <div class="mt-1">
                                                <label for="checkbox">Manage Courses:</label>
                                                <input type="checkbox" value="manage_courses" id="checkbox" name="permission[]">
                                            </div>

                                            <div class="mt-1">
                                                <label for="checkbox">Manage Blog & News:</label>
                                                <input type="checkbox" value="manage_blog_&_news" id="checkbox" name="permission[]">
                                            </div>


                                            <div class="mt-1">
                                                <label for="checkbox">Manage Users:</label>
                                                <input type="checkbox" value="manage_users" id="checkbox" name="permission[]">
                                            </div>

                                            <div class="mt-1">
                                                <label for="checkbox">Manage Testimonials:</label>
                                                <input type="checkbox" value="manage_testimonials" id="checkbox" name="permission[]">
                                            </div>


                                            <div class="mt-1">
                                                <label for="checkbox">Manage FAQs:</label>
                                                <input type="checkbox" value="manage_faqs" id="checkbox" name="permission[]">
                                            </div>

                                            <div class="mt-1">
                                                <label for="checkbox">Manage Resources:</label>
                                                <input type="checkbox" value="manage_resources" id="checkbox" name="permission[]">
                                            </div>

                                            <div class="mt-1">
                                                <label for="checkbox">Manage Destinations:</label>
                                                <input type="checkbox" value="manage_destinations" id="checkbox" name="permission[]">
                                            </div>


                                            <div class="mt-1">
                                                <label for="checkbox">Manage Counsellor:</label>
                                                <input type="checkbox" value="manage_counsellor" id="checkbox" name="permission[]">
                                            </div>

                                            <div class="mt-1">
                                                <label for="checkbox">Manage Settings:</label>
                                                <input type="checkbox" value="manage_settings" id="checkbox" name="permission[]">
                                            </div>

                                            <div class="text-left">
                                                <button type="submit" class="btn btn-primary">Set Permission</button>
                                            </div>
                                    </form><!-- End Multi Columns Form -->


                                </div>
                            </div>


                        </div>
                    </div>
            </div>
            @else
                <div class="col-lg-8">

                    <div class="card">
                        <div class="card-body">
                            {{--            <h5 class="card-title">Set Permission for <span class="text-danger">{{$role->name}}</span></h5>--}}
                            <div class="">

                                <form action="{{route('role.permission.set', $role->id)}}" method="post" class="row g-3">
                                    @csrf
                                    <div class="col-md-12 col-lg-12">
                                        @php
                                            $permissionsFromDB = json_decode($role->permission);

                                          $allPermissions = ['manage_applications', 'manage_courses',  'manage_blog_&_news', 'manage_users', 'manage_testimonials', 'manage_counsellor', 'manage_faqs', 'manage_resources', 'manage_destinations', 'manage_counsellor', 'manage_settings'];
                                        @endphp
                                        @foreach($allPermissions as $permission)
                                            <div class="mt-1">
                                                @php

                                                    $label = str_replace('_', ' ', $permission);
                                                @endphp
                                                <label for="{{$permission}}">{{$label}}</label>

                                                <input type="checkbox" value="{{$permission}}" id="{{$permission}}" name="permission[]" {{ in_array($permission, $permissionsFromDB) ? 'checked' : '' }}>
                                            </div>
                                        @endforeach

                                    </div>

                                    <div class="text-left">
                                        <button type="submit" class="btn btn-primary">Set Permission</button>
                                    </div>
                                </form><!-- End Multi Columns Form -->


                            </div>
                        </div>


                    </div>
                </div>

            @endif
        </section>

    </div>
@endsection
