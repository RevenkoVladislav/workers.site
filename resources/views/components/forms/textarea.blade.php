<div class="{{ $classes }}">
    <label for="{{ $id }}" class="form-label">{{ $label }}</label>
    <textarea name="{{ $name }}" class="form-control" id="{{ $id }}" rows="{{ $rows }}" cols="{{ $cols }}">{{ old($name) }}</textarea>
    <div class="form-text text-danger">
        @error($name)
        {{ $message }}
        @enderror
    </div>
</div>
