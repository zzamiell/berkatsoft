<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Image;
use Session;


use Illuminate\Http\Request;
use Hash;

class SuperController extends Controller
{

    public function index()
    {
        return view('welcome');
    }

    public function masuk(Request $request)
    {
        try {
            $email = $request->get('email');
            $pass  = $request->get('password');

            $cek = DB::table('tb_user')
                ->where('email', $email)
                ->first();

            if ($cek) {
                if (Hash::check($pass, $cek->password)) {
                    $request->session()->put('id', $cek->id);
                    $request->session()->put('email', $cek->email);
                    $request->session()->put('nama', $cek->nama);
                    $request->session()->put('role', $cek->role);

                    return redirect()->route('customer')->with('data', 'Berhasil login');
                } else {
                    return redirect()->to('/')->with('fail', 'Terjadi Kesalahan Sistem, Silahkan Coba Lagi');
                }
            } else {
                return redirect()->to('/')->with('fail', 'Terjadi Kesalahan Sistem, Silahkan Coba Lagi');
            }
        } catch (\Exception $e) {
            dd($e);
        }
    }

    public function list_customer()
    {
        try {
            $data['customer'] = DB::table('tb_user')->where('role', 2)->get();

            return view('master.master')->nest('child', 'customer', $data);
        } catch (\Exception $e) {
            dd($e);
        }
    }

    public function list_produk()
    {
        try {
            $data['produk'] = DB::table('tb_produk')->get();

            return view('master.master')->nest('child', 'produk', $data);
        } catch (\Exception $e) {
            dd($e);
        }
    }

    public function list_order()
    {
        try {

            $data['produk'] = DB::table('tb_produk')->get();
            $data['user'] = DB::table('tb_user')->where('role', 2)->get();
            $data['order'] = DB::table('tb_order')
                ->join('tb_user', 'tb_user.id', '=', 'tb_order.id_user')
                ->join('tb_produk', 'tb_produk.id', '=', 'tb_order.id_produk')
                ->select('tb_user.nama as customer', 'tb_user.hp', 'tb_user.alamat', 'tb_produk.nama_produk', 'tb_order.qty', 'tb_order.catatan', 'tb_order.total_harga', 'tb_order.created_at')
                ->get();


            return view('master.master')->nest('child', 'order', $data);
        } catch (\Exception $e) {
            dd($e);
        }
    }

    public function insert_customer(Request $request)
    {
        try {

            $data = array(
                'nama' => $request->nama,
                'email' => $request->email,
                'alamat' => $request->alamat,
                'hp' => $request->hp,
                'password' => Hash::make($request->get('password')),
            );
            $create = DB::table('tb_user')->insert($data);

            if ($create) {
                return redirect()->route('customer')->with('data_sukses', 'Berhasil tambah customer');
            } else {
                return redirect()->to('customer')->with('fail', 'Terjadi Kesalahan Sistem, Silahkan Coba Lagi');
            }
        } catch (\Exception $e) {
            dd($e);
        }
    }

    public function insert_order(Request $request)
    {
        try {

            $data = array(
                'id_user' => $request->id_user,
                'id_produk' => $request->id_produk,
                'qty' => $request->text,
                'catatan' => $request->catatan,
                'total_harga' => $request->total_harga
            );

            $create = DB::table('tb_order')->insert($data);

            if ($create) {
                return redirect()->route('order')->with('data_sukses', 'Berhasil tambah order');
            } else {
                return redirect()->to('order')->with('fail', 'Terjadi Kesalahan Sistem, Silahkan Coba Lagi');
            }
        } catch (\Exception $e) {
            dd($e);
        }
    }

    public function insert_produk(Request $request)
    {
        try {

            if ($request->hasFile('file')) {
                // set Image
                $image = $request->file('file');
                $input['imagename'] = time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('/assets/produk');

                // Upload Image
                $destinationPath = public_path('/assets/produk');
                $image->move($destinationPath, $input['imagename']);
            }

            $data = array(
                'nama_produk' => $request->nama,
                'qty' => $request->stok,
                'harga' => $request->harga,
                'deskripsi' => $request->deskripsi,
                'image' => asset('assets/produk/' . $input['imagename']),
            );

            $create = DB::table('tb_produk')->insert($data);

            if ($create) {
                return redirect()->route('produk')->with('data', 'Berhasil tambah produk');
            } else {
                return redirect()->to('produk')->with('fail', 'Terjadi Kesalahan Sistem, Silahkan Coba Lagi');
            }
        } catch (\Exception $e) {
            dd($e);
        }
    }


    public function edit_customer(Request $request, $id)
    {
        try {

            $data = array(
                'nama' => $request->nama,
                'email' => $request->email,
                'alamat' => $request->alamat,
                'hp' => $request->hp,
                'password' => Hash::make($request->get('password')),
            );

            $update =  DB::table('tb_user')
                ->where('id', $id)
                ->update($data);

            if ($update) {
                return redirect()->route('customer')->with('edit', 'Berhasil edit customer');
            } else {
                return redirect()->to('customer')->with('fail', 'Terjadi Kesalahan Sistem, Silahkan Coba Lagi');
            }
        } catch (\Exception $e) {
            dd($e);
        }
    }

    public function edit_produk(Request $request, $id)
    {
        try {
            if ($request->hasFile('file')) {
                // set Image
                $image = $request->file('file');
                $input['imagename'] = time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('/assets/produk');

                // Upload Image
                $destinationPath = public_path('/assets/produk');
                $image->move($destinationPath, $input['imagename']);

                $data = array(
                    'nama_produk' => $request->nama,
                    'qty' => $request->stok,
                    'harga' => $request->harga,
                    'deskripsi' => $request->deskripsi,
                    'image' => asset('assets/produk/' . $input['imagename']),
                );

                $update =  DB::table('tb_produk')
                    ->where('id', $id)
                    ->update($data);

                if ($update) {
                    return redirect()->route('produk')->with('edit', 'Berhasil edit produk');
                } else {
                    return redirect()->to('customer')->with('fail', 'Terjadi Kesalahan Sistem, Silahkan Coba Lagi');
                }
            } else {
                $data = array(
                    'nama_produk' => $request->nama,
                    'qty' => $request->stok,
                    'harga' => $request->harga,
                    'deskripsi' => $request->deskripsi,
                );

                $update =  DB::table('tb_produk')
                    ->where('id', $id)
                    ->update($data);

                if ($update) {
                    return redirect()->route('produk')->with('edit', 'Berhasil edit produk');
                } else {
                    return redirect()->to('produk')->with('fail', 'Terjadi Kesalahan Sistem, Silahkan Coba Lagi');
                }
            }
        } catch (\Exception $e) {
            dd($e);
        }
    }

    public function hapus_customer($id)
    {
        $hapus = DB::table('tb_user')->where('id', $id)->delete();
    }

    public function hapus_produk($id)
    {
        $hapus = DB::table('tb_produk')->where('id', $id)->delete();
    }

    public function logout(Request $request)
    {
        Session::forget('nama');
        return redirect('/')->with('logout', 'Berhasil Logout');
    }
}
