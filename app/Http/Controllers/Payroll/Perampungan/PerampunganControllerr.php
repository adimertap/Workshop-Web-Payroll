<?php

namespace App\Http\Controllers\Payroll\Perampungan;

use App\Http\Controllers\Controller;
use App\Model\Kepegawaian\Pegawai;
use App\Model\Payroll\Detailgaji;
use App\Model\Payroll\DetailPerampungan;
use App\Model\Payroll\Gajipegawai;
use App\Model\Payroll\MasterPTKP;
use App\Model\Payroll\Perampungan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\New_;

class PerampunganControllerr extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perampungan = Perampungan::with('Detail','Pegawai','Pemotong')->get();
        $today = Carbon::now()->isoFormat('dddd');
        $tanggal = Carbon::now()->format('j F Y');
        $tahun = Carbon::now()->format('Y');
        $pegawai = Pegawai::with([
            'Jabatan'
        ])->join('tb_kepeg_master_jabatan', 'tb_kepeg_master_pegawai.id_jabatan', 'tb_kepeg_master_jabatan.id_jabatan')
        ->where('nama_jabatan', '!=', 'Owner')->get();
        
  

        return view('pages.payroll.perampungan.index',compact('perampungan','today','tanggal','pegawai','tahun'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id = Perampungan::getId();
        foreach($id as $value);
        $idlama = $value->id_perampungan;
        $idbaru = $idlama + 1;
        $blt = date('m');
        $year = date('y');
        
        $kode_perampungan = '1.1-'.$blt.'.'.$year.'-000000'.$idbaru;

        $data = Perampungan::where('id_bengkel', Auth::user()->id_bengkel)->where('id_pegawai', $request->id_pegawai)
        ->where('masa_perolehan_awal', Carbon::create($request->masa_perolehan_awal)->startOfMonth())->where('masa_perolehan_akhir', Carbon::create($request->masa_perolehan_akhir)->startOfMonth())->first();
        // return $data;

        if (empty($data)){
            $perampungan = Perampungan::create([
                'masa_perolehan_awal'=> Carbon::create($request->masa_perolehan_awal)->startOfMonth(), 
                'masa_perolehan_akhir'=> Carbon::create($request->masa_perolehan_akhir)->startOfMonth(), 
                'id_bengkel' => $request['id_bengkel'] = Auth::user()->id_bengkel,
                'id_pegawai' => $request->id_pegawai,
                'tanggal_perampungan' => $request->tanggal_perampungan,
                'karyawan_asing' => $request->karyawan_asing,
                'kode_negara' => $request->kode_negara,
                'nomor' => $kode_perampungan
               
            ]); 
            
            return $perampungan;
        }else{
            throw new \Exception('Data Perampungan Sudah Ada');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $perampungan = Perampungan::with('Pegawai','Pegawai.Jabatan','Pegawai.PTKP','Pemotong','Detail')->find($id);

        // $detailgaji = Detailgaji::with('Gaji')->where('id_pegawai', $perampungan->id_pegawai)->get();
        
        $detailgaji = Detailgaji::with([
            'Gaji'
        ])->join('tb_payroll_perhitungan_gaji', 'tb_payroll_detail_gaji.id_gaji_pegawai', 'tb_payroll_perhitungan_gaji.id_gaji_pegawai')
        ->where('id_pegawai', $perampungan->id_pegawai)
        ->whereBetween('bulan_gaji', [$perampungan->masa_perolehan_awal, $perampungan->masa_perolehan_akhir])
        ->get();

        return $detailgaji;


        $ptkp = MasterPTKP::get();

        return view('pages.payroll.perampungan.edit',compact('perampungan','ptkp'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_perampungan)
    {
        $perampungan = Perampungan::find($id_perampungan);
        DetailPerampungan::where('id_perampungan', $id_perampungan)->delete();
        $perampungan->delete();

        return redirect()->back()->with('messagehapus','Berhasil menghapus data perampungan');
    }
}
