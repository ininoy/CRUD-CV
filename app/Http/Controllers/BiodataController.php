<?php
namespace App\Http\Controllers;

use App\Models\Biodata;
use App\Models\Pendidikan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BiodataController extends Controller
{

    public function index(Request $request)
    {
        $query = Biodata::query();

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('nama', 'LIKE', "%{$search}%")
                ->orWhere('email', 'LIKE', "%{$search}%")
                ->orWhere('jurusan_kelas', 'LIKE', "%{$search}%");
        }

        $biodatas = $query->latest()->get();
        return view('biodata.index', compact('biodatas'));
    }

    public function create()
    {
        return view('biodata.create');
    }

    public function store(Request $request)
    {

        $request->validate([
            'nim'           => 'required|unique:biodata_1152,nim',
            'nama'          => 'required',
            'jurusan_kelas' => 'required',
            'email'         => 'required|email',
            'telepon'       => 'required',
            'alamat'        => 'required',
            'foto'          => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('foto_profil', 'public');
        }

        Biodata::create($data);

        return redirect()->route('biodata.index')->with('success', 'Data biodata berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $biodata = Biodata::findOrFail($id);
        return view('biodata.edit', compact('biodata'));
    }

    public function update(Request $request, $id)
    {
        $biodata = Biodata::findOrFail($id);

        $request->validate([
            'nim'           => 'required|unique:biodata_1152,nim,' . $id,
            'nama'          => 'required',
            'jurusan_kelas' => 'required',
            'email'         => 'required|email',
            'telepon'       => 'required',
            'alamat'        => 'required',
            'foto'          => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('foto')) {
            if ($biodata->foto && Storage::disk('public')->exists($biodata->foto)) {
                Storage::disk('public')->delete($biodata->foto);
            }
            $data['foto'] = $request->file('foto')->store('foto_profil', 'public');
        }

        $biodata->update($data);

        return redirect()->route('biodata.index')->with('success', 'Data biodata berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $biodata = Biodata::findOrFail($id);

        // Hapus file foto dari storage jika ada
        if ($biodata->foto && Storage::disk('public')->exists($biodata->foto)) {
            Storage::disk('public')->delete($biodata->foto);
        }

        $biodata->delete();

        return redirect()->route('biodata.index')->with('success', 'Data biodata berhasil dihapus!');
    }

    public function cv($id)
    {
        $biodata = Biodata::with('pendidikans')->findOrFail($id);
        return view('biodata.cv', compact('biodata'));
    }

    public function storePendidikan(Request $request, $biodata_id)
    {
        $request->validate([
            'nama_instansi' => 'required',
            'keterangan'    => 'required',
            'tahun'         => 'required',
        ]);

        Pendidikan::create([
            'biodata_id'    => $biodata_id,
            'nama_instansi' => $request->nama_instansi,
            'keterangan'    => $request->keterangan,
            'tahun'         => $request->tahun,
        ]);

        return back()->with('success', 'Riwayat pendidikan berhasil ditambahkan!');
    }

    public function destroyPendidikan($id)
    {
        $pendidikan = Pendidikan::findOrFail($id);
        $pendidikan->delete();

        return back()->with('success', 'Riwayat pendidikan berhasil dihapus!');
    }
}
