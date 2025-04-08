<!DOCTYPE html>
<html>
<head>
    <title>Formulir Laporan</title>
    <link rel="stylesheet" href="styles.css">
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
