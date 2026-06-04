# evoting-ketua-kelass
Evoting  untuk pemilihan ketua kelas
I. SISTEM DASAR (Koneksi & Autentikasi)
1. koneksi.php
Fungsi: Menghubungkan jembatan komunikasi antara codingan PHP dengan database MySQL tempat penyimpanan data pemilih, kandidat, dan hasil suara.
Cara Kerja: Menggunakan ekstensi mysqli untuk mendaftarkan alamat host, username, password, dan nama database. Jika database tidak ditemukan atau password salah, file ini akan menghentikan seluruh sistem dan menampilkan pesan "Koneksi gagal".
2. proses_login.php
Fungsi: Memeriksa apakah nama pengguna (username) dan kata sandi (password) yang dimasukkan di halaman login sudah terdaftar dan sesuai dengan database.
Cara Kerja:
Menerima data yang dikirim dari form login.
Melakukan query pencarian ke tabel pengguna.
Menggunakan fungsi keamanan session (session_start()). Jika datanya cocok, server akan menandai pengguna tersebut (apakah dia berstatus sebagai Siswa atau Admin) lalu mengarahkannya ke halaman yang sesuai. Jika salah, pengguna akan dikembalikan ke halaman login dengan pesan peringatan.
3. logout.php
Fungsi: Mengakhiri sesi masuk pengguna secara aman.
Cara Kerja: Menghapus seluruh data session yang tersimpan di server menggunakan perintah session_destroy(), kemudian secara otomatis melempar (mengarahkan) pengguna kembali ke halaman index.php (form login utama).
II. HALAMAN PENGGUNA (Siswa / Pemilih)
4. index.php (Halaman Form Login Utama)
Fungsi: Pintu masuk utama website sekaligus form bagi siswa atau admin untuk memasukkan username dan password mereka.
Cara Kerja: Menyediakan tampilan input berbasis HTML. Data yang diketik oleh pengguna di halaman ini akan dilempar ke file proses_login.php menggunakan metode pengiriman tersembunyi (POST) demi alasan keamanan.
5. voting.php (Halaman Bilik Suara Digital)
Fungsi: Menampilkan daftar kandidat ketua kelas yang bisa dipilih oleh siswa.
Cara Kerja:
File ini pertama-tama akan mengecek session siswa. Jika orang yang belum login mencoba langsung membuka halaman ini, sistem akan memblokirnya secara otomatis.
Mengambil data foto, nama, nomor urut, serta visi-misi kandidat dari database untuk ditampilkan dalam bentuk kartu pilihan (card layout).
Menyediakan tombol "Pilih" atau "Vote" di bawah masing-masing kandidat.
6. proses_vote.php
Fungsi: Memproses dan mencatat pilihan suara yang diklik oleh siswa di halaman voting.php.
Cara Kerja:
Menangkap ID kandidat yang dipilih oleh siswa.
Menjalankan query INSERT untuk memasukkan suara baru ke tabel hasil voting.
Keamanan Ganda: Mengubah status siswa bersangkutan di database dari "Belum Memilih" menjadi "Sudah Memilih". Hal ini krusial agar siswa tersebut tidak bisa melakukan vote dua kali atau memanipulasi hasil suara.
Setelah selesai, siswa diarahkan ke halaman konfirmasi terima kasih atau langsung di-logout otomatis.
III. HALAMAN MANAJEMEN (Admin)
7. admin.php (Dashboard Utama Admin)
Fungsi: Tempat kendali utama bagi panitia pemilihan (Admin) untuk memantau berjalannya e-voting.
Cara Kerja:
Proteksi Hak Akses: Menolak keras akses dari akun bersatus "Siswa". Hanya akun dengan status "Admin" yang bisa melihat halaman ini.
Real-time Quick Count: Menghitung total suara masuk menggunakan fungsi agregasi SQL (COUNT) dan menampilkannya dalam bentuk diagram batang (chart) atau tabel angka persentase.
Menyediakan menu pintas untuk melihat daftar siswa yang belum memilih, menambah data kandidat baru, atau melakukan reset pemungutan suara jika terjadi simulasi ulang.
