<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Transactions extends Model
{
    protected $table = 'transaction';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','no_invoice','tgl_pembayaran','status_terakhir',
        'tgl_pesanan_selesai','wkt_pesanan_selesai','tgl_pesanan_dibatalkan',
        'wkt_pesanan_dibatalkan','nama_produk','tipe_produk','no_sku','
        catatan_produk_pembeli','catatan_produk_penjual','jumlah_produk_dibeli',
        'harga_awal','diskon_produk','harga_jual','jumlah_subsidi_tokopedia',
        'nilai_voucher_toko_terpakai','jenis_voucher_toko_terpakai',
        'kode_voucher_toko_yang_digunakan','biaya_pengiriman_tunai','biaya_asuransi_pengiriman',
        'total_biaya_pengiriman','total_penjualan','nama_pembeli','no_telp_pembeli','nama_penerima',
        'no_telp_penerima','alamat_pengiriman','kota','provinsi','nama_kurir','tipe_pengiriman',
        'no_resi','tgl_pengiriman_barang','waktu_pengiriman_barang','nama_campaign','bebas_ongkir','cod',
        //addons
        'tahun','coordinate','is_complete'
    ];

    protected $primaryKey = 'id';
    
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    public static function getAllData() {
        $data = \DB::table('transaction')->select('id','no_invoice','nama_pembeli','alamat_pengiriman','coordinate','tahun','is_complete')
                ->where('is_complete',0)
                ->limit(1000)->get();
        
        return $data;
    }

}