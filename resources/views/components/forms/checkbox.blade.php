<div class="form-check">
  <input class="form-check-input" type="checkbox" name="{{ $name }}" value="{{ $value }}"
    id="{{ $name . '_' . $label }}"
    {{ (is_array($items) ? in_array($value, $items) : $value == $items) ? 'checked' : '' }}
    {{ $attributes->has('disabled') ? 'disabled' : '' }} {{ $attributes->whereStartsWith('wire:') }}
    {{ $attributes->whereStartsWith('x-') }}>
  <label class="form-check-label" for="{{ $name . '_' . $label }}">
    {{ $label }}
  </label>
</div>
