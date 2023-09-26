@extends('layout.layout')

@section('manageitembutton', 'active')
@section('manageitem', 'active')
@section('showmanageitem', 'show')

@section('content')
    <div class="main-panel">
        <div class="content">
            {{-- ini page buat manage item --}}
            <div class="page-inner">

                @if (session('sukses_delete_item'))
                    <div class="alert alert-warning alert-block" id="alertDelete">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ session('sukses_delete_item') }}</strong>
                    </div>
                @elseif (session('sukses_editItem'))
                    <div class="alert alert-success alert-block" id="alertSuccess">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>Sukses mengupdate data "{{ session('sukses_editItem') }}"</strong>
                    </div>
                @elseif (session('noData_editItem'))
                    <div class="alert alert-danger alert-block" id="alertFailed">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>Update Gagal: Tidak ada kolom yang terisi</strong>
                    </div>
                @elseif (session('gagal_delete_item'))
                    <div class="alert alert-danger alert-block" id="alertFailed">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ session('gagal_delete_item') }}</strong>
                    </div>
                @elseif ($errors->any())
                    <div class="alert alert-danger alert-block" id="alertFailed">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>Update Gagal: {{ $errors->first() }}</strong>
                    </div>
                @endif

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex align-items-center">
                                    <h4 class="card-title"><strong>Mengelola Barang</strong></h4>
                                    {{-- <h4 class="card-title">Manage Existing Items and its Stocks</h4> --}}

                                    <div class="ml-3 mr-2">
                                        Export ke Excel berdasarkan
                                    </div>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-secondary"
                                            data-target="#exportCustomerItemModal"
                                            data-toggle="modal"><strong>Customer</strong>
                                        </button>

                                        <button type="button" class="btn btn-secondary" data-target="#exportBrandItemModal"
                                            data-toggle="modal"><strong>Brand</strong>
                                        </button>
                                    </div>
                                    {{-- export items by customer --}}
                                    <div class="modal fade" id="exportCustomerItemModal" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h3 class="modal-title" id="exampleModalLongTitle">
                                                        <strong>
                                                            Export barang milik customer
                                                        </strong>
                                                    </h3>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="post" action="/exportCustomerItem">
                                                        @csrf

                                                        <div class="card-body">
                                                            <div class="form-group">
                                                                <label for="customerLabelExport">Customer</label>
                                                                <select class="form-control" data-width="100%"
                                                                    id="customerLabelExport" name="customerItemExport" required>
                                                                    <option></option>
                                                                    @foreach ($customer as $data)
                                                                        <option value="{{ $data->customer_id }}">
                                                                            {{ $data->customer_name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <div class="form-group">
                                                                <div class="card mt-5 ">
                                                                    <button id="" class="btn btn-primary">Export
                                                                        Data</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- export items by brand --}}
                                    <div class="modal fade" id="exportBrandItemModal" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h3 class="modal-title" id="exampleModalLongTitle">
                                                        <strong>
                                                            Export barang milik Brand
                                                        </strong>
                                                    </h3>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="post" action="/exportBrandItem">
                                                        @csrf

                                                        <div class="card-body">
                                                            <div class="form-group">
                                                                <label for="brandLabelExport">Brand</label>
                                                                <select class="form-control" id="brandLabelExport"
                                                                    data-width="100%" name="brandItemExport" required>
                                                                    <option></option>
                                                                    @foreach ($brand as $data)
                                                                        <option value="{{ $data->brand_id }}">
                                                                            {{ $data->brand_name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <div class="form-group">
                                                                <div class="card mt-5 ">
                                                                    <button id="" class="btn btn-primary">Export
                                                                        Data</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="add-row" class="display table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>Customer</th>
                                                <th>Brand</th>
                                                <th>ID Barang</th>
                                                <th>Nama Barang</th>
                                                <th>Stok</th>
                                                <th>Tanggal Data Dimasukkan</th>
                                                <th>Tanggal Terakhir Diupdate</th>
                                                <th>Gambar Barang</th>
                                                <th style="width: 10%">Edit</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Customer</th>
                                                <th>Brand</th>
                                                <th>ID Barang</th>
                                                <th>Nama Barang</th>
                                                <th>Stok</th>
                                                <th>Tanggal Data Dimasukkan</th>
                                                <th>Tanggal Terakhir Diupdate</th>
                                                <th>Gambar Barang</th>
                                                <th>Edit</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            @foreach ($item as $item)
                                                <tr>
                                                    <td>{{ $item->customer->customer_name }}</td>
                                                    <td>{{ $item->brand->brand_name }}</td>
                                                    <td>{{ $item->item_id }}</td>
                                                    <td>{{ $item->item_name }}</td>
                                                    <td>{{ $item->stocks }}</td>
                                                    {{-- <td>{{ $item->created_at }}</td> --}}
                                                    <td>{{ date_format(date_create($item->created_at), 'D H:i:s d-m-Y') }}
                                                    </td>
                                                    {{-- <td>{{ $item->updated_at }}</td> --}}
                                                    <td>{{ date_format(date_create($item->updated_at), 'D H:i:s d-m-Y') }}
                                                    </td>
                                                    <td>
                                                        {{-- <img class="rounded mx-auto d-block"
                                                            style="width: 100px;
                                                        height: auto;"
                                                            src="{{ Storage::url($item->item_pictures) }}"
                                                            alt="no picture"> --}}
                                                        <a style="cursor: pointer"
                                                            data-target="#imageModalCenter{{ $item->item_id }}"
                                                            data-toggle="modal">
                                                            <img class="rounded mx-auto d-block"
                                                                style="width: 100px; height: auto;"
                                                                src="{{ Storage::url($item->item_pictures) }}"
                                                                alt="no picture" loading="lazy">
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex justify-content-center">
                                                            {{-- <a style="cursor: pointer"
                                                                data-target="#addModalCenter{{ $item->id }}"
                                                                data-toggle="modal">
                                                                <i class="fa fa-arrow-up mt-3 text-warning"
                                                                    data-toggle="tooltip"
                                                                    data-original-title="Add Stock"></i>
                                                            </a>
                                                            <a class="ml-3 mb-2" style="cursor: pointer"
                                                                data-target="#reduceModalCenter{{ $item->id }}"
                                                                data-toggle="modal">
                                                                <i class="fa fa-arrow-down mt-3 text-warning"
                                                                    data-toggle="tooltip"
                                                                    data-original-title="Reduce Stock"></i>
                                                            </a> --}}
                                                            <a style="cursor: pointer" class="mb-2"
                                                                data-target="#editModalCenter{{ $item->item_id }}"
                                                                data-toggle="modal">
                                                                <i class="fa fa-edit mt-3 text-primary"
                                                                    data-toggle="tooltip"
                                                                    data-original-title="Edit Data Barang"></i>
                                                            </a>
                                                            @if (App\Models\Item::checkItemDeletable($item->item_id) == 'kosong')
                                                                <a class="ml-3 mb-2" style="cursor: pointer"
                                                                    data-target="#deleteModal{{ $item->item_id }}"
                                                                    data-toggle="modal">
                                                                    <i class="fa fa-times mt-3 text-danger"
                                                                        data-toggle="tooltip"
                                                                        data-original-title="Hapus Barang"></i>
                                                                </a>
                                                            @else
                                                                <a class="ml-3 mb-2" style="cursor: pointer">
                                                                    <i class="fa fa-ban mt-3 text-danger"
                                                                        data-toggle="tooltip"
                                                                        data-original-title="Cannot Delete Item, has history"></i>
                                                                </a>
                                                            @endif
                                                        </div>

                                                        <div class="modal fade" id="deleteModal{{ $item->item_id }}">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">
                                                                            <strong>PENGHAPUSAN ITEM</strong>
                                                                        </h5>
                                                                        <button type="button" class="close"
                                                                            data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <p>Apakah anda yakin untuk menghapus item
                                                                            "{{ $item->item_name }}" ?</p>
                                                                        <p>Jika dihapus, stock yang dimiliki item
                                                                            ini juga terhapus</p>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            id="close-modal"
                                                                            data-dismiss="modal">Tidak</button>
                                                                        <a href="/deleteItem/{{ encrypt($item->item_id) }}"
                                                                            class="btn btn-danger">YAKIN
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="modal fade" id="editModalCenter{{ $item->item_id }}"
                                                            tabindex="-1" role="dialog"
                                                            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered"
                                                                role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <div class="d-flex flex-column">
                                                                            <div class="p-2">
                                                                                <h3 class="modal-title"
                                                                                    id="exampleModalLongTitle">
                                                                                    <strong> Update data untuk
                                                                                        "{{ $item->item_name }}"</strong>
                                                                                </h3>
                                                                            </div>
                                                                            <div class="p-2">
                                                                                <h5> Isi
                                                                                    data yang ingin diubah</h5>
                                                                            </div>
                                                                        </div>
                                                                        <button type="button" class="close"
                                                                            data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form enctype="multipart/form-data" method="post"
                                                                            action="/updateItem">
                                                                            @csrf
                                                                            <div class="card-body">
                                                                                <div class="form-group">
                                                                                    <div class="form-group">
                                                                                        <label>Nama Barang</label>
                                                                                        <input type="text"
                                                                                            class="form-control"
                                                                                            placeholder="masukkan nama barang"
                                                                                            aria-label=""
                                                                                            aria-describedby="basic-addon1"
                                                                                            name="itemnameformupdate">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="largeInput">Gambar
                                                                                            Barang</label>
                                                                                        <input type="file"
                                                                                            class="form-control form-control"
                                                                                            id="itemImage"
                                                                                            name="itemImage">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <div class="card mt-5 ">
                                                                                            <button id=""
                                                                                                class="btn btn-primary">Update
                                                                                                Data Barang</button>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div>
                                                                                        <h5 style="text-align: center;">
                                                                                            kolom
                                                                                            yang tidak diisi
                                                                                            akan menggunakan data yang
                                                                                            sebelumnya</h5>
                                                                                    </div>
                                                                                </div>

                                                                                <input type="hidden" class="form-control"
                                                                                    name="itemIdHidden"
                                                                                    value="{{ $item->item_id }}">
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        {{-- old feature to add incoming package in this page --}}
                                                         {{-- <div class="modal fade" id="addModalCenter{{ $item->id }}"
                                                            tabindex="-1" role="dialog"
                                                            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered"
                                                                role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title"
                                                                            id="exampleModalLongTitle">
                                                                            Update Stock for "{{ $item->item_name }}"</h5>
                                                                        <button type="button" class="close"
                                                                            data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form method="post" action="/addItemStock">
                                                                            @csrf
                                                                            <div class="card-body">
                                                                                <div class="form-group">

                                                                                    <label for="quantity">Stock</label>
                                                                                    <input type="number" id="quantity"
                                                                                        name="itemAddStock" min="1"
                                                                                        max="1000000" style="width: 100%"
                                                                                        class="form-control"
                                                                                        placeholder="minimum 1">

                                                                                    <div class="card mt-5 ">
                                                                                        <button id=""
                                                                                            class="btn btn-primary">Update
                                                                                            Data</button>
                                                                                    </div>
                                                                                </div>
                                                                                <input type="hidden" class="form-control"
                                                                                    name="itemIdHidden"
                                                                                    value="{{ $item->id }}">
                                                                                <input type="hidden" class="form-control"
                                                                                    name="userIdHidden"
                                                                                    value="{{ auth()->user()->id }}">
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div> --}}

                                                        {{-- old feature to add outgoing package in this page --}}
                                                        {{-- <div class="modal fade" id="reduceModalCenter{{ $item->id }}"
                                                            tabindex="-1" role="dialog"
                                                            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered"
                                                                role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title"
                                                                            id="exampleModalLongTitle">
                                                                            Reduce Stock for "{{ $item->item_name }}"</h5>
                                                                        <button type="button" class="close"
                                                                            data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form method="post" action="/reduceItemStock">
                                                                            @csrf
                                                                            <div class="card-body">
                                                                                <div class="form-group">

                                                                                    <label for="quantity">Stock</label>
                                                                                    <input type="number" id="quantity"
                                                                                        name="itemReduceStock"
                                                                                        min="1"
                                                                                        max="{{ $item->stocks }}"
                                                                                        style="width: 100%"
                                                                                        class="form-control"
                                                                                        placeholder="minimum 1">

                                                                                    <div class="card mt-5 ">
                                                                                        <button id=""
                                                                                            class="btn btn-primary">Update
                                                                                            Data</button>
                                                                                    </div>
                                                                                </div>
                                                                                <input type="hidden" class="form-control"
                                                                                    name="itemIdHidden"
                                                                                    value="{{ $item->id }}">
                                                                                <input type="hidden" class="form-control"
                                                                                    name="userIdHidden"
                                                                                    value="{{ auth()->user()->id }}">
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div> --}}
                                                    </td>
                                                </tr>
                                                <div class="modal fade" id="imageModalCenter{{ $item->item_id }}"
                                                    tabindex="-1" role="dialog"
                                                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-lg"
                                                        role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h3 class="modal-title" id="exampleModalLongTitle">
                                                                    <strong>Gambar barang "
                                                                        {{ $item->item_name }}"</strong>
                                                                </h3>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <img class="rounded mx-auto d-block"
                                                                    style="width: 750px; height: auto;"
                                                                    src="{{ Storage::url($item->item_pictures) }}"
                                                                    alt="no picture" loading="lazy">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection