@section('title', $title)

<main class="app-main">
  <div class="app-content-header">
    <div class="container-fluid">
      <div class="d-flex justify-content-between align-items-center">
        <h3 class="mb-0">{{ $title }}</h3>

        @isset($tools)
          <div class="d-flex align-items-center gap-3">{{ $tools }}</div>
        @endisset
      </div>
    </div>
  </div>
  <div class="app-content">
    <div class="container-fluid">
      <div class="card mb-4 py-3">
        <div class="card-body">
          <div class="d-flex flex-column gap-4">
            {{ $slot }}
          </div>
        </div>
      </div>

      @isset($additional)
        {{ $additional }}
      @endisset
    </div>
  </div>
</main>
