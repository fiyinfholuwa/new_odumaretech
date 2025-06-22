@extends('admin.app')

@section('content')

    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- SweetAlert2 for fancy alerts -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <div class="row" style="margin:10px">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header bg-primary">
                    <div class="card-title"><h4 class="text-white">Manage GitHub Link</h4> </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('github.link.add') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="githubLink">GitHub Link</label>
                            <input type="text" class="form-control" id="githubLink"
                                   value="{{ $github_link->link ?? '' }}" name="link" required placeholder="Enter GitHub Link">
                            <small style="color:red; font-weight:500">
                                @error('link') {{ $message }} @enderror
                            </small>
                            @if($github_link)
                                <input type="hidden" name="id" value="{{ $github_link->id }}" />
                            @endif
                        </div>
                        <div class="card-action">
                            <button class="btn btn-success">
                                {{ $github_link ? 'Update Link' : 'Add GitHub Link' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-7">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-secondary">
                            <h4 class="card-title text-white">Check GitHub Link</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="basic-datatables" class="display table table-striped table-hover">
                                    <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>GitHub URL</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php $i = 1; @endphp
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>
                                            @if($github_link)
                                                <a href="{{ $github_link->link }}" target="_blank">{{ $github_link->link }}</a>
                                            @else
                                                No GitHub Link Found
                                            @endif
                                        </td>
                                        <td>
                                            @if($github_link)
                                                <button class="btn btn-sm btn-outline-primary" onclick="copyToClipboard('{{ $github_link->link }}')">
                                                    <i class="fas fa-copy"></i> Copy
                                                </button>
                                            @endif
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>



    

@endsection
