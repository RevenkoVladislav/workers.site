<div class="{{ $classes }}">
    <label for="{{ $id }}" class="form-label">{{ $label }}</label>
    <input type="{{ $type }}" name="{{ $name }}" class="form-control" id="{{ $id }}" value="{{ old($name) }}">
    <div class="form-text text-danger">
        @error($name)
        {{ $message }}
        @enderror
    </div>
</div>
