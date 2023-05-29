@extends('layout.layout')

@section('manageitembutton', 'active')
@section('manageitem', 'active')
@section('showmanageitem', 'show')

@section('content')
    <div class="main-panel">
        <div class="content">
            ini page buat manage item
            <div class="page-inner">

                @if (session('sukses_delete_item'))
                    <div class="alert alert-warning alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ session('sukses_delete_item') }}</strong>
                    </div>
                @elseif (session('sukses_editItem'))
                    <div class="alert alert-primary alert-block" id="alerts">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>Sukses mengupdate data "{{ session('sukses_editItem') }}"</strong>
                    </div>
                @elseif (session('sukses_addStock'))
                    <div class="alert alert-primary alert-block" id="alerts">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>Sukses menambah stock"{{ session('sukses_addStock') }}"</strong>
                    </div>
                @elseif (session('sukses_reduceStock'))
                    <div class="alert alert-primary alert-block" id="alerts">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>Sukses mengurangi stock "{{ session('sukses_reduceStock') }}"</strong>
                    </div>
                @elseif ($errors->any())
                    <div class="alert alert-danger alert-block" id="alerts">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>Update Failed, validation not met, error is: {{ $errors->first() }}</strong>
                    </div>
                @endif

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex align-items-center">
                                    <h4 class="card-title">Manage Existing Items and its Stocks</h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="add-row" class="display table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>Brand</th>
                                                <th>Item Name</th>
                                                <th>Stocks</th>
                                                <th>First Added at</th>
                                                <th>Last Updated at</th>
                                                <th style="width: 10%">Action</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Brand</th>
                                                <th>Item Name</th>
                                                <th>Stocks</th>
                                                <th>First Added at</th>
                                                <th>Last Updated at</th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            @foreach ($item as $item)
                                                <tr>
                                                    <td>{{ $item->brand->brand_name }}</td>
                                                    <td>{{ $item->item_name }}</td>
                                                    <td>{{ $item->stocks }}</td>
                                                    <td>{{ $item->created_at }}</td>
                                                    <td>{{ $item->updated_at }}</td>
                                                    <td>
                                                        <div class="d-flex justify-content-center">
                                                            <a style="cursor: pointer"
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
                                                            </a>
                                                            <a style="cursor: pointer" class="ml-3 mb-2"
                                                                data-target="#editModalCenter{{ $item->id }}"
                                                                data-toggle="modal">
                                                                <i class="fa fa-edit mt-3 text-primary"
                                                                    data-toggle="tooltip"
                                                                    data-original-title="Edit Item Name"></i>
                                                            </a>
                                                            <a class="ml-3 mb-2" style="cursor: pointer"
                                                                data-target="#deleteModal{{ $item->id }}"
                                                                data-toggle="modal">
                                                                <i class="fa fa-times mt-3 text-danger"
                                                                    data-toggle="tooltip"
                                                                    data-original-title="Delete Item"></i>
                                                            </a>
                                                        </div>

                                                        <div class="modal fade" id="deleteModal{{ $item->id }}">
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
                                                                        <a href="/deleteItem/{{ $item->id }}"
                                                                            class="btn btn-danger">YAKIN
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="modal fade" id="editModalCenter{{ $item->id }}"
                                                            tabindex="-1" role="dialog"
                                                            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLongTitle">
                                                                            Update data for "{{ $item->item_name }}"</h5>
                                                                        <button type="button" class="close"
                                                                            data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form method="post" action="/updateItem">
                                                                            @csrf
                                                                            <div class="card-body">
                                                                                <div class="form-group">
                                                                                    <label>Item Name</label>
                                                                                    <input type="text"
                                                                                        class="form-control"
                                                                                        placeholder="item name"
                                                                                        aria-label=""
                                                                                        aria-describedby="basic-addon1"
                                                                                        name="itemnameformupdate" required>
                                                                                    <div class="card mt-5 ">
                                                                                        <button id=""
                                                                                            class="btn btn-primary">Update
                                                                                            Data</button>
                                                                                    </div>
                                                                                </div>
                                                                                <input type="hidden" class="form-control"
                                                                                    name="itemIdHidden"
                                                                                    value="{{ $item->id }}">
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="modal fade" id="addModalCenter{{ $item->id }}"
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
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="modal fade" id="reduceModalCenter{{ $item->id }}"
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
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
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