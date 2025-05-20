<!DOCTYPE html>
<html>
<head>
    <title>Umpan Balik</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            background-color: #f5f7fa;
        }

        .navbar {
            background-color: white;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
            padding: 10px 20px;
            height: 60px;
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 20px;
            margin-left: 10px;
            color: #333;
        }

        .nav-link {
            color: #555;
            font-size: 14px;
            font-weight: 500;
        }

        .content-area {
            padding: 40px 60px;
            background: linear-gradient(135deg, #f8faff 0%, #f9f6e7 100%);
            min-height: calc(100vh - 60px);
        }

        .page-title {
            font-size: 36px;
            font-weight: 700;
            color: #333;
            margin-bottom: 5px;
            letter-spacing: -0.5px;
            text-align: center;
        }

        .subtitle {
            font-size: 16px;
            color: #555;
            margin-bottom: 35px;
            font-weight: 400;
            text-align: center;
        }

        .card-container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
            padding: 30px;
            margin-bottom: 30px;
            max-width: 650px;
            margin-left: auto;
            margin-right: auto;
        }

        .card-title {
            font-size: 18px;
            font-weight: 600;
            color: #333;
            margin-bottom: 20px;
        }

        .form-label {
            font-weight: 500;
            color: #333;
            font-size: 15px;
            margin-bottom: 4px;
        }

        .form-sublabel {
            color: #888;
            font-size: 13px;
            margin-bottom: 15px;
        }

        .emoji-rating {
            display: flex;
            gap: 12px;
            margin: 15px 0;
        }

        .emoji-option {
            cursor: pointer;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f5f5f5;
            border-radius: 50%;
            transition: transform 0.2s;
            font-size: 24px;
            opacity: 0.6;
        }

        .emoji-option:hover, .emoji-option.selected {
            opacity: 1;
            transform: scale(1.1);
        }

        .satisfaction-bar {
            height: 8px;
            background-color: #e9e9e9;
            border-radius: 4px;
            margin: 10px 0 25px;
            position: relative;
            overflow: hidden;
        }

        .satisfaction-level {
            position: absolute;
            height: 100%;
            background: linear-gradient(90deg, #ff4d4d 0%, #ffcc00 50%, #4CAF50 100%);
            width: 0%;
            border-radius: 4px;
        }

        textarea.form-control {
            border-radius: 8px;
            border: 1px solid #ddd;
            padding: 12px 15px;
            min-height: 120px;
            resize: vertical;
            margin-bottom: 5px;
            box-shadow: inset 0 1px 2px rgba(0,0,0,0.05);
            font-size: 14px;
        }

        textarea.form-control:focus {
            border-color: #ddd;
            box-shadow: inset 0 1px 2px rgba(0,0,0,0.05), 0 0 0 2px rgba(246, 178, 62, 0.2);
            outline: none;
        }

        .character-count {
            text-align: right;
            color: #888;
            font-size: 12px;
            margin-top: 5px;
        }

        .btn-container {
            display: flex;
            justify-content: flex-end;
            margin-top: 30px;
            gap: 15px;
        }

        .btn-cancel {
            background-color: white;
            color: #333;
            border: 1px solid #ddd;
            border-radius: 20px;
            font-weight: 500;
            padding: 8px 25px;
            font-size: 14px;
            transition: background 0.2s;
        }

        .btn-cancel:hover {
            background-color: #f9f9f9;
        }

        .btn-kirim {
            background-color: #f6b23e;
            color: white;
            border: none;
            border-radius: 20px;
            font-weight: 500;
            padding: 9px 30px;
            font-size: 14px;
            transition: background 0.2s;
        }

        .btn-kirim:hover {
            background-color: #f5a623;
        }

        .img-result {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            margin: 10px 0 20px;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        .mt-30 {
            margin-top: 30px;
        }

        /* Left-side gradient background effect */
        .content-wrapper {
            position: relative;
            overflow: hidden;
        }

        .gradient-bg {
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 170px;
            background: linear-gradient(180deg, #c8e0ff 0%, #dbedff 100%);
            z-index: -1;
        }

        /* Notification dropdown styles */
        .notification-dropdown {
            position: relative;
        }

        .notification-btn {
            background: none;
            border: none;
            color: #555;
            font-size: 14px;
            font-weight: 500;
            display: flex;
            align-items: center;
            padding: 8px 10px;
            border-radius: 4px;
            cursor: pointer;
            position: relative;
        }

        .notification-btn:hover {
            background-color: #f5f5f5;
        }

        .notification-btn i {
            margin-right: 5px;
        }

        .notification-badge {
            position: absolute;
            top: 0;
            right: 0;
            background-color: #f6b23e;
            color: white;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            font-size: 11px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .notification-menu {
            position: absolute;
            top: 100%;
            right: 0;
            width: 320px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            display: none;
            z-index: 1000;
            max-height: 400px;
            overflow-y: auto;
        }

        .notification-menu.show {
            display: block !important;
        }

        .notification-header {
            padding: 12px 15px;
            border-bottom: 1px solid #eee;
            font-weight: 600;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .notification-item {
            padding: 12px 15px;
            border-bottom: 1px solid #eee;
            display: flex;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .notification-item:hover {
            background-color: #f9f9f9;
        }

        .notification-item.unread {
            background-color: #f0f7ff;
        }

        .notification-item:last-child {
            border-bottom: none;
        }

        .notification-icon {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background-color: #f6b23e;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 12px;
            flex-shrink: 0;
            color: white;
        }

        .notification-content {
            flex: 1;
        }

        .notification-title {
            font-weight: 500;
            font-size: 14px;
            margin-bottom: 3px;
            color: #333;
        }

        .notification-message {
            font-size: 13px;
            color: #666;
            margin-bottom: 3px;
        }

        .notification-time {
            font-size: 11px;
            color: #999;
        }

        .empty-notifications {
            padding: 30px 20px;
            text-align: center;
            color: #888;
        }

        .notification-footer {
            padding: 10px;
            text-align: center;
            border-top: 1px solid #eee;
        }

        .show {
            display: block;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand" href="#">LaporPak!</a>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item notification-dropdown">
                    <button type="button" class="notification-btn" id="notificationDropdown">
                        <i class="fas fa-bell"></i>
                        <span>Notifikasi</span>
                        <span class="notification-badge" id="notificationBadge" style="display: none;">0</span>
                    </button>
                    <div class="notification-menu" id="notificationMenu">
                        <div class="notification-header">
                            <span>Notifikasi</span>
                            <span class="small" id="markAllRead" style="cursor: pointer; color: #f6b23e;">Tandai semua dibaca</span>
                        </div>
                        <div id="notificationList">
                            <!-- Notifications will be loaded here -->
                            <div class="empty-notifications">
                                <i class="fas fa-inbox fa-2x mb-3" style="color: #ddd;"></i>
                                <p>Tidak ada notifikasi</p>
                            </div>
                        </div>
                        <div class="notification-footer">
                            <a href="#" style="color: #f6b23e; font-size: 13px;">Lihat semua notifikasi</a>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">FAQ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Statistik</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Profil</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="content-wrapper">
        <div class="gradient-bg"></div>
        <div class="content-area">
            <!-- Display validation errors -->
            @if ($errors->any())
            <div class="alert alert-danger mb-4">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <!-- Display error message -->
            @if(session('error'))
            <div class="alert alert-danger mb-4">
                {{ session('error') }}
            </div>
            @endif

            <h1 class="page-title">UMPAN BALIK</h1>
            <p class="subtitle">Beri Umpan Balik: Perbaiki Infrastruktur untuk Masa Depan</p>

            <div class="card-container">
                <h5 class="card-title">Hasil Laporan</h5>

                @if(isset($laporanModel))
                <div class="text-center">
                    <div class="row">
                        <div class="col-md-12">
                            <h6 class="mb-2">Bukti Perbaikan</h6>
                            @if($laporanModel->feedback_file)
                                @if(pathinfo($laporanModel->feedback_file, PATHINFO_EXTENSION) == 'pdf')
                                    <div class="d-flex flex-column align-items-center">
                                        <i class="fas fa-file-pdf" style="font-size: 48px; color: #dc3545; margin-bottom: 10px;"></i>
                                        <a href="{{ asset('storage/' . $laporanModel->feedback_file) }}" target="_blank" class="btn btn-sm btn-outline-primary">Lihat PDF</a>
                                    </div>
                                @else
                                    <img src="{{ asset('storage/' . $laporanModel->feedback_file) }}" alt="Bukti Perbaikan" class="img-result">
                                @endif
                            @else
                                <div class="d-flex flex-column align-items-center justify-content-center h-100">
                                    <i class="fas fa-image" style="font-size: 48px; color: #ccc; margin-bottom: 10px;"></i>
                                    <p class="text-muted">Belum ada bukti perbaikan</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="mb-4">
                    <div class="d-flex justify-content-between mb-2">
                        <strong>Nomor Laporan:</strong>
                        <span>{{ $laporanModel->nomor_laporan }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <strong>Status:</strong>
                        <span class="badge bg-{{ $laporanModel->status == 'diajukan' ? 'warning' : ($laporanModel->status == 'selesai' ? 'success' : 'primary') }}">
                            {{ ucfirst($laporanModel->status) }}
                        </span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <strong>Jenis Laporan:</strong>
                        <span>{{ $laporanModel->jenis_laporan }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <strong>Lokasi:</strong>
                        <span>{{ $laporanModel->lokasi_laporan }}</span>
                    </div>
                </div>
                @else
                <div class="text-center">
                    <img src="{{ asset('images/jalan.jpg') }}" alt="Hasil Laporan" class="img-result">
                </div>
                @endif

                <form id="feedbackForm" method="POST" action="{{ route('users.feedback.submit') }}">
                    @csrf
                    @if(isset($laporanModel))
                    <input type="hidden" name="laporan_id" value="{{ $laporanModel->id }}">
                    @endif
                    <div>
                        <div class="form-label">Bagaimana pengalaman kamu?</div>
                        <p class="form-sublabel">Bagaimana pendapat kamu tentang ekspektasi yang telah direalisasikan?</p>

                        <div class="emoji-rating">
                            <div class="emoji-option" data-value="1">😢</div>
                            <div class="emoji-option" data-value="2">😐</div>
                            <div class="emoji-option" data-value="3">🙂</div>
                            <div class="emoji-option" data-value="4">😄</div>
                            <div class="emoji-option" data-value="5">🤩</div>
                        </div>

                        <div class="satisfaction-bar">
                            <div class="satisfaction-level"></div>
                        </div>

                        <input type="hidden" name="rating" id="rating" value="">
                    </div>

                    <div class="mt-30">
                        <div class="form-label">Ceritakan pengalaman kamu</div>
                        <p class="form-sublabel">Apa bagian pengalaman kamu sekaitan mengenai pemakaian aplikasi</p>
                        <textarea class="form-control" id="pesan_feedback" name="pesan_feedback" maxlength="500" placeholder="Beritahu video ini, saya mengalami pelan tanmbungan di sekitar mungguran nyewe yang mungkin perlu ditinjau kembali namun platform pengaduan online memudahkan saya melapor"></textarea>
                        <div class="character-count">
                            <span id="charCount">0</span>/500
                        </div>
                    </div>

                    <input type="hidden" name="kategori_feedback" value="Pengalaman Pengguna">
                    <input type="hidden" name="setuju" value="on">

                    <div class="btn-container">
                        <button type="button" class="btn btn-cancel" id="btnCancel">Cancel</button>
                        <button type="submit" class="btn btn-kirim">Kirim</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/locale/id.js"></script>
    <script>
        $(document).ready(function() {
            // Emoji selection
            $('.emoji-option').on('click', function() {
                $('.emoji-option').removeClass('selected');
                $(this).addClass('selected');

                // Get the value
                const value = $(this).data('value');
                $('#rating').val(value);

                // Update satisfaction bar
                const percentage = (value / 5) * 100;
                $('.satisfaction-level').css('width', percentage + '%');
            });

            // Character count
            $('#pesan_feedback').on('input', function() {
                const count = $(this).val().length;
                $('#charCount').text(count);
            });

            // Cancel button
            $('#btnCancel').on('click', function() {
                window.history.back();
            });

            // Form submission
            $('#feedbackForm').on('submit', function(e) {
                if (!$('#rating').val()) {
                    e.preventDefault();
                    alert('Silakan pilih salah satu emoji untuk memberikan penilaian');
                }

                if (!$('#pesan_feedback').val().trim()) {
                    e.preventDefault();
                    alert('Silakan ceritakan pengalaman Anda');
                }
            });

            // Fix for notification dropdown toggle
            $(document).on('click', '#notificationDropdown', function(e) {
                e.preventDefault();
                e.stopPropagation();
                $('#notificationMenu').toggleClass('show');
                if ($('#notificationMenu').hasClass('show')) {
                    loadNotifications();
                }
            });

            // Close dropdown when clicking outside
            $(document).on('click', function(e) {
                if (!$(e.target).closest('.notification-dropdown').length) {
                    $('#notificationMenu').removeClass('show');
                }
            });

            // Prevent dropdown from closing when clicking inside
            $(document).on('click', '#notificationMenu', function(e) {
                e.stopPropagation();
            });

            // Mark all notifications as read
            $(document).on('click', '#markAllRead', function(e) {
                e.preventDefault();
                e.stopPropagation();
                markAllNotificationsAsRead();
            });

            // Item click handler (using delegated events)
            $(document).on('click', '.notification-item', function(e) {
                e.preventDefault();
                e.stopPropagation();
                const notificationId = $(this).data('id');

                // Find the notification object in our loaded notifications
                const notification = window.loadedNotifications.find(n => n.id === notificationId);

                if (notification && notification.data && notification.data.next_endpoint) {
                    // Mark as read and navigate to the endpoint
                    markNotificationAsRead(notificationId, function() {
                        window.location.href = notification.data.next_endpoint;
                    });
                } else {
                    // Just mark as read if no endpoint
                    markNotificationAsRead(notificationId);
                }
            });

            // Load notifications initially
            setTimeout(function() {
                try {
                    loadNotifications();
                } catch (e) {
                    console.error('Error loading notifications:', e);
                }
            }, 500);

            // Notification functions
            function loadNotifications() {
                $.ajax({
                    url: '{{ route("notifications.index") }}',
                    type: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        console.log('Notifications response:', response);
                        displayNotifications(response);
                    },
                    error: function(xhr) {
                        console.error('Error loading notifications:', xhr);
                    }
                });
            }

            function displayNotifications(notifications) {
                try {
                    // Store notifications globally for access in click handler
                    window.loadedNotifications = notifications;

                    const $notificationList = $('#notificationList');
                    $notificationList.empty();

                    if (notifications && notifications.length > 0) {
                        let unreadCount = 0;

                        notifications.forEach(function(notification) {
                            // Check if read_at is null for unread status
                            const isUnread = notification.read_at === null;
                            if (isUnread) {
                                unreadCount++;
                            }

                            // Parse the data field if it's not already an object
                            let notificationData = notification.data;

                            // Safely escape any potential HTML or problematic content
                            const safeTitle = $('<div>').text(notificationData.title || '').html();
                            const safeMessage = $('<div>').text(notificationData.message || '').html();

                            const notificationItem = `
                                <div class="notification-item ${isUnread ? 'unread' : ''}" data-id="${notification.id}">
                                    <div class="notification-icon">
                                        <i class="${getNotificationIcon(notification.type)}"></i>
                                    </div>
                                    <div class="notification-content">
                                        <div class="notification-title">${safeTitle}</div>
                                        <div class="notification-message">${safeMessage}</div>
                                        <div class="notification-time">${formatDate(notification.created_at)}</div>
                                    </div>
                                </div>
                            `;

                            $notificationList.append(notificationItem);
                        });

                        // Update badge
                        if (unreadCount > 0) {
                            $('#notificationBadge').text(unreadCount).show();
                        } else {
                            $('#notificationBadge').hide();
                        }
                    } else {
                        $notificationList.html(`
                            <div class="empty-notifications">
                                <i class="fas fa-inbox fa-2x mb-3" style="color: #ddd;"></i>
                                <p>Tidak ada notifikasi</p>
                            </div>
                        `);
                        $('#notificationBadge').hide();
                    }
                } catch (error) {
                    console.error('Error displaying notifications:', error);
                    $('#notificationList').html(`
                        <div class="empty-notifications">
                            <i class="fas fa-exclamation-triangle fa-2x mb-3" style="color: #f6b23e;"></i>
                            <p>Gagal memuat notifikasi</p>
                        </div>
                    `);
                }
            }

            function markNotificationAsRead(id, callback) {
                try {
                    if (!id) {
                        console.error('Invalid notification ID');
                        return;
                    }

                    $.ajax({
                        url: `/notifications/${id}`,
                        type: 'PUT',
                        data: JSON.stringify({ read_at: new Date().toISOString() }),
                        contentType: 'application/json',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function() {
                            loadNotifications();
                            if (callback) {
                                callback();
                            }
                        },
                        error: function(xhr) {
                            console.error('Error marking notification as read:', xhr);
                        }
                    });
                } catch (error) {
                    console.error('Error in markNotificationAsRead:', error);
                }
            }

            function markAllNotificationsAsRead() {
                try {
                    const unreadItems = $('.notification-item.unread');

                    if (unreadItems.length === 0) return;

                    const promises = [];

                    unreadItems.each(function() {
                        const id = $(this).data('id');
                        const promise = $.ajax({
                            url: `/notifications/${id}`,
                            type: 'PUT',
                            data: JSON.stringify({ read_at: new Date().toISOString() }),
                            contentType: 'application/json',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });

                        promises.push(promise);
                    });

                    $.when.apply($, promises).done(function() {
                        loadNotifications();
                    }).fail(function(error) {
                        console.error('Error marking all notifications as read:', error);
                    });
                } catch (error) {
                    console.error('Error in markAllNotificationsAsRead:', error);
                }
            }

            function getNotificationIcon(type) {
                try {
                    if (!type) return 'fas fa-bell';

                    switch (type) {
                        case 'success':
                            return 'fas fa-check';
                        case 'info':
                            return 'fas fa-info';
                        case 'warning':
                            return 'fas fa-exclamation';
                        case 'danger':
                            return 'fas fa-times';
                        default:
                            return 'fas fa-bell';
                    }
                } catch (error) {
                    console.error('Error getting notification icon:', error);
                    return 'fas fa-bell';
                }
            }

            function formatDate(dateString) {
                try {
                    if (!dateString) return '';

                    moment.locale('id');
                    const date = moment(dateString);

                    if (!date.isValid()) {
                        return dateString;
                    }

                    const now = moment();

                    if (now.diff(date, 'days') < 1) {
                        return date.fromNow();
                    } else if (now.diff(date, 'days') < 7) {
                        return date.format('dddd [pukul] HH:mm');
                    } else {
                        return date.format('D MMMM YYYY [pukul] HH:mm');
                    }
                } catch (error) {
                    console.error('Error formatting date:', error);
                    return dateString || '';
                }
            }
        });
    </script>
</body>
</html>
