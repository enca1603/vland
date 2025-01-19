@props(['label' => '', 'name' => '', 'type' => 'text', 'value' => ''])

<label class="form-label" for="{{ $name }}">{{ $label }}</label>
<input type="{{ $type }}" id="{{ $name }}" name="{{ $name }}" class="form-control @error($name) is-invalid @enderror"
    value="{{ old($name, $value) }}">
<div class="invalid-feedback {{ $name }}_invalid">{{ $errors->first($name) }}</div>