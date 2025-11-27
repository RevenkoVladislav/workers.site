<div class="{{ $classes }}">
    <label for="{{ $id }}" class="form-label">{{ $label }}</label>
    <textarea name="{{ $name }}"
              class="form-control"
              id="{{ $id }}"
              placeholder="{{ $placeholder }}"
              rows="{{ $rows }}"
              cols="{{ $cols }}">{{ old($name, $model?->$name) }}</textarea>
    <div class="form-text text-danger">
        @error($name)
        {{ $message }}
        @enderror
    </div>
</div>
