@extends('layouts.app')

@section('content')
<section class="content-header">
    <h1>
        Navigation
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ route('setting.navigation') }}">Navigation</a></li>
        <li class="active">Create</li>
    </ol>
</section>
<section class="content">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Create Navigation</h3>
        </div>
        <form role="form" method="POST" action="{{ route('setting.navigation.update', $nav->id) }}">
            @csrf
            @method('PUT')
            <div class="box-body">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input name="name" type="text" class="form-control" placeholder="Navigation" value="{{ $nav->name }}">
                </div>
                <div class="form-group">
                    <label for="route">Page</label>
                    <input name="route" type="text" class="form-control" placeholder="/page/sample"  value="{{ $nav->route }}">
                </div>
                <div class="form-group">
                    <label for="icon">Icon</label>
                    <input name="icon" type="text" class="form-control" placeholder="fa fa-dashboard"  value="{{ $nav->icon }}">
                </div>
                <div class="form-group">
                    <label for="icon">Order</label>
                    <input name="order" type="text" class="form-control" placeholder="1" value="1"  value="{{ $nav->order }}">
                </div>
                <div class="form-group">
                    <label for="parent">Parent</label>
                    <select class="form-control" name="parent_id">
                        <option value="NULL">Parent Navigation</option>
                        @foreach(\App\Models\Navigation::tree() as $parent)
                        <x-option :option="$parent" :selected="$nav->parent_id" />
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="box-footer">
                <button type="reset" class="btn btn-default">Cancel</button> <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</section>
@endsection
