<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Document;
use App\Models\Jadwal;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class KurikulumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __contruct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = User::all();

        if(Auth::user()->role == 'kurikulum'){
            return view('kurikulum.home', compact('data'));
        }elseif(Auth::user()->role == 'guru'){
            return redirect()->route('guru');
        }elseif(Auth::user()->role == 'kepsek'){
            return redirect()->route('kepsek');
        }
    }

    public function getKurikulum()
    {
        $user = User::all();
        return view('kurikulum.add', compact('user'));
    }

    public function postKurikulum (Request $request)
    {
        $validasi = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'nip' => ['required', 'integer', 'min:8', 'unique:users'],
            'alamat' => 'required',
            'role' => 'required'
        ]);

        $create = User::create([
            'nip' => $request->nip,
            'name' => $request->name,
            'alamat' => $request->alamat,
            'email' => $request->email,
            'role' => $request->role,
            'password' =>  Hash::make($request->nip)
        ]);

        return redirect()->route('kurikulum.home');
    }

    public function UpdateAccount(Request $request, $id)
    {
        $validasi = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'nip' => ['required', 'integer', 'min:8', 'unique:users'],
            'alamat' => 'required',
            'role' => 'required'
        ]);

        $update = User::where('id', $id)->update([
            'nip' => $request->nip,
            'name' => $request->name,
            'alamat' => $request->alamat,
            'email' => $request->email,
            'role' => $request->role,
            'password' =>  Hash::make($request->nip)
        ]);

        dd($update);
    }

    public function deleteAccount($id)
    {
        $delete = User::destroy($id);
        return redirect()->route('kurikulum.home');
    }

    public function listJadwal()
    {
        $dataJadwal = Jadwal::all();
        return view('kurikulum.jadwal.home', compact('dataJadwal'));
    }
    
    public function getJadwal()
    {
        $dataGuru = User::where('role', 'guru')->get();
        $dataSupervisor = User::where('supervisor', 'ya')->get();
        return view('kurikulum.jadwal.add', compact('dataGuru', 'dataSupervisor'));
    }

    public function postJadwal(Request $request)
    {
        $validasi = $request->validate([
            'tanggal' => 'required',
            'jam_awal' => 'required',
            'jam_akhir' => 'required',
            'nip' => 'required',
            'id_supervisor' => 'required'
        ]);

        $postJadwal = Jadwal::create([
            'tanggal' => $request->tanggal,
            'jam_awal' => $request->jam_awal,
            'jam_akhir' => $request->jam_akhir,
            'nip' => $request->nip,
            'id_supervisor' => $request->id_supervisor,
        ]);

        return redirect()->route('jadwal');

    }

    public function listRPP()
    {
        $document = Document::where('nip', Auth::user()->nip)->get();
        return view('kurikulum.guru.list', compact('document'));
    }

    public function getRPP()
    {
        return view('kurikulum.guru.addrpp');
    }

    public function postRPP(Request $request)
    {
        $validasi = $request->validate([
            'mapel' => 'required|string',
            'rpp' => 'required|mimetypes:application/pdf|max:5120',
            'embed' => 'required'
        ]);

        $rpp = time(). '-' .$request->rpp->getClientOriginalName();
        $request->rpp->move(public_path('materi'), $rpp);

        $post = Document::create([
            'nip' => Auth::user()->nip,
            'mapel' => $request->mapel,
            'rpp' => $rpp,
            'embed' => $request->embed,
        ]);

        return redirect()->route('list-rpp');
    }
}
