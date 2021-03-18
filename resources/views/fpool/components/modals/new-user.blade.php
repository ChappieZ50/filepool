@component('fpool.components.modals.modal')
    @slot('id','newUserModal')
    @slot('title','New User')
    @slot('body')
        <div id="new_user_modal">
            <div class="mt-2 mb-4 alert alert-danger w-100 d-none" id="non_error" role="alert"></div>

            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" name="username" id="username" placeholder="Username">
            </div>
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="Email Address">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Password">
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirm Password</label>
                <input type="password" class="form-control" name="password_confirmation" id="confirm_password"
                       placeholder="Confirm Password">
            </div>
            <div class="form-group">
                <div class="form-check form-check-flat">
                    <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="is_admin" id="is_admin">
                        Is Admin User
                    </label>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-secondary btn-lg" data-dismiss="modal">Close</button>
                <button class="btn btn-primary btn-lg" id="add_new_user">Create User</button>
            </div>
        </div>
    @endslot
@endcomponent
