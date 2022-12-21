@extends('layouts.app')

@section('content')
<section class="content-header">
    <h1>
        Design Scada UI
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ route('setting.design') }}">Design</a></li>
        <li class="active">Create</li>
    </ol>
</section>
<section class="content"> 
    <workbench :svg="{{ json_encode($svg) }}"></workbench>
</section>
@endsection