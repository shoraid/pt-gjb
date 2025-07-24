<div class="btn-group">
  <button class="btn btn-sm btn-primary dropdown-toggle" type="button" id="defaultDropdown" data-bs-toggle="dropdown"
    data-bs-auto-close="true" aria-expanded="false">
    {{ $label }}
  </button>
  <ul class="dropdown-menu" aria-labelledby="defaultDropdown">
    {{ $slot }}
  </ul>
</div>
