<!DOCTYPE html>
<html>
<head>
    <title>Formulir Laporan</title>
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

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .title {
            color: #000000;
            margin-bottom: 10px;
        }

        .subtitle {
            color: #666;
        }

        form {
            width: 100%;
            box-sizing: border-box;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #555;
            font-weight: bold;
        }

        input[type="text"],
        input[type="file"],
        select,
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        select {
            height: 40px;
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 10px center;
            background-size: 15px;
            padding-right: 30px;
        }

        /* Style untuk dropdown list */
        select option {
            padding: 10px;
            background-color: white;
            color: #333;
        }

        /* Style untuk hover pada dropdown list */
        select option:hover,
        select option:focus,
        select option:active {
            background: #f6b23e !important;
            color: white !important;
            cursor: pointer;
        }

        /* Style untuk opsi yang dipilih */
        select option:checked {
            background: #f6b23e !important;
            color: white !important;
        }

        /* Style untuk dropdown saat dibuka */
        select:focus option:checked {
            background: #f6b23e !important;
            color: white !important;
        }

        /* Style untuk opsi yang sedang di-hover */
        select option:hover:not(:checked) {
            background: #f6b23e !important;
            color: white !important;
        }

        /* Style untuk dropdown list saat dibuka */
        select:focus {
            outline: none;
            border-color: #f6b23e;
        }

        /* Style untuk opsi dropdown */
        select option {
            padding: 8px 12px;
            background-color: white;
            color: #333;
            transition: all 0.3s ease;
        }

        /* Style untuk hover pada opsi dropdown */
        select option:hover {
            background-color: #f6b23e !important;
            color: white !important;
        }

        textarea {
            resize: vertical;
            min-height: 100px;
        }

        input[type="checkbox"] {
            margin-right: 5px;
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

        button {
            background-color: #6c757d;
            margin-left: 10px;
        }

        button:hover {
            background-color: #5a6268;
        }

        .required {
            color: red;
        }

        .optional {
            color: #666;
            font-style: italic;
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

        .form-group {
            margin-bottom: 20px;
        }

        .checkbox-container {
            display: flex;
            align-items: center;
            margin-top: 5px;
        }

        .checkbox-container input[type="checkbox"] {
            width: auto;
            margin-right: 10px;
        }

        .checkbox-container label {
            margin-bottom: 0;
            font-weight: normal;
        }

        .form-group:last-child {
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
            padding: 0 20px;
        }

        .form-group:last-child button {
            margin-left: 0;
            order: 1;
        }

        .form-group:last-child input[type="submit"] {
            margin-left: 0;
            order: 2;
        }

        /* Style untuk input yang error */
        input.error,
        select.error,
        textarea.error {
            border: 2px solid red !important;
        }

        .file-info {
            display: block;
            font-size: 10px;
            color: #666;
            margin-top: 5px;
        }

        .error-message {
            color: red;
            font-size: 12px;
            margin-top: 5px;
            display: none;
        }

        /* Hapus style :invalid */
        input[type="text"]:invalid,
        input[type="file"]:invalid,
        select:invalid,
        textarea:invalid {
            border: 1px solid #ccc;
        }

        /* Style untuk checkbox error */
        input[type="checkbox"]:invalid + .error-message {
            display: block;
            color: red;
            font-size: 12px;
            margin-top: 5px;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1 class="title">LAYANAN PENGADUAN ONLINE</h1>
        <p class="subtitle">Laporkan segera saat Anda mempunyai informasi Jalan atau Jembatan Nasional Rusak</p>
    </div>

    <div class="container">
        <form action="proses_laporan.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="jenis_laporan">Jenis Laporan <span class="required">*</span></label>
                <select name="jenis_laporan" id="jenis_laporan" required>
                    <option value="jalan_rusak">Jalan Rusak</option>
                    <option value="jembatan_rusak">Jembatan Rusak</option>
                </select>
                <span class="error-message">Kolom wajib diisi</span>
            </div>

            <div class="form-group">
                <label for="bukti_laporan">Bukti Laporan <span class="required">*</span></label>
                <input type="file" name="bukti_laporan" id="bukti_laporan" accept=".jpg,.jpeg,.png,.mp4" required>
                <span class="error-message">Kolom wajib diisi</span>
            </div>

            <div class="form-group">
                <label for="lokasi_laporan">Lokasi Laporan <span class="required">*</span></label>
                <input type="text" name="lokasi_laporan" id="lokasi_laporan" placeholder="Ketik disini" required>
                <span class="error-message">Kolom wajib diisi</span>
                <div id="map">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126748.6091242787!2d107.57311654129782!3d-6.903273917028756!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e6398252477f%3A0x146a1f93d3e815b2!2sBandung%2C%20Kota%20Bandung%2C%20Jawa%20Barat!5e0!3m2!1sid!2sid!4v1645521234567!5m2!1sid!2sid" 
                        width="100%" 
                        height="300" 
                        style="border:0;" 
                        allowfullscreen="" 
                        loading="lazy">
                    </iframe>
                </div>
            </div>

            <div class="form-group">
                <label for="ciri_lokasi">Ciri Khusus Lokasi <span class="optional">(Optional)</span></label>
                <input type="text" name="ciri_lokasi" id="ciri_lokasi" placeholder="Ketik disini">
            </div>

            <div class="form-group">
                <label for="kategori_laporan">Kategori Laporan <span class="required">*</span></label>
                <select name="kategori_laporan" id="kategori_laporan" required>
                    <option value="jalan_rusak">Jalan Rusak</option>
                    <option value="jembatan_rusak">Jembatan Rusak</option>
                    <option value="banjir">Banjir</option>
                </select>
                <span class="error-message">Kolom wajib diisi</span>
            </div>

            <div class="form-group">
                <label for="deskripsi">Deskripsi Laporan <span class="required">*</span></label>
                <textarea name="deskripsi" id="deskripsi" placeholder="Ceritakan dengan detil, jelas, dan padat" required></textarea>
                <span class="error-message">Kolom wajib diisi</span>
            </div>

            <div class="form-group">
                <label for="pernyataan">Laporan yang Saya Buat Benar dan dapat dipertanggungjawabkan <span class="required">*</span></label>
                <div class="checkbox-container">
                    <input type="checkbox" name="pernyataan" id="pernyataan" value="setuju" required>
                    <label for="pernyataan">Ya, Saya setuju</label>
                </div>
                <span class="error-message">Anda harus menyetujui pernyataan ini</span>
            </div>

            <div class="form-group">
                <input type="submit" value="Kirim">
                <button type="button">Cancel</button>
            </div>
        </form>
    </div>

    <script>
        // Script untuk validasi form
        document.querySelector('form').addEventListener('submit', function(e) {
            e.preventDefault(); // Mencegah form submit dulu
            
            // Reset semua error
            document.querySelectorAll('.error').forEach(el => {
                el.classList.remove('error');
            });
            document.querySelectorAll('.error-message').forEach(el => {
                el.style.display = 'none';
            });
            
            let isValid = true;
            
            // Validasi input text dan select
            const textInputs = document.querySelectorAll('input[type="text"], select, textarea');
            textInputs.forEach(input => {
                if (input.hasAttribute('required') && !input.value.trim()) {
                    isValid = false;
                    input.classList.add('error');
                    const errorMessage = input.nextElementSibling;
                    if (errorMessage && errorMessage.classList.contains('error-message')) {
                        errorMessage.style.display = 'block';
                    }
                }
            });
            
            // Validasi file input
            const fileInput = document.querySelector('input[type="file"]');
            if (fileInput && fileInput.hasAttribute('required')) {
                if (!fileInput.value) {
                    isValid = false;
                    fileInput.classList.add('error');
                    const errorMessage = fileInput.nextElementSibling;
                    if (errorMessage && errorMessage.classList.contains('error-message')) {
                        errorMessage.style.display = 'block';
                    }
                } else {
                    const file = fileInput.files[0];
                    const validTypes = ['image/jpeg', 'image/png', 'video/mp4'];
                    const maxSize = 10 * 1024 * 1024; // 10MB
                    
                    if (!validTypes.includes(file.type)) {
                        isValid = false;
                        fileInput.classList.add('error');
                        const errorMessage = fileInput.nextElementSibling;
                        if (errorMessage && errorMessage.classList.contains('error-message')) {
                            errorMessage.textContent = 'Format file tidak didukung. Gunakan JPG, PNG, atau MP4';
                            errorMessage.style.display = 'block';
                        }
                    }
                    
                    if (file.size > maxSize) {
                        isValid = false;
                        fileInput.classList.add('error');
                        const errorMessage = fileInput.nextElementSibling;
                        if (errorMessage && errorMessage.classList.contains('error-message')) {
                            errorMessage.textContent = 'Ukuran file terlalu besar. Maksimal 10MB';
                            errorMessage.style.display = 'block';
                        }
                    }
                }
            }
            
            // Validasi checkbox
            const checkbox = document.querySelector('input[type="checkbox"]');
            if (checkbox && checkbox.hasAttribute('required') && !checkbox.checked) {
                isValid = false;
                checkbox.classList.add('error');
                const errorMessage = checkbox.closest('.form-group').querySelector('.error-message');
                if (errorMessage) {
                    errorMessage.style.display = 'block';
                }
            }
            
            // Jika valid, submit form
            if (isValid) {
                this.submit();
            }
        });

        // Script untuk menangani hover pada dropdown list
        document.addEventListener('DOMContentLoaded', function() {
            const selects = document.querySelectorAll('select');
            
            selects.forEach(select => {
                select.addEventListener('mousedown', function() {
                    const options = this.options;
                    
                    // Menambahkan event listener untuk setiap opsi
                    Array.from(options).forEach(option => {
                        option.addEventListener('mouseover', function() {
                            this.style.backgroundColor = '#f6b23e';
                            this.style.color = 'white';
                        });
                        
                        option.addEventListener('mouseout', function() {
                            if (!this.selected) {
                                this.style.backgroundColor = 'white';
                                this.style.color = '#333';
                            }
                        });
                    });
                });
            });
        });
    </script>
</body>
</html>
