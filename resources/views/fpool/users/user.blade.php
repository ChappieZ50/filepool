@extends('fpool.layouts.app')

@section('content')
    <div class="row">
        @if (!$user->status)
            <div class="alert alert-danger w-100 ml-3 mr-3">
                "{{ $user->username }}" {{__('page.admin.banned_text')}}
            </div>
        @endif
        <div class="col-lg-12 d-flex justify-content-between flex-wrap mt-3">
            <div class="col-xl-3 col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="user-info">
                            <div class="user-avatar">
                                <img src="{{avatar_url($user->avatar)}}" alt="">
                            </div>
                            <span class="username">{{ $user->username }}</span>
                            <span class="email text-muted small">{{ $user->email }}</span>
                            <div class="user-status">
                                @if ($user->is_admin)
                                    <label class="badge badge-info">{{__('page.admin.user_admin_role')}}</label>
                                @else
                                    <label class="badge badge-primary">{{__('page.admin.user_normal_role')}}</label>
                                @endif
                                @if ($user->status)
                                    <label class="badge badge-success text-white">{{__('page.admin.active')}}</label>
                                @else
                                    <label class="badge badge-danger text-white">{{__('page.admin.banned')}}</label>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-9 col-lg-12 col-md-12 col-sm-12 mt-3">
                @component('fpool.components.card')
                    @slot('title', __('page.admin.users.page_info.title'))
                    @slot('searchRoute', route('admin.user.show',$user->id))
                    @slot('body')
                        @component('fpool.components.files')
                            @slot('files',$files)
                        @endcomponent
                    @endslot
                @endcomponent
            </div>
        </div>
    </div>
@endsection
