<option value="{{ $parent->id }}" {{ $selected == $parent->parent_id? 'selected': '' }}>{{ $tab }} {{ $parent->name }}</option>
@if(! $parent->children->isEmpty())
    @foreach($parent->children as $child)
    <x-option :option="$child" :tab="$tab . '--'" :selected="$selected" />
    @endforeach
@endif