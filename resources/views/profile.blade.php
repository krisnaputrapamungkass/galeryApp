@extends('template.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h1 class="m-0">Profil</h1>
                        <div class="d-flex align-items-center">

                            <!-- Button trigger modal -->
                            <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#editProfile">
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 50 50">
                                    <path fill="#FF2D20" d="M10 12h30v4H10zm0 10h30v4H10zm0 10h30v4H10z"></path>
                                </svg>
                            </button>
                            <!-- Modal -->
                            <div class="modal fade" id="editProfile" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data Profile</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('updateProfile', Auth::user()->id) }}" method="post">
                                                @csrf
                                                @method('PUT')
                                                <div class="mb-3">
                                                    <label for="name" class="form-label">Name</label>
                                                    <input class="form-control" type="text" name="name" id="name"
                                                        value="{{ Auth::user()->name }}">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                                                    <input class="form-control" type="text" name="nama_lengkap"
                                                        id="nama_lengkap" value="{{ Auth::user()->nama_lengkap }}">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="email" class="form-label">Email</label>
                                                    <input class="form-control" type="email" name="email" id="email"
                                                        value="{{ Auth::user()->email }}">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="alamat" class="form-label">Alamat</label>
                                                    <input class="form-control" type="text" name="alamat" id="alamat"
                                                        value="{{ Auth::user()->alamat }}">
                                                </div>
                                                <div class="mb-3">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Save</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="text-center col-4">
                                <div class="position-relative d-inline-block">
                                    <!-- Foto Profil -->
                                    <img src="{{ Auth::user()->foto ? asset('storage/img-profile/' . Auth::user()->foto) : asset('default-profile.png') }}"
                                        alt="Foto Profil" class="border rounded-circle border-secondary"
                                        style="width: 165px; height: 165px; object-fit: cover; background-color: #2a2a2a; display: block;">

                                    <!-- Tombol Upload dengan Ikon Kamera -->
                                    <label for="uploadFoto"
                                        class="bottom-0 p-2 shadow position-absolute end-0 bg-success rounded-circle d-flex align-items-center justify-content-center"
                                        style="width: 35px; height: 35px; cursor: pointer;">
                                        <i class="text-white fas fa-camera"></i>
                                    </label>
                                </div>

                                <!-- Form Upload Foto (Hidden) -->
                                <form action="{{ route('updateFoto', Auth::user()->id) }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <input type="file" id="uploadFoto" name="foto" class="d-none"
                                        onchange="this.form.submit()">
                                </form>
                            </div>

                            <div class="col-8">
                                <h3>{{ Auth::user()->name }}</h3>
                                <div class="mt-3">
                                    <p class="mb-1">
                                        <i class="fas fa-envelope me-2"></i> {{ Auth::user()->email }}
                                    </p>
                                    <p class="mb-1">
                                        <i class="fas fa-user me-2"></i> {{ Auth::user()->nama_lengkap }}
                                    </p>
                                    <p class="mb-1">
                                        <i class="fa-solid fa-map-pin me-2"></i> {{ Auth::user()->alamat }}
                                    </p>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- List Foto --}}
        <div>
            <div class="container mt-5">
                @if (Auth::check() == true)
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahFoto">
                        Tambah Foto
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="tambahFoto" data-bs-backdrop="static" data-bs-keyboard="false"
                        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Foto</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('foto.store') }}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="formfile" class="form-label">Foto</label>
                                            <input class="form-control" type="file" id="formfile" name="foto">
                                        </div>
                                        <div class="mb-3">
                                            <label for="">Judul</label>
                                            <input type="text" class="form-control" name="judul">
                                        </div>
                                        <div class="mb-3">
                                            <label for="">Deskripsi</label>
                                            <textarea name="deskripsi" class="form-control" id="" cols="30" rows="10"></textarea>
                                        </div>
                                        <label for="">Status</label>
                                        <select name="status" id="" class="form-control">
                                            <option value="1">Publish</option>
                                            <option value="0">Draft</option>
                                        </select>
                                        <label for="">Album</label>
                                        <select name="album_id" id="" class="form-control">
                                            @foreach ($album as $item)
                                                <option value="{{ $item->id }}">{{ $item->album }}</option>
                                            @endforeach
                                        </select>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahAlbum">
                        Tambah Album
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="tambahAlbum" data-bs-backdrop="static" data-bs-keyboard="false"
                        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Album</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('album.store') }}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="formfile" class="form-label">Album</label>
                                            <input class="form-control" type="text" id="formfile" name="album">
                                        </div>
                                        <div class="mb-3">
                                            <label for="">Deskripsi</label>
                                            <input type="text" class="form-control" name="deskripsi">
                                        </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col">
                                        <img src="..." id="foto" style="width: 300px; weight: 250px"
                                            class="img-fluid" alt="...">
                                    </div>
                                    <div class="col">
                                        <label for="">Dibuat Oleh :</label>
                                        <label for="" class="form-label" id="name">Author</label>
                                        <hr>
                                        <label for="" class="form-label" id="judul">Caption</label>
                                        <hr>
                                        <label for="" class="form-label" id="deskripsi">Deskripsi</label>
                                        <hr>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row d-flex justify-content-start">
                    @if ($fotos->isEmpty())
                        <div class="alert alert-danger">Tidak Ada</div>
                    @endif
                    @foreach ($fotos as $item)
                        <div class="col-auto">
                            <div class="mt-3 card" style="width: 20rem;">
                                <img src="{{ asset('storage/images/' . $item->foto) }}"
                                    style="text-align:center;width: 300px; height: 200px;" class="card-img-top"
                                    alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $item->judul }}</h5>
                                    <p class="short-text">{{ Str::limit($item->deskripsi, 25, '') }}</p>
                                    <p class="full-text d-none">{{ $item->deskripsi }}</p>

                                    <a href="javascript:void(0)" class="btn btn-link read-more">Read More</a>

                                    <hr>
                                    <div class="btn-group" role="group" aria-label="Basic outlined example">
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-outline-info show" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal" data-judul="{{ $item->judul }}"
                                            data-deskripsi="{{ $item->deskripsi }}" data-foto="{{ $item->foto }}"
                                            data-nama="{{ $item->user->nama_lengkap }} "data-id="{{ $item->id }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24">
                                                <path fill="currentColor"
                                                    d="M12 9a3 3 0 0 0-3 3a3 3 0 0 0 3 3a3 3 0 0 0 3-3a3 3 0 0 0-3-3m0 8a5 5 0 0 1-5-5a5 5 0 0 1 5-5a5 5 0 0 1 5 5a5 5 0 0 1-5 5m0-12.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5" />
                                            </svg>
                                        </button>
                                        @if (Auth::check() == true)
                                            @if ($item->likes->contains('users_id', Auth::id()) == false)
                                                {{-- Button like --}}
                                                <button type="button" class="btn btn-outline-danger like"
                                                    data-id="{{ $item->id }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24">
                                                        <path fill="currentColor"
                                                            d="M5 9v12H1V9zm4 12a2 2 0 0 1-2-2V9c0-.55.22-1.05.59-1.41L14.17 1l1.06 1.06c.27.27.44.64.44 1.05l-.03.32L14.69 8H21a2 2 0 0 1 2 2v2c0 .26-.05.5-.14.73l-3.02 7.05C19.54 20.5 18.83 21 18 21zm0-2h9.03L21 12v-2h-8.79l1.13-5.32L9 9.03z" />
                                                    </svg>

                                                    <label for="" class="likeLabel"
                                                        data-id="{{ $item->id }}">
                                                        {{ $item->likes->count() }}</label>
                                                </button>
                                            @else
                                                {{-- Button like --}}
                                                <button type="button" class="btn btn-outline-danger unlike"
                                                    data-id="{{ $item->id }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24">
                                                        <path fill="#c40707"
                                                            d="M23 10a2 2 0 0 0-2-2h-6.32l.96-4.57c.02-.1.03-.21.03-.32c0-.41-.17-.79-.44-1.06L14.17 1L7.59 7.58C7.22 7.95 7 8.45 7 9v10a2 2 0 0 0 2 2h9c.83 0 1.54-.5 1.84-1.22l3.02-7.05c.09-.23.14-.47.14-.73zM1 21h4V9H1z" />
                                                    </svg>
                                                    <label for="" class="likeLabel"
                                                        data-id="{{ $item->id }}">
                                                        {{ $item->likes->count() }}</label>
                                                </button>
                                            @endif
                                        @endif

                                        <button type="button" class="btn btn-outline-info">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24">
                                                <g fill="none" stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2">
                                                    <path stroke-dasharray="72" stroke-dashoffset="72"
                                                        d="M3 19.5v-15.5c0 -0.55 0.45 -1 1 -1h16c0.55 0 1 0.45 1 1v12c0 0.55 -0.45 1 -1 1h-14.5Z">
                                                        <animate fill="freeze" attributeName="stroke-dashoffset"
                                                            dur="0.6s" values="72;0" />
                                                    </path>
                                                    <path stroke-dasharray="10" stroke-dashoffset="10" d="M8 7h8">
                                                        <animate fill="freeze" attributeName="stroke-dashoffset"
                                                            begin="0.7s" dur="0.2s" values="10;0" />
                                                    </path>
                                                    <path stroke-dasharray="10" stroke-dashoffset="10" d="M8 10h8">
                                                        <animate fill="freeze" attributeName="stroke-dashoffset"
                                                            begin="1s" dur="0.2s" values="10;0" />
                                                    </path>
                                                    <path stroke-dasharray="6" stroke-dashoffset="6" d="M8 13h4">
                                                        <animate fill="freeze" attributeName="stroke-dashoffset"
                                                            begin="1.3s" dur="0.2s" values="6;0" />
                                                    </path>
                                                </g>
                                            </svg>
                                            <label for="" class="komentarLabel" data-id="{{ $item->id }}">
                                                {{ $item->komentar->count() }}</label>
                                        </button>
                                        <button type="button" class="btn btn-outline-info status"
                                            data-id="{{ $item->id }}" data-status="{{ $item->status }}">
                                            @if ($item->status == 0)
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24">
                                                    <path fill="#000"
                                                        d="m20.475 23.3l-2.95-2.95q-1.2.8-2.587 1.225T12 22q-2.075 0-3.9-.788t-3.175-2.137T2.788 15.9T2 12q0-1.55.425-2.937T3.65 6.475L.675 3.5L2.1 2.075l19.8 19.8zM11 19.95V18q-.825 0-1.412-.587T9 16v-1l-4.8-4.8q-.075.45-.137.9T4 12q0 3.025 1.988 5.3T11 19.95m9.35-2.475l-1.45-1.45q.525-.925.813-1.937T20 12q0-2.45-1.362-4.475T15 4.6V5q0 .825-.587 1.413T13 7h-2v1.125L6.525 3.65q1.2-.775 2.575-1.212T12 2q2.075 0 3.9.788t3.175 2.137T21.213 8.1T22 12q0 1.525-.437 2.9t-1.213 2.575" />
                                                </svg>
                                            @else
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24">
                                                    <path fill="#000"
                                                        d="M12 22q-2.075 0-3.9-.788t-3.175-2.137T2.788 15.9T2 12t.788-3.9t2.137-3.175T8.1 2.788T12 2t3.9.788t3.175 2.137T21.213 8.1T22 12t-.788 3.9t-2.137 3.175t-3.175 2.138T12 22m-1-2.05V18q-.825 0-1.412-.587T9 16v-1l-4.8-4.8q-.075.45-.137.9T4 12q0 3.025 1.988 5.3T11 19.95m6.9-2.55q1.025-1.125 1.563-2.512T20 12q0-2.45-1.362-4.475T15 4.6V5q0 .825-.587 1.413T13 7h-2v2q0 .425-.288.713T10 10H8v2h6q.425 0 .713.288T15 13v3h1q.65 0 1.175.388T17.9 17.4" />
                                                </svg>
                                            @endif
                                        </button>
                                        @if (Auth::user()->id == $item->users_id)
                                            <button type="button" class="btn btn-outline-danger delete-photo"
                                                data-id="{{ $item->id }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24">
                                                    <path fill="currentColor"
                                                        d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zm2.46-7.12l1.41-1.41L12 12.59l2.12-2.12l1.41 1.41L13.41 14l2.12 2.12l-1.41 1.41L12 15.41l-2.12 2.12l-1.41-1.41L10.59 14l-2.13-2.12zM15.5 4l-1-1h-5l-1 1H5v2h14V4z" />
                                                </svg>
                                            </button>
                                        @endif
                                        <div class="modal fade" id="komentarModal" tabindex="-1"
                                            aria-labelledby="komentarModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="komentarModalLabel">Komentar</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <ul id="komentarList" class="list-group">
                                                            @if (Auth::check() == true)
                                                                <label for="">Komentar</label>
                                                                <div class="input-group">
                                                                    <input type="hidden" name="id" id="idFoto">
                                                                    <textarea name="komentar" id="isiKomentar" class="form-control" id="" cols="30" rows="2"></textarea>
                                                                    <button class="btn btn-primary"
                                                                        id="btnKomentar">Kirim</button>
                                                                </div>
                                                                <hr>
                                                                <div id="komentarAll">
                                                                </div>
                                                            @endif
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('.status').on('click', function() {
                var id = $(this).data('id');
                var status = $(this).data('status');
                $.ajax({
                    url: "{{ route('StatusUpdate', ':id') }}".replace(':id', id),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "PUT",
                    data: {
                        id: id,
                        status: status,
                    },
                    success: function(data) {
                        location.reload();
                    }
                });
            });
            // Kode yang sudah ada tetap dipertahankan
            $('.show').on('click', function() {
                var id = $(this).data('id');
                var judul = $(this).data('judul');
                var deskripsi = $(this).data('deskripsi');
                // alert(deskripsi);
                var author = $(this).data('nama');
                var foto = $(this).data('foto');
                console.log(foto);
                $('#idFoto').val(id);
                $('#exampleModalLabel').text(judul);
                $('#foto').attr('src', "{{ asset('storage/images/') }}/" + foto);
                $('#name').text(author);
                let wrapText = deskripsi.match(/.{1,25}/g).join("<br>");
                $('#deskripsi').text(deskripsi);
                $('#judul').text(judul);

                $.ajax({
                    url: "{{ route('Detailkomentar', ':id') }}".replace(':id', id),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "PUT",
                    data: {
                        id: id,
                    },
                    success: function(data) {
                        var html = `
                <div style="max-width: 500px; height: 300px; overflow-y: auto; border: 1px solid #ddd; padding: 10px; border-radius: 8px; font-family: Arial, sans-serif;">
                    <ul style="list-style-type: none; padding: 0; margin: 0;">`;

                        for (var i = 0; i < data.data.length; i++) {
                            html += `
                    <li style="display: flex; align-items: flex-start; margin-bottom: 15px; border-bottom: 1px solid #eee; padding-bottom: 10px;">
                        <!-- Gambar Profil (Placeholder) -->
                        <!-- Isi Komentar -->
                        <div style="max-width: 400px;">
                            <strong>${data.data[i].user.nama_lengkap}</strong>
                            <p>
                                ${data.data[i].komentar}
                            </p>
                        </div>
                    </li>`;
                        }
                        html += `
                    </ul>
                </div>`;
                        // console.log( data.data.length);
                        $('#komentarAll').html(html);
                    }
                });
            });

            // Tambahkan event listener untuk tombol komentar
            $('.btn-outline-info').on('click', function() {
                if ($(this).find('.komentarLabel').length > 0) {
                    var id = $(this).find('.komentarLabel').data('id');
                    $('#idFoto').val(id);
                    $('#komentarModal').modal('show');

                    // Muat komentar
                    $.ajax({
                        url: "{{ route('Detailkomentar', ':id') }}".replace(':id', id),
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: "PUT",
                        data: {
                            id: id,
                        },
                        success: function(data) {
                            var html = `
                    <div style="max-width: 500px; height: 300px; overflow-y: auto; border: 1px solid #ddd; padding: 10px; border-radius: 8px; font-family: Arial, sans-serif;">
                        <ul style="list-style-type: none; padding: 0; margin: 0;">`;

                            for (var i = 0; i < data.data.length; i++) {
                                html += `
                        <li style="display: flex; align-items: flex-start; margin-bottom: 15px; border-bottom: 1px solid #eee; padding-bottom: 10px;">
                            <div style="max-width: 400px;">
                                <strong>${data.data[i].user.nama_lengkap}</strong>
                                <p>
                                    ${data.data[i].komentar}
                                </p>
                            </div>
                        </li>`;
                            }
                            html += `
                        </ul>
                    </div>`;
                            $('#komentarAll').html(html);
                        }
                    });
                }
            });

            $('.like').on('click', function() {
                var id = $(this).data('id');
                $.ajax({
                    url: "{{ route('like') }}",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method: "POST",
                    data: {
                        id: id,
                    },
                    success: function() {
                        location.reload();
                    }
                });
            });

            $('.unlike').on('click', function() {
                var id = $(this).data('id');
                $.ajax({
                    url: "{{ route('unlike') }}",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method: "POST",
                    data: {
                        id: id,
                    },
                    success: function() {
                        location.reload();
                    }
                });
            });

            // 


            $(document).ready(function() {
                // Validasi formulir untuk formulir unggah foto
                $('form[action="{{ route('foto.store') }}"]').on('submit', function(e) {
                    let isValid = true;
                    const judulValue = $(this).find('input[name="judul"]').val().trim();
                    const fotoValue = $(this).find('input[name="foto"]').val().trim();
                    let pesanError = [];

                    // Cek apakah foto kosong
                    if (!fotoValue) {
                        isValid = false;
                        pesanError.push("Foto wajib diisi!");
                    }

                    // Cek apakah judul kosong
                    if (!judulValue) {
                        isValid = false;
                        pesanError.push("Judul wajib diisi!");
                    }

                    // Jika ada validasi yang gagal, cegah pengiriman formulir dan tampilkan error
                    if (!isValid) {
                        e.preventDefault();

                        // Hapus alert yang ada sebelumnya
                        $(this).closest('.modal-content').find('.alert').remove();

                        // Buat pesan alert dengan semua error
                        const alertHtml = `
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error!</strong>
                    <ul class="mb-0">
                        ${pesanError.map(msg => `<li>${msg}</li>`).join('')}
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            `;

                        // Masukkan alert di bagian atas modal body
                        $(this).closest('.modal-content').find('.modal-body').prepend(alertHtml);

                        // Otomatis tutup alert setelah 5 detik
                        setTimeout(function() {
                            $('.alert').alert('close');
                        }, 5000);

                        return false;
                    }
                });
            });

            $('#btnKomentar').on('click', function() {
                var id = $('#idFoto').val();
                var komentar = $('#isiKomentar').val();

                if (komentar.trim() === '') {
                    alert('Komentar tidak boleh kosong');
                    return;
                }

                $.ajax({
                    url: "{{ route('komentar') }}",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method: "POST",
                    data: {
                        id: id,
                        komentar: komentar,
                    },
                    success: function(response) {
                        // Bersihkan input komentar
                        $('#isiKomentar').val('');

                        // Perbarui tampilan komentar
                        $.ajax({
                            url: "{{ route('Detailkomentar', ':id') }}".replace(':id',
                                id),
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                    'content')
                            },
                            type: "PUT",
                            data: {
                                id: id,
                            },
                            success: function(data) {
                                var html = `
                        <div style="max-width: 500px; height: 300px; overflow-y: auto; border: 1px solid #ddd; padding: 10px; border-radius: 8px; font-family: Arial, sans-serif;">
                            <ul style="list-style-type: none; padding: 0; margin: 0;">`;

                                for (var i = 0; i < data.data.length; i++) {
                                    html += `
                            <li style="display: flex; align-items: flex-start; margin-bottom: 15px; border-bottom: 1px solid #eee; padding-bottom: 10px;">
                                <div style="max-width: 400px;">
                                    <strong>${data.data[i].user.nama_lengkap}</strong>
                                    <p>
                                        ${data.data[i].komentar}
                                    </p>
                                </div>
                            </li>`;
                                }
                                html += `
                            </ul>
                        </div>`;
                                $('#komentarAll').html(html);

                                // Perbarui jumlah komentar tanpa reload
                                updateLikedanKomentar();
                            }
                        });
                    },
                    error: function() {
                        alert('Terjadi kesalahan saat mengirim komentar');
                    }
                });
            });

            $(".read-more").click(function() {
                let cardText = $(this).prevAll(".short-text");
                let moreText = $(this).prevAll(".full-text");
                if (moreText.hasClass("d-none")) {
                    moreText.removeClass("d-none");
                    cardText.addClass("d-none");
                    $(this).text("Less");
                } else {
                    moreText.addClass("d-none");
                    cardText.removeClass("d-none");
                    $(this).text("Read More");
                }
            });
        });

        function updateLikedanKomentar() {
            $(".likeLabel").each(function() {
                var id = $(this).data('id');
                var label = $(this);
                $.ajax({
                    url: "{{ route('getUpdate') }}",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method: "POST",
                    data: {
                        id: id,
                    },
                    success: function(response) {
                        label.text(response.likes);
                    }
                });
            });
            $(".komentarLabel").each(function() {
                var id = $(this).data('id');
                var label = $(this);
                $.ajax({
                    url: "{{ route('getUpdate') }}",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method: "POST",
                    data: {
                        id: id,
                    },
                    success: function(response) {
                        label.text(response.komentar);
                    }
                });
            });
        }

        // Add this inside your existing $(document).ready(function() { ... });
        $('.delete-photo').on('click', function() {
            var id = $(this).data('id');

            Swal.fire({
                title: 'Are you sure?',
                text: "Anda tidak dapat mengembalikannya!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('foto.destroy', ':id') }}".replace(':id', id),
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: "DELETE",
                        success: function(data) {
                            Swal.fire(
                                'Deleted!',
                                'Foto Anda telah dihapus.',
                                'success'
                            ).then(() => {
                                location.reload();
                            });
                        },
                        error: function(err) {
                            Swal.fire(
                                'Error!',
                                'Terjadi kesalahan saat menghapus foto Anda.',
                                'error'
                            );
                        }
                    });
                }
            });
        });


        $(document).ready(function() {
            // Form validation for the photo upload form
            $('form[action="{{ route('foto.store') }}"]').on('submit', function(e) {
                const judulValue = $(this).find('input[name="judul"]').val().trim();

                if (!judulValue) {
                    e.preventDefault(); // Prevent form submission

                    // Create alert message
                    const alertHtml = `
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error!</strong> Judul wajib diisi!
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            `;

                    // Insert alert at the top of the modal body
                    $(this).closest('.modal-content').find('.modal-body').prepend(alertHtml);

                    // Auto-dismiss alert after 5 seconds
                    setTimeout(function() {
                        $('.alert').alert('close');
                    }, 5000);

                    // Focus on the judul field
                    $(this).find('input[name="judul"]').focus();

                    return false;
                }
            });
        });
        setInterval(updateLikedanKomentar, 10000);
    </script>
@endsection
