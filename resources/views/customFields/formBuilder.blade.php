@if($customFields)
    @foreach($customFields as $customField)

        @if($customField->type == 'text')
            <div class="form-group">
                {{ Form::label('customField-'.$customField->id, __($customField->name),['class'=>'form-label']) }}
                <div class="input-group">
                    {{ Form::text('customField['.$customField->id.']', isset($customer->customField[$customField->id])?$customer->customField[$customField->id]:'', array('class' => 'form-control')) }}
                </div>
            </div>
        @elseif($customField->type == 'email')
            <div class="form-group">
                {{ Form::label('customField-'.$customField->id, __($customField->name),['class'=>'form-label']) }}
                <div class="input-group">
                    {{ Form::email('customField['.$customField->id.']', isset($customer->customField[$customField->id])?$customer->customField[$customField->id]:'', array('class' => 'form-control')) }}
                </div>
            </div>
        @elseif($customField->type == 'number')
            <div class="form-group">
                {{ Form::label('customField-'.$customField->id, __($customField->name),['class'=>'form-label']) }}
                <div class="input-group">
                    {{ Form::number('customField['.$customField->id.']', isset($customer->customField[$customField->id])?$customer->customField[$customField->id]:'', array('class' => 'form-control')) }}
                </div>
            </div>
        @elseif($customField->type == 'date')
            <div class="form-group">
                {{ Form::label('customField-'.$customField->id, __($customField->name),['class'=>'form-label']) }}
                <div class="input-group">
                    {{ Form::date('customField['.$customField->id.']', isset($customer->customField[$customField->id])?$customer->customField[$customField->id]:'', array('class' => 'form-control')) }}
                </div>
            </div>
        @elseif($customField->type == 'textarea')
            <div class="form-group">
                {{ Form::label('customField-'.$customField->id, __($customField->name),['class'=>'form-label']) }}
                <div class="input-group">
                    {{ Form::textarea('customField['.$customField->id.']', isset($customer->customField[$customField->id])?$customer->customField[$customField->id]:'', array('class' => 'form-control')) }}
                </div>
            </div>
        @elseif($customField->type == 'select')
            <div class="form-group">
                {{ Form::label('customField-'.$customField->id, __($customField->name),['class'=>'form-label']) }}
                <div class="input-group">
                    {{ Form::select('customField['.$customField->id.']', App\Models\Utility::commaSeperatedToArray($customField->options), isset($customer->customField[$customField->id])?$customer->customField[$customField->id]:'', array('class' => 'form-control')) }}
                </div>
            </div>
        @endif

    @endforeach
@endif


