@extends('fpool.layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            @component('fpool.components.card')
                @slot('title','Messages')
                @slot('body')
                    @unless(count($messages))
                        <h5 class="text-center mt-3">No Records Found</h5>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover table-striped">
                                <thead>
                                <tr>
                                    <th>Avatar</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Created</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($messages as $message)
                                    <tr>
                                        <td>
                                            @if($message->user && $message->user->avatar)
                                                <img src="{{avatar_url($message->user->avatar)}}" alt="{{ $message->user->username }}">
                                            @else
                                                <img src="{{ asset('assets/images/avatar.png') }}"
                                                     alt="{{ $message->name }}">
                                            @endif
                                        </td>
                                        <td>{{ $message->name }}</td>
                                        <td>{{ $message->email }}</td>
                                        <td>{{ $message->created_at->diffForHumans() }}</td>
                                        <td>
                                            <a href="{{route('admin.message.show',$message->id)}}" class="btn btn-primary social-btn" style="padding: 6px 10px;"
                                               title="Message Info">
                                                <i class="mdi mdi-eye"></i>
                                            </a>
                                            <button class="btn btn-danger social-btn" id="message_delete" style="padding: 6px 10px;"
                                                    title="Delete this message" data-id="{{ $message->id }}">
                                                <i class="mdi mdi-delete-outline"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-center mt-4">
                            {{ $messages->appends(['s' => request()->get('s')])->links() }}
                        </div>
                    @endunless
                @endslot
            @endcomponent
        </div>
    </div>
@endsection
