<?php

namespace App\Model\Payroll;

use App\Model\Kepegawaian\Pegawai;
use App\Scopes\OwnershipScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Perampungan extends Model
{
    use SoftDeletes;

    protected $table = "tb_payroll_perampungan";

    protected $primaryKey = 'id_perampungan';

    protected $fillable = [
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
    ];

    protected $hidden =[ 
        'created_at',
        'updated_at',
        'deleted_at'
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

    protected static function booted()
    {
        static::addGlobalScope(new OwnershipScope);
    }
}
