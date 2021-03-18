<div class="col-lg-6 grid-margin stretch-card">
    <div class="card">
        <div class="p-4 border-bottom bg-light">
            <h4 class="card-title mb-0">Statics of uploads</h4>
        </div>
        <div id="file_chart"></div>
    </div>
</div>
<div class="col-lg-6 grid-margin stretch-card">
    <div class="card">
        <div class="p-4 border-bottom bg-light d-flex justify-content-between">
            <h4 class="card-title mb-0">Latest images</h4>
            <a href="{{ route('admin.file.index') }}" class="btn btn-primary btn-fw">
                <span>Show All Images</span>
                <i class="mdi mdi-arrow-right"></i>
            </a>
        </div>
        <div class="latest-items">
            @unless(count($files))
                <h5 class="text-center mt-3">No Records Found</h5>
            @else
                @foreach ($files as $file)
                    <div class="latest-item d-flex justify-content-between align-items-center p-3">

                        <div class="item-left d-flex">
                            <div class="user-avatar">
                                <img src="{{ $file->user ? avatar_url($file->user->avatar) : avatar_url('') }}"
                                    alt="{{ $file->file_id }}" style="width: 50px;height: 50px;">
                            </div>
                            <div class="item-content d-flex flex-column ml-3">
                                <div class="user-name">
                                    @if ($file->user)
                                        <a href="{{ route('admin.user.show', $file->user_id) }}" target="_blank">
                                            <strong>{{ $file->user->username }}</strong>
                                        </a>
                                    @else
                                        <strong>Anonymous</strong>
                                    @endif

                                </div>
                                <div class="file-name">
                                    <small>Uploaded this image: <a href="{{ route('admin.file.show', $file->id) }}"
                                            target="_blank" title="{{$file->file_original_id . '.' . $file->file_mime}}">{{ str_limit($file->file_original_id . '.' . $file->file_mime) }}</a></small>
                                </div>
                            </div>
                        </div>
                        <div class="item-right small">
                            {{ $file->created_at->diffForHumans() }}
                        </div>
                    </div>
                @endforeach
            @endunless
        </div>
    </div>
</div>
