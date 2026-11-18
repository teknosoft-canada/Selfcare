@if($row->ipd_diagnosis_document_url != '')
@else
    {{ __('messages.common.n/a') }}
@endif
