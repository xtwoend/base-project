@extends('layouts.app')

@section('content')
<section class="content-header">
    <h1>
        Edit Design Scada
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ route('setting.design') }}">Design</a></li>
        <li class="active">Edit</li>
    </ol>
</section>
<section class="content"> 
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Upload Design</h3>
        </div>
        <form role="form" method="POST" action="{{ route('setting.design.update', $svg->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="box-body">
                <div class="form-group">
                    <label for="name">Design Name</label>
                    <input name="name" type="text" class="form-control" id="name" placeholder="exp. dashboard mechine" value="{{ $svg->name }}">
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
                <div class="svg">
                    <img src="/{{ $svg->path }}" class="preview"/>
                </div>
            </div>
            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
    <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Existing Files</h3>
        </div>
        <!-- /.box-header -->
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>File Name</th>
                    <th style="width: 100px"></th>
                </tr>
                
                @foreach($files as $row)
                <tr>
                    <td>{{ $row->id }}</td>
                    <td>{{ $row->name }}</td>
                    <td>
                        <a href="{{ route('setting.design.edit', $row->id) }}" class="btn btn-xs btn-primary btn-flat mr-1">Edit</a>
                        <a href="{{ route('setting.design.workbench', $row->id) }}" class="btn btn-xs btn-primary btn-flat">Show</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <!-- /.box-body -->
        <div class="box-footer clearfix">
            {{ $files->links() }}
        </div>
      </div>
</section>
@endsection