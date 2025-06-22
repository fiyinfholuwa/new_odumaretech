@extends('user.app')

@section('content')
    <div class="row" style="margin:10px;">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{$course_title->title}}</h4>
                    <div class="bg-white p-3   align-items-center">
                


                <div class="card-body">
                    <div class="table-responsive">
                        <table id="basic-datatables" class="display table table-striped table-hover" >
                            <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>Title</th>
                                    <th>Content</th>
                                    
                                </tr>
                            </thead>
                           
                            <tbody>
                            <?php $i = 1; ?>
                             @foreach($resources as $resource)
                             <tr>
                             
                             <td>{{$i++;}}</td>
                             <td>{{$resource->title}}</td>
                              <td><a target="_blank" class="btn btn-dark" href="{{asset($resource->image)}}">View</a> <a target="_blank" class="btn btn-success" href="{{asset($resource->image)}}" download>Download</a></td>
                            </tr>
                             @endforeach
                            </tbody>
                           
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection