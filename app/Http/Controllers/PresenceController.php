<?php

namespace App\Http\Controllers;

use App\Models\Presence;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PresenceController extends Controller
{
    private function checkId($id)
    {
        $presence = Presence::find($id);
        if (is_null($presence)) {
            Alert::toast('Data presensi tidak ditemukan!', 'error');
            return false;
        }
        return $presence;
    }

    public function index()
    {
        $presence = Presence::latest()->get();
        return view('presence.index', compact('presence'));
    }

    public function create()
    {
        return view('presence.create');
    }

    public function store(Request $request)
    {
        $validated = WebRequest::validator($request->all(), [
            'employee_id' => ['required', 'integer'],
            'status' => ['required', 'string'],
        ]);
        if (!$validated) return back();

        Presence::create([
            'employee_id' => $request->employee_id,
            'status' => $request->status,
        ]);
 
        Alert::toast('Berhasil menambah data presensi!', 'success');
        return to_route('presence.index');
    }
    
    public function edit($id)
    {
        $presence = $this->checkId($id);
        if (!$presence) return back();

        return view('presence.edit', compact('presence'));
    }

    public function update(Request $request, $id)
    {
        $presence = $this->checkId($id);
        if (!$presence) return back();
        
        $validated = WebRequest::validator($request->all(), [
            'employee_id' => ['required', 'integer'],
            'status' => ['required', 'string'],
        ]);
        if (!$validated) return back();

        $presence->update([
            'employee_id' => $request->employee_id,
            'status' => $request->status,
        ]);
 
        Alert::toast('Berhasil mengubah data presensi!', 'success');
        return to_route('presence.index');
    }

    public function delete($id)
    {
        $presence = $this->checkId($id);
        if (!$presence) return back();

        $presence->delete();

        Alert::toast('Berhasil menghapus data presensi!', 'success');
        return back();
    }
}