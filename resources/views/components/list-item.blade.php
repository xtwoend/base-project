<li>
    <span class="handle">
        <i class="fa fa-ellipsis-v"></i>
        <i class="fa fa-ellipsis-v"></i>
    </span>
    <span class="text"><i class="{{ $navigation->icon }} mr-5"></i> {{ $navigation->name }}</span>
    <div class="tools">
        <a href="#" class="mr-5"><i class="fa fa-edit"></i></a>
        <btn-remove url="{{ route('setting.navigation.destroy', $navigation->id) }}">
            <i class="fa fa-trash-o"></i>
        </btn-remove>
    </div>
</li>
@if(! $navigation->children->isEmpty())
<ul class="list sub-list">
    @foreach($navigation->children as $nav)
        <x-list-item :navigation="$nav"></x-list-item>
    @endforeach
</ul>
@endif