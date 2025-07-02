
# Lab7Web
MIRANDA OKTAVIA SIAGIAN
T1.23.C1
312310008 

# PRAKTIKUM 3
## Modul Praktikum pemograman Lab7Web

## Modul Praktikum 2


Menjalankan CLI (Command Line Interface)
Codeigniter 4 menyediakan CLI untuk mempermudah proses development. Untuk mengakses
CLI buka terminal/command prompt.

## Konfigurasi PHP

![App Screenshot](./image/xampp.png)


Arahkan lokasi direktori sesuai dengan direktori kerja project dibuat
(xampp/htdocs/lab11_ci/ci4/)
Perintah yang dapat dijalankan untuk memanggil CLI Codeigniter adalah:

## Mengaktifkan Mode Debugging

Codeigniter 4 menyediakan fitur debugging untuk memudahkan developer untuk mengetahui
pesan error apabila terjadi kesalahan dalam membuat kode program.
Secara default fitur ini belum aktif. Ketika terjadi error pada aplikasi akan ditampilkan pesan
kesalahan seperti berikut.

## CI error

![App Screenshot](./image/whoops.png)

Semua jenis error akan ditampilkan sama. Untuk memudahkan mengetahui jenis errornya,
maka perlu diaktifkan mode debugging dengan mengubah nilai konfigurasi pada environment

## Codelgniter 4.1.2

![App Screenshot](./image/codeigniter.png)



## variable CI_ENVIRINMENT menjadi development.
Ubah nama file env menjadi .env kemudian buka file tersebut dan ubah nilai variable
CI_ENVIRINMENT menjadi development.

Contoh error yang terjadi. Untuk mencoba error tersebut, ubah kode pada file
app/Controller/Home.php hilangkan titik koma pada akhir kode.

## Konfigurasi CI

![App Screenshot](./image/environment.png)

##Struktur Direktori

Untuk lebih memahami Framework Codeigniter 4 perlu mengetahui struktur direktori dan file
yang ada. Buka pada Windows Explorer atau dari Visual Studio Code -> Open Folder.
Terdapat beberapa direktori dan file yang perlu dipahami fungsi dan kegunaannya.
• .github folder ini kita butuhkan untuk konfigurasi repo github, seperti konfigurasi untuk
build dengan github action;
• app folder ini akan berisi kode dari aplikasi yang kita kembangkan;
• public folder ini berisi file yang bisa diakses oleh publik, seperti file index.php, robots.txt,
favicon.ico, ads.txt, dll;
• tests folder ini berisi kode untuk melakukan testing dengna PHPunit;
• vendor folder ini berisi library yang dibutuhkan oleh aplikasi, isinya juga termasuk kode
core dari system CI.
• writable folder ini berisi file yang ditulis oleh aplikasi. Nantinya, kita bisa pakai untuk
menyimpan file yang di-upload, logs, session, dll.
Sedangkan file-file yang berada pada root direktori CI sebagai berikut.
• .env adalah file yang berisi variabel environment yang dibutuhkan oleh aplikasi.
• .gitignore adalah file yang berisi daftar nama file dan folder yang akan diabaikan oleh Git.
• build adalah script untuk mengubah versi codeigniter yang digunakan. Ada versi release
(stabil) dan development (labil).
• composer.json adalah file JSON yang berisi informasi tentang proyek dan daftar library
yang dibutuhkannya. File ini digunakan oleh Composer sebagai acuan.
• composer.lock adalah file yang berisi informasi versi dari libraray yang digunakan aplikasi.
• license.txt adalah file yang berisi penjelasan tentang lisensi Codeigniter;
• phpunit.xml.dist adalah file XML yang berisi konfigurasi untuk PHPunit.
• README.md adalah file keterangan tentang codebase CI. Ini biasanya akan dibutuhkan
pada repo github atau gitlab.
• spark adalah program atau script yang berfungsi untuk menjalankan server, generate kode,
dll.

## Struktur Direktori CI4

![App Screenshot](./image/ci4.png)

Fokus kita pada folder app, dimana folder tersebut adalah area kerja kita untuk membuat
aplikasi. Dan folder public untuk menyimpan aset web seperti css, gambar, javascript, dll.
Memahami Konsep MVC

##Codeigniter menggunakan konsep MVC. 

MVC meripakan singkatan dari Model-View-
Controller. MVC merupakan konsep arsitektur yang umum digunakan dalam pengembangan

aplikasi. Konsep MVC adalah memisahkan kode program berdasarkan logic proses, data, dan
tampilan. Untuk logic proses diletakkan pada direktori Contoller, Objek data diletakkan pada
direktori Model, dan desain tampilan diletakkan pada direktori View.

Codeigniter menggunakan konsep pemrograman berorientasi objek dalam
mengimplementasikan konsep MVC.
Model merupakan kode program yang berisi pemodelan data. Data dapat berupa database
ataupun sumber lainnya.
View merupakan kode program yang berisi bagian yang menangani terkait tampilan user
interface sebuah aplikasi. didalam aplikasi web biasanya pasti akan berhubungan dengan html
dan css.

Controller merupakaan kode program yang berkaitan dengan logic proses yang
menghubungkan antara view dan model. Controller berfungsi untuk menerima request dan data
dari user kemudian diproses dengan menghubungkan bagian model dan view.

Routing dan Controller

Routing merupakan proses yang mengatur arah atau rute dari request untuk menentukan
fungsi/bagian mana yang akan memproses request tersebut. Pada framework CI4, routing
bertujuan untuk menentukan Controller mana yang harus merespon sebuah request. Controller
adalah class atau script yang bertanggung jawab merespon sebuah request.
Pada Codeigniter, request yang diterima oleh file index.php akan diarahkan ke Router untuk
meudian oleh router tesebut diarahkan ke Controller.
Router terletak pada file app/config/Routes.php

## Routes PHP

![App Screenshot](./image/routes.png)

```bash
$routes->get('/', 'Home::index');
```
Kode tersebut akan mengarahkan rute untuk halaman home.
Membuat Route Baru.
Tambahkan kode berikut di dalam Routes.php

```bash
routes->get('/about', 'Page::about');
$routes->get('/contact', 'Page::contact');
$routes->get('/faqs', 'Page::faqs');
```
Untuk mengetahui route yang ditambahkan sudah benar, buka CLI dan jalankan perintah
berikut.

```bash
php spark routes
```
## Tampilan CLI

![App Screenshot](./image/spark%20routes.png)

## Tampilan Error page

![App Screenshot](./image/error%20page.png)

Ketika diakses akan mucul tampilan error 404 file not found, itu artinya file/page tersebut tidak
ada. Untuk dapat mengakses halaman tersebut, harus dibuat terlebih dahulu Contoller yang
sesuai dengan routing yang dibuat yaitu Contoller Page.

##Membuat Controller

Selanjutnya adalah membuat Controller Page. Buat file baru dengan nama page.php pada
direktori Controller kemudian isi kodenya seperti berikut.

```bash
<?php
namespace App\Controllers;
class Page extends BaseController
{
public function about()
{
echo "Ini halaman About";
}
public function contact()
{
echo "Ini halaman Contact";
}
public function faqs()
{
echo "Ini halaman FAQ";
}
}
```
Selanjutnya refresh Kembali browser, maka akan ditampilkan hasilnya yaotu halaman sudah
dapat diakses.

## Tampilan Halama Abot 

![App Screenshot](./image/halamanabout.png)

## Tampilan Halama About

![App Screenshot](./image/halaman.png)

##Auto Routing

Secara default fitur autoroute pada Codeiginiter sudah aktif. Untuk mengubah status autoroute
dapat mengubah nilai variabelnya. Untuk menonaktifkan ubah nilai true menjadi false.

```bash
$routes->setAutoRoute(true);
```
Tambahkan method baru pada Controller Page seperti berikut.

```bash
public function tos()
{
echo "ini halaman Term of Services";
}
```
Method ini belum ada pada routing, sehingga cara mengaksesnya dengan menggunakan
alamat:localhost:80/lab11_ci/ci4/public/tos

## Tampilan Halaman autoroute

![App Screenshot](./image/TOS.png)

##Membuat View

Selanjutnya adalam membuat view untuk tampilan web agar lebih menarik. Buat file baru
dengan nama about.php pada direktori view (app/view/about.php) kemudian isi kodenya
seperti berikut.

```bash
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title><?= $title; ?></title>
</head>
<body>
<h1><?= $title; ?></h1>
<hr>
<p><?= $content; ?></p>
</body>
</html>
```
ubah method about pada class Controller Page menjadi seperti berikut:
```bash
public function about()
{
return view('about', [
'title' => 'Halaman Abot',
'content' => 'Ini adalah halaman abaut yang menjelaskan tentang isi
halaman ini.'
]);
}
```
Kemudian lakukan refresh pada halaman tersebut.

## Tampilan Halaman contact 

![App Screenshot](./image/Contact.png)

##Membuat Layout Web dengan CSS
Pada dasarnya layout web dengan css dapat diimplamentasikan dengan mudah pada
codeigniter. Yang perlu diketahui adalah, pada Codeigniter 4 file yang menyimpan asset css
dan javascript terletak pada direktori public.
Buat file css pada direktori public dengan nama style.css (copy file dari praktikum
lab4_layout. Kita akan gunakan layout yang pernah dibuat pada praktikum 4.

## Tampilan Halaman FAQ

![App Screenshot](./image/FAQ.png)

# PRAKTIKUM 4 

## Membuat Layout Utama
Kemudian buat folder template pada direktori view kemudian buat file header.php dan
footer.php
File app/view/template/header.php

```bash
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title><?= $title; ?></title>
<link rel="stylesheet" href="<?= base_url('/style.css');?>">
</head>
<body>
<div id="container">
<header>
<h1>Layout Sederhana</h1>
</header>
<nav>
<a href="<?= base_url('/');?>" class="active">Home</a>
<a href="<?= base_url('/artikel');?>">Artikel</a>
<a href="<?= base_url('/about');?>">About</a>
<a href="<?= base_url('/contact');?>">Kontak</a>
</nav>
<section id="wrapper">
<section id="main">
```
File app/view/template/footer.php
```bash
</section>
<aside id="sidebar">
<div class="widget-box">
<h3 class="title">Widget Header</h3>
<ul>
<li><a href="#">Widget Link</a></li>
<li><a href="#">Widget Link</a></li>
</ul>
</div>
<div class="widget-box">
<h3 class="title">Widget Text</h3>
<p>Vestibulum lorem elit, iaculis in nisl volutpat,
malesuada tincidunt arcu. Proin in leo fringilla, vestibulum mi porta,
faucibus felis. Integer pharetra est nunc, nec pretium nunc pretium ac.</p>
</div>
</aside>
</section>
<footer>
<p>&copy; 2021 - Universitas Pelita Bangsa</p>
</footer>
</div>
</body>
</html>
```
Kemudian ubah file app/view/about.php seperti berikut.
```bash
<?= $this->include('template/header'); ?>
<h1><?= $title; ?></h1>
<hr>
<p><?= $content; ?></p>
<?= $this->include('template/footer'); ?>
```
Selanjutnya refresh tampilan

## Tampilan Halaman Database 

![App Screenshot](./image/database.png)

## Tampilan Halaman php spark

![App Screenshot](./image/php%20spark.png)

Pada bagian extention, hilangkan tanda ; (titik koma) pada ekstensi yang akan diaktifkan.
Kemudian simpan kembali filenya dan restart Apache web server.

## Tampilan Halaman php spark setelah restart Apache web server

![App Screenshot](./image/php_spark2.png)

Instalasi Codeigniter 4

Untuk melakukan instalasi Codeigniter 4 dapat dilakukan dengan dua cara, yaitu cara manual
dan menggunakan composer. Pada praktikum ini kita menggunakan cara manual.
• Unduh Codeigniter dari website https://codeigniter.com/download
• Extrak file zip Codeigniter ke direktori htdocs/lab11_ci.
• Ubah nama direktory framework-4.x.xx menjadi ci4.
• Buka browser dengan alamat http://localhost/lab11_ci/ci4/public/ 

## Tampilan Halaman Web

![App Screenshot](./image/layout.png)

## Pertanyaan dan Tugas

1. Manfaat utama dari penggunaan View Layout dalam pengembangan aplikasi:
View Layout adalah template utama yang digunakan untuk membungkus semua halaman (view) di aplikasi.

Manfaat utamanya:

Konsistensi Tampilan: Semua halaman memiliki header, footer, sidebar, dan struktur layout yang konsisten.

Menghindari Pengulangan Kode: Tidak perlu menulis ulang struktur HTML umum pada setiap file view 

```bash
(misalnya: tag <head>, <nav>, <footer>).
```

Pemeliharaan Lebih Mudah: Perubahan pada layout global (seperti mengganti tema atau header) cukup dilakukan di satu file layout saja.

Lebih Modular dan Terorganisir: Setiap bagian halaman (konten, sidebar, footer) bisa diatur sebagai bagian terpisah dan dipanggil sesuai kebutuhan.

 2. Perbedaan antara View Cell dan View biasa:

 FITUR : fungsi, reusable, pemanggilan , cocok untuk lifecycle.

VIEW CELL: menyiapkan komponen kecil (modul) di dalam view , sangat bisa di gunakan berulang (moduler)
```bash
<?= view_cell('NameClass::method') ?>
```
Widget seperti : post terbaru, komentar , iklan, sidebar.
Di render melalui controller/helper.
VIEW BIASA : manmpilkan satu halaman penuh
kurang fleksibel untuk bagian kecil, 

```bash
return view('name_view')
```
konten utama halaman
di-render langsung dari controller


Contoh penggunaan View Cell:

php

```bash
<?= view_cell('\App\Libraries\PostWidget::recentPosts') ?>
```
3. Ubah View Cell agar hanya menampilkan post dengan kategori tertentu:
Langkah-langkah:
Misalkan Anda memiliki class PostWidget dengan method recentPosts.

a. Tambahkan parameter kategori di method-nya:
php
```bash
namespace App\Libraries;

use App\Models\PostModel;

class PostWidget
{
    public function recentPosts($kategori = null)
    {
        $postModel = new PostModel();

        if ($kategori) {
            $data['posts'] = $postModel->where('kategori', $kategori)
                                       ->orderBy('created_at', 'DESC')
                                       ->findAll(5);
        } else {
            $data['posts'] = $postModel->orderBy('created_at', 'DESC')->findAll(5);
        }

        return view('components/recent_posts', $data);
    }
}
```

b. Panggil View Cell-nya dengan parameter kategori:
php
```bash
<?= view_cell(['\App\Libraries\PostWidget::recentPosts', 'kategori' => 'teknologi']) ?>
```
Dengan cara ini, View Cell hanya akan menampilkan post dengan kategori teknologi saja.



# PRAKTIKUM 5 
1. MEMBUAT TABEL USER PADA DATA BASE 

![App Screenshot](./image/praktikum5/pra1.png)

2. MEMBUAT MODEL USER 

Selanjutnya adalah membuat Model untuk memproses data Login. Buat file baru pada direktori
app/Models dengan nama UserModel.php

![App Screenshot](./image/praktikum5/pra2.png)

3. MEMBUAT CONTROLLER USER

Buat Controller baru dengan nama User.php pada direktori app/Controllers. Kemudian
tambahkan method index() untuk menampilkan daftar user, dan method login() untuk proses
login.

![App Screenshot](./image/praktikum5/pra3a.png)
![App Screenshot](./image/praktikum5/pra3b.png)
![App Screenshot](./image/praktikum5/pra3c.png)

4. MEMBUAT VIEW LOGIN

Buat file baru pada direktori app/Views dengan nama login.php. Kemudian tambahkan
form login dengan method post dan action pada controller User.
![App Screenshot](./image/praktikum5/pra4a.png)
![App Screenshot](./image/praktikum5/pra4b.png)

5. MEMBUAT DATABASE SEEDER 

Database seeder digunakan untuk membuat data dummy. Untuk keperluan ujicoba modul
login, kita perlu memasukkan data user dan password kedaalam database. Untuk itu buat
database seeder untuk tabel user.

```bash
php spark make:seeder UserSeeder
```
Selanjutnya, buka file UserSeeder.php yang berada di lokasi direktori
/app/Database/Seeds/UserSeeder.php kemudian isi dengan kode berikut:

![App Screenshot](./image/praktikum5/pra5b.png)

selanjutnya buka kembali CLI dan ketik perintah berikut :

```bash
php spark db:seed UserSeeder
```
UJI COBA LOGIN

Selanjutnya buka url http://localhost:8080/user/login seperti berikut:

![App Screenshot](./image/praktikum5/pra5a.png)

6. MENAMBAHKAN AUTH FILTER 

Selanjutnya membuat filer untuk halaman admin. Buat file baru dengan nama Auth.php pada
direktori app/Filters.

![App Screenshot](./image/praktikum5/pra6.png)

selanjutnya buka file app/Config/Filters.php tambahkan kode berikut : 

![App Screenshot](./image/praktikum5/pra7.png)

selanjutnya buka filr app/Config/Routes.php dan sesuaikan kodenya. 

![App Screenshot](./image/praktikum5/pra8.png)

7. PERCOBAAN AKSES MENU ADMIN

Buka url dengan alamat http://localhost:8080/admin/artikel ketika alamat tersebut diakses
maka, akan dimuculkan halaman login.

![App Screenshot](./image/praktikum5/pra5a.png)

8. Fungsi Logout 

Tambahkan method logout pada Controller User seperti berikut : 

![App Screenshot](./image/praktikum5/pra9.png)

# PRAKTIKUM 6

1. Membuat Pagination

Pagination merupakan proses yang digunakan untuk membatasi tampilan yang panjang
dari data yang banyak pada sebuah website. Fungsi pagination adalah memecah tampilan
menjadi beberapa halaman tergantung banyaknya data yang akan ditampilkan pada
setiap halaman.

Pada Codeigniter 4, fungsi pagination sudah tersedia pada Library sehingga cukup mudah
menggunakannya.

Untuk membuat pagination, buka Kembali Controller Artikel, kemudian modifikasi kode
pada method admin_index seperti berikut.

![App Screenshot](./image/praktikum6/pra1.png)

Kemudian buka file views/artikel/admin_index.php dan tambahkan kode berikut
dibawah deklarasi tabel data.

![App Screenshot](./image/praktikum6/pra2.png)


Selanjutnya buka kembali menu daftar artikel, tambahkan data lagi untuk melihat
hasilnya.

![App Screenshot](./image/praktikum6/pra3.png)

Membuat Pencarian

Pencarian data digunakan untuk memfilter data.
Untuk membuat pencarian data, buka kembali Controller Artikel, pada method
admin_index ubah kodenya seperti berikut: 

![App Screenshot](./image/praktikum6/pra4.png)

Kemudian buka kembali file views/artikel/admin_index.php dan tambahkan form
pencarian sebelum deklarasi tabel seperti berikut:

![App Screenshot](./image/praktikum6/pra5.png)

Selanjutnya ujicoba dengan membuka kembali halaman admin artikel, masukkan kata
kunci tertentu pada form pencarian.

![App Screenshot](./image/praktikum6/pra3.png)

# PRAKTIKUM 7

Langkah-langkah Praktikum

Upload Gambar pada Artikel
Menambahkan fungsi unggah gambar pada tambah artikel.
Buka kembali Controller Artikel pada project sebelumnya, sesuaikan kode pada method
add seperti berikut:

![App Screenshot](./image/praktikum7/pra2.png)

Kemudian pada file views/artikel/form_add.php tambahkan field input file seperti
berikut.

```bash
<p>
    <input type="file" name="gambar">
</p>
```
Dan sesuaikan tag form dengan menambahkan ecrypt type seperti berikut.

```bash
<form action="" method="post" enctype="multipart/form-data">
```

Ujicoba file upload dengan mengakses menu tambah artikel.

![App Screenshot](./image/praktikum7/pra1.png)

# PRAKTIKUM 9

## Mengubah Tabel Artikel
Tambahkan foreign key `id_kategori` pada tabel `artikel` untuk membuat relasi dengan tabel
`kategori`.
Query untuk menambahkan foreign key:
`ALTER TABLE artikel
ADD COLUMN id_kategori INT(11),
ADD CONSTRAINT fk_kategori_artikel
FOREIGN KEY (id_kategori) REFERENCES kategori(id_kategori);`

![App Screenshot](./image/praktikum9/pra1.png)

![App Screenshot](./image/praktikum9/pra1a.png)

## Membuat Model Kategori
Buat file model baru di `app/Models` dengan nama `KategoriModel.php`:

![App Screenshot](./image/praktikum9/pra2.png)

## Memodifikasi Model Artikel
Modifikasi `ArtikelModel.php` untuk mendefinisikan relasi dengan `KategoriModel`:

![App Screenshot](./image/praktikum9/pra3.png)

![App Screenshot](./image/praktikum9/pra3a.png)


Menambahkan method `getArtikelDenganKategori()` untuk mengambil data artikel beserta
nama kategorinya menggunakan join.

## Memodifikasi Controller Artikel
Modifikasi `Artikel.php` untuk menggunakan model baru dan menampilkan data relasi:

![App Screenshot](./image/praktikum9/pra4a.png)

![App Screenshot](./image/praktikum9/pra4b.png)

![App Screenshot](./image/praktikum9/pra4c.png)

![App Screenshot](./image/praktikum9/pra4d.png)

![App Screenshot](./image/praktikum9/pra4e.png)

![App Screenshot](./image/praktikum9/pra4f.png)

![App Screenshot](./image/praktikum9/pra4g.png)

![App Screenshot](./image/praktikum9/pra4h.png)

![App Screenshot](./image/praktikum9/pra4i.png)

## Memodifikasi View
Buka folder view/artikel sesuaikan masing-masing view.
index.php

![App Screenshot](./image/praktikum9/pra5.png)

admin_index.php

![App Screenshot](./image/praktikum9/pra6a.png)

![App Screenshot](./image/praktikum9/pra6b.png)

![App Screenshot](./image/praktikum9/pra6c.png)

![App Screenshot](./image/praktikum9/pra6d.png)

![App Screenshot](./image/praktikum9/pra6e.png)

![App Screenshot](./image/praktikum9/pra6f.png)

![App Screenshot](./image/praktikum9/pra6g.png)

![App Screenshot](./image/praktikum9/pra6h.png)

![App Screenshot](./image/praktikum9/pra6i.png)

![App Screenshot](./image/praktikum9/pra6j.png)

![App Screenshot](./image/praktikum9/pra6k.png)

form_add.php

![App Screenshot](./image/praktikum9/pra7.png)

form_edit.php

![App Screenshot](./image/praktikum9/pra8.png)

## Testing
Lakukan uji coba untuk memastikan semua fungsi berjalan dengan baik:
• Menampilkan daftar artikel dengan nama kategori.
• Menambah artikel baru dengan memilih kategori.
• Mengedit artikel dan mengubah kategorinya.
• Menghapus artikel.

# PRAKTIKUM 10

Apa itu AJAX?

AJAX merupakan singkatan dari Asynchronous JavaScript and XML. Meskipun
kepanjangannya menyebutkan XML, pada praktiknya AJAX tidak terbatas pada
penggunaan XML saja. AJAX adalah kumpulan teknik pengembangan web yang
memungkinkan aplikasi web bekerja secara asynchronous (tidak langsung).
Dengan kata lain, AJAX memungkinkan aplikasi web untuk memperbarui dan
menampilkan data dari server tanpa harus melakukan reload halaman secara
keseluruhan. Hal ini membuat aplikasi web terasa lebih responsif dan dinamis.

Cara Kerja AJAX

AJAX bekerja dengan cara berikut:
1. Event Trigger:
Pengguna melakukan suatu aksi di halaman web, misalnya menekan tombol atau
mengetikkan sesuatu pada formulir.
2. Request Dikirim:
JavaScript di browser akan membuat request HTTP ke server. Request ini biasanya
berupa request GET atau POST, dan bisa membawa data tambahan jika diperlukan.
3. Server Memproses Request:
Server menerima request dan memprosesnya sesuai dengan kebutuhan. Server bisa
mengambil data dari database, melakukan kalkulasi tertentu, atau melakukan aksi
lainnya.
4. Respon Dikembalikan:
Server mengirimkan respon kembali ke browser. Respon ini biasanya berupa data
dalam format JSON (JavaScript Object Notation) atau format lainnya.
5. Data Ditampilkan:
JavaScript di browser menerima respon dari server. JavaScript kemudian memproses
data tersebut dan memperbarui bagian tertentu dari halaman web tanpa perlu
melakukan reload keseluruhan.
Keuntungan menggunakan AJAX:
• Meningkatkan User Experience (UX): Hal ini karena halaman web tidak perlu
dimuat ulang setiap kali ada interaksi pengguna, sehingga membuat aplikasi web
terasa lebih responsif dan dinamis.
• Menghemat Bandwidth: Hanya data yang dibutuhkan yang dikirimkan antara
browser dan server, sehingga menghemat bandwidth dan mempercepat loading
halaman.
• Mempertahankan State Aplikasi: Dengan AJAX, state aplikasi (misalnya data yang
sedang diedit) bisa dipertahankan walaupun halaman tidak di-reload.
Contoh Penggunaan AJAX:
• Live chat applications
• Autocomplete suggestions
• Real-time updates (misalnya pada papan skor pertandingan olahraga)
• Validasi formulir secara real-time
• Dan masih banyak lagi
Dengan memahami konsep dan cara kerja AJAX, Anda dapat membuat aplikasi web yang
lebih interaktif dan menarik bagi pengguna.

## Menambahkan Pustaka jQuery.
Kita akan menggunakan pustaka jQuery untuk mempermudah proses AJAX. Download
pustaka jQuery versi terbaru dari https://jquery.com dan ekstrak filenya.
Salin file jquery-3.6.0.min.js ke folder public/assets/js.

## Membuat Model.

Pada modul sebelumnya sudah dibuat ArtikelModel, pada modul ini kita akan
memanfaatkan model tersebut agar dapat diakses melalui AJAX.

## Membuat AJAX Controller
![App Screenshot](./image/praktikum10/pra1a.png)

![App Screenshot](./image/praktikum10/pra1b.png)

## Membuat View

![App Screenshot](./image/praktikum10/pra2a.png)

![App Screenshot](./image/praktikum10/pra2b.png)

![App Screenshot](./image/praktikum10/pra2c.png)

![App Screenshot](./image/praktikum10/pra2d.png)

![App Screenshot](./image/praktikum10/pra2e.png)

![App Screenshot](./image/praktikum10/pra2f.png)

![App Screenshot](./image/praktikum10/pra2g.png)

![App Screenshot](./image/praktikum10/pra2h.png)

![App Screenshot](./image/praktikum10/pra2i.png)

![App Screenshot](./image/praktikum10/pra2j.png)


# PRAKTIKUM 11

## Modifikasi Controller Artikel
Ubah method `admin_index()` di `Artikel.php` untuk mengembalikan data dalam format
JSON jika request adalah AJAX. (Sama seperti modul sebelumnya)

![App Screenshot](./image/praktikum11/pra1.png)

![App Screenshot](./image/praktikum11/pra2.png)

![App Screenshot](./image/praktikum11/pra3.png)


## Modifikasi View (admin_index.php)
* Ubah view `admin_index.php` untuk menggunakan jQuery.
* Hapus kode yang menampilkan tabel artikel dan pagination secara langsung.
* Tambahkan elemen untuk menampilkan data artikel dan pagination dari AJAX.
* Tambahkan kode jQuery untuk melakukan request AJAX.

![App Screenshot](./image/praktikum11/pra4.png)

![App Screenshot](./image/praktikum11/pra5.png)

![App Screenshot](./image/praktikum11/pra6.png)

![App Screenshot](./image/praktikum11/pra7.png)

![App Screenshot](./image/praktikum11/pra8.png)

# PRAKTIKUM 12

## Apa itu REST API?

Representational State Transfer (REST) adalah salah satu desain arsitektur Application
Programming Interface (API). API sendiri merupakan interface yang menjadi perantara
yang menghubungkan satu aplikasi dengan aplikasi lainnya.
REST API berisi aturan untuk membuat web service dengan membatasi hak akses client
yang mengakses API. Kenapa harus demikian?
Jika dianalogikan sebagai restoran, REST API adalah daftar menu. Pelanggan hanya bisa
memesan sesuai daftar menu meskipun si koki (server) bisa membuatkan pesanan
tersebut.

REST API bisa diakses atau dihubungkan dengan aplikasi lain. Oleh sebab itu, pembatasan
dilakukan untuk melindungi database/resource yang ada di server.
Cara kerja REST API menggunakan prinsip REST Server dan REST Client.
REST Server bertindak sebagai penyedia data/resource, sedangkan REST Client akan
membuat HTTP request pada server dengan URI atau global ID. Nantinya, server akan
memberikan response dengan mengirim kembali HTTP request yang diminta client.
Nah, data yang dikirim maupun diterima ini biasanya berformat JSON. Itulah kenapa REST
API mudah diintegrasikan dengan berbagai platform dengan bahasa pemrograman
ataupun framework yang berbeda.

Misalnya, Anda membuat backend project menggunakan REST API dengan bahasa
pemrograman PHP. Nantinya, REST API tersebut bisa dihubungkan dengan frontend yang
menggunakan Vue js.

Pengembangan aplikasi tentu lebih cepat dan efisien, kan? Apalagi, cara membuat REST
API juga mudah. Anda bisa menggunakan framework PHP seperti CodeIgniter.
Kebetulan, di artikel ini kami akan menjelaskan cara membuat web service dengan
CodeIgniter. Yuk, simak selengkapnya!

Langkah-langkah Praktikum

Persiapan
Periapan awal adalah mengunduh aplikasi REST Client, ada banyak aplikasi yang dapat digunakan untuk
keperluan tersebut. Salah satunya adalah Postman. Postman – Merupakan aplikasi yang berfungsi
sebagai REST Client, digunakan untuk testing REST API. Unduh apliasi Postman dari tautan berikut:
https://www.postman.com/downloads/

Membuat Model.

Pada modul sebelumnya sudah dibuat ArtikelModel, pada modul ini kita akan memanfaatkan model
tersebut agar dapat diakses melalui API.

Membuat REST Controller

Pada tahap ini, kita akan membuat file REST Controller yang berisi fungsi untuk menampilkan,
menambah, mengubah dan menghapus data. Masuklah ke direktori app\Controllers dan buatlah file
baru bernama Post.php. Kemudian, salin kode di bawah ini ke dalam file tersebut:

![App Screenshot](./image/praktikum12/pra1.png)

![App Screenshot](./image/praktikum12/pra2.png)

![App Screenshot](./image/praktikum12/pra3.png)

Kode diatas berisi 5 method, yaitu:
• index() – Berfungsi untuk menampilkan seluruh data pada database.
• create() – Berfungsi untuk menambahkan data baru ke database.
• show() – Berfungsi untuk menampilkan suatu data spesifik dari database.
• update() – Berfungsi untuk mengubah suatu data pada database.
• delete() – Berfungsi untuk menghapus data dari database.

Membuat Routing REST API

Untuk mengakses REST API CodeIgniter, kita perlu mendefinisikan route-nya terlebih dulu.
Caranya, masuklah ke direktori app/Config dan bukalah file Routes.php. Tambahkan kode
di bawah ini:

```bash
$routes->resource('post');
```

Untuk mengecek route nya jalankan perintah berikut:
```bash
php spark routes
```

Selanjutnya akan muncul daftar route yang telah dibuat.

![App Screenshot](./image/praktikum12/pra4.png)

![App Screenshot](./image/praktikum12/pra5.png)

![App Screenshot](./image/praktikum12/pra6.png)

Seperti yang terlihat, satu baris kode routes yang di tambahkan akan menghasilkan banyak
Endpoint.
Selanjutnya melakukan uji coba terhadap REST API CodeIgniter.

## Testing REST API CodeIgniter

Buka aplikasi postman dan pilih create new → HTTP Request

![App Screenshot](./image/praktikum12/pra7.png)

Menampilkan Semua Data

Pilih method GET dan masukkan URL berikut:

http://localhost:8080/post

Lalu, klik Send. Jika hasil test menampilkan semua data artikel dari database, maka pengujian
berhasil.

![App Screenshot](./image/praktikum12/pra8.png)

Menampilkan Data Spesifik

Masih menggunakan method GET, hanya perlu menambahkan ID artikel di belakang URL
seperti ini:

http://localhost:8080/post/2

Selanjutnya, klik Send. Request tersebut akan menampilkan data artikel yang memiliki ID
nomor 2 di database.

![App Screenshot](./image/praktikum12/pra9.png)

Mengubah Data

Untuk mengubah data, silakan ganti method menjadi PUT. Kemudian, masukkan URL artikel
yang ingin diubah. Misalnya, ingin mengubah data artikel dengan ID nomor 2, maka masukkan
URL berikut:

http://localhost:8080/post/2

Selanjutnya, pilih tab Body. Kemudian, pilih x-www-form-uriencoded. Masukkan nama
atribut tabel pada kolom KEY dan nilai data yang baru pada kolom VALUE. Kalau sudah,
klik Send.

![App Screenshot](./image/praktikum12/pra10.png)

Menambahkan Data

Anda perlu menggunakan method POST untuk menambahkan data baru ke database.
Kemudian, masukkan URL berikut:

http://localhost:8080/post

Pilih tab Body, lalu pilih x-www-form-uriencoded. Masukkan atribut tabel pada kolom KEY
dan nilai data baru di kolom VALUE. Jangan lupa, klik Send.

![App Screenshot](./image/praktikum12/pra11.png)

