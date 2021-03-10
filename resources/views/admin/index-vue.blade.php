@extends('admin.layout')

@section('content')
    <div class="uper">

{{--        @if(session()->get('success'))--}}
{{--            <div class="alert alert-success">--}}
{{--                {{ session()->get('success') }}--}}
{{--            </div><br />--}}
{{--        @endif--}}

        <admin_page></admin_page>
    </div>
@endsection
