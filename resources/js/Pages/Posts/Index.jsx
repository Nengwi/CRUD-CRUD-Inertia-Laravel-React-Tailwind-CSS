import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head, usePage, Link, router } from '@inertiajs/react';

export default function Dashboard(props) { //  Ini adalah definisi komponen Dashboard. Ini adalah komponen utama yang akan diekspor dan digunakan untuk menampilkan halaman indeks posting. //
    const { posts } = usePage().props // Baris ini mengambil properti posts dari props yang diterima oleh komponen. Properti ini adalah daftar posting yang akan ditampilkan di halaman indeks.
    // Penggunaan { posts } adalah cara untuk mengekstrak nilai posts dari objek props dengan menggunakan destrukturisasi. posts didapat dari return pada PostController.php yang sudah kita buat sebelumnya tepatnya didalam blok kode//
    function destroy(e) {
        if (confirm("Apakah anda yakin ingin menghapus data post ini?")) {
            router.delete(route("posts.destroy", e.currentTarget.id));
        }
    }
    return (
        <AuthenticatedLayout auth={props.auth} user={props.auth.user} errors={props.errors} header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">All Posts</h2>}> // Ini adalah komponen layout yang digunakan sebagai tata letak (layout) untuk halaman indeks posting (Posts). Ini menerima properti seperti auth, user, dan errors dari props.//
            <Head title="Posts" /> //  Ini mengatur judul halaman web menjadi "Posts" menggunakan komponen Head//
            <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                {props.flash.success && (
                    <div className="text-center bg-gray-300 font-bold text-blue-900 p-1">
                        {props.flash.success}
                    </div>
                )}
            </div>
            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div className="p-6 bg-white border-b border-gray-200">
                            <div className="flex items-center justify-between mb-6">
                                <Link className="flex items-center px-6 py-2 text-white bg-gray-500 rounded-md focus:outline-none" href={route("posts.create")}>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor" className="w-6 h-6">
                                        <path strokeLinecap="round" strokeLinejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                    </svg>
                                    <span className="ml-2">New Post</span> // Tombol "New Post": Ada tombol "New Post" yang mengarahkan pengguna ke halaman pembuatan posting baru ketika diklik.//
                                </Link>
                            </div>

                            <table className="table-fixed w-full">
                                <thead>
                                    <tr className="text-white bg-gray-500">
                                        <th className="px-4 py-2 w-20">No.</th>
                                        <th className="px-4 py-2">Title</th>
                                        <th className="px-4 py-2">Body</th>
                                        <th className="px-4 py-2">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {posts && posts.map((item) => (
                                        <tr key={item.id}>
                                            <td className="border px-4 text-center py-2">{item.id}</td>
                                            <td className="border px-4 text-center py-2">{item.title}</td>
                                            <td className="border px-4 text-center py-2">{item.body}</td>
                                            <td className="border px-4 text-center py-2">
                                                <Link tabIndex="1" className="px-4 py-2 text-sm text-white bg-gray-500 rounded" href={route("posts.edit", item.id)} >Edit</Link>
                                                <button onClick={destroy} id={item.id} tabIndex="-1" type="button" className="mx-1 px-4 py-2 text-sm text-white bg-red-500 rounded" >Delete</button>
                                            </td>
                                        </tr>
                                    ))}
                                    {posts.length === 0 && (
                                        <tr>
                                            <td className="px-6 py-4 border-t" colSpan="4">No posts found.</td>
                                        </tr>
                                    )}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}    
