@extends('template.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">


                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h1 class="text-center">Profil</h1>
                        <button class="btn btn-sm btn-outline-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" width=24 height=24 viewBox="0 0 50 50">
                                <path fill="#FDFD" d="M10 12h30v4H10zm0 10h30v4H10zm0 10h30v4H10z"></path>
                            </svg>
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4">
                                <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=random"
                                    alt="profile" class="rounded-circle"
                                    style="width: 100px; height: 100px; object-fit: cover;">
                                <form action="{{ route('updateFoto', Auth::user()->id) }}" method="post" enctype="multipart/form-data" class="mt-4">
                                    @csrf
                                    @method('PUT')
                                    <div class="input-group flex-nowrap">
                                        <input type="file" class="form-control" name="foto"
                                            placeholder="Tidak Ada Foto yang Diupload" aria-label="Username"
                                            aria-describedby="addon-wrapping">
                                        <button type="submit" class="btn btn-primary">Upload</button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-8">
                                <h3>{{ Auth::user()->name }}</h3>
                                <p>{{ Auth::user()->email }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
