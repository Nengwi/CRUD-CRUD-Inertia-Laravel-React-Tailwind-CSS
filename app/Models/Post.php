<?php

namespace App\Models; // Ini adalah deklarasi namespace yang menentukan lokasi kelas //

use Illuminate\Database\Eloquent\Factories\HasFactory; //alat bantu yang digunakan untuk mempermudah pembuatan data dummy (dummy data) saat mengembangkan dan menguji aplikasi.//
use Illuminate\Database\Eloquent\Model; //Ini adalah pernyataan use yang mengimpor kelas Model dari Laravel.//

class Post extends Model // Ini adalah deklarasi kelas Post yang menggambarkan model Eloquent dalam aplikasi Laravel.//
{
    use HasFactory; // Ini adalah penggunaan trait HasFactory. Trait ini memberikan kemampuan untuk membuat data dummy yang terkait dengan model Post.//

    protected $fillable = [
        'title', 'body'     
    ]; //Ini adalah properti yang mendefinisikan kolom-kolom dalam tabel yang dapat diisi (fillable) secara massal (mass-assignment).//
}

