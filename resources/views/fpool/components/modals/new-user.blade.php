@component('fpool.components.modals.modal')
    @slot('id','newUserModal')
    @slot('title',__('page.admin.users.modal.title'))
    @slot('body')
        <div id="new_user_modal">
            <div class="mt-2 mb-4 alert alert-danger w-100 d-none" id="non_error" role="alert"></div>

            <div class="form-group">
                <label for="username">{{__('page.admin.users.modal.username')}}</label>
                <input type="text" class="form-control" name="username" id="username" placeholder="{{__('page.admin.users.modal.username')}}">
            </div>
            <div class="form-group">
                <label for="email">{{__('page.admin.users.modal.email')}}</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="{{__('page.admin.users.modal.email')}}">
            </div>
            <div class="form-group">
                <label for="password">{{__('page.admin.users.modal.password')}}</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="{{__('page.admin.users.modal.password')}}">
            </div>
            <div class="form-group">
                <label for="confirm_password">{{__('page.admin.users.modal.password_confirm')}}</label>
                <input type="password" class="form-control" name="password_confirmation" id="confirm_password"
                       placeholder="{{__('page.admin.users.modal.password_confirm')}}">
            </div>
            <div class="form-group">
                <div class="form-check form-check-flat">
                    <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="is_admin" id="is_admin">
                        {{__('page.admin.users.modal.is_admin')}}
                    </label>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-secondary btn-lg" data-dismiss="modal">{{__('page.admin.users.modal.close_button')}}</button>
                <button class="btn btn-primary btn-lg" id="add_new_user">{{__('page.admin.users.modal.create_button')}}</button>
            </div>
        </div>
    @endslot
@endcomponent
