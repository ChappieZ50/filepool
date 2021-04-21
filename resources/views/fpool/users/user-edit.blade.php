@extends('fpool.layouts.app')

@section('content')
    @if(session()->has('success'))
        <div class="alert alert-success">
            {{session()->get('success')}}
        </div>
    @elseif(session()->has('error'))
        <div class="alert alert-danger">
            {{session()->get('error')}}
        </div>
    @endif
    <div class="row">
        @if (!$user->status)
            <div class="alert alert-danger w-100 ml-3 mr-3">
                "{{ $user->username }}" {{__('page.admin.banned_text')}}
            </div>
        @endif
        <div class="col-lg-12 grid-margin stretch-card">
            @component('fpool.components.card')
                @slot('title',$user->username.' | '.__('page.admin.users.page_edit.title'))
                @slot('body')
                    <form action="{{route('admin.user.update',$user->id)}}" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="col-xl-6  col-lg-12 mt-5 mx-auto">
                            <div class="form-group">
                                <label for="username">{{__('page.admin.users.page_edit.username')}}</label>
                                <input type="text" class="form-control" id="username" name="username" value="{{$user->username}}">
                                @error('username')
                                <span class="invalid-feedback d-block mt-1 ml-2" role="alert">
                                   <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email">{{__('page.admin.users.page_edit.email')}}</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{$user->email}}">
                                @error('email')
                                <span class="invalid-feedback d-block mt-1 ml-2" role="alert">
                                   <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="storage_limit">{{__('page.admin.users.page_edit.storage_limit')}}</label>
                                <input type="text" class="form-control" id="storage_limit" name="storage_limit" value="{{bytes_to_mb($user->storage_limit)}}">
                                <span class="text-muted small">MB</span>
                                @error('storage_limit')
                                <span class="invalid-feedback d-block mt-1 ml-2" role="alert">
                                   <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <div class="form-check form-check-flat">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input" name="is_admin" id="is_admin" {{$user->is_admin ? 'checked' : ''}}>
                                            {{__('page.admin.users.page_edit.admin_user')}}
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <div class="form-check form-check-flat">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input" name="is_premium" id="is_premium" {{$user->is_premium ? 'checked' : ''}}>
                                            {{__('page.admin.users.page_edit.premium_user')}}
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-danger btn-lg float-left" id="delete_user_avatar" data-id="{{$user->id}}">{{__('page.admin.users.page_edit.delete_avatar_button')}}</button>
                            <button type="submit" class="btn btn-primary btn-lg float-right">{{__('page.admin.users.page_edit.update_button')}}</button>
                        </div>
                    </form>
                @endslot
            @endcomponent
        </div>
    </div>
@endsection
