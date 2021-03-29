<div class="fpool-user-container col-xl-10 col-lg-10 col-md-12 col-sm-12">
    <div class="fpool-user">
        <div class="fpool-user-header d-flex align-items-center justify-content-center justify-content-md-between flex-wrap">
            <h2 class="fpool-sidebar-title">My Files</h2>
            <div class="fpool-files-expire">
                <ul>
                    <li>
                        <a href="{{route('user.files')}}" class="{{empty(request()->get('expire')) ? 'active' : ''}}">All</a>
                    </li>
                    <li>
                        <a href="{{route('user.files',['expire' => 'never'])}}" class="{{request()->get('expire') == 'never' ? 'active' : ''}}">Never</a>
                    </li>
                    <li>
                        <a href="{{route('user.files',['expire' => '30'])}}" class="{{request()->get('expire') == '30' ? 'active' : ''}}">30D</a>
                    </li>
                    <li>
                        <a href="{{route('user.files',['expire' => '15'])}}" class="{{request()->get('expire') == '15' ? 'active' : ''}}">15D</a>
                    </li>
                    <li>
                        <a href="{{route('user.files',['expire' => '7'])}}" class="{{request()->get('expire') == '7' ? 'active' : ''}}">7D</a>
                    </li>
                    <li>
                        <a href="{{route('user.files',['expire' => '1'])}}" class="{{request()->get('expire') == '1' ? 'active' : ''}}">1D</a>
                    </li>
                </ul>
            </div>
        </div>
        <hr>
        <div class="fpool-user-content">
            <svg class="fpool-spinner" viewBox="0 0 50 50">
                <circle class="path" cx="25" cy="25" r="20" fill="none" stroke-width="5"></circle>
            </svg>
            <div class="fpool-images-wrapper">
                <div class="col-12 fpool-images-content">
                    @unless(count($files))
                        <div class="empty-images">
                            <img src="{{ asset('assets/images/empty-files.svg') }}" alt="empty file" class="img-fluid">
                            <h5>
                                No files found
                            </h5>
                            <p>
                                You can upload some files from <a href="{{ route('home') }}">here.</a>
                            </p>
                        </div>

                    @else
                        @foreach ($files as $file)
                            @php $link = file_url($file); @endphp

                            <div class="ipool-file-wrapper shadow-sm">
                                <button type="button" class="btn fpool-button btn-sm file-actions" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
                                        <path
                                            d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"></path>
                                    </svg>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{ route('file.show',$file->file_id) }}" target="_blank">View</a>
                                    <a class="dropdown-item" href="javascript:;" data-id="{{$file->file_id}}"
                                       data-mime="{{$file->file_mime}}" id="download_file" data-direct="true">Download</a>
                                    <div class="dropdown-divider"></div>
                                    @if($file->password)
                                        <a class="dropdown-item" href="javascript:;" id="show_file_password" data-id="{{$file->file_id}}">Show Password</a>
                                    @endif
                                    <a class="dropdown-item text-danger" href="javascript:;" id="file_delete" data-id="{{$file->file_id}}">Delete File</a>
                                </div>
                                <div class="ipool-file-type ipool-file-{{$file->file_mime}}">
                                    <div class="file-icon-text">
                                        <div>
                                            {{$file->file_mime}}
                                        </div>
                                    </div>
                                    <div class="ipool-file-text">
                                        {{str_limit($file->file_original_id,8,'..')}}.{{$file->file_mime}}
                                    </div>
                                </div>
                                @if($file->password)
                                    <div class="fpool-file-locked">
                                        <i data-feather="lock"></i>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    @endunless
                </div>
            </div>
            <div class="mx-auto mt-3">
                {{ $files->appends(['expire'=>request()->get('expire')])->links() }}
            </div>
        </div>
    </div>
</div>
