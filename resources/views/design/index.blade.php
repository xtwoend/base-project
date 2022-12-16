@extends('layouts.app')

@section('content')
<div class="content"> 
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Upload Design</h3>
        </div>
        <form role="form" method="POST" action="{{ route('design.upload') }}" enctype="multipart/form-data">
            @csrf
            <div class="box-body">
                <div class="form-group">
                    <label for="name">Design Name</label>
                    <input name="name" type="text" class="form-control" id="name" placeholder="exp. dashboard mechine">
                    @error('name')
                        <p class="help-block">Name is required</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputFile">Pick svg file</label>
                    <input type="file" id="exampleInputFile" name="file">
                    @error('file')
                        <p class="help-block">Please choice svg file</p>
                    @enderror
                </div>
            </div>
            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</div>
@endsection