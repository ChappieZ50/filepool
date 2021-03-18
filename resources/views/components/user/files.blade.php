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
                            <div class="fpool-user-image">
                                <div class="fpool-image-delete" id="file_delete" data-id="{{ $file->id }}">
                                    <i data-feather="x"></i>
                                </div>
                                <div class="fpool-image-link">
                                    <i data-feather="link" id="copy" data-clipboard-text="{{ $link }}"></i>
                                </div>

                                <a href="{{ route('file.show',$file->file_id) }}" target="_blank">
                                    <img src="{{ $link }}" alt="{{ $file->file_original_id }}" class="rounded">
                                </a>

                                <div class="fpool-image-bottom">
                                    <div class="bottom-content">
                                        <div class="image-name"
                                             title="{{ $file->file_original_id . '.' . $file->file_mime }}">{{ $file->file_original_id . '.' . $file->file_mime }}</div>
                                        <div class="image-info">
                                            <a href="{{ route('file.download',['file' => $file->file_id]) }}" {{has_ad('download_ad') ? 'onclick=window.open(\''.get_ad('download_ad').'\');' : ''}}>
                                                <i data-feather="download"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endunless
                </div>
                <div class="mx-auto mt-3">
                    {{ $files->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
