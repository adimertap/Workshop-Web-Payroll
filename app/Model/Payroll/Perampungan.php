<?php

namespace App\Model\Payroll;

use App\Model\Kepegawaian\Pegawai;
use App\Scopes\OwnershipScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Perampungan extends Model
{
   

    protected $table = "tb_payroll_perampungan";

    protected $primaryKey = 'id_perampungan';

    protected $fillable = [
        'id_bengkel',
        'nama_pemotong',
        'npwp_pemotong',
        'masa_perolehan_awal',
        'masa_perolehan_akhir',
        'tanggal_perampungan',
    ];

    protected $hidden =[ 
        'created_at',
        'updated_at',
       
    ];

    public $timestamps = true;

    public function Detail(){
        return $this->belongsToMany(Pegawai::class,'tb_payroll_detail_perampungan','id_perampungan','id_pegawai')
        ->withPivot(
            'nomor','karyawan_asing','kode_negara','kode_objek_pajak','gaji_pokok','tunjangan_pph','tunjangan_lain',
            'honorarium','premi_prsh','natura','bruto','biaya_jabatan','iuran_jht','total_pengurangan',
            'netto','netto_sebelumnya','netto_pph21','ptkp','pkp','pph21_pkp',
            'pph21_telah_pot','pph21_terutang','pph21_lunas','status_hitung'
        );
    }

    // public function Pemotong(){
    //     return $this->belongsTo(Pegawai::class,'id_pemotong','id_pegawai');
    // }

   

    protected static function booted()
    {
        static::addGlobalScope(new OwnershipScope);
    }
}
