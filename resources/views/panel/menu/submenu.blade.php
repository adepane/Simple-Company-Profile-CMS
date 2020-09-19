@section('submenu')
<span class="kt-subheader__separator kt-hidden"></span>
<a href="{{ route('menu.index') }}" class="btn btn-label-primary btn-bold btn-sm btn-icon-h kt-margin-l-10">
    <i class="fas fa-bars"></i> Daftar Halaman Menu
</a>
<a href="{{ route('menu.create') }}" class="btn btn-label-primary btn-bold btn-sm btn-icon-h kt-margin-l-10 newmenu">
    <i class="fas fa-plus"></i> Halaman Menu Baru
</a>
@endsection