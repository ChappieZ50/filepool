@extends('fpool.layouts.app')

@section('content')
    <div class="row">
        @if (!$user->status)
            <div class="alert alert-danger w-100 ml-3 mr-3">
                "{{ $user->username }}" has been banned
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
                                    <label class="badge badge-info">Admin</label>
                                @else
                                    <label class="badge badge-primary">User</label>
                                @endif
                                @if ($user->status)
                                    <label class="badge badge-success text-white">Active</label>
                                @else
                                    <label class="badge badge-danger text-white">Banned</label>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-9 col-lg-12 col-md-12 col-sm-12 mt-3">
                @component('fpool.components.card')
                    @slot('title', 'User Files')
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
