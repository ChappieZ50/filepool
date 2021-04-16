@extends('fpool.layouts.app')

@section('content')
    <div class="row">
        @if (!$user->status)
            <div class="alert alert-danger w-100 ml-3 mr-3">
                "{{ $user->username }}" has been banned
            </div>
        @endif
        <div class="col-lg-12 grid-margin stretch-card">
            @component('fpool.components.card')
                @slot('title',$user->username.' | Updating')
                @slot('body')
                    <form action="{{route('admin.user.update',$user->id)}}" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="col-xl-6  col-lg-12 mt-5 mx-auto">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" id="username" name="username" value="{{$user->username}}">
                                @error('username')
                                <span class="invalid-feedback d-block mt-1 ml-2" role="alert">
                                   <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email">Username</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{$user->email}}">
                                @error('email')
                                <span class="invalid-feedback d-block mt-1 ml-2" role="alert">
                                   <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="storage_limit">Storage Limit</label>
                                <input type="text" class="form-control" id="storage_limit" name="storage_limit" value="{{bytes_to_mb($user->storage_limit)}}">
                                <span class="text-muted small">MB</span>
                                @error('storage_limit')
                                <span class="invalid-feedback d-block mt-1 ml-2" role="alert">
                                   <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>
                            @error('is_admin')
                            <span class="invalid-feedback d-block mt-1 ml-2" role="alert">
                                   <strong>{{$message}}</strong>
                                </span>
                            @enderror
                            @error('is_premium')
                            <span class="invalid-feedback d-block mt-1 ml-2" role="alert">
                                   <strong>{{$message}}</strong>
                                </span>
                            @enderror
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <div class="form-check form-check-flat">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input" name="is_admin" id="is_admin" {{$user->is_admin ? 'checked' : ''}}>
                                            Admin User
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <div class="form-check form-check-flat">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input" name="is_premium" id="is_premium" {{$user->is_premium ? 'checked' : ''}}>
                                            Premium User
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-danger btn-lg float-left" id="delete_user_avatar" data-id="{{$user->id}}">Delete Avatar</button>
                            <button type="submit" class="btn btn-primary btn-lg float-right">Update User</button>
                        </div>
                    </form>
                @endslot
            @endcomponent
        </div>
    </div>
@endsection
