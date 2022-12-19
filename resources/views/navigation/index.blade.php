@extends('layouts.app')

@section('content')
<section class="content-header">
    <h1>
        Navigation
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Navigation</li>
    </ol>
</section>
<section class="content">
    <div class="box box-primary">
        <div class="box-header">
            <i class="ion ion-clipboard"></i>
            <h3 class="box-title">Navigations</h3>
        </div>
        <div class="box-body">
            <ul class="list">
                @foreach ($navigations as $nav)
                    <x-list-item :navigation="$nav"></x-list-item>
                @endforeach
            </ul>
        </div>
        <div class="box-footer clearfix no-border">
            <a href="{{ route('setting.navigation.create') }}" class="btn btn-default pull-right"><i class="fa fa-plus"></i> Add item</a>
        </div>
    </div>
</section>
@endsection
