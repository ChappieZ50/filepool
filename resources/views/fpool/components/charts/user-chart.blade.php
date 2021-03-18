<div class="col-lg-6 grid-margin stretch-card">
    <div class="card">
        <div class="p-4 border-bottom bg-light">
            <h4 class="card-title mb-0">Statics of users</h4>
        </div>
        <div id="user_chart"></div>
    </div>
</div>
<div class="col-lg-6 grid-margin stretch-card">
    <div class="card">
        <div class="p-4 border-bottom bg-light d-flex justify-content-between">
            <h4 class="card-title mb-0">Latest users</h4>
            <a href="{{ route('admin.user.index') }}" class="btn btn-primary btn-fw">
                <span>Show All Users</span>
                <i class="mdi mdi-arrow-right"></i>
            </a>
        </div>
        <div class="latest-items">
            @unless(count($users))
                <h5 class="text-center mt-3">No Records Found</h5>
            @else
                @foreach ($users as $user)
                    <div class="latest-item d-flex align-items-center p-3">
                        <div class="user-avatar mr-3">
                            <img src="{{ avatar_url($user->avatar) }}" alt="{{ $user->username }}"
                                style="width: 50px;height: 50px;">
                        </div>
                        <div class="item-content d-flex justify-content-between align-items-center w-100">
                            <div class="user-name d-flex flex-column">
                                <div class="user-name-content">
                                    <a href="{{ route('admin.user.show', $user->id) }}" target="_blank">
                                        <strong>{{ $user->username }}</strong>
                                    </a>
                                    <span class="text-muted" style="font-size: 14px;">Just register.</span>
                                </div>
                                <small class="text-muted">
                                    {{ $user->created_at->diffForHumans() }}
                                </small>
                            </div>
                            @if (!$user->status)
                                <label class="badge badge-danger text-white">Banned</label>
                            @endif
                        </div>
                    </div>
                @endforeach
            @endunless
        </div>
    </div>
</div>
