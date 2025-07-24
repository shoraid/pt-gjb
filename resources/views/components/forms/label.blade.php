<div>
  <label for="{{ $name }}" class="form-label">
    {{ $label }}
    @if ($attributes->has('required'))
      <span class="text-danger">*</span>
    @endif
  </label>

  {{ $slot }}

  @error($name)
    <div id="{{ $name . '_validation' }}" class="invalid-feedback">
      {{ $message }}
    </div>
  @enderror
</div>
