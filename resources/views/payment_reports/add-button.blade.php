@if(Auth::user()->hasRole('Admin'))
        {{__('messages.common.export_to_excel')}}
    </a>
@endif
