@extends('fpool.layouts.app')

@section('content')
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @elseif(session()->has('error'))
        <div class="alert alert-danger">
            {{ session()->get('error') }}
        </div>
    @endif
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            @component('fpool.components.card')
                @slot('title') Manage Ads @endslot
                @slot('body')
                    <form action="{{ route('admin.ad.store') }}" method="POST">
                        @csrf
                        <div class="row mt-3 p-3">
                            <div class="form-group col-lg-6">
                                <label for="home_top_ad">Home Top Ad</label>
                                <textarea name="home_top_ad" id="home_top_ad" rows="10"
                                          class="form-control">{{ isset($ad) ? $ad->home_top_ad : '' }}</textarea>
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="home_bottomad">Home Bottom Ad</label>
                                <textarea name="home_bottom_ad" id="home_bottomad" rows="10"
                                          class="form-control">{{ isset($ad) ? $ad->home_bottom_ad : '' }}</textarea>
                            </div>
                        </div>

                        <div class="row mt-3 p-3">
                            <div class="form-group col-lg-6">
                                <label for="file_left_ad">File Left Ad</label>
                                <textarea name="file_left_ad" id="file_left_ad" rows="10"
                                          class="form-control">{{ isset($ad) ? $ad->file_left_ad : '' }}</textarea>
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="file_bottom_ad">File Bottom Ad</label>
                                <textarea name="file_bottom_ad" id="file_bottom_ad" rows="10"
                                          class="form-control">{{ isset($ad) ? $ad->file_bottom_ad : '' }}</textarea>
                            </div>
                        </div>

                        <div class="form-group col-lg-12">
                            <label for="mobile_ad">Mobile Ad</label>
                            <textarea name="mobile_ad" id="mobile_ad" rows="10"
                                      class="form-control">{{ isset($ad) ? $ad->mobile_ad : '' }}</textarea>
                        </div>
                        <div class="form-group col-lg-12">
                            <label for="download__ad">Download Ad Link</label>
                            <input name="download_ad" id="download__ad" class="form-control" value="{{ isset($ad) ? $ad->download_ad : '' }}">
                        </div>

                        <button type="submit" class="btn btn-primary btn-lg float-right mr-3">Save Ads</button>
                    </form>
                @endslot
            @endcomponent
        </div>
    </div>
@endsection
