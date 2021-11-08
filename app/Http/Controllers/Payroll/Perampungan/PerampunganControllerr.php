<?php

namespace App\Http\Controllers\Payroll\Perampungan;

use App\Http\Controllers\Controller;
use App\Model\Kepegawaian\Pegawai;
use App\Model\Payroll\Detailgaji;
use App\Model\Payroll\DetailPerampungan;
use App\Model\Payroll\Gajipegawai;
use App\Model\Payroll\Mastergajipokok;
use App\Model\Payroll\Masterpph21;
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
        $perampungan = Perampungan::where('status_aktif', 'Aktif')->get();

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
        $data = Perampungan::where('id_bengkel', Auth::user()->id_bengkel)->where('status_aktif', 'Aktif')
            ->where('masa_perolehan_awal', Carbon::create($request->masa_perolehan_awal)->startOfMonth())->first();

        if (empty($data)){
            $perampungan = new Perampungan;
            $perampungan->masa_perolehan_awal = Carbon::create($request->masa_perolehan_awal)->startOfMonth();
            $perampungan->masa_perolehan_akhir = Carbon::create($request->masa_perolehan_awal)->addMonths(11);
            $perampungan->status_aktif = 'Tidak Aktif';
            $perampungan->id_bengkel = $request['id_bengkel'] = Auth::user()->id_bengkel;
            $perampungan->nama_pemotong = Auth::user()->pegawai->nama_pegawai;
            $perampungan->npwp_pemotong = Auth::user()->pegawai->npwp_pegawai;
            $perampungan->tanggal_perampungan = $request->tanggal_perampungan;
    
            $perampungan->save();
            $perampungan->Detail()->sync($request->pegawai);
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
    public function show($id_perampungan)
    {
        $perampungan = Perampungan::with('Detail')->find($id_perampungan);
        return view('pages.payroll.perampungan.detail',compact('perampungan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id_perampungan)
    {
        $perampungan = Perampungan::with('Detail')->find($id_perampungan);
      
        // return $kode;

        $tes = DetailPerampungan::where('id_perampungan', $perampungan->id_perampungan)->get(['id_pegawai']);

        $detailgaji = Detailgaji::with('Pegawai')->join('tb_payroll_perhitungan_gaji', 'tb_payroll_detail_gaji.id_gaji_pegawai', 'tb_payroll_perhitungan_gaji.id_gaji_pegawai')
        ->whereIn('id_pegawai', $tes)->groupBy('id_pegawai')
        ->selectRaw('SUM(total_tunjangan) as total_tunjangan, SUM(total_gaji) as total_gaji, 
            SUM(total_pph21) as total_pph21, SUM(total_pokok) as total_pokok, bulan_gaji, id_pegawai')
        ->whereBetween('bulan_gaji', [$perampungan->masa_perolehan_awal, $perampungan->masa_perolehan_akhir])
        ->get();


        $gas = DetailPerampungan::join('tb_kepeg_master_pegawai','tb_payroll_detail_perampungan.id_pegawai','tb_kepeg_master_pegawai.id_pegawai')->where('id_perampungan', $perampungan->id_perampungan)
        ->get();


        $blt = date('m');
        $year = date('y');

        
        $pph21 = Masterpph21::get();
        $ptkp = MasterPTKP::get();
        return view('pages.payroll.perampungan.edit',compact('perampungan','ptkp','pph21','detailgaji','blt','year','gas'));     
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_perampungan)
    {
        $perampungan = Perampungan::findOrFail($id_perampungan);
        $perampungan->status_aktif = 'Aktif';

        $perampungan->save();
        $perampungan->Detail()->sync($request->detail);

        return $request;
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

    public function CetakForm($id_perampungan){
        $perampungan = Perampungan::with('Detail')->find($id_perampungan);
        return view('print.Payroll.cetakperampungan',compact('perampungan'));
    }
}
