<div>
  <label for="{{ $name }}" class="form-label">
    {{ $label }}
    @if ($attributes->has('required'))
      <span class="text-danger">*</span>
    @endif
  </label>

  <textarea name="{{ $name }}" id="{{ $name }}"
    class="form-control @error($attributes->get('errors') ?? $name) is-invalid @enderror"
    aria-describedby="{{ $name . '_validation' }}" cols="30" rows="{{ $attributes->get('rows') ?? 3 }}"
    placeholder="{{ $attributes->get('placeholder') }}" {{ $attributes->has('disabled') ? 'disabled' : '' }}
    {{ $attributes->whereStartsWith('wire:') }} {{ $attributes->whereStartsWith('x-') }}>{{ old($name) ?? $attributes->get('value') }}</textarea>

  @error($attributes->get('errors') ?? $name)
    <div id="{{ $name . '_validation' }}" class="invalid-feedback">
      {{ $message }}
    </div>
  @enderror
</div>
