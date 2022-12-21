@extends('layouts.app')

@section('content')
<section class="content-header">
    <h1>
        Users
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Users</li>
    </ol>
</section>
<section class="content">
    <div class="toolbar">
        <a href="{{ route('setting.users.create') }}" class="btn btn-primary">Add New User</a>
    </div>
    <data-table
        url="{{ route('setting.users.data') }}"
        :headers="[
            {text: 'Name', value: 'name', sortable: true},
            {text: 'Email', value: 'email'},
            {text: 'Permission', value: 'permissions'},
            {text: 'Operation', value: 'operation'},
        ]"
        ref="vtable"
    >
    <template #item-permissions="item">
        <div class="operation-wrapper">
            @{{ item.permissions.map(o => o.name) }}
        </div>
    </template>
    <template #item-operation="item">
        <div class="operation-wrapper">
            <a :href="`/setting/users/${item.id}/edit`" data-bs-toggle="tooltip" data-bs-title="Edit Row"><i class="fa fa-pencil-square-o"></i></a> | 
            <btn-remove :url="`/setting/users/${item.id}`" data-bs-toggle="tooltip" data-bs-title="Delete Row"><i class="fa fa-trash-o"></i></del-btn>
        </div>
    </template>
    </data-table>
</section>
@endsection
