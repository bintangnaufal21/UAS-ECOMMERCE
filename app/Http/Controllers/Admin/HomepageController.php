<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Homepage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomepageController extends Controller
{
    public function index()
    {
        $books = Book::with('category')->orderBy('title')->get();

        // ambil 1 baris homepage (kalau belum ada, null)
        $homepage = Homepage::first();

        $bannerTitle = $homepage->banner_title ?? '';
        $bannerDesc  = $homepage->banner_desc ?? '';
        $bannerImage = $homepage->banner_image ?? null;

        return view('admin.homepages.index', compact('books', 'bannerTitle', 'bannerDesc', 'bannerImage'));
    }


    public function update(Request $request)
    {
        // 1) BEST SELLER
        $selected = $request->input('bestseller_books', []);   // array id buku
        $orders   = $request->input('bestseller_order', []);   // [book_id => order]

        // reset semua dulu
        Book::query()->update([
            'is_bestseller'    => false,
            'bestseller_order' => null,
        ]);

        // set yang dicentang
        foreach ($selected as $bookId) {
            Book::where('id', $bookId)->update([
                'is_bestseller'    => true,
                'bestseller_order' => $orders[$bookId] ?? null,
            ]);
        }

        // 2) BANNER
        $homepage = Homepage::first() ?? new Homepage();

        $homepage->banner_title = $request->banner_title;
        $homepage->banner_desc  = $request->banner_desc;

        if ($request->hasFile('banner_image')) {
            // hapus gambar lama kalau ada
            if ($homepage->banner_image && Storage::disk('public')->exists($homepage->banner_image)) {
                Storage::disk('public')->delete($homepage->banner_image);
            }

            $path = $request->file('banner_image')->store('banners', 'public');
            $homepage->banner_image = $path;
        }

        $homepage->save();

        return redirect()
            ->route('admin.homepages.index')
            ->with('success', 'Homepage berhasil diperbarui.');
    }
}
