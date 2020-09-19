@section('submenu')
<span class="kt-subheader__separator kt-hidden"></span>
<a href="{{ route('users.create') }}" class="btn btn-label-primary btn-bold btn-sm btn-icon-h kt-margin-l-10">
    <i class="fas fa-plus"></i> Tambah User
</a>
<a href="{{ route('users.edit',Auth::user()->id) }}"
    class="btn btn-label-primary btn-bold btn-sm btn-icon-h kt-margin-l-10">
    <i class="fas fa-edit"></i> Edit Profile
</a>
@endsection