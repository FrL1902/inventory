<?php

namespace App\Http\Controllers;

use App\Exports\customerExport;
use App\Models\Brand;
use App\Models\Customer;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class CustomerController extends Controller
{
    public function manage_customer_page()
    {
        $customer = Customer::all();

        return view('manageCustomer', compact('customer'));
    }

    public function new_customer_page(Request $request)
    {
        return view('newCustomer');
    }

    public function makeCustomer(Request $request)
    {
        // validate the required inputs first
        // $pattern = '';

        // DIY regex pattern for \/:*?"<>|   i know this is jank af, but normal regex is kinda bad for this case, or im just too dumb for it, but hey, it works
        //just in case i found something, the regex is this, from da gpt ^[^/\\:*?"'<>\|]*$ , try it here https://regex101.com/r/sM6wQ7/28  https://laracasts.com/discuss/channels/laravel/how-to-write-regex-in-laravel
        // $flag = 0;
        // if (str_contains($request->customername, '\\')) {
        //     $flag += 1;
        // }
        // if (str_contains($request->customername, '/')) {
        //     $flag += 1;
        // }
        // if (str_contains($request->customername, ':')) {
        //     $flag += 1;
        // }
        // if (str_contains($request->customername, '*')) {
        //     $flag += 1;
        // }
        // if (str_contains($request->customername, '?')) {
        //     $flag += 1;
        // }
        // if (str_contains($request->customername, '"')) {
        //     $flag += 1;
        // }
        // if (str_contains($request->customername, '<')) {
        //     $flag += 1;
        // }
        // if (str_contains($request->customername, '>')) {
        //     $flag += 1;
        // }
        // if (str_contains($request->customername, '|')) {
        //     $flag += 1;
        // }

        // if ($flag > 0) {
        //     // dd('masok');
        //     // $request->session()->flash('formatError', 'Nama Customer tidak boleh menggunakan simbol berikut:   \\ /  : * ? " < > |');
        //     $request->session()->flash('formatError', 'Nama Customer tidak boleh menggunakan simbol berikut: ');
        //     return redirect()->back();
        // }

        // dd($flag);

        // dd(preg_match($pattern, $str));

        // first validation, "required"
        $request->validate([
            'customerid' => 'required',
            'customername' => 'required',
            'address' => 'required',
        ], [
            'customerid.required' => 'Kolom "ID Customer" Harus Diisi',
            'customername.required' => 'Kolom "Nama Customer" Harus Diisi',
            'address.required' => 'Kolom "Alamat Customer" Harus Diisi'
        ]);

        $request->validate([
            'customerid' => 'required|unique:App\Models\Customer,customer_id|min:4|max:10|alpha_dash',
            'customername' => 'required|min:4|max:30|regex:/^[\pL\s\-]+$/u',  //kalo emg udh menyerah bgt ya pake alpha:ascii aje, https://laravel.com/docs/10.x/validation#rule-alpha, ga perlu, pake alpha:dash aja
            'address' => 'required|min:5|max:100',
            // 'email' => 'required',
            // 'phone1' => 'required'
        ], [
            'customerid.unique' => 'ID Customer yang dimasukkan sudah terambil, masukkan ID yang lain',
            'customerid.min' => 'ID Customer minimal 4 karakter',
            'customerid.max' => 'ID Customer maksimal 10 karakter',
            'customerid.alpha_dash' => 'ID Customer hanya membolehkan huruf, angka, -, _ (spasi dan simbol lainnya tidak diterima)',
            'customername.min' => 'Nama Customer minimal 4 karakter',
            'customername.max' => 'Nama Customer maksimal 30 karakter',
            'customername.regex' => 'Nama Customer hanya membolehkan huruf, spasi, dan tanda penghubung(-)',
            'address.min' => 'Alamat Customer minimal 5 karakter',
            'address.max' => 'Alamat Customer maksimal 100 karakter',
        ]);

        $customer = new Customer();

        // $customer->customer_id = $request->customerid;       yang dibutuhin ini
        // $customer->customer_name = $request->customername;   yang dibutuhin ini
        // $customer->address = $request->address;
        // $customer->email = $request->email;                  yang dibutuhin ini
        // $customer->phone1 = $request->phone1;                yang dibutuhin ini, work
        // $customer->phone2 = $request->phone2;
        // $customer->fax = $request->fax;
        // $customer->website = $request->website;
        // $customer->pic = $request->picname;
        // $customer->pic_phone = $request->picnumber;
        // $customer->npwp_perusahaan = $request->npwp;

        // check if input is null, set to "no-input" or ""
        // if (is_null($request->address)) {
        //     $customer->address = "";
        // } else {
        //     $customer->address = $request->address;
        // }


        if (is_null($request->email)) {
            $customer->email = "";
        } else {
            $request->validate([
                'email' => 'max:50',
            ],  [
                'email.max' => 'Email Customer maksimal 50 karakter'
            ]);
            $customer->email = $request->email;
        }

        if (is_null($request->phone1)) {
            $customer->phone1 = "";
        } else {
            $request->validate([
                'phone1' => 'min:4|max:30',
            ],  [
                'phone1.min' => 'Nomor Telpon 1 Customer minimal 4 karakter',
                'phone1.max' => 'Nomor Telpon 1 Customer maksimal 30 karakter',
            ]);
            $customer->phone1 = $request->phone1;
        }

        if (is_null($request->phone2)) {
            $customer->phone2 = "";
        } else {
            $request->validate([
                'phone2' => 'min:4|max:30',
            ],  [
                'phone2.min' => 'Nomor Telpon 2 Customer minimal 4 karakter',
                'phone2.max' => 'Nomor Telpon 2 Customer maksimal 30 karakter',
            ]);
            $customer->phone2 = $request->phone2;
        }

        if (is_null($request->fax)) {
            $customer->fax = "";
        } else {
            $request->validate([
                'fax' => 'min:4|max:30',
            ],  [
                'fax.min' => 'Nomor Fax Customer minimal 4 karakter',
                'fax.max' => 'Nomor Fax Customer maksimal 30 karakter',
            ]);
            $customer->fax = $request->fax;
        }

        if (is_null($request->website)) {
            $customer->website = "";
        } else {
            $request->validate([
                'website' => 'min:4|max:100',
            ],  [
                'website.min' => 'Website Customer minimal 4 karakter',
                'website.max' => 'Website Customer maksimal 100 karakter',
            ]);
            $customer->website = $request->website;
        }

        if (is_null($request->picname)) {
            $customer->pic = "";
        } else {
            $request->validate([
                'picname' => 'min:4|max:100',
            ],  [
                'picname.min' => 'Nama PIC minimal 4 karakter',
                'picname.max' => 'Nama PIC maksimal 100 karakter',
            ]);
            $customer->pic = $request->picname;
        }

        if (is_null($request->picnumber)) {
            $customer->pic_phone = "";
        } else {
            $request->validate([
                'picnumber' => 'min:4|max:30',
            ],  [
                'picnumber.min' => 'Nomor PIC minimal 4 karakter',
                'picnumber.max' => 'Nomor PIC maksimal 30 karakter',
            ]);
            $customer->pic_phone = $request->picnumber;
        }

        if (is_null($request->npwp)) {
            $customer->npwp_perusahaan = "";
        } else {
            $request->validate([
                'npwp' => 'min:4|max:100',
            ],  [
                'npwp.min' => 'Nomor NPWP minimal 4 karakter',
                'npwp.max' => 'Nomor NPWP maksimal 30 karakter',
            ]);
            $customer->npwp_perusahaan = $request->npwp;
        }

        // input the required variables in
        $customer->customer_id = $request->customerid;
        $customer->customer_name = $request->customername;
        $customer->address = $request->address;
        // $customer->email = $request->email;
        // $customer->phone1 = $request->phone1;

        $customer->save();

        $customerAdded = "Customer " . "\"" . $request->customername . "\"" . " berhasil di tambahkan";

        $request->session()->flash('sukses_addNewCustomer', $customerAdded);

        return redirect()->back();

        // return back()->withInput(); ini gak tau kenapa ga bisa, ya ga harus bgt sih tp sebagai Quality of Life aja
    }

    public function updateCustomer(Request $request)
    {
        $customer = Customer::where('id', $request->customerIdHidden)->first();

        $flagNull = 0;

        if (is_null($request->customername)) {
            $flagNull += 1;
        } else {
            $request->validate([
                'customername' => 'min:4|max:30|regex:/^[\pL\s\-]+$/u',
            ], [
                'customername.min' => 'Nama Customer minimal 4 karakter',
                'customername.max' => 'Nama Customer maksimal 30 karakter',
                'customername.regex' => 'Nama Customer hanya membolehkan huruf, spasi, dan tanda penghubung(-)',
            ]);
            $customer->customer_name = $request->customername;
        }

        if (is_null($request->address)) {
            $flagNull += 1;
        } else {
            $request->validate([
                'address' => 'min:5|max:100',
            ], [
                'address.min' => 'Alamat Customer minimal 5 karakter',
                'address.max' => 'Alamat Customer maksimal 100 karakter',
            ]);
            $customer->address = $request->address;
        }

        if (is_null($request->email)) {
            $flagNull += 1;
        } else {
            $request->validate([
                'email' => 'max:50',
            ],  [
                'email.max' => 'Email Customer maksimal 50 karakter'
            ]);
            $customer->email = $request->email;
        }

        if (is_null($request->phone1)) {
            $flagNull += 1;
        } else {
            $request->validate([
                'phone1' => 'min:4|max:30',
            ],  [
                'phone1.min' => 'Nomor Telpon 1 Customer minimal 4 karakter',
                'phone1.max' => 'Nomor Telpon 1 Customer maksimal 30 karakter',
            ]);
            $customer->phone1 = $request->phone1;
        }

        if (is_null($request->phone2)) {
            $flagNull += 1;
        } else {
            $request->validate([
                'phone2' => 'min:4|max:30',
            ],  [
                'phone2.min' => 'Nomor Telpon 2 Customer minimal 4 karakter',
                'phone2.max' => 'Nomor Telpon 2 Customer maksimal 30 karakter',
            ]);
            $customer->phone2 = $request->phone2;
        }

        if (is_null($request->fax)) {
            $flagNull += 1;
        } else {
            $request->validate([
                'fax' => 'min:4|max:30',
            ],  [
                'fax.min' => 'Nomor Fax Customer minimal 4 karakter',
                'fax.max' => 'Nomor Fax Customer maksimal 30 karakter',
            ]);
            $customer->fax = $request->fax;
        }

        if (is_null($request->website)) {
            $flagNull += 1;
        } else {
            $request->validate([
                'website' => 'min:4|max:100',
            ],  [
                'website.min' => 'Website Customer minimal 4 karakter',
                'website.max' => 'Website Customer maksimal 100 karakter',
            ]);
            $customer->website = $request->website;
        }

        if (is_null($request->picname)) {
            $flagNull += 1;
        } else {
            $request->validate([
                'picname' => 'min:4|max:100',
            ],  [
                'picname.min' => 'Nama PIC minimal 4 karakter',
                'picname.max' => 'Nama PIC maksimal 100 karakter',
            ]);
            $customer->pic = $request->picname;
        }

        if (is_null($request->picnumber)) {
            $flagNull += 1;
        } else {
            $request->validate([
                'picnumber' => 'min:4|max:30',
            ],  [
                'picnumber.min' => 'Nomor PIC minimal 4 karakter',
                'picnumber.max' => 'Nomor PIC maksimal 30 karakter',
            ]);
            $customer->pic_phone = $request->picnumber;
        }

        if (is_null($request->npwp)) {
            $flagNull += 1;
        } else {
            $request->validate([
                'npwp' => 'min:4|max:100',
            ],  [
                'npwp.min' => 'Nomor NPWP minimal 4 karakter',
                'npwp.max' => 'Nomor NPWP maksimal 30 karakter',
            ]);
            $customer->npwp_perusahaan = $request->npwp;
        }

        if ($flagNull == 10) {
            session()->flash('noInput', "Update Gagal: tidak ada data yang dimasukkan");
            return redirect('manageCustomer');
        }

        $customer->update();

        $customerUpdated = "Customer" . " \"" . $customer->customer_name . "\" " . "berhasil di update";

        session()->flash('sukses_update_customer', $customerUpdated);

        return redirect('manageCustomer');
    }

    public function deleteCustomer($id)
    {
        // dd($id);
        // decrypt Customer ID
        try {
            $decrypted = decrypt($id);
        } catch (DecryptException $e) {
            abort(403);
        }

        // brand checking if customer has any, (2nd measure if encrypted is bypassed)
        $nullCheckBrand = Brand::where('customer_id', $decrypted)->first();
        $cust = Customer::find($decrypted);
        $deletedCustomer = $cust->customer_name;
        if (is_null($nullCheckBrand)) {

            $cust->delete();

            $customerDeleted = "Customer" . " \"" . $deletedCustomer . "\" " . "berhasil di hapus";

            session()->flash('sukses_delete_customer', $customerDeleted);

            return redirect('manageCustomer');
        } else {
            session()->flash('gagal_delete_customer', 'Customer' . " \"" . $deletedCustomer . "\" " . 'Gagal Dihapus karena sudah mempunyai Brand');
            return redirect('manageCustomer');
        }
    }

    public function exportCustomerExcel()
    {
        return Excel::download(new customerExport, 'Customer Data.xlsx');
    }
}
