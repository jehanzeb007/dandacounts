@php
    $chatGPT = \App\Models\Utility::settings('enable_chatgpt');
    $enable_chatgpt = !empty($chatGPT);
@endphp

{{ Form::open(['url' => 'custom-field','class'=>'needs-validation','novalidate']) }}
<div class="modal-body">
    <div class="row">
        @if ($enable_chatgpt)
            <div>
                <a href="#" data-size="md" data-ajax-popup-over="true"
                   data-url="{{ route('generate', ['custom field']) }}" data-bs-toggle="tooltip" data-bs-placement="top"
                   title="{{ __('Generate') }}" data-title="{{ __('Generate content with AI') }}"
                   class="btn btn-primary btn-sm float-end">
                    <i class="fas fa-robot"></i>
                    {{ __('Generate with AI') }}
                </a>
            </div>
        @endif

        <div class="form-group col-md-12">
            {{ Form::label('name', __('Custom Field Name'), ['class' => 'form-label']) }}<x-required></x-required>
            {{ Form::text('name', null, ['class' => 'form-control', 'required' => 'required', 'placeholder'=>__('Enter Custom Field Name')]) }}
        </div>

        <div class="form-group col-md-12">
            {{ Form::label('type', __('Type'), ['class' => 'form-label']) }}<x-required></x-required>
            {{ Form::select('type', $types, null, ['class' => 'form-control', 'id' => 'field_type', 'required' => 'required']) }}
        </div>
        {{-- Show when type = "select" --}}
        <div class="form-group col-md-12 d-none" id="select_options_container">
            {{ Form::label('Options', __('Options (comma separated)'), ['class' => 'form-label']) }}
            {{ Form::text('options', null, ['class' => 'form-control', 'placeholder' => __('e.g. Red, Blue, Green')]) }}
            <small class="text-muted">{{ __('Enter multiple options separated by commas') }}</small>
        </div>
        <div class="form-group col-md-12">
            {{ Form::label('module', __('Module'), ['class' => 'form-label']) }}<x-required></x-required>
            {{ Form::select('module', $modules, null, ['class' => 'form-control', 'required' => 'required']) }}
        </div>


    </div>
</div>

<div class="modal-footer">
    <input type="button" value="{{ __('Cancel') }}" class="btn btn-light" data-bs-dismiss="modal">
    <input type="submit" value="{{ __('Create') }}" class="btn btn-primary">
</div>
{{ Form::close() }}

{{-- ✅ Script for AJAX-loaded modal --}}
<script>
    (function($){
        let typeField = $('#field_type');
        let optionsContainer = $('#select_options_container');

        function toggleSelectOptions() {
            if (typeField.val() === 'select') {
                optionsContainer.removeClass('d-none');
            } else {
                optionsContainer.addClass('d-none');
            }
        }

        // Run immediately after the modal content is injected
        toggleSelectOptions();

        // Watch for type changes
        $(document).on('change', '#field_type', toggleSelectOptions);
    })(jQuery);
</script>
