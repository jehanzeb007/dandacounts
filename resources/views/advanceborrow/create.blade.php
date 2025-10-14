{{ Form::open(array('url' => 'advanceborrow','class'=>'needs-validation','novalidate')) }}
<div class="modal-body">
    <div class="row">
        <div class="form-group  col-md-6">
            {{ Form::label('date', __('Date'),['class'=>'form-label']) }}<x-required></x-required>
            {{Form::date('date',date('Y-m-d'),array('class'=>'form-control','required'=>'required'))}}
        </div>
        <div class="form-group col-md-6">
            {{ Form::label('amount', __('Amount'),['class'=>'form-label']) }}<x-required></x-required>
            {{ Form::number('amount', '', array('class' => 'form-control','required'=>'required','step'=>'0.01', 'placeholder'=>__('Enter Amount'))) }}
        </div>

        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('category_id', __('Category'),['class'=>'form-label']) }}<x-required></x-required>
                {{ Form::select('category_id', $category,null, array('class' => 'form-control select','required'=>'required')) }}
                <div class="text-xs mt-1">
                    {{ __('Create category here.') }} <a href="{{ route('product-category.index') }}"><b>{{ __('Create category') }}</b></a>
                </div>
            </div>
        </div>
        <div class="form-group col-md-6">
            {{ Form::label('account_id', __('Account'),['class'=>'form-label']) }}<x-required></x-required>
            {{ Form::select('account_id',$accounts,null, array('class' => 'form-control select','required'=>'required')) }}
            <div class="text-xs mt-1">
                {{ __('Create account here.') }} <a href="{{ route('bank-account.index') }}"><b>{{ __('Create account') }}</b></a>
            </div>
        </div>
        <div class="form-group col-md-6">
            {{ Form::label('reference', __('Reference'),['class'=>'form-label']) }}<x-required></x-required>
            {{ Form::text('reference', '', array('class' => 'form-control','required'=>'required', 'placeholder'=>__('Enter Reference'))) }}
        </div>


        <div class="form-group  col-md-12">
            {{ Form::label('description', __('Description'),['class'=>'form-label']) }}
            {{Form::textarea('description','',array('class'=>'form-control'))}}

        </div>
    </div>
</div>

<div class="modal-footer">
    <input type="button" value="{{__('Cancel')}}" class="btn  btn-light" data-bs-dismiss="modal">
    <input type="submit" value="{{__('Create')}}" class="btn  btn-primary">
</div>

{{ Form::close() }}

