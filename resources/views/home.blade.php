@extends('layouts.apphome')
<script>
    (function() {
        window.Laravel = {
            csrfToken: '{{ csrf_token() }}'
        };
        @if(Auth::check())
        window.authUser = {!! Auth::user() !!}
       // window.setting = { !!App\ Setting::first() !!}
        @else
        window.authUser = false
        window.setting = false
        @endif
    })();
</script>

@section('content')

<z-dashboard></z-dashboard>
@endsection