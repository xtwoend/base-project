<option value="{{ $parent->id }}">{{ $tab }} {{ $parent->name }}</option>
@if(! $parent->children->isEmpty())
    @foreach($parent->children as $child)
    <x-option :option="$child" :tab="$tab . '--'" />
    @endforeach
@endif