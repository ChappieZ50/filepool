@extends('fpool.layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            @component('fpool.components.card')
                @slot('title','Users')
                @slot('searchRoute',route('admin.user.index'))
                @slot('header')
                    <div class="card-right">
                        <button class="btn btn-primary btn-fw btn-lg" data-toggle="modal" data-target="#newUserModal">
                            <i class="mdi mdi-account-plus-outline" style="font-size: 16px;"></i>
                            New User
                        </button>
                    </div>
                @endslot
                @slot('body')
                    @unless(count($users))
                        <h5 class="text-center mt-3">No Records Found</h5>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover table-striped">
                                <thead>
                                <tr>
                                    <th>Avatar</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Created</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>
                                            <img src="{{ avatar_url($user->avatar) }}" alt="{{ $user->username }}">
                                        </td>
                                        <td>{{ $user->username }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->created_at->diffForHumans() }}</td>
                                        <td>
                                            @if ($user->is_admin)
                                                <label class="badge badge-info">Admin</label>
                                            @else
                                                <label class="badge badge-primary">User</label>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($user->status)
                                                <label class="badge badge-success text-white">Active</label>
                                            @else
                                                <label class="badge badge-danger text-white">Banned</label>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{route('admin.user.show',$user->id)}}" class="btn btn-primary social-btn" style="padding: 6px 10px;"
                                               title="User Info">
                                                <i class="mdi mdi-eye"></i>
                                            </a>
                                            @if ($user->status)
                                                <button class="btn btn-danger social-btn" id="ban" style="padding: 6px 10px;"
                                                        title="Ban this user" data-id="{{ $user->id }}">
                                                    <i class="mdi mdi-block-helper"></i>
                                                </button>
                                            @else
                                                <button class="btn btn-success social-btn" id="unban" style="padding: 6px 10px;"
                                                        title="Unban this user" data-id="{{ $user->id }}">
                                                    <i class="mdi mdi-block-helper"></i>
                                                </button>
                                            @endif

                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-center mt-4">
                            {{ $users->appends(['s' => request()->get('s')])->links() }}
                        </div>
                    @endunless
                @endslot
            @endcomponent
        </div>
    </div>


    @include('fpool.components.modals.new-user')
@endsection
