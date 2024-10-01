<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Pegawai</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"
        integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <h1 class="text-center" mb-3>Data Pegawai</h1>
    <div class="container">
        <a href="/tambahdata" class="btn btn-info">Tambah Pegawai +</a>
        <div class="row g-3 align-items-center mt-2">
            <div class="col-auto">
                <label for="caridata" class="col-form-label">Cari Data</label>
            </div>
            <div class="col-auto">
                <form action="/pegawai" method="GET">
                    <input type="search" name="search" id="caridata" class="form-control"
                        aria-describedby="caridata">
                </form>
            </div>
            <div class="col-auto">
                <a href="/exportPdf" class="btn btn-info">Export PDF</a>
            </div>
            <div class="col-auto">
                <a href="/exportExcel" class="btn btn-info">Export Excel</a>
            </div>
            <div class="col-auto">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    Import Data
                </button>
            </div>


            <!-- Button trigger modal -->

            <!-- Modal -->
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
                tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <form action="/importExcel" method="POST" enctype="multipart/form-data">
                    
                            @csrf
                            <div class="modal-body">
                                <div class="form-group">
                                    <input type="file" name="file" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save Data</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="row">
            {{-- @if ($message = Session::get('success'))
                <div class="alert alert-success" role="alert">
                    {{ $message }}
                </div>
            @endif --}}
            <table class="table">
        </div>
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nama</th>
                <th scope="col">foto</th>
                <th scope="col">Jenis Kelamin</th>
                <th scope="col">No Telepon</th>
                <th scope="col">Dibuat</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @php
                $no = 1;
            @endphp

            @foreach ($data as $row)
                <tr>
                    <th scope="row">{{ $no++ }}</th>
                    <td>{{ $row->name }}</td>
                    <td>
                        <img src="{{ asset('fotopegawai/' . $row->foto) }}" style="width: 40px" alt=""
                            srcset="">

                    </td>
                    <td>{{ $row->jeniskelamin }}</td>
                    <td>{{ $row->notelepon }}</td>
                    <td>{{ $row->created_at->format('D M Y') }}</td>
                    <td>
                        <a href="/tampildata/{{ $row->id }}"class="btn btn-success">Update</a>
                        {{-- <a href="/delete/{{ $row->id }}" class="btn btn-danger">Delete</a> --}}
                        <a href="#" class="btn btn-danger delete" data-id="{{ $row->id }}"
                            data-nama="{{ $row->name }}">Delete</a>

                    </td>
                </tr>
            @endforeach
        </tbody>
        </table>
        {{ $data->links() }}
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

</body>
<script>
    $('.delete').click(function() {
        var pegawaiid = $(this).attr('data-id');
        var pegawainama = $(this).attr('data-nama');

        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: "btn btn-success",
                cancelButton: "btn btn-danger"
            },
            buttonsStyling: false
        });
        swalWithBootstrapButtons.fire({
            title: "Apakah Kamu Yakin?",
            text: "Kamu akan menghapus data dengan Nama " + pegawainama + "!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel!",
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                window.location = "/delete/" + pegawaiid + ""
                swalWithBootstrapButtons.fire({
                    title: "Deleted!",
                    text: "Data berhasil dihapus.",
                    icon: "success"
                });
            } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire({
                    title: "Cancelled",
                    text: "Data tidak jadi dihapus :)",
                    icon: "error"
                });
            }
        });
    });
</script>

<script>
    @if (Session::has('success'))
        toastr.success('{{ Session::get('success') }}')
    @endif
</script>

</html>
