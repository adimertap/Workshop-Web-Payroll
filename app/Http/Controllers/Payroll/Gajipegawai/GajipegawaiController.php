<?php

namespace App\Http\Controllers\Payroll\Gajipegawai;

use App\Http\Controllers\Controller;
use App\Model\Accounting\Jenistransaksi;
use App\Model\Inventory\Retur\Retur;
use App\Model\Kepegawaian\Jabatan;
use App\Model\Kepegawaian\Pegawai;
use App\Model\Payroll\Detailgaji;
use App\Model\Payroll\Detailpegawai;
use App\Model\Payroll\Detailtunjangan;
use App\Model\Payroll\Gajipegawai;
use App\Model\Payroll\Masterpph21;
use App\Model\Payroll\Mastertunjangan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\New_;

class GajipegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $gaji = Gajipegawai::with([
            'Detailpegawai','Jenistransaksi'
        ])->where('status_aktif', 'Aktif')->get();

        $today = Carbon::now()->isoFormat('dddd');
        $tanggal = Carbon::now()->format('j F Y');
        $tahun_bayar = Carbon::now()->format('Y');

        $pegawai = Pegawai::with([
            'Jabatan.Gajipokok','Cabang'
        ])->join('tb_kepeg_master_jabatan', 'tb_kepeg_master_pegawai.id_jabatan', 'tb_kepeg_master_jabatan.id_jabatan')
        ->where('nama_jabatan', '!=', 'Owner')->get();
       

        return view('pages.payroll.gajipegawai.gajipegawai', compact('gaji','tahun_bayar','today','tanggal','pegawai'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.payroll.gajipegawai.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = Gajipegawai::where('id_bengkel', Auth::user()->id_bengkel)->where('status_aktif', 'Aktif')
        ->where('bulan_gaji', Carbon::create($request->bulan_gaji)->startOfMonth())->first();

         if (empty($data)){
            $gaji = new Gajipegawai;
            $gaji->bulan_gaji = Carbon::create($request->bulan_gaji)->startOfMonth();
            $gaji->id_bengkel = $request['id_bengkel'] = Auth::user()->id_bengkel;
            $gaji->id_jenis_transaksi ='8';
            $gaji->status_aktif = 'Tidak Aktif';

            $gaji->save();
            $gaji->Detailpegawai()->sync($request->detailgaji);
            return $gaji;
        }else{
            throw new \Exception('Gaji Sudah Ada');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id_gaji_pegawai)
    {
        $gaji = Gajipegawai::with('Detailpegawai.Detailtunjangan')->findOrFail($id_gaji_pegawai);

        return view('pages.payroll.gajipegawai.detail')->with([
            'gaji' => $gaji,
            'jumlah_pegawai' => Detailgaji::where('id_gaji_pegawai', $id_gaji_pegawai)->count(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $gaji = Gajipegawai::with([
            // 'Pegawai','Pegawai.Jabatan.Gajipokok','Pegawai.absensi','Detailtunjangan'
            'Detailpegawai','Jenistransaksi'
        ])->find($id);
       
        $jenis_transaksi = Jenistransaksi::all();

        
        $pegawai = Pegawai::with([
            'Jabatan.Gajipokok','PTKP','Cabang'
        ])->join('tb_kepeg_master_jabatan', 'tb_kepeg_master_pegawai.id_jabatan', 'tb_kepeg_master_jabatan.id_jabatan')
        ->where('nama_jabatan', '!=', 'Owner')->get();

        $jabatan = Jabatan::get();
        $pph21 = Masterpph21::get();
        $tunjangan = Mastertunjangan::all();
        $today = Carbon::now()->format('D, d/m/Y');

        return view('pages.payroll.gajipegawai.create',['gaji_total' => Gajipegawai::sum('grand_total_gaji')], compact('gaji','pegawai','tunjangan','today','jenis_transaksi','jabatan','pph21'));
    }

    public function edit2(Request $request, $id_gaji_pegawai)
    {
        $gaji = Gajipegawai::with([
            'Detailpegawai','Detailpegawai.Jabatan.Gajipokok','Detailtunjangan','Jenistransaksi'
        ])->find($id_gaji_pegawai);


        $pegawai = Pegawai::with([
            'Jabatan.Gajipokok'
        ])->join('tb_kepeg_master_jabatan', 'tb_kepeg_master_pegawai.id_jabatan', 'tb_kepeg_master_jabatan.id_jabatan')
        ->where('nama_jabatan', '!=', 'Owner')->get();

        $jabatan = Jabatan::all();
        $jenis_transaksi = Jenistransaksi::all();
        $seluruhpegawai = Pegawai::all();
        $tunjangan = Mastertunjangan::all();
        $today = Carbon::now()->format('D, d/m/Y');
        $pph21 = Masterpph21::get();

        return view('pages.payroll.gajipegawai.edit',['gaji_total' => Gajipegawai::sum('grand_total_gaji')], compact('gaji','seluruhpegawai','tunjangan','today','jenis_transaksi','jabatan','pegawai','pph21'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_gaji_pegawai)
    {
        $gaji = Gajipegawai::findOrFail($id_gaji_pegawai);
        $gaji->grand_total_gaji = $request->grand_total_gaji;
        $gaji->grand_total_tunjangan = $request->grand_total_tunjangan;
        $gaji->grand_total_pph21 = $request->grand_total_pph21;
        $gaji->keterangan = $request->keterangan;
        $gaji->status_aktif = 'Aktif';
        $gaji->id_bengkel = $request['id_bengkel'] = Auth::user()->id_bengkel;
        
        $gaji->save();
        $gaji->Detailpegawai()->sync($request->pegawai);
        $gaji->Detailtunjangan()->sync($request->tunjangan);

        return $request;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_gaji_pegawai)
    {
        $gaji = Gajipegawai::findOrFail($id_gaji_pegawai);
        Detailgaji::where('id_gaji_pegawai', $id_gaji_pegawai)->delete();
        Detailtunjangan::where('id_gaji_pegawai', $id_gaji_pegawai)->delete();
        $gaji->delete();

        return redirect()->back()->with('messagehapus','Data Pembayaran Gaji Pegawai Berhasil dihapus');
    }

    public function setStatus(Request $request, $id_gaji_pegawai)
    {
        $request->validate([
            'status' => 'required|in:Belum Dibayarkan,Dibayarkan'
        ]);

        $item = Gajipegawai::findOrFail($id_gaji_pegawai);
        $item->status_diterima = $request->status;

        $item->save();
        return redirect()->route('gaji-pegawai.index')->with('messagebayar','Slip Gaji Pegawai berhasil Dibayarkan');
    }

   

    public function CetakSlip($id_gaji_pegawai)
    {
        $gaji = Gajipegawai::with('Detailpegawai','Detailpegawai.Jabatan.Gajipokok','Detailtunjangan','Detailpegawai.Detailtunjangan')
        ->find($id_gaji_pegawai);

        $now = Carbon::now()->format('j F Y');
        return view('print.Payroll.cetakslip', compact('gaji','now'));
    }
}
