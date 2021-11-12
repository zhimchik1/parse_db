<div class="col-md-12">
    <form method="POST" action="{{ route('import') }}">
        @csrf
        <div class="card">
            <div class="card-header">{{ __('Files SQL') }}</div>
            @if(session()->has('success_ingest'))
                <div class="alert alert-success">
                    {!! session()->get('success_ingest') !!}
                </div>
            @endif
            @if(session()->has('danger_ingest'))
                <div class="alert alert-danger">
                    {!! session()->get('danger_ingest') !!}
                </div>
            @endif

            @if(session()->has('success_file'))
                <div class="alert alert-success">
                    {!! session()->get('success_file') !!}
                </div>
            @endif
            @if(session()->has('danger_file'))
                <div class="alert alert-danger">
                    {!! session()->get('danger_file') !!}
                </div>
            @endif
            <div class="card-body">
                <table id="files" class="table table-bordered dt-responsive nowrap">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Delete</th>
                        <th>Ingest</th>

                    </tr>
                    @if (!empty($files))
                        @foreach($files as $file)
                            <tr>
                                <td>{{$file}}</td>
                                <td class="text-center">
                                    <a class="btn btn-danger"
                                       href="{{ route('removeSQLFile', ['file' => $file]) }}">
                                        Delete
                                    </a>
                                </td>
                                <td class="text-center"><label>
                                        <input type="checkbox" name="status[]" value="{{$file}}">
                                    </label>
                                </td>

                            </tr>
                        @endforeach
                    @endif
                    </thead>
                </table>

                <div class="form-group row mb-0">
                    <div class="col-md-12 col-md-12 offset-md-10">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Ingest') }}
                        </button>


                    </div>
                </div>

            </div>
        </div>
        <br>
    </form>
</div>
<div class="col-md-12">
    <form method="POST" enctype="multipart/form-data" id="upload-file" action="{{ url('uploadSql') }}">
        @csrf
        <div class="form-group">
            @if(session()->has('status_upload'))
                <div class="alert alert-success">
                    {!! session()->get('status_upload') !!}
                </div>
            @endif
            @error('file')
            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
            <input type="file" name="file" placeholder="Choose file" id="file" required>

            <button type="submit" class="btn btn-primary offset-7"
                    id="submit"> {{ __('Upload') }}</button>
        </div>
        <br>
    </form>
</div>
