@extends('admin.layouts.app')

@section('page_title', '| Course Categories')

@section('content')
<div class="content-w space_main_content">
  <ul class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="{{ route('dashboard') }}">Dashboard</a>
    </li>
    <li class="breadcrumb-item">
      <span>Course Categories</span>
    </li>
  </ul>

  <div class="content-i">
    <div class="content-box">
      
      <div class="element-wrapper">
        <div class="element-actions">
          <a class="btn btn-primary btn-sm" href="{{ route('admin.categories.create') }}">
            <i class="os-icon os-icon-ui-22"></i><span>Add Category</span>
          </a>
        </div>
        <h6 class="element-header">
          Course Categories
        </h6>
        <div class="element-box">

          @include('admin.partials.alert')

          <div class="controls-above-table">
            <div class="row">
              <div class="col-sm-6">
                {{-- <a class="btn btn-sm btn-secondary" href="#">Download CSV</a> --}}
                {{-- <a class="btn btn-sm btn-secondary" href="#">Archive</a>
                <a class="btn btn-sm btn-danger" href="#">Delete</a> --}}
              </div>
              {{-- <div class="col-sm-6">
                <form class="form-inline justify-content-sm-end">
                  <input class="form-control form-control-sm rounded bright" placeholder="Search" type="text"><select class="form-control form-control-sm rounded bright">
                    <option selected="selected" value="">
                      Select Status
                    </option>
                    <option value="Pending">
                      Pending
                    </option>
                    <option value="Active">
                      Active
                    </option>
                    <option value="Cancelled">
                      Cancelled
                    </option>
                  </select>
                </form>
              </div> --}}
            </div>
          </div>

          <div class="table-responsive">
          <table class="table table-lightborder table-striped table-hover">
            <thead>
              <tr>
                <th width="35%">Category</th>
                <th width="15%">Status</th>
                <th width="15%">Courses</th>
                <th width="17%">Created On</th>
                @can ('isAdminGroup')
                  <th width="18%">&nbsp;</th>
                @endcan
              </tr>
            </thead>
            <tbody>
              @forelse ($categories as $category)
                <tr>
                  <td>{{ $category->name }}</td>
                  <td>
                    <div class="status-pill {{ $category->is_live ? 'green' : 'yellow' }}"></div> 
                    <small class="text-muted" style="margin-left: 5px; font-weight: 700;">{{ strtoupper($category->status) }}</small>
                  </td>
                  <td>
                    {{ $count = $category->courses->count() }}
                    {{ str_plural('course', $count) }}
                  </td>
                  <td>
                    <abbr title="{{ $category->created_at->format('d M, Y @ h:ia') }}">
                      {{ $category->created_at->format('d M, Y') }}
                    </abbr>
                  </td>
                  @can ('isAdminGroup')
                    <td>
                      <div class="btn-group mr-1 mb-1">
                        <button aria-expanded="false" aria-haspopup="true" class="btn btn-grey dropdown-toggle" data-toggle="dropdown" id="dropdownMenuButton6" type="button">Actions</button>
                        <div aria-labelledby="dropdownMenuButton6" class="dropdown-menu">
                          <a class="dropdown-item" href="{{ route('admin.categories.edit', $category->uid) }}"> {{ __('Edit') }}</a>
                          <a class="dropdown-item" href="#"> {{ __('View Courses') }}</a>
                          
                          <a class="dropdown-item text-danger" href="javascript:;" onclick="confirm('{{ __("Are you sure you want to delete?") }}') ? document.getElementById('delete-{{$category->uid}}').submit() : ''"> {{ __('Delete') }}</a>

                          <form id="delete-{{$category->uid}}" action="{{ route('admin.categories.destroy', $category->uid) }}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                        </div>
                      </div>
                    </td>
                  @endcan
                </tr>
              @empty
                <tr>
                  <td colspan="4" class="text-center">No record found!</td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>

        </div>
      </div>
     
    </div>
  </div>
</div>

@endsection
