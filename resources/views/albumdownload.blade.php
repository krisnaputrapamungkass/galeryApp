
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <div class="container mt-2">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h4>Album</h4>
            </div>
            @foreach ($album as $item)
                {{ $item->album }}
                @foreach ($item->fotos as $itemfoto)
                    <div class="mb-3 col-md-4">
                        <div class="mt-2 card" style="width: 18rem;">
                            <img src="{{ public_path('storage/images/' . $itemfoto->foto) }}" 
                                style="text-align: center;width: 285px; height: 200px;" class="card-img-top"
                                alt="...">
                        </div>
                    </div>
                @endforeach
            @endforeach
        </div>
    </div>
</body>

</html>
