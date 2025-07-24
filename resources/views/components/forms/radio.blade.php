<div class="form-check {{ $attributes->has('inline') ? 'form-check-inline' : '' }}">
  <input class="form-check-input" type="radio" name="{{ $name }}" id="{{ $name . '_' . $label }}"
    value="{{ $value }}" @checked($attributes->get('checked')) {{ $attributes->whereStartsWith('wire:') }}
    {{ $attributes->whereStartsWith('x-') }}>
  <label class="form-check-label" for="{{ $name . '_' . $label }}">
    {{ $label }}
  </label>
</div>
