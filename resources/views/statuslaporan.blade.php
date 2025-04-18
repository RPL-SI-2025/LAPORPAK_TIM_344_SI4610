<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan - LaporPak</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            display: flex;
            height: 100vh;
            background: #f7f8fa;
        }

        .sidebar {
            width: 220px;
            background: white;
            padding: 20px;
            display: flex;
            flex-direction: column;
            border-right: 1px solid #eee;
        }

        .logo {
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 40px;
        }

        .logo span {
            color: #2385FC;
        }

        nav ul {
            list-style: none;
        }

        nav ul li {
            padding: 15px 0;
            color: #555;
            cursor: pointer;
        }

        nav ul li.active, nav ul li:hover {
            color: #2385FC;
            font-weight: bold;
        }

        .main-content {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .header {
            background: white;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #eee;
        }

        .search-bar {
            width: 300px;
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 6px;
        }

        .profile {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .flag {
            width: 24px;
        }

        .profile-pic {
            width: 30px;
            height: 30px;
            border-radius: 50%;
        }

        .content {
            padding: 20px;
        }

        .filters {
            display: flex;
            gap: 10px;
            margin: 20px 0;
        }

        .filters button {
            background: white;
            border: 1px solid #ddd;
            padding: 8px 15px;
            border-radius: 6px;
            cursor: pointer;
        }

        .filters .reset {
            color: red;
            border-color: red;
        }

        .report-table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0,0,0,0.05);
        }

        .report-table th, .report-table td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }

        .report-table th {
            background: #fafafa;
        }

        .status {
            padding: 5px 10px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: bold;
        }

        .status.lihat {
            background: #FFE9C8;
            color: #D99200;
        }

        .status.ditolak {
            background: #FFD7D7;
            color: #C12C2C;
        }

        .status.diproses {
            background: #E3E0FF;
            color: #5B45FF;
        }

        .status.selesai {
            background: #D7FFE0;
            color: #28A745;
        }
    </style>
</head>
<body>
    <aside class="sidebar">
        <div class="logo">Lapor<span>Pak</span></div>
        <nav>
            <ul>
                <li class="active">Dashboard</li>
                <li>Laporan</li>
                <li>Umpan Balik</li>
                <li>Pengguna</li>
                <li>Petugas</li>
                <li>Logout</li>
            </ul>
        </nav>
    </aside>

    <main class="main-content">
        <header class="header">
            <input type="text" placeholder="Search..." class="search-bar">
            <div class="profile">
                <img src="https://flagcdn.com/gb.svg" alt="English" class="flag">
                <span>English</span>
                <img src="https://via.placeholder.com/30" alt="Profile" class="profile-pic">
                <span>Moni Roy (Admin)</span>
            </div>
        </header>

        <section class="content">
            <h1>Laporan</h1>
            <div class="filters">
                <button>Filter By</button>
                <button>Date</button>
                <button>Order Type</button>
                <button>Order Status</button>
                <button class="reset">Reset Filter</button>
            </div>

            <table class="report-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Lokasi</th>
                        <th>Tanggal</th>
                        <th>Kategori Laporan</th>
                        <th>Status Verifikasi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>00001</td>
                        <td></td>
                        <td>089 Kutch Green Apt. 448</td>
                        <td>04 Sep 2019</td>
                        <td>Jalan Rusak</td>
                        <td><span class="status lihat">Lihat</span></td>
                    </tr>
                    <tr>
                        <td>00002</td>
                        <td>Rosie Pearson</td>
                        <td>979 Immanuel Ferry Suite 526</td>
                        <td>28 May 2019</td>
                        <td>Jalan Rusak</td>
                        <td><span class="status lihat">Lihat</span></td>
                    </tr>
                    <tr>
                        <td>00003</td>
                        <td>Darrell Caldwell</td>
                        <td>8587 Frida Ports</td>
                        <td>23 Nov 2019</td>
                        <td>Jalan Rusak</td>
                        <td><span class="status ditolak">Ditolak</span></td>
                    </tr>
                    <tr>
                        <td>00004</td>
                        <td></td>
                        <td>768 Destiny Lake Suite 600</td>
                        <td>05 Feb 2019</td>
                        <td>Trotoar Rusak</td>
                        <td><span class="status lihat">Lihat</span></td>
                    </tr>
                    <tr>
                        <td>00005</td>
                        <td></td>
                        <td>042 Mylene Throughway</td>
                        <td>29 Jul 2019</td>
                        <td>Jalan Rusak</td>
                        <td><span class="status diproses">Diproses</span></td>
                    </tr>
                    <tr>
                        <td>00006</td>
                        <td>Alfred Murray</td>
                        <td>543 Weinman Mountain</td>
                        <td>15 Aug 2019</td>
                        <td>Trotoar Rusak</td>
                        <td><span class="status diproses">Diproses</span></td>
                    </tr>
                    <tr>
                        <td>00007</td>
                        <td>Maggie Sullivan</td>
                        <td>New Scottieberg</td>
                        <td>21 Dec 2019</td>
                        <td>Pohon Tumbang</td>
                        <td><span class="status diproses">Diproses</span></td>
                    </tr>
                    <tr>
                        <td>00008</td>
                        <td></td>
                        <td>New Jon</td>
                        <td>30 Apr 2019</td>
                        <td>Jalan Rusak</td>
                        <td><span class="status ditolak">Ditolak</span></td>
                    </tr>
                    <tr>
                        <td>00009</td>
                        <td>Dollie Hines</td>
                        <td>124 Lyla Forge Suite 975</td>
                        <td>09 Jan 2019</td>
                        <td>Jalan Rusak</td>
                        <td><span class="status selesai">Selesai</span></td>
                    </tr>
                </tbody>
            </table>
        </section>
    </main>
</body>
</html>