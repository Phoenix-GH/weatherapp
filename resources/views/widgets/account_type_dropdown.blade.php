@foreach ($types as $type)
    <option value="{{ $type->slug }}">{{ $type->name }}</option>
@endforeach
