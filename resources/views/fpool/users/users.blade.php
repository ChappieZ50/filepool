@extends('fpool.layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            @component('fpool.components.card')
                @slot('title',__('page.admin.users.title'))
                @slot('searchRoute',route('admin.user.index'))
                @slot('header')
                    <div class="card-right">
                        <button class="btn btn-primary btn-fw btn-lg" data-toggle="modal" data-target="#newUserModal">
                            <i class="mdi mdi-account-plus-outline" style="font-size: 16px;"></i>
                            {{__('page.admin.users.new_user')}}
                        </button>
                    </div>
                @endslot
                @slot('body')
                    @unless(count($users))
                        <h5 class="text-center mt-3">{{__('page.admin.no_record')}}</h5>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover table-striped">
                                <thead>
                                <tr>
                                    <th>{{__('page.admin.users.avatar')}}</th>
                                    <th>{{__('page.admin.users.username')}}</th>
                                    <th>{{__('page.admin.users.email')}}</th>
                                    <th>{{__('page.admin.users.created')}}</th>
                                    <th>{{__('page.admin.users.role')}}</th>
                                    <th>{{__('page.admin.users.status')}}</th>
                                    <th>{{__('page.admin.users.action')}}</th>
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
                                                <label class="badge badge-info">{{__('page.admin.user_admin_role')}}</label>
                                            @else
                                                <label class="badge badge-primary">{{__('page.admin.user_normal_role')}}</label>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($user->status)
                                                <label class="badge badge-success text-white">{{__('page.admin.active')}}</label>
                                            @else
                                                <label class="badge badge-danger text-white">{{__('page.admin.banned')}}</label>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{route('admin.user.edit',$user->id)}}" class="btn btn-primary social-btn" style="padding: 6px 10px;"
                                               title="{{__('page.admin.users.user_edit')}}">
                                                <i class="mdi mdi-circle-edit-outline"></i>
                                            </a>
                                            <a href="{{route('admin.user.show',$user->id)}}" class="btn btn-primary social-btn" style="padding: 6px 10px;"
                                               title="{{__('page.admin.users.user_info')}}">
                                                <i class="mdi mdi-eye"></i>
                                            </a>
                                            @if ($user->status)
                                                <button class="btn btn-danger social-btn" id="ban" style="padding: 6px 10px;"
                                                        title="{{__('page.admin.users.user_ban')}}" data-id="{{ $user->id }}">
                                                    <i class="mdi mdi-block-helper"></i>
                                                </button>
                                            @else
                                                <button class="btn btn-success social-btn" id="unban" style="padding: 6px 10px;"
                                                        title="{{__('page.admin.users.user_unban')}}" data-id="{{ $user->id }}">
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
