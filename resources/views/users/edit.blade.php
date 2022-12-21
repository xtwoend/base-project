@extends('layouts.app')

@section('content')
<section class="content-header">
    <h1>
        User
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ route('setting.users.index') }}">Users</a></li>
        <li class="active">Add New User</li>
    </ol>
</section>
<section class="content">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Add New User</h3>
        </div>
        <form role="form" method="POST" action="{{ route('setting.users.update', $user->id) }}">
            @csrf
            @method('PUT')
            <div class="box-body">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input name="name" type="text" class="form-control" placeholder="Name" value="{{ $user->name }}">
                    @error('name')
                        <p class="help-block txt-red">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="route">Email</label>
                    <input name="email" type="email" class="form-control" placeholder="email@domain.com" value="{{ $user->email }}">
                    @error('email')
                        <p class="help-block txt-red">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="route">Password</label>
                    <input name="password" type="password" class="form-control" placeholder="******">
                    @error('password')
                        <p class="help-block txt-red">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="route">Password</label>
                    <input name="password_confirmation" type="password" class="form-control" placeholder="******">
                </div>
                <div class="form-group">
                    <label for="route">Permission</label>
                    @forelse ($navs as $item)                                
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" {{ in_array($item->id, $userHasPermissions) ? 'checked' : ''  }} name="permissions[]" value="{{ $item->id }}" class="form-check-input">
                                {{ $item->name }}
                                <i class="input-helper"></i>
                            </label>
                        </div>
                    @empty
                        ----
                    @endforelse                          
                </div>
            </div>
            <div class="box-footer">
                <button type="reset" class="btn btn-default">Cancel</button> <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</section>
@endsection
