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
                <h4>Arsip Surat >> Unggah</h4>
                <p>
                    Unggah surat yang telah terbit pada form ini untuk diarsipkan. </br>
                    Catatan: </br>
                    > Gunakan file berformat PDF
                </p>
                <form method="POST" action="/arsip/insert">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label>Nomor Surat</label>
                        <input type="text" class="form-control" name="nomor" required="required">
                    </div>
                    </br>
                    <div class="form-group">
                        <label>Kategori</label>
                        <div class="col-sm-8">
                            <select name="kategori" class="form-control" required="required">
                                <option value="Undangan">Undangan</option>
                                <option value="Pengumuman">Pengumuman</option>
                                <option value="Nota Dinas">Nota Dinas</option>
                                <option value="Pemberitahuan">Pemberitahuan</option>
                            </select>
                        </div>
                    </div>
                    </br>
                    <div class="form-group">
                        <label>Judul</label>
                        <input type="text" class="form-control" name="judul" required="required">
                    </div>
                    </br>
                    <div class="form-group">
                        <label>File Surat (PDF)</label>
                        <input type="file" class="form-control" name="file" value="{{ old ('dokumen') }}">
                        @error('dokumen')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                        @enderror
                    </div>
                    </br></br>
                    <div class="form-group">
                        <a href="/arsip" class="btn btn-secondary">Kembali</a>
                        <button class="btn btn-secondary insert">Simpan</button>
                    </div>
                </form>
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
    $('.insert').click(function() {
        swal("Berhasil!", "Data surat telah ditambahkan!", "success");
    });
</script>

</html>