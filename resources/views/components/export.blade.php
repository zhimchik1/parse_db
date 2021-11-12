<div class="col-md-12">
    <form method="POST" action="{{ route('export') }}">
        @csrf
        <div class="card">
            <div class="card-header">{{ __('Export in File') }}</div>

            <div class="card-body">
                @if(session()->has('status_export'))
                    <div class="alert alert-success">
                        {!! session()->get('status_export') !!}
                    </div>
                @endif
                @if(session()->has('success_removeExport'))
                    <div class="alert alert-success">
                        {!! session()->get('success_removeExport') !!}
                    </div>
                @endif
                @if(session()->has('danger_downloadExportFile'))
                    <div class="alert alert-danger">
                        {!! session()->get('danger_downloadExportFile') !!}
                    </div>
                @endif
                <table id="export" class="table table-bordered dt-responsive nowrap">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>File Name</th>
                        <th>Created</th>
                        <th>Updated</th>
                        <th>Download</th>
                        <th>Delete</th>
                    </tr>
                    </thead>
                    @if (!empty($exportFiles))
                        @foreach($exportFiles as $exportFile)
                            <tr>
                                <td>{{$exportFile->id}}</td>
                                <td>{{$exportFile->file_name}}</td>
                                <td>{{$exportFile->created_at}}</td>
                                <td>{{$exportFile->updated_at}}</td>
                                <td class="text-center">
                                    <a class="btn btn-primary"
                                       href="{{ route('downloadExportFile', ['file' => $exportFile]) }}">
                                        Download
                                    </a>
                                </td>
                                <td class="text-center">
                                    <a class="btn btn-danger"
                                       href="{{ route('removeExport', ['file' => $exportFile]) }}">
                                        Delete
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </table>
                <div class="form-group row mb-0">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Create File Export') }}
                        </button>

                    </div>
                </div>
            </div>
        </div>
        <br>
    </form>
</div>