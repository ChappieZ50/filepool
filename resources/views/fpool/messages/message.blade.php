@extends('fpool.layouts.app')

@section('content')
    <div class="row">
        @if ($message->user  && !$message->user->status)
            <div class="alert alert-danger w-100 ml-3 mr-3">
                "{{ $message->user->username }}" {{__('page.admin.banned_text')}}
            </div>
        @endif
        <div class="col-lg-12 d-flex justify-content-between flex-wrap mt-3">
            <div class="col-xl-3 col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="user-info">
                            <div class="user-avatar">
                                @if($message->user)
                                    <img src="{{avatar_url($message->user->avatar)}}" alt="{{ $message->user->username }}">
                                @else
                                    <img src="{{ asset('assets/images/avatar.png') }}"
                                         alt="{{ $message->name }}">
                                @endif

                            </div>
                            @if ($message->user)
                                <a href="{{ route('admin.user.show', $message->user->id) }}">
                                    <span class="username">{{ $message->user->username }}</span>
                                </a>
                                <span class="email text-muted small">{{ $message->user->email }}</span>

                            @else
                                <span class="username">{{ $message->name }}</span>
                                <span class="email text-muted small">{{ $message->email }}</span>
                            @endif

                            <div class="user-status">
                                @if (!$message->user)
                                    <label class="badge badge-warning text-white">Anonymous</label>
                                @else
                                    @if($message->user->is_admin)
                                        <label class="badge badge-info">{{__('page.admin.user_admin_role')}}</label>
                                    @else
                                        <label class="badge badge-primary">{{__('page.admin.user_normal_role')}}</label>
                                    @endif
                                @endif
                                @if ($message->user && $message->user->status)
                                    <label class="badge badge-success text-white">{{__('page.admin.active')}}</label>
                                @elseif($message->user && !$message->user->status)
                                    <label class="badge badge-danger text-white">{{__('page.admin.banned')}}</label>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-9 col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            <h4 class="h4">{{$message->subject}}</h4>
                        </div>
                    </div>
                    <div class="card-body" style="padding: 1.88rem 1.81rem !important;">
                        {{$message->message}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
