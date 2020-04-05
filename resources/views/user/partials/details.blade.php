<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="first_name">@lang('Role')</label>
            {!! Form::select('role_id', $roles, $edit ? $user->role->ref_role : '',
                ['class' => 'custom-select', 'id' => 'role_id', $profile ? 'disabled' : '']) !!}
        </div>

        @if(!$edit)
        <div class="form-group">
            <label for="id_direc">@lang('Direction')</label>
            {!! Form::select('id_direc', $directions, $edit ? $user->direction->id : '',
                ['class' => 'custom-select', 'id' => 'id_direc', $profile ? 'disabled' : '']) !!}
        </div>
        @endif

        <div class="form-group">
            <label for="status">@lang('Status')</label>
            {!! Form::select('status', $statuses, $edit ? $user->status : '',
                ['class' => 'custom-select', 'id' => 'status', $profile ? 'disabled' : '']) !!}
        </div>
        <div class="form-group">
            <label for="first_name">@lang('First Name')</label>
            <input type="text" class="form-control input-solid" id="first_name"
                   name="first_name" placeholder="@lang('First Name')" value="{{ $edit ? $user->first_name : '' }}">
        </div>
        <div class="form-group">
            <label for="last_name">@lang('Last Name')</label>
            <input type="text" class="form-control input-solid" id="last_name"
                   name="last_name" placeholder="@lang('Last Name')" value="{{ $edit ? $user->last_name : '' }}">
        </div>
    </div>

    @if ($edit)
        <div class="col-md-12 mt-2">
            <button type="submit" class="btn btn-primary  btn-block" id="update-details-btn">
                <i class="fa fa-refresh"></i>
                @lang('Update Details')
            </button>
        </div>
    @endif
</div>
