@extends('template.master')

@section('content')
    <div class="container mt-5">
        <div class="text-center">
            <h4>Halaman Beranda</h4>
        </div>
        @if (Auth::check() == true)
            <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahFoto">
            Tambah Foto
        </button>
        <!-- Modal -->
        <div class="modal fade" id="tambahFoto" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('foto.store')}}" method="post" enctype="multipart/form-data">
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
                            <select name="status" id="" class="form-control">
                                <option value="1">Publish</option>
                                <option value="0">Draft</option>
                            </select>
                            
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
        <div class="modal fade" id="tambahAlbum" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('album.store')}}" method="post" enctype="multipart/form-data">
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
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endif
        

        
        <div class="mt-3 card" style="width: 18rem;">
            <img src="https://images.vexels.com/media/users/3/131734/isolated/preview/05d86a9b63d1930d6298b27081ddc345-photo-preview-frame-icon.png" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
        </div>
    </div>
@endsection  