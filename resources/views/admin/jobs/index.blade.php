@extends('admin.layouts.app')

@section('page_title', '| Jobs')

@section('content')
<div class="content-w space_main_content">
  <ul class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="{{ route('dashboard') }}">Dashboard</a>
    </li>
    <li class="breadcrumb-item">
      <span>Jobs</span>
    </li>
  </ul>

  <div class="content-i">
    <div class="content-box">

      <div class="element-wrapper">
        <div class="element-actions">
          <a class="btn btn-primary btn-sm" href="{{ route('admin.jobs.create') }}">
            <i class="os-icon os-icon-ui-22"></i><span>Add Job</span>
          </a>
        </div>
        <h6 class="element-header">
          Jobs
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
                <th width="42%">{{ __('Title') }}</th>
                <th width="28%">{{ __('Opening Duration') }}</th>
                <th width="15%">{{ __('Status') }}</th>
                @can ('isAdminGroup')
                  <th width="15%">&nbsp;</th>
                @endcan
              </tr>
            </thead>
            <tbody>
              @forelse ($jobs->chunk(10) as $chunk)
                @foreach ($chunk as $job)
                  <tr>
                    <td>
                      {{ $job->title }}
                    </td>
                    <td>
                      @if (! is_null($job->opening_start_date))
                        <div>
                          <small>
                            {{ is_null($job->openingEnds) ? strtoupper($job->openingStarts) : strtoupper($job->openingStarts . ' to ') }}
                          </small>
                          <br>
                          <small>{{ strtoupper($job->openingEnds) }}</small>
                        </div>
                      @endif
                    </td>
                    <td>
                      <small class="badge {{ $job->is_live ? 'badge-success-inverted' : 'badge-default-inverted' }}">{{ $job->status }}</small>
                    </td>
                    @can ('isAdminGroup')
                      <td>
                        <div class="btn-group mr-1 mb-1">
                          <button aria-expanded="false" aria-haspopup="true" class="btn btn-grey dropdown-toggle" data-toggle="dropdown" id="dropdownMenuButton6" type="button">Actions</button>
                          <div aria-labelledby="dropdownMenuButton6" class="dropdown-menu">
                            <a class="dropdown-item" href="{{ route('admin.jobs.edit', $job->uid) }}"> {{ __('Edit') }}</a>

                            {{-- <a class="dropdown-item" href="javascript:;" onclick="confirm('{{ __("Are you sure you want to proceed?") }}') ? document.getElementById('status-{{$job->uid}}').submit() : ''"> {{ __('Change Status') }}</a>
                            <form id="status-{{$job->uid}}" action="{{ route('admin.jobs.status', $job->uid) }}" method="POST" style="display: none;">
                              @csrf
                              @method('PUT')
                              <input type="text" value="{{ $job->is_live }}" name="is_live">
                            </form> --}}

                            <a class="dropdown-item text-danger" href="javascript:;" onclick="confirm('{{ __("Are you sure you want to delete?") }}') ? document.getElementById('delete-{{$job->uid}}').submit() : ''"> {{ __('Delete') }}</a>
                            <form id="delete-{{$job->uid}}" action="{{ route('admin.jobs.destroy', $job->uid) }}" method="POST" style="display: none;">
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
                    <td colspan="5" class="p-3 text-center uppercase">
                      <small>Showing {{ $jobs->firstItem() }} to {{ $jobs->lastItem() }} of
                      {{ $jobs->total() }} records</small>
                    </td>
                  </tr>
                @endif

              @empty
                <tr>
                  <td colspan="5" class="text-center">No records found!</td>
                </tr>
              @endforelse
            </tbody>
          </table>
          <div class="mt-4">
            {{ $jobs->links() }}
          </div>

        </div>

        </div>
      </div>

    </div>
  </div>
</div>

@endsection
