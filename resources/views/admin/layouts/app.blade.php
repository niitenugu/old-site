@include('admin.layouts.partials._header')

@include('admin.layouts.partials._top_bar')

<div class="layout-w">

  @include('admin.layouts.partials._sidebar')

  @yield('content')

</div>

@include('admin.layouts.partials._footer')
