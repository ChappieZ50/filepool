@unless(count($files))
    <h5 class="text-center mt-3">No Records Found</h5>
@else
    <div class="table-responsive">
        <table class="table table-hover table-striped">
            <thead>
            <tr>
                <th>{{__('page.admin.file_table.preview')}}</th>
                @isset($username)
                    <th>{{__('page.admin.file_table.username')}}</th>
                @endisset
                <th>{{__('page.admin.file_table.name')}}</th>
                <th>{{__('page.admin.file_table.original_name')}}</th>
                <th>{{__('page.admin.file_table.size')}}</th>
                <th>{{__('page.admin.file_table.created')}}</th>
                <th>{{__('page.admin.file_table.expire')}}</th>
                <th>{{__('page.admin.file_table.action')}}</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($files as $file)
                <tr>
                    <td>
                        <a href="{{ route('admin.file.show', $file->id) }}">
                            <div class="ipool-file-type ipool-file-type-sm ipool-file-{{$file->file_mime}}">
                                <div class="file-icon-text">
                                    <div>
                                        {{$file->file_mime}}
                                    </div>
                                </div>
                            </div>
                        </a>
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
                    <td><strong>{{ empty($file->expire) ? '~' : \Illuminate\Support\Carbon::create($file->expire)->diffForHumans() }}</strong></td>

                    <td>
                        <a href="{{ route('admin.file.show', $file->id) }}" class="btn btn-primary social-btn"
                           style="padding: 6px 10px;" title="{{__('page.admin.file_table.file_info')}}">
                            <i class="mdi mdi-eye"></i>
                        </a>
                        <button class="btn btn-danger social-btn" id="file_delete" style="padding: 6px 10px;"
                                title="{{__('page.admin.file_table.delete_file')}}" data-id="{{ $file->id }}">
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
