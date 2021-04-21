<div class="fpool-file-container col-xl-9 col-lg-9 col-md-12 col-sm-12">
    <div class="fpool-file-content">
        <div class="img-preview text-center">
            <div class="ipool-file-type ipool-file-type-lg ipool-file-{{$file->file_mime}}">
                <div class="file-icon-text">
                    <div>
                        {{$file->file_mime}}
                    </div>
                </div>
            </div>
        </div>
        <div class="file-snap p-4">
            <div class="form-group">
                <label for="fpool_file_url" class="h5">{{__('page.website.user.files.share_link')}}</label>
                <div class="fpool-copy-container">
                    <input type="text" class="form-control" value="{{file_url($file)}}" readonly id="fpool_file_url">
                    <div id="copy_content" class="d-none">{{file_url($file)}}</div>
                    <div class="fpool-copy" id="click_to_copy" data-clipboard-target="#click_to_copy">
                        {{__('page.website.user.files.click_to_copy')}}
                    </div>
                </div>
            </div>
        </div>
        @component('components.ads.file.bottom') @endcomponent
        <div class="h4 text-center">{{__('page.website.user.files.share_with')}}</div>
        <hr>
        @component('components.social-share')
            @slot('text',$file->file_original_id)
            @slot('url',url()->current())
            @slot('media',file_url($file))
        @endcomponent
    </div>
</div>
