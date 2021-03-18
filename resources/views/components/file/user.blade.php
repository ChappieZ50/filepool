<div class="fpool-file-user-container col-xl-3 col-lg-3 col-md-12 col-sm-12">
    <div class="fpool-file-user-content">
        <div class="fpool-user-card"></div>
        <img class="user-avatar" src="{{ avatar_url($user ? $user->avatar : '') }}" alt="avatar">
        <div class="username h4">{{$user ? $user->username : 'Anonymous'}}</div>
        <div class="file-info">
            <ul>
                <li title="{{$file->file_original_id}}">
                    <strong><i data-feather="file-text"></i></strong>
                    <span>{{$file->file_original_id}}</span>
                </li>
                <li>
                    <strong><i data-feather="hard-drive"></i></strong>
                    <span>{{readable_size($file->file_size)}}</span>
                </li>
                <li>
                    <strong><i data-feather="calendar"></i></strong>
                    <span>{{$file->created_at->diffForHumans()}}</span>
                </li>
                <li>
                    <strong><i data-feather="command"></i></strong>
                    <span>{{$file->file_mime}}</span>
                </li>
            </ul>
        </div>
        <a href="{{ route('file.download',$file->file_id) }}" class="btn btn-sm fpool-button mt-3 w-100"
           style="font-size: 14px;" {{has_ad('download_ad') ? 'onclick=window.open(\''.get_ad('download_ad').'\');' : ''}}>
            <i data-feather="download"></i>
            Download
        </a>
    </div>
    @component('components.ads.file.left') @endcomponent
</div>

