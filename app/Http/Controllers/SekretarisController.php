<?php

namespace App\Http\Controllers;

use App\Exports\EksporSurat;
use App\Models\Arsip_surat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class SekretarisController extends Controller
{

    public function dashboard() {
       
        return view('sekertaris.dashboardSekertaris');
        
        
    }

    public function index() {
        $letters = Arsip_surat::where('user_id', Auth::id())->get(); // Hanya surat milik sekretaris yang login
        $canExport = $letters->count() > 0; //info surat yang diekspor
        return view('sekertaris.arsipSekertaris', compact('letters','canExport'));

    }

     // Form tambah surat
     public function create()
     {
         return view('sekertaris.arsipSurat.create');
     }
 
     // Menyimpan surat baru
     public function store(Request $request)
     {
         $request->validate([
             'title' => 'required|string|max:255',
             'description' => 'required|string|max:255',
             'date' => 'required|date',
             'file' => 'required|file|mimes:pdf,doc,docx|max:2048', // Upload file PDF,doc,dox
         ]);
 
         $filePath = $request->file('file')->store('arsip_surat', 'public');
 
         Arsip_surat::create([
             'title' => $request->title,
             'description' => $request->description,
             'date' => $request->date,
             'file_path' => $filePath,
             'user_id' => Auth::id(), // Sekretaris yang login

             
         ]);
         // Simpan data surat ke database
        //  $letter = new Arsip_surat();
        //  $letter->user_id = Auth::id(); // User yang sedang login
        //  $letter->title = $request->title;
        //  $letter->description = $request->description;
        //  $letter->date = $request->date;
        //  $letter->file_path = $request->file('file')->store('letters', 'public'); // Simpan file ke storage
        //  $letter->save();
 
         // Catat aktivitas (Spatie Laravel Activitylog)
        //  activity()
            //  ->causedBy(Auth::user())
            //  ->performedOn($letter)
        //      ->withProperties([
        //          'title' => $letter->title,
        //          'sender' => $letter->sender,
        //          'date' => $letter->date,
        //      ])
        //      ->log('Surat baru ditambahkan');
         
         
         return redirect()->route('arsipSurat')->with('success', 'Surat berhasil diarsipkan!');
     }
 
     // Menghapus surat
     public function destroy(Arsip_surat $letter)
     {
         if ($letter->user_id != Auth::id()) {
             abort(403, 'Anda tidak diizinkan untuk menghapus surat ini.');
         }
 
         Storage::disk('public')->delete($letter->file_path);
         $letter->delete();
 
         return redirect()->route('arsipSurat')->with('success', 'Surat berhasil dihapus!');
     }
     public function export(){

        // Ambil semua surat milik user yang login
        $letters = Arsip_surat::where('user_id', Auth::id())->get();
         // Jika tidak ada surat, kembalikan dengan pesan error
        if ($letters->isEmpty()) {
            return redirect()->route('arsipSurat')->with('error', 'Tidak ada surat yang dapat diekspor.');
            }

        //log export
        activity()
            ->causedBy(Auth::user())
            ->log('Sekretaris mengekspor data surat');

         
         return Excel::download(new EksporSurat(Auth::id()), 'arsip_surat.xlsx');    
     }
}
