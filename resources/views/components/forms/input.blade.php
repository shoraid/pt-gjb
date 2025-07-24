<div>
  <label for="{{ $name }}" class="form-label">
    {{ $label }}
    @if ($attributes->has('required'))
      <span class="text-danger">*</span>
    @endif
  </label>

  <input type="{{ $attributes->get('type') ?? 'text' }}" name="{{ $name }}" id="{{ $name }}"
    value="{{ old($name) ?? $attributes->get('value') }}" placeholder="{{ $attributes->get('placeholder') }}"
    class="form-control @error($attributes->get('errors') ?? $name) is-invalid @enderror"
    aria-describedby="{{ $name . '_validation' }}" {{ $attributes->has('disabled') ? 'disabled' : '' }}
    {{ $attributes->has('accept') ? "accept={$attributes->get('accept')}" : '' }}
    {{ $attributes->whereStartsWith('wire:') }} {{ $attributes->whereStartsWith('x-') }} />

  @error($attributes->get('errors') ?? $name)
    <div id="{{ $name . '_validation' }}" class="invalid-feedback">
      {{ $message }}
    </div>
  @enderror
</div>
