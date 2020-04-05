<div class="row">
    <div class="col-md-12">


        @if ($edit)
        <div class="form-group">
            <label for="direc_status">@lang('Status')</label>
            {!! Form::select('direc_status', $statuses, $edit ? $direction->direc_status : '',
                ['class' => 'custom-select', 'id' => 'direc_status', !$edit ? 'disabled' : '']) !!}
        </div>
        @endif

        <div class="form-group">
            <label for="direc_name">@lang('Direction Name')</label>
            <input type="text" class="form-control input-solid" id="direc_name"
                   name="direc_name" placeholder="@lang('Direction Name')" value="{{ $edit ? $direction->direc_name : old('direc_name') }}">
        </div>

        <div class="form-group">
            <label for="direc_description">@lang('Direction Description')</label>
            <input type="text" class="form-control input-solid" id="direc_description"
                   name="direc_description" placeholder="@lang('Direction Description')" value="{{ $edit ? $direction->direc_description : old('direc_description') }}">
        </div>

        <div class="form-group">
            <label for="direc_email">@lang('Direction Email')</label>
            <input type="text" class="form-control input-solid" id="direc_email"
                   name="direc_email" placeholder="@lang('Direction Email')" value="{{ $edit ? $direction->direc_email : old('direc_email') }}">
        </div>

        <div class="form-group">
            <label for="direc_phone">@lang('Direction Phone')</label>
            <input type="text" class="form-control input-solid" id="direc_phone"
                   name="direc_phone" placeholder="@lang('Direction Phone')" value="{{ $edit ? $direction->direc_phone : old('direc_phone') }}">
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
