@if($navigation->canAccess(Auth::user()))
<li class="{{ ! $navigation->children->isEmpty() ? 'treeview': '' }}">
    <a href="{{ $navigation->route }}">
        @if($navigation->icon)
            <i class="{{ $navigation->icon }}"></i>
        @endif
        <span>{{ $navigation->name }}</span>
        @if(! $navigation->children->isEmpty())
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
        @endif
    </a>
    @if(! $navigation->children->isEmpty())
    <ul class="treeview-menu">
        @foreach($navigation->children as $child)
            <x-navigation :navigation="$child"></x-navigation>
        @endforeach
    </ul>
    @endif
</li>
@endif