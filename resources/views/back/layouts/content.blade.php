<div class="content-wrapper">
  @foreach(['warning','success','danger','info'] as $r)
  @if(session()->has($r))
  <div class="alert alert-{{$r}} alert-dismissible fade show" role="alert" style="margin:10px">
    {{session($r)}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  @endif
  @endforeach
    @yield('content')
    @yield('script')
</div>
