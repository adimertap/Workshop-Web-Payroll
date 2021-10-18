<?php

namespace App\Model\Payroll;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DetailPerampungan extends Model
{
    protected $table = "tb_payroll_detail_perampungan";

    protected $primaryKey = 'id_1721a1';

    protected $fillable = [
        'id_pegawai',
        'nomor',
        'karyawan_asing',
        'kode_negara',
        'kode_objek_pajak',
        'gaji_pokok',
        'tunjangan_pph',
        'tunjangan_lain',
        'honorium',
        'premi_prsh',
        'natura',
        'bruto',
        'biaya_jabatan',
        'iuran_jht',
        'total_pengurangan',
        'netto',
        'netto_sebelumnnya',
        'jenis_netto',
        'netto_pph21',
        'ptkp',
        'pkp',
        'pph21_pkp',
        'pph21_telah_pot',
        'pph21_terutang',
        'pph21_lunas',
        'id_perampungan',
        'status_hitung'
    ];

    protected $hidden =[ 
        'created_at',
        'updated_at',
    ];

    public $timestamps = true;

    public function Perampungan(){
        return $this->belongsTo(Perampungan::class,'id_perampungan','id_perampungan');
    }

    public function Pegawai(){
        return $this->belongsTo(Pegawai::class,'id_pegawai','id_pegawai');
    }

    public static function getId(){
        // return $this->orderBy('id_sparepart')->take(1)->get();
        $getId = DB::table('tb_payroll_detail_perampungan')->orderBy('id_1721a1','DESC')->take(1)->get();
        if(count($getId) > 0) return $getId;
        return (object)[
            (object)[
                'id_1721a1'=> 0
            ]
            ];
    }


}
