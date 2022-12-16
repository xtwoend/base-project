@extends('layouts.app')

@section('content')
<div class="content"> 
    <workbench :svg="{{ json_encode($svg) }}"></workbench>
</div>
@endsection