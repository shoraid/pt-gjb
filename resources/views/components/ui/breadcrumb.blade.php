<ol class="breadcrumb float-sm-end">
  @foreach ($items ?? [] as $key => $value)
    @if ($loop->last)
      <li class="breadcrumb-item active" aria-current="page">
        {{ is_string($key) ? $key : $value }}
      </li>
    @else
      <li class="breadcrumb-item"><a href="{{ $value ?? '#' }}">{{ $key ?? '' }}</a></li>
    @endif
  @endforeach
</ol>
