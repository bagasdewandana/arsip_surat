<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Arsip Surat</title>
    <!-- bootstrap 5 css -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/css/bootstrap.min.css" integrity="sha384-DhY6onE6f3zzKbjUPRc2hOzGAdEf4/Dz+WJwBvEYL/lkkIsI3ihufq9hk9K4lVoK" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />
    <style>
        li {
            list-style: none;
            margin: 20px 0 20px 0;
        }

        a {
            text-decoration: none;
        }

        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            margin-left: -300px;
            transition: 0.4s;
        }

        .active-main-content {
            margin-left: 250px;
        }

        .active-sidebar {
            margin-left: 0;
        }

        #main-content {
            transition: 0.4s;
        }
    </style>
</head>

<body>
    <div>
        <div class="sidebar p-4 bg-primary" id="sidebar">
            <h4 class="mb-5 text-white">Menu</h4>
            <li>
                <a class="text-white" href="/arsip">
                    <i class="bi bi-star-fill mr-2"></i>
                    Arsip
                </a>
            </li>
            <li>
                <a class="text-white" href="/about">
                    <i class="bi bi-info-circle-fill mr-2"></i>
                    About
                </a>
            </li>
        </div>
    </div>
    <section class="p-4" id="main-content">
        <button class="btn btn-primary" id="button-toggle">
            <i class="bi bi-list"></i>
        </button>
        <div class="card mt-5">
            <div class="card-body">
                <h4>Arsip Surat</h4>
                <p>
                    Berikut ini adalah surat-surat yang telah terbit dan diarsipkan. </br>
                    Klik "Lihat" pada kolom aksi untuk menampilkan surat
                </p>
                <form action="/arsip/cari" method="GET">
                    <div class="input-group mb-2">
                        <p>Cari surat:&nbsp;&nbsp;</p>
                        <input type="text" class="form-control" name="cari" placeholder="search" value="{{ old('cari') }}">
                        <input type="submit" value="&nbsp;&nbsp;Cari!&nbsp;&nbsp;">
                    </div>
                </form>
                <table class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">Nomor Surat</th>
                            <th class="text-center">Kategori</th>
                            <th class="text-center">Judul</th>
                            <th class="text-center">Waktu Pengerjaan</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($data as $s => $value)
                        <tr>
                            <td>{{ $value->nomor}}</td>
                            <td>{{ $value->kategori}}</td>
                            <td>{{ $value->judul}}</td>
                            <td>{{ $value->tanggal}}</td>
                            <td><a href="#" type="button" class="btn btn-danger delete" data-id="{{ $value->judul }}">Hapus</a>
                                <a href="/arsip/download/{{ $value->file_surat }}" type="button" class="btn btn-warning">Unduh</a>
                                <a href="/arsip/lihat/{{ $value->judul }}" type="button" class="btn btn-primary">Lihat >></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <a href="/arsip/tambah" type="button" class="btn btn-secondary">Arsipkan Surat...</a>
            </div>
        </div>
    </section>
    <script>
        // event will be executed when the toggle-button is clicked
        document.getElementById("button-toggle").addEventListener("click", () => {

            // when the button-toggle is clicked, it will add/remove the active-sidebar class
            document.getElementById("sidebar").classList.toggle("active-sidebar");

            // when the button-toggle is clicked, it will add/remove the active-main-content class
            document.getElementById("main-content").classList.toggle("active-main-content");
        });
    </script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.slim.js" integrity="sha256-tXm+sa1uzsbFnbXt8GJqsgi2Tw+m4BLGDof6eUPjbtk=" crossorigin="anonymous"></script>
</body>
<script>
    $('.delete').click(function() {
        var judul = $(this).attr('data-id');
        swal({
                title: "Apakah anda yakin?",
                text: "Anda akan menghapus data surat dengan judul " + judul + " ",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    window.location = "/arsip/hapus/" + judul + ""
                    swal("Data surat berhasil dihapus", {
                        icon: "success",
                    });
                } else {
                    swal("Data surat batal dihapus");
                }
            });
    });
</script>

</html>