<div class="col-md-12">
    <form method="POST" action="{{ route('remove') }}">
        @csrf
        <div class="card">
            <div class="card-header">{{ __('Dumps in Database') }}</div>

            <div class="card-body">
                @if(session()->has('success_dump'))
                    <div class="alert alert-success">
                        {!! session()->get('success_dump') !!}
                    </div>
                @endif
                @if(session()->has('danger_dump'))
                    <div class="alert alert-danger">
                        {!! session()->get('danger_dump') !!}
                    </div>
                @endif
                <table id="dumps" class="table table-bordered dt-responsive nowrap">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>File Name</th>
                        <th>Created</th>
                        <th>Updated</th>
                        <th>Status</th>
                        <th>Delete</th>
                    </tr>
                    </thead>
                    @if (!empty($dumps))
                        @foreach($dumps as $dump)
                            <tr>
                                <td>{{$dump->id}}</td>
                                <td>{{$dump->file_name}}</td>
                                <td>{{$dump->created_at}}</td>
                                <td>{{$dump->updated_at}}</td>
                                <td>{{$dump->status}}</td>
                                <td><label>
                                        <input type="checkbox" name="dump[]" value="{{$dump->id}}">
                                    </label>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </table>
                <div class="form-group row mb-0">
                    <div class="col-md-12 offset-md-10">
                        <button type="submit" class="btn btn-danger">
                            {{ __('Delete') }}
                        </button>

                    </div>
                </div>
            </div>
        </div>
        <br>
    </form>
</div>
