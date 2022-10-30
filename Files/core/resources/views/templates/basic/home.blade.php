@extends($activeTemplate.'layouts.frontend')
@section('content')

@include($activeTemplate.'sections.banner')


<h1>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore temporibus at, doloribus sequi quae, sit et quasi eius reprehenderit repellat nam exercitationem esse laborum fuga repudiandae facilis? Ut, obcaecati voluptates.</h1>

@if($sections->secs != null)
@foreach(json_decode($sections->secs) as $sec)
    @include($activeTemplate.'sections.'.$sec)
@endforeach
@endif

@endsection
