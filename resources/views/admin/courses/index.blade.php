@extends('admin.layouts.app')

@section('page_title', '| Courses')

@section('content')
<div class="content-w space_main_content">
  <ul class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="{{ route('dashboard') }}">Dashboard</a>
    </li>
    <li class="breadcrumb-item">
      <span>Courses</span>
    </li>
  </ul>

  <div class="content-i">
    <div class="content-box">
      
      <div class="element-wrapper">
        <div class="element-actions">
          <a class="btn btn-primary btn-sm" href="{{ route('admin.courses.create') }}">
            <i class="os-icon os-icon-ui-22"></i><span>Add Course</span>
          </a>
        </div>
        <h6 class="element-header">
          Courses
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
                <th width="30%">{{ __('Courses') }}</th>
                <th width="10">{{ __('Image') }}</th>
                <th width="13%" class="text-right">{{ __('Cost') }} (&#x20a6;)</th>
                <th width="17%" class="text-center">{{ __('Discount (%)') }}</th>
                <th width="12%">{{ __('Status') }}</th>
                @can ('isAdminGroup')
                  <th width="18%">&nbsp;</th>
                @endcan
              </tr>
            </thead>
            <tbody>
              @forelse ($courses->chunk(10) as $chunk)
                @foreach ($chunk as $course)
                  <tr>
                    <td>{{ $course->title }}</td>
                    <td>
                      @if (! is_null($course->image_url))
                        <a href="{{ $course->image_url }}" target="_blank">View image</a>
                      @else
                        No image
                      @endif
                    </td>
                    <td class="text-right">&#x20a6;{{ number_format($course->cost) }}</td>
                    <td class="text-center">{{ number_format($course->discount) }}</td>
                    <td>
                      <div class="badge {{ $course->is_live == '' ? ' badge-primary-inverted' : 'badge-success-inverted' }}">
                        {{ $course->status }}
                      </div>
                      {{-- <div class="status-pill {{ $course->is_live ? 'green' : 'yellow' }}"></div> 
                      <small class="text-muted" style="margin-left: 5px; font-weight: 700;">{{ strtoupper($course->status) }}</small> --}}
                    </td>
                    @can ('isAdminGroup')
                      <td>
                        <div class="btn-group mr-1 mb-1">
                          <button aria-expanded="false" aria-haspopup="true" class="btn btn-grey dropdown-toggle" data-toggle="dropdown" id="dropdownMenuButton6" type="button">Actions</button>
                          <div aria-labelledby="dropdownMenuButton6" class="dropdown-menu">
                            <a class="dropdown-item" href="{{ route('admin.courses.edit', $course->uid) }}"> {{ __('Edit') }}</a>
                            <a class="dropdown-item" href="#"> {{ __('View Details') }}</a>
                            
                            <a class="dropdown-item text-danger" href="javascript:;" onclick="confirm('{{ __("Are you sure you want to delete?") }}') ? document.getElementById('delete-{{$course->uid}}').submit() : ''"> {{ __('Delete') }}</a>

                            <form id="delete-{{$course->uid}}" action="{{ route('admin.courses.destroy', $course->uid) }}" method="POST" style="display: none;">
                              @csrf
                              @method('DELETE')
                          </form>
                          </div>
                        </div>
                      </td>
                    @endcan
                  </tr>
                @endforeach

                @if ($loop->remaining === 0)
                  <tr style="background-color:#ced2db; text-transform: uppercase;">
                    <td colspan="6" class="p-3 text-center uppercase">
                      <small>Showing {{ $courses->firstItem() }} to {{ $courses->lastItem() }} of 
                      {{ $courses->total() }} records</small>
                    </td>
                  </tr>
                @endif

              @empty
                <tr>
                  <td colspan="6" class="text-center">No record found!</td>
                </tr>
              @endforelse
            </tbody>
          </table>
          <div class="mt-4">
            {{ $courses->links() }}
          </div>

        </div>

        </div>
      </div>
     
    </div>
  </div>
</div>

@endsection
