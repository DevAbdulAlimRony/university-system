@extends('backend.layouts.master')

@section('main-content')

    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{!! route('admin.dashboard') !!}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Report Categories</li>
    </ol>

    {{-- Data Table --}}
    <div class="card mb-3">
        <div class="card-header">
            <i class="fa fa-table"></i> Report Categories
            <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#addModal"><i class="fa fa-fw fa-plus"></i>Add Meeting Report Categroy</button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Priority</th>
                            <th>Icon Image</th>
                            <th>Manage</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Name</th>
                            <th>Priority</th>
                            <th>Icon Image</th>
                            <th>Manage</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($cabinetCategories as $cabinetCategory)
                            <tr>
                                <td>{{ $cabinetCategory->name }}</td>
                                <td>{{ $cabinetCategory->priority }}</td>
                                <td>
                                    <img style="height:50px; width:50px; text-align: center; display: block; margin-left: auto; margin-right: auto;" src="{{ asset('images/' . App\Helpers\ReturnPathHelper::getCabinetCategoryImage($cabinetCategory->id)) }}" alt="">
                                </td>
                                <td>
                                    <button class="btn btn-outline-primary" data-toggle="modal" data-target="#cabinetCategoryEditModal{{ $cabinetCategory->id }}"><i class="fa fa-edit"></i> Edit</button>

                                    {{-- Edit Modal --}}
                                    <div class="modal fade" id="cabinetCategoryEditModal{{ $cabinetCategory->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLongTitle">Edit Report Category</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>

                                                <form class="form-control" action="{{ route('admin.cabinetCategories.update', $cabinetCategory->id) }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    
                                                    <div class="form-group">
                                                        <label for="name" class="col-form-label">Report Files Title <span class="text-danger"><b>*</b></span></label>
                                                        <input type="text" class="form-control" name="name" id="name" value="{{ $cabinetCategory->name }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="priority" class="col-form-label">Priority <span class="text-danger"><b>(lower value will get higher priority)</b></span></label>
                                                        <input type="number" class="form-control" name="priority" id="priority" value="{{ $cabinetCategory->priority ? $cabinetCategory->priority : '10' }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="image" class="col-form-label">Icon Image<span class="text-danger"><b>(If you not change, previous image will be there.)</b></span></label>
                                                        <input type="file" class="form-control" name="image" id="image" value="{{ $cabinetCategory->image}}">
                                                    </div>
                                                    <button type="submit" class="btn btn-primary float-right">Save Information</button>
                                                    <button type="button" class="btn btn-secondary float-right mr-2" data-dismiss="modal">Close</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                {{-- End Edit Modal --}}
                                
                                <button class="btn btn-outline-danger" data-toggle="modal" data-target="#primarycabinetCategoryDeleteModal{{ $cabinetCategory->id }}"><i class="fa fa-trash"></i> Delete</button>
                                {{-- Delete Modal --}}
                                <div class="modal fade" id="primarycabinetCategoryDeleteModal{{ $cabinetCategory->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModalLabel">Are you want to delete this data? The Sub Category and Files belonged to this category will also be deleted.</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-footer">
                                                <button data-toggle="modal" data-target="#cabinetCategoryDeleteModal{{ $cabinetCategory->id }}" class="btn btn-outline-danger" data-dismiss="modal"><i class="fa fa-trash"></i> Delete</button>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal fade" id="cabinetCategoryDeleteModal{{ $cabinetCategory->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModalLabel">Are you want to delete this data?</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                              <span class="text-danger">All data related to this category will delete.. Are you want to delete this category ? </span>
                                            </div>
                                            <div class="modal-footer">
                                                <form class="" action="{{ route('admin.cabinetCategories.delete', $cabinetCategory->id) }}" method="post">
                                                    @csrf
                                                    <button type="submit" class="btn btn-outline-danger"><i class="fa fa-trash"></i> Delete</button>
                                                </form>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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



<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModal">Meeting Reports Category Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.cabinetCategories.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name" class="col-form-label">Category Name<span class="text-danger"><b>*</b></span></label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Report Files Categroy Title">
                    </div>
                    <div class="form-group">
                        <label for="priority" class="col-form-label">Priority <span class="text-danger"><b>(lower value will get higher priority)</b></span></label>
                        <input type="number" class="form-control" name="priority" id="priority" placeholder="Report Files Categroy Priority" value="10">
                    </div>
                    <div class="form-group">
                        <label for="image" class="col-form-label">Icon Image<span class="text-danger"><b> (optional) </b></span></label>
                        <input type="file" class="form-control" name="image" id="image" placeholder="Report Files Categroy Image">
                    </div>
                    <button type="submit" class="btn btn-primary float-right">Save Information</button>
                    <button type="button" class="btn btn-secondary float-right mr-2" data-dismiss="modal">Close</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
