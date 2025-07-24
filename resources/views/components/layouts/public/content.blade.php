@section('title', $title)

<main class="app-main">
  <div class="app-content">
    <div class="d-flex flex-column align-items-center" style="margin-top: 5%">
      <div class="w-100" style="max-width: 50rem;">
        <div class="card mb-4 py-3">
          <div class="card-body">
            <div class="d-flex flex-column gap-4">
              {{ $slot }}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
