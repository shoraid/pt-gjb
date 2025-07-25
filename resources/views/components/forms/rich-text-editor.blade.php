<div>
  <label for="{{ $name }}" class="form-label">
    {{ $label }}
    @if ($attributes->has('required'))
      <span class="text-danger">*</span>
    @endif
  </label>

  <div id="{{ $name . '-editor' }}" style="height: 200px; border-top-left-radius: 0px; border-top-right-radius: 0px;"
    class="form-control @error($attributes->get('errors') ?? $name) is-invalid @enderror">
    @if (old($name) || $attributes->get('value'))
      {!! old($name) ?? $attributes->get('value') !!}
    @else
      {{ $attributes->get('placeholder') }}
    @endif
  </div>

  <input type="hidden" name="{{ $name }}" id="{{ $name }}"
    value="{{ old($name, $attributes->get('value')) }}">

  @error($attributes->get('errors') ?? $name)
    <div id="{{ $name . '_validation' }}" class="invalid-feedback">
      {{ $message }}
    </div>
  @enderror
</div>

@push('scripts')
  <script defer>
    document.addEventListener('DOMContentLoaded', () => {
      const quill = new Quill(`#{{ $name }}-editor`, {
        theme: 'snow'
      });

      const contentInput = document.getElementById(`{{ $name }}`);

      // Sync Quill data to hidden input
      quill.on('text-change', function() {
        contentInput.value = quill.root.innerHTML;
      });

      // Set initial value from old('content')
      contentInput.value = quill.root.innerHTML;
    });
  </script>
@endpush
