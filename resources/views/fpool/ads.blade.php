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
                @slot('title') {{__('page.admin.ads.title')}} @endslot
                @slot('body')
                    <form action="{{ route('admin.ad.store') }}" method="POST">
                        @csrf
                        <div class="row mt-3 p-3">
                            <div class="form-group col-lg-6">
                                <label for="home_left_ad">{{__('page.admin.ads.home_left')}}</label>
                                <textarea name="home_left" id="home_left_ad" rows="10"
                                          class="form-control">{{ isset($ad) ? $ad->home_left : '' }}</textarea>
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="home_right_ad">{{__('page.admin.ads.home_right')}}</label>
                                <textarea name="home_right" id="home_right_ad" rows="10"
                                          class="form-control">{{ isset($ad) ? $ad->home_right : '' }}</textarea>
                            </div>
                        </div>

                        <div class="row mt-3 p-3">
                            <div class="form-group col-lg-6">
                                <label for="file_left_ad">{{__('page.admin.ads.file_left')}}</label>
                                <textarea name="file_left" id="file_left_ad" rows="10"
                                          class="form-control">{{ isset($ad) ? $ad->file_left : '' }}</textarea>
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="file_bottom_ad">{{__('page.admin.ads.file_bottom')}}</label>
                                <textarea name="file_bottom" id="file_bottom_ad" rows="10"
                                          class="form-control">{{ isset($ad) ? $ad->file_bottom : '' }}</textarea>
                            </div>
                        </div>

                        <div class="form-group col-lg-12">
                            <label for="mobile_ad">{{__('page.admin.ads.mobile')}}</label>
                            <textarea name="mobile" id="mobile_ad" rows="10"
                                      class="form-control">{{ isset($ad) ? $ad->mobile : '' }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg float-right mr-3">{{__('page.admin.ads.save_button')}}</button>
                    </form>
                @endslot
            @endcomponent
        </div>
    </div>
@endsection
