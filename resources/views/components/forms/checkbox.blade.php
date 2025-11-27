<div class="{{ $classes }}">
    <label class="form-check-label" for="{{ $id }}">Check me out</label>
    <input type="hidden" name="{{ $name }}" value="0">
    <input type="checkbox" name="{{ $name }}" value="1" class="form-check-input" id="{{ $id }}"
           @if(old($name, $model?->$name))
               checked
        @endif
    >
    <div class="form-text text-danger">
        @error($name)
        {{ $message }}
        @enderror
    </div>
</div>
