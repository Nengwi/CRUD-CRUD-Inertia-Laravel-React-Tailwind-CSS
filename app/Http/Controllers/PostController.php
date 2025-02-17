<?php
   
namespace App\Http\Controllers;
    
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Post;
use Illuminate\Support\Facades\Validator;
   
class PostController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function index()
    {
        $posts = Post::all(); //digunakan untuk mengambil semua data post dari basis data.//
        return Inertia::render('Posts/Index', ['posts' => $posts]); //digunakan untuk menampilkan tampilan dengan menggunakan framework Inertia.//
    }
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function create()
    {
        return Inertia::render('Posts/Create'); // Ini adalah metode yang digunakan untuk menampilkan formulir pembuatan post baru.//
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function store(Request $request) //Ini adalah metode yang digunakan untuk menyimpan post baru ke basis data.//
    {
        Validator::make($request->all(), [
            'title' => ['required'],
            'body' => ['required'],
        ])->validate(); //digunakan untuk memvalidasi data yang diterima dari formulir. Dalam contoh ini, validasi dilakukan untuk memastikan bahwa 'title' wajib diisi dan 'body' wajib diisi.//
   
        Post::create($request->all()); // objek yang digunakan untuk mengambil data yang dikirim melalui permintaan HTTP, seperti data dari formulir.//
            
        return redirect(route('posts.index'))->with('success', 'Post created.');
    }                                                            // Kemudian, pengguna akan diarahkan kembali ke halaman daftar post dengan pesan sukses Post created.//            
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function edit(Post $post)
    {
        return Inertia::render('Posts/Edit', [
            'post' => $post
        ]);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
        Validator::make($request->all(), [
            'title' => ['required'],
            'body' => ['required'],
        ])->validate(); //digunakan untuk memastikan bahwa 'title' harus diisi dan memiliki maksimal 50 karakter, dan 'body' wajib diisi.//
    
        Post::find($id)->update($request->all()); //Setelah validasi berhasil, post yang sesuai dengan Post $post diperbarui dengan data yang sudah divalidasi menggunakan $post->update($validated).//
        return redirect(route('posts.index'))->with('success', 'Post updated.');
    }                                                              // Pengguna diarahkan kembali ke halaman daftar post dengan pesan sukses Post updated.//              
    
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function destroy($id) // Metode ini digunakan untuk menghapus entri (post) dari database berdasarkan ID yang diterima sebagai argumen.//
    {
        Post::find($id)->delete(); //Ini adalah salah satu cara untuk menghapus data dalam Laravel menggunakan Eloquent.//
        return redirect(route('posts.index'))->with('success', 'Post deleted.'); // adalah cara Laravel untuk menghasilkan URL berdasarkan nama rute yang telah ditentukan dalam file routes/web.php.//
    }
}  

// Selain itu, kita menggunakan metode with('success', 'Post deleted.') untuk menyimpan pesan sukses ke dalam session. Pesan ini dapat diakses di halaman index dan digunakan untuk memberikan umpan balik kepada pengguna bahwa penghapusan telah berhasil. Pesan ini disimpan dengan kunci 'success' dan isi pesan adalah Post deleted..//