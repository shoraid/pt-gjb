<div>
  <label for="{{ $name }}" class="form-label">
    {{ $label }}
    @if ($attributes->has('required'))
      <span class="text-danger">*</span>
    @endif
  </label>

  <select name="{{ $name }}{{ $attributes->has('multiple') ? '[]' : '' }}" id="{{ $name }}"
    class="form-control @error($attributes->get('errors') ?? $name) is-invalid @enderror {{ $attributes->has('select2') ? 'select2' : '' }}"
    aria-describedby="{{ $name . '_validation' }}" {{ $attributes->has('multiple') ? 'multiple' : '' }}
    {{ $attributes->has('disabled') ? 'disabled' : '' }} {{ $attributes->whereStartsWith('wire:') }}
    {{ $attributes->whereStartsWith('x-') }}>
    {{ $slot }}
  </select>

  @error($attributes->get('errors') ?? $name)
    <div id="{{ $name . '_validation' }}" class="invalid-feedback">
      {{ $message }}
    </div>
  @enderror
</div>

@if ($attributes->has('select2') && !$attributes->whereStartsWith('wire:')->first())
  @push('scripts')
    <script>
      $(document).ready(function() {
        $(`#{{ $name }}.select2`).select2({
          width: '100%',
        });
      });
    </script>
  @endpush
@endif

@if ($attributes->has('select2') && $attributes->whereStartsWith('wire:')->first())
  @push('scripts')
    <script>
      document.addEventListener('livewire:init', () => {
        $(`#{{ $name }}.select2`).select2({
          width: '100%',
        });

        $(`#{{ $name }}.select2`).on('change', function(e) {
          var data = $(`#{{ $name }}.select2`).select2("val");
          @this.set(`{{ $attributes->whereStartsWith('wire:model')->first() }}`, data);
        });

        Livewire.hook('morph.updated', ({
          el,
          component
        }) => {
          $(`#{{ $name }}.select2`).select2({
            width: '100%',
          });
        });
      });
    </script>
  @endpush
@endif

@if ($errors->has([$attributes->get('errors') ?? $name]) && $attributes->has('select2'))
  @push('styles')
    <style>
      {{ '#' . $name }}.is-invalid+.select2 .select2-selection.select2-selection--single,
      {{ '#' . $name }}.is-invalid+.select2 .select2-selection.select2-selection--multiple {
        border: 1px solid #dc3545;
      }
    </style>
  @endpush
@endif
