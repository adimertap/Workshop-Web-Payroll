<?php

namespace App\Model\Payroll;

use Illuminate\Database\Eloquent\Model;

class DetailPerampungan extends Model
{
    protected $table = "tb_payroll_detail_perampungan";

    protected $primaryKey = 'id_1721a1';

    protected $fillable = [
        'id_perampungan',
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
        'pph21_lunas'
    ];

    protected $hidden =[ 
        'created_at',
        'updated_at',
    ];

    public $timestamps = true;

    public function Perampungan(){
        return $this->belongsTo(Perampungan::class,'id_perampungan','id_perampungan');
    }
}
