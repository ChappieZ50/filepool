<div class="fpool-user-container col-xl-10 col-lg-10 col-md-12 col-sm-12">
    <div class="fpool-user">
        <h2 class="fpool-sidebar-title">My Files</h2>
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
                            <a href="{{ route('file.show',$file->file_id) }}" target="_blank" class="ipool-file-wrapper shadow-sm">
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
                            </a>
                        @endforeach
                    @endunless
                </div>
            </div>
            <div class="mx-auto mt-3">
                {{ $files->links() }}
            </div>
        </div>
    </div>
</div>
