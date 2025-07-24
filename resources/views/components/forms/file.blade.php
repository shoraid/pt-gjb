<div>
  <label for="{{ $name }}" class="form-label">
    {{ $label }}
    @if ($attributes->has('required'))
      <span class="text-danger">*</span>
    @endif
  </label>

  <input type="file" name="{{ $name }}" id="{{ $name }}"
    class="form-control @error($name) is-invalid @enderror" aria-describedby="{{ $name . '_validation' }}"
    accept="{{ $accept }}" {{ $attributes->has('disabled') ? 'disabled' : '' }}
    {{ $attributes->whereStartsWith('wire:') }} {{ $attributes->whereStartsWith('x-') }} />

  @error($name)
    <div id="{{ $name . '_validation' }}" class="invalid-feedback">
      {{ $message }}
    </div>
  @enderror

  <div class="mt-2" style="display: {{ $attributes->get('value') ? 'block' : 'none' }}; max-width: 150px;"
    id="{{ $name . '_preview-container' }}">
    <img id="{{ $name . '_preview' }}" src="{{ $attributes->get('value') }}"
      style="width: 100%; object-fit: cover;" />
  </div>
</div>

@push('scripts')
  <script>
    document.getElementById("{{ $name }}").onchange = evt => {
      const [file] = document.getElementById("{{ $name }}").files

      if (file) {
        document.getElementById("{{ $name . '_preview-container' }}").style.display = 'block';
        document.getElementById("{{ $name . '_preview' }}").src = URL.createObjectURL(file)
      }
    }
  </script>
@endpush
