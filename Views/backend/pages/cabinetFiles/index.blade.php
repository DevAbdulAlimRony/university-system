@extends('backend.layouts.master')

@section('main-content')

    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{!! route('admin.dashboard') !!}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Reports</li>
    </ol>

    {{-- Data Table --}}
    <div class="card mb-3">
        <div class="card-header">
            <i class="fa fa-table"></i>PSTU Meeting/Program Report Files
            <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#addFile"><i class="fa fa-fw fa-plus"></i>Add File</button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Sub Category</th>
                            <th>File</th>
                            <th>Manage</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Sub Category</th>
                            <th>File</th>
                            <th>Manage</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($files as $file)
                            <tr>
                                <td>{{ $file->title  }}</td>
                                <td>{{ $file->subcategory->cabinet->name }}</td>
                                <td>{{ $file->subcategory->subcategory_title }}</td>
                                <td>
                                    @if($file->file)
                                        <a href="{{ asset('files/cabinets/'.$file->file) }}" target="_blank"><img src="{{ asset('images/defaults/pdf.png') }}" width="50px" height="50px" alt=""></a>
                                    @else
                                        {{ 'N/A' }}
                                    @endif
                                </td>
                                <td>
                                    <button class="btn btn-outline-primary" data-toggle="modal" data-target="#editFile{{ $file->id }}"><i class="fa fa-fw fa-edit"></i> Edit</button>
                                    {{-- Edit Modal --}}
                                    <div class="modal fade" id="editFile{{ $file->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLongTitle">Edit File</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>

                                                <form class="form-control" action="{{ route('admin.cabinetFiles.update', $file->id) }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="file_category_id" class="col-form-label">File Category <span class="text-danger"><b>*</b></span> (If empty then add File category first <a href="{{ route('admin.cabinetFiles.index') }}" target="_blank"> Here</a>)</label>
                                                        <select class="form-control" name="category_id" id="file_category_id">
                                                            @foreach ($cabinetCategories as $cabinetCategory)
                                                                <option value="{{ $cabinetCategory->id }}"
                                                                    @if($cabinetCategory->id == $file->category_id)
                                                                        selected
                                                                    @endif
                                                                    >
                                                                    {{ $cabinetCategory->name }}</option>
                                                                @endforeach

                                                            </select>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="file_sub_category_id" class="col-form-label">File Sub Category <span class="text-danger"><b>*</b></span> (If empty then add File sub category first <a href="{{ route('admin.cabinetSubCategories.index') }}" target="_blank"> Here</a>)</label>
                                                            <select class="form-control" name="sub_category_id" id="file_sub_category_id">
                                                                @foreach ($cabinetSubCategories as $cabinetSubCategory)
                                                                    <option value="{{ $cabinetSubCategory->id }}"
                                                                        @if($cabinetSubCategory->id == $file->sub_category_id)
                                                                            selected
                                                                        @endif
                                                                        >
                                                                        {{ $cabinetSubCategory->subcategory_title }}</option>
                                                                    @endforeach
    
                                                                </select>
                                                            </div>

                                                        <div class="form-group">
                                                            <label for="title" class="col-form-label">Title <span class="text-danger"><b>*</b></span></label>
                                                            <input type="text" class="form-control" name="title" id="title" value="{{ $file->title }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="file" class="col-form-label">
                                                                @if($file->file != null)
                                                                    New File <a href="{{ asset('files/cabinets/'.$file->file) }}" class="btn btn-success btn-sm ml-2" target="_blank"><i class="fa fa-fw fa-download"></i>Previous File Here</a>
                                                                @else
                                                                    File <span class="text-danger">(No File Yet)<span class="text-danger"><b>*</b></span></span>
                                                                @endif
                                                            </label>
                                                            <input type="file" class="form-control" name="file" id="file">
                                                        </div>
                                                        <button type="submit" class="btn btn-primary float-right">Save Information</button>
                                                        <button type="button" class="btn btn-secondary float-right mr-2" data-dismiss="modal">Close</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- End Edit Modal --}}

                                    <button type="submit" data-toggle="modal" data-target="#deleteModal{{ $file->id }}" class="btn btn-outline-danger"><i class="fa fa-fw fa-trash"></i> Delete</button>

                                    {{-- Delete Modal --}}
                                    <div class="modal fade" id="deleteModal{{ $file->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteModalLabel">Are you want to delete this file?</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-footer">
                                                    <form class="" data-toggle="modal" data-target="#deleteModal" action="{{ route('admin.cabinetFiles.delete', $file->id) }}" method="post">
                                                        @csrf
                                                        <button type="submit" class="btn btn-outline-danger"><i class="fa fa-trash"></i>Delete</button>
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



        <div class="modal fade" id="addFile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addFile">Report File Information</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="needs-validation" action="{{ route('admin.cabinetFiles.store') }}" method="POST" enctype="multipart/form-data" novalidate>
                            @csrf
                            <div class="form-group">
                                <label for="file_category_id" class="col-form-label">File Category<span class="text-danger"><b>*</b></span> (If empty then add File category first <a href="{{ route('admin.cabinetCategories.index') }}" target="_blank"> Here</a>)</label>
                                <select class="form-control" name="category_id" id="file_category_id" class="ReportCategory" required>
                                    <option>Select File Category</option>
                                    @foreach ($cabinetCategories as $fileCategory)
                                        <option value="{{ $fileCategory->id }}">{{ $fileCategory->name }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                  Please select a category.
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="file_sub_category_id" class="col-form-label">File Sub Category<span class="text-danger"><b>*</b></span> (If empty then add File sub category first <a href="{{ route('admin.cabinetSubCategories.index') }}" target="_blank"> Here</a>)</label>
                                <select class="form-control" name="sub_category_id" id="file_sub_category_id" required>
                                    <option>Select File Sub Category</option>
                                    @foreach ($cabinetSubCategories as $fileSubCategory)
                                        <option value="{{ $fileSubCategory->id }}">{{ $fileSubCategory->subcategory_title }}</option>
                                    @endforeach
                                </select>
                                {{-- <select class="form-control formselect required" placeholder="Select Sub Category" id="file_sub_category_id"></select> --}}
                                <div class="invalid-feedback">
                                  Please select a sub category.
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="title" class="col-form-label">Title <span class="text-danger"><b>*</b></span></label>
                                <input type="text" class="form-control" name="title" id="title" placeholder="File Title" required>
                                <div class="invalid-feedback">
                                  Please give a title.
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="file" class="col-form-label">File File <span class="text-danger"><b>*</b></span></label>
                                <input type="file" class="form-control" name="file" id="file" required>
                                <div class="invalid-feedback">
                                  Please give a file.
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary float-right mt-2">Save Information</button>
                            <button type="button" class="btn btn-secondary float-right mt-2 mr-2" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    @endsection

    <script src="http://code.jquery.com/jquery-3.4.1.js"></script>
    {{-- <script>
        $(document).ready(function () {
        $('#file_category_id').on('change', function () {
        let id = $(this).val();
        $('file_sub_category_id').empty();
        $('file_sub_category_id').append(`<option value="0" disabled selected>Processing...</option>`);
        $.ajax({
        type: 'GET',
        url: 'GetSubCatAgainstMainCatEdit/' + id,
        success: function (response) {
        var response = JSON.parse(response);
        console.log(response);   
        $('file_sub_category_id').empty();
        $('file_sub_category_id').append(`<option value="0" disabled selected>Select Sub Category*</option>`);
        response.forEach(element => {
            $('file_sub_category_id').append(`<option value="${element['id']}">${element['name']}</option>`);
            });
        }
    });
});
});
</script> --}}
