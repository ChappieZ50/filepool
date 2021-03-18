@unless(count($files))
    <h5 class="text-center mt-3">No Records Found</h5>
@else
    <div class="table-responsive">
        <table class="table table-hover table-striped">
            <thead>
            <tr>
                <th>Preview</th>
                @isset($username)
                    <th>Username</th>
                @endisset
                <th>Name</th>
                <th>Original Name</th>
                <th>Size</th>
                <th>Created</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($files as $file)
                <tr>
                    <td>
                        <img src="{{ file_url($file) }}" alt="{{ $file->file_id }}" class="table-image file-image">
                    </td>
                    @isset($username)
                        <td>
                            @if($file->user)
                                <a href="{{ route('admin.user.show',$file->user->id) }}" target="_blank">{{ $file->user->username }}</a>
                            @else
                                Anonymous
                            @endif
                        </td>
                    @endisset
                    <td>{{ $file->file_id }}</td>
                    <td title="{{$file->file_original_id}}">{{ str_limit($file->file_original_id) }}</td>
                    <td>{{ readable_size($file->file_size) }}</td>
                    <td>{{ $file->created_at->diffForHumans() }}</td>

                    <td>
                        <a href="{{ route('admin.file.show', $file->id) }}" class="btn btn-primary social-btn"
                           style="padding: 6px 10px;" title="File info">
                            <i class="mdi mdi-eye"></i>
                        </a>
                        <button class="btn btn-danger social-btn" id="file_delete" style="padding: 6px 10px;"
                                title="Delete this file" data-id="{{ $file->id }}">
                            <i class="mdi mdi-delete-outline"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-center mt-4">
        {{ $files->appends(['s' => request()->get('s')])->links() }}
    </div>
@endunless
