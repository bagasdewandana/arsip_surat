<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Lihat Surat</title>
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
                <h4>Arsip Surat >> Lihat</h4>
                <td>Nomor : </td> {{$data->nomor}} </br>
                <td>Kategori : </td> {{$data->kategori}} </br>
                <td>Judul : </td> {{$data->judul}} </br>
                <td>Waktu Unggah : </td> {{$data->tanggal}} </br>
                <iframe src="/dokumen/{{$data->file_surat}}" height="500" width="1268"></iframe>
                <a href="/arsip" type="button" class="btn btn-secondary">
                    << Kembali</a>
                        <a href="/arsip/download/{{ $data->file_surat }}" type="button" class="btn btn-secondary">Unduh</a>
                        <a href="/arsip/edit/{{ $data->judul }}" type="button" class="btn btn-secondary">Edit/Ganti File</a>
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
</body>

</html>