<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Pegawai</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <h1 class="text-center" mb-3>Edit Data Pegawai</h1>
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-8">
                <div class="card">
                    <div class="card-body">
                        <form action="/updatedata/{{$data-> id}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" name="name" id="name"
                                    aria-describedby="name" value="{{ $data->name }}">
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">Silahkan Pilih</label>
                                <select class="form-select" name="jeniskelamin" aria-label="Default select example">
                                    <option selected>{{ $data->jeniskelamin }}</option>
                                    <option value="cowo">Cowo</option>
                                    <option value="cewe">Cewe</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="notelepon" class="form-label">Nomor Telepon</label>
                                <input type="number" name="notelepon" class="form-control" id="notelepon"
                                    aria-describedby="notelepon" value="{{ $data->notelepon }}">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
