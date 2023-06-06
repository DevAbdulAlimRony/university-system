@extends('backend.layouts.master')

@section('main-content')


    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{!! route('admin.dashboard') !!}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Report Sub Category</li>
    </ol>

    {{-- Data Table --}}
    <div class="card mb-3">
        <div class="card-header">
            <i class="fa fa-table"></i> Report Sub Categories
            <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#addModal"><i class="fa fa-fw fa-plus"></i>Add Report Sub Categroy</button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Priority</th>
                            <th>Category</th>
                            <th>Manage</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Name</th>
                            <th>Priority</th>
                            <th>Category</th>
                            <th>Manage</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($cabinetSubCategories as $cabinetSubCategory)
                            <tr>
                                <td>{{ $cabinetSubCategory->subcategory_title }}</td>
                                <td>{{ $cabinetSubCategory->priority }}</td>
                                <td>{{ $cabinetSubCategory->cabinet->name }}</td>
                                <td>
                                    <button class="btn btn-outline-primary" data-toggle="modal" data-target="#cabinetSubCategoryEditModal{{ $cabinetSubCategory->id }}"><i class="fa fa-edit"></i> Edit</button>

                                    {{-- Edit Modal --}}
                                    <div class="modal fade" id="cabinetSubCategoryEditModal{{ $cabinetSubCategory->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLongTitle">Edit Report Sub Category</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>

                                                <form class="form-control" action="{{ route('admin.cabinetSubCategories.update', $cabinetSubCategory->id) }}" method="POST">
                                                    @csrf
                                                    
                                                    <div class="form-group">
                                                        <label for="subcategory_title" class="col-form-label">Sub Category Title <span class="text-danger"><b>*</b></span></label>
                                                        <input type="text" class="form-control" name="subcategory_title" id="subcategory_title" value="{{ $cabinetSubCategory->subcategory_title}}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="priority" class="col-form-label">Priority <span class="text-danger"><b>(lower value will get higher priority)</b></span></label>
                                                        <input type="number" class="form-control" name="priority" id="priority" value="{{ $cabinetSubCategory->priority ? $cabinetSubCategory->priority : '10' }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="category_id">Category
                                                            <span class="text-danger"><b>*</b></span> (If empty then add Category first <a href="{{ route('admin.cabinetCategories.index') }}" target="_blank"> Here</a>)
                                                        </label>
                                                        <select name="category_id" id="category_id" class="form-control">
                                                            @foreach($cabinetData as $cabinetCategory)
                                                    
                                                            <option value="{{ $cabinetCategory->id }}" 
                                                                @if($cabinetCategory->id == $cabinetCategory->category_id)
                                                                selected
                                                              @endif>{{ $cabinetCategory->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary float-right">Save Information</button>
                                                    <button type="button" class="btn btn-secondary float-right mr-2" data-dismiss="modal">Close</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                {{-- End Edit Modal --}}
                                
                                <button class="btn btn-outline-danger" data-toggle="modal" data-target="#primarycabinetSubCategoryDeleteModal{{ $cabinetSubCategory->id }}"><i class="fa fa-trash"></i>Delete</button>
                                {{-- Delete Modal --}}
                                <div class="modal fade" id="primarycabinetSubCategoryDeleteModal{{ $cabinetSubCategory->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModalLabel">Are you want to delete this data? The Files belonging to his subcategory will also be deleted.</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-footer">
                                                <button data-toggle="modal" data-target="#cabinetSubCategoryDeleteModal{{ $cabinetSubCategory->id }}" class="btn btn-outline-danger" data-dismiss="modal"><i class="fa fa-trash"></i>Delete</button>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal fade" id="cabinetSubCategoryDeleteModal{{ $cabinetSubCategory->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
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
                                                <form class="" action="{{ route('admin.cabinetSubCategories.delete', $cabinetSubCategory->id) }}" method="post">
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
                <h5 class="modal-title" id="addModal">Report Sub Category Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.cabinetSubCategories.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="subcategory_title" class="col-form-label">Sub Category Title<span class="text-danger"><b>*</b></span></label>
                        <input type="text" class="form-control" name="subcategory_title" id="subcategory_title" placeholder="Cabinet Files Sub Categroy Title">
                    </div>
                    <div class="form-group">
                        <label for="priority" class="col-form-label">Priority <span class="text-danger"><b>(lower value will get higher priority)</b></span></label>
                        <input type="number" class="form-control" name="priority" id="priority" placeholder="Cabinet Files Sub Categroy Priority" value="10">
                    </div>
                    <div class="form-group">
                    <label for="category_id">Category
                        <span class="text-danger"><b>*</b></span> (If empty then add Category first <a href="{{ route('admin.cabinetCategories.index') }}" target="_blank"> Here</a>)
                    </label>
                    <select name="category_id" id="category_id" class="form-control">
                        <option value="">Select Category</option>
                        @foreach($cabinetData as $data)
                        <option value="{{ $data->id }}">{{ $data->name }}</option>
                        @endforeach
                    </select> 
                    </div>
                    <button type="submit" class="btn btn-primary float-right">Save Information</button>
                    <button type="button" class="btn btn-secondary float-right mr-2" data-dismiss="modal">Close</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
