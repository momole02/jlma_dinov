@php
    if(Session::has('data')) $data=Session::get('data');
@endphp
@if(isset($data) && $data['success'] == true)
    {{ $data['result'] }}
@endif