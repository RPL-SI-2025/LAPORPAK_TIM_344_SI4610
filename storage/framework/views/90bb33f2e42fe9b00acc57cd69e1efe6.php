<!DOCTYPE html>
<html>
<head>
    <title>Form Laporan</title>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
            min-height: 100vh;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .error-message {
            color: red;
        }

        .required {
            color: red;
        }

        .optional {
            color: #666;
            font-style: italic;
        }

        textarea {
            resize: vertical;
            min-height: 100px;
        }

        input[type="submit"],
        button {
            background-color: #f6b23e;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover,
        button:hover {
            background-color: #e6a23c;
        }

        .form-group {
            margin-bottom: 20px;
        }

        #map {
            height: 300px;
            width: 100%;
            margin-bottom: 20px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }

        #map iframe {
            width: 100%;
            height: 100%;
            border: 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="title">LAYANAN PENGADUAN ONLINE</h1>
        <p class="subtitle">Laporkan segera saat Anda mempunyai informasi Jalan atau Jembatan Nasional Rusak</p>

        <?php if(session('nomor_laporan')): ?>
            <div class="alert alert-success">
                Laporan berhasil dikirim! Nomor Laporan Anda adalah: <span class="font-weight-bold"><?php echo e(session('nomor_laporan')); ?></span>
            </div>
        <?php endif; ?>
        <?php if(session('error')): ?>
            <div class="alert alert-danger"><?php echo e(session('error')); ?></div>
        <?php endif; ?>
        <form id="laporanForm" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <div class="form-group">
                <label for="kategori_laporan">Jenis Laporan <span class="required">*</span></label>
                <select class="form-control" id="jenis_laporan" name="jenis_laporan" required>
                    <option value="">Pilih Jenis Laporan</option>
                    <option value="Privat">Privat/Rahasia</option>
                    <option value="Publik">Publik</option>
                </select>
                <div id="jenis_laporan_error" class="error-message"></div>
            </div>

            <div class="form-group">
                <label for="bukti_laporan">Bukti Laporan <span class="required">*</span></label>
                <input type="file" class="form-control" id="bukti_laporan" name="bukti_laporan" accept=".jpg,.jpeg,.png,.mp4" required>
                <div id="bukti_laporan_error" class="error-message"></div>
            </div>

            <div class="form-group">
                <label for="lokasi_laporan">Lokasi Laporan <span class="required">*</span></label>
                <input type="text" class="form-control" id="lokasi_laporan" name="lokasi_laporan" placeholder="Ketik disini" required>
                <div id="lokasi_laporan_error" class="error-message"></div>
                <div id="map">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126748.6091242787!2d107.57311654129782!3d-6.903273917028756!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e6398252477f%3A0x146a1f93d3e815b2!2sBandung%2C%20Kota%20Bandung%2C%20Jawa%20Barat!5e0!3m2!1sid!2sid!4v1645521234567!5m2!1sid!2sid" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>

            <div class="form-group">
                <label for="ciri_khusus_lokasi">Ciri Khusus Lokasi <span class="optional">(Optional)</span></label>
                <input type="text" class="form-control" id="ciri_khusus_lokasi" name="ciri_khusus_lokasi">
            </div>

            <div class="form-group">
                <label for="kategori_laporan">Kategori Laporan <span class="required">*</span></label>
                <select class="form-control" id="kategori_laporan" name="kategori_laporan" required>
                    <option value="">Pilih Kategori</option>
                    <option value="Jalan Rusak">Jalan Rusak</option>
                    <option value="Jembatan Rusak">Jembatan Rusak</option>
                    <option value="Banjir">Banjir</option>
                </select>
                <div id="kategori_laporan_error" class="error-message"></div>
            </div>

            <div class="form-group">
                <label for="deskripsi_laporan">Deskripsi Laporan <span class="required">*</span></label>
                <textarea class="form-control" id="deskripsi_laporan" name="deskripsi_laporan" rows="3" required></textarea>
                <div id="deskripsi_laporan_error" class="error-message"></div>
            </div>

            <div class="form-group">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="ceklis" name="ceklis" required>
                    <label class="form-check-label" for="ceklis">
                        Laporan yang Saya Buat Benar dan dapat dipertanggungjawabkan <span class="required">*</span>
                    </label>
                </div>
                <div id="pernyataan_error" class="error-message"></div>
            </div>

            <button type="submit" class="btn btn-primary">Kirim</button>
            <button type="button" class="btn btn-secondary">Cancel</button>
        </form>

        <div id="successMessage" class="alert alert-success" style="display:none;">
            Laporan berhasil dikirim! Nomor Laporan Anda adalah: <span id="nomorLaporan"></span>
        </div>
        <div id="errorMessage" class="alert alert-danger" style="display:none;"></div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#laporanForm').submit(function(e) {
                e.preventDefault();

                var formData = new FormData(this);

                $.ajax({
                    url: "<?php echo e(route('submit.laporan')); ?>",
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        $('#successMessage').show();
                        $('#nomorLaporan').text(response.nomor_laporan);
                        $('#errorMessage').hide();

                        // Reset form fields
                        $('#laporanForm')[0].reset();
                        // Clear error messages
                        $('.error-message').text('');
                    },
                    error: function(xhr, status, error) {
                        var errorMessage = '';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMessage = xhr.responseJSON.message;
                        } else {
                            errorMessage = 'Terjadi kesalahan. Silakan coba lagi.';
                        }
                        $('#errorMessage').text(errorMessage);
                        $('#errorMessage').show();
                        $('#successMessage').hide();

                        // Tampilkan pesan error dari validasi
                        if (xhr.responseJSON && xhr.responseJSON.errors) {
                            var errors = xhr.responseJSON.errors;
                            $.each(errors, function(key, value) {
                                $('#' + key + '_error').text(value[0]);
                            });
                        }
                    }
                });
            });
        });
    </script>
</body>
</html>
<?php /**PATH D:\Kuliah\Ekstensi\LaporPak\se\resources\views/form_laporan.blade.php ENDPATH**/ ?>