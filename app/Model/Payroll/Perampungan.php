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
        'nomor',
        'id_pegawai',
        'id_bengkel',
        'id_pemotong',
        'masa_perolehan_awal',
        'masa_perolehan_akhir',
        'tahun',
        'bruto',
        'pph21',
        'karyawan_asing',
        'kode_negara',
        'tanggal_perampungan'
    ];

    protected $hidden =[ 
        'created_at',
        'updated_at',
       
    ];

    public $timestamps = true;

    public function Detail(){
        return $this->hasMany(DetailPerampungan::class,'id_perampungan','id_perampungan');
    }

    public function Pegawai(){
        return $this->belongsTo(Pegawai::class,'id_pegawai','id_pegawai');
    }

    public function Pemotong(){
        return $this->belongsTo(Pegawai::class,'id_pemotong','id_pegawai');
    }

    public static function getId(){
        // return $this->orderBy('id_sparepart')->take(1)->get();
        $getId = DB::table('tb_payroll_perampungan')->orderBy('id_perampungan','DESC')->take(1)->get();
        if(count($getId) > 0) return $getId;
        return (object)[
            (object)[
                'id_perampungan'=> 0
            ]
            ];
    }


    protected static function booted()
    {
        static::addGlobalScope(new OwnershipScope);
    }
}
