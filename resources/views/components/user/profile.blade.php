<div class="fpool-user-container col-xl-10 col-lg-10 col-md-12 col-sm-12">
    <div class="fpool-user">
        <h2 class="fpool-sidebar-title">{{__('page.website.user.profile.title')}}</h2>
        <div class="alert alert-danger" id="user_profile_errors" style="display: none"></div>
        <hr>
        <div class="fpool-user-content">
            <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12">
                <div class="form-group">
                    <label for="user_email">{{__('page.website.user.profile.email')}}</label>
                    <input type="email" class="form-control" name="email" id="user_email" placeholder="{{__('page.website.user.profile.email')}}"
                        value="{{ $user->email }}">
                </div>
                <div class="form-group">
                    <label for="user_username">{{__('page.website.user.profile.username')}}</label>
                    <input type="text" class="form-control" name="username" id="user_username" placeholder="{{__('page.website.user.profile.username')}}"
                        value="{{ $user->username }}">
                </div>
                <button class="btn fpool-button" id="user_update">{{__('page.website.user.profile.user_update_profile')}}</button>
                @if (!auth()->user()->google)
                    <h2 class="user-profile-title mt-5">{{__('page.website.user.profile.security_title')}}</h2>
                    <hr>
                    <div class="form-group mt-4">
                        <input type="password" class="form-control" name="current_password" id="user_current_password"
                            placeholder="{{__('page.website.user.profile.current_password')}}">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="password" id="user_new_password"
                            placeholder="{{__('page.website.user.profile.new_password')}}">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="password_confirmation"
                            id="user_new_password_confirmation" placeholder="{{__('page.website.user.profile.new_password_confirm')}}">
                    </div>
                    <button class="btn fpool-button" id="user_update_password">{{__('page.website.user.profile.user_update_password')}}</button>
                @endif
            </div>
            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 fpool-update-avatar">
                <div class="form-group mx-auto fpool-avatar-area">
                    <div class="fpool-avatar">
                        <img src="{{ avatar_url($user->avatar) }}" alt="{{ $user->username }}" class="user-avatar"
                            id="user_avatar_preview" data-original="{{ avatar_url($user->avatar) }}">

                        <label for="user_avatar" class="btn fpool-button">
                            <i data-feather="edit-2"></i>
                        </label>
                        @if ($user->avatar)
                            <label for="user_delete_avatar" class="btn fpool-button bg-danger fpool-delete-button"
                                id="user_delete_avatar">
                                <i data-feather="trash"></i>
                            </label>
                        @endif
                    </div>
                    <input type="file" class="form-control-file" name="avatar" id="user_avatar" placeholder="Avatar">
                </div>
                <button class="btn fpool-button mx-auto" id="user_update_avatar">{{__('page.website.user.profile.user_update_avatar')}}</button>
            </div>
        </div>
    </div>
</div>
