@extends('template.master')

@section('content')
    <div class="container mt-5">
        <div class="text-center">
            <h4>Halaman Like</h4>
        </div>
       
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col">
                                <img src="..." id="foto" style="width: 300px; weight: 250px" class="img-fluid"
                                    alt="...">
                            </div>
                            <div class="col">
                                {{-- <label for="">Dibuat Oleh :</> --}}
                                    <label for="">Dibuat Oleh :</label> <span id="name">Nama Author</span>
                                    <hr>
                                    <label for="">Judul :</label> <span id="judul">Isi Caption</span>
                                    <hr>
                                    <label for="">Deskripsi :</label> <span id="deskripsi">Isi Deskripsi</span>
                                    <hr>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row d-flex justify-content-start">
            @if ($fotos->isEmpty())
                <div class="alert alert-danger">Tidak Ada Foto Yang Anda Sukai</div>
            @endif
            @foreach ($fotos as $item)
                <div class="col-auto">
                    <div class="mt-3 card" style="width: 18rem;">
                        <img src="{{ asset('storage/images/' . $item->foto) }}"
                            style="text-align:center;width: 285px; height: 200px;" class="card-img-top" alt="...">
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
                                            <label for="" class="likeLabel" data-id="{{ $item->id }}">
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
                                            <label for="" class="likeLabel" data-id="{{ $item->id }}">
                                                {{ $item->likes->count() }}</label>
                                        </button>
                                    @endif
                                @endif

                                <!-- Tombol komentar yang sudah diperbaiki -->
                                <button type="button" class="btn btn-outline-info btn-komentar" data-bs-toggle="modal"
                                    data-bs-target="#komentarModal" data-id="{{ $item->id }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24">
                                        <g fill="none" stroke="currentColor" stroke-linecap="round"
                                            stroke-linejoin="round" stroke-width="2">
                                            <path stroke-dasharray="72" stroke-dashoffset="72"
                                                d="M3 19.5v-15.5c0 -0.55 0.45 -1 1 -1h16c0.55 0 1 0.45 1 1v12c0 0.55 -0.45 1 -1 1h-14.5Z">
                                                <animate fill="freeze" attributeName="stroke-dashoffset" dur="0.6s"
                                                    values="72;0" />
                                            </path>
                                            <path stroke-dasharray="10" stroke-dashoffset="10" d="M8 7h8">
                                                <animate fill="freeze" attributeName="stroke-dashoffset" begin="0.7s"
                                                    dur="0.2s" values="10;0" />
                                            </path>
                                            <path stroke-dasharray="10" stroke-dashoffset="10" d="M8 10h8">
                                                <animate fill="freeze" attributeName="stroke-dashoffset" begin="1s"
                                                    dur="0.2s" values="10;0" />
                                            </path>
                                            <path stroke-dasharray="6" stroke-dashoffset="6" d="M8 13h4">
                                                <animate fill="freeze" attributeName="stroke-dashoffset" begin="1.3s"
                                                    dur="0.2s" values="6;0" />
                                            </path>
                                        </g>
                                    </svg>
                                    <label for="" class="komentarLabel" data-id="{{ $item->id }}">
                                        {{ $item->komentar->count() }}</label>
                                </button>
                                <!-- Modal untuk menampilkan komentar -->
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
@endsection


@section('script')
    <script>
        $(document).ready(function() {
            // Handler untuk tombol komentar - Kode yang diperbaiki
            $('.btn-komentar').on('click', function() {
                var id = $(this).data('id');
                $('#idFoto').val(id);
                
                // Mengambil komentar dengan AJAX
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
                        $('#komentarAll').html(html);
                    }
                });
            });

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
            $('#btnKomentar').on('click', function() {
                var id = $('#idFoto').val();
                var komentar = $('#isiKomentar').val();
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
                    success: function() {
                        location.reload();
                    }
                });
            });
            $(".read-more").click(function() {
                let cardText = $(this).prevAll(".short-text");
                let moreText = $(this).prevAll(".full-text");
                if (moreText.hasClass("d-none")) {
                    moreText.removeClass("d-none");
                    cardText.addClass("d-none");
                    // $(this).text("Less");
                } else {
                    moreText.addClass("d-none");
                    cardText.removeClass("d-none");
                    $(this).text("Read More");
                }
            });
        });
    </script>

    <script>
        function updateLikedanKomentar() {
            $(".likeLabel").each(function() {
                var id = $(this).data('id');
                var label = $(this);
                // alert(label);
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
        setInterval(updateLikedanKomentar, 10000);
    </script>
@endsection