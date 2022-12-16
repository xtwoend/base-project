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
                    <th style="width: 40px"></th>
                </tr>
                
                @foreach($files as $row)
                <tr>
                    <td>{{ $row->id }}</td>
                    <td>{{ $row->name }}</td>
                    <td>
                        <a href="{{ route('design.workbench', $row->id) }}" class="btn btn-xs btn-primary btn-flat">Show</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <!-- /.box-body -->
        <div class="box-footer clearfix">
            {{ $files->links() }}
            {{-- <ul class="pagination pagination-sm no-margin pull-right">
                <li><a href="#">«</a></li>
                <li><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">»</a></li>
            </ul> --}}
        </div>
      </div>
</div>
@endsection