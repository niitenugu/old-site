@extends('admin.layouts.app')

@section('page_title', '| Users')

@section('content')
<div class="content-w space_main_content">
  <ul class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="{{ route('dashboard') }}">Dashboard</a>
    </li>
    <li class="breadcrumb-item">
      <span>Users</span>
    </li>
  </ul>

  <div class="content-i">
    <div class="content-box">
      
      <div class="element-wrapper">
        <div class="element-actions">
          <a class="btn btn-primary btn-sm" href="{{ route('admin.users.create') }}">
            <i class="os-icon os-icon-ui-22"></i><span>Create User</span>
          </a>
        </div>
        <h6 class="element-header">
          Users
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
                <th width="30%">{{ __('Full Name') }}</th>
                <th width="20%">{{ __('Contact') }}</th>
                <th width="15%">{{ __('Status') }}</th>
                <th width="20%">{{ __('Last Login') }}</th>
                @can ('isAdminGroup')
                  <th width="15%">&nbsp;</th>
                @endcan
              </tr>
            </thead>
            <tbody>
              @forelse ($users->chunk(10) as $chunk)
                @foreach ($chunk as $user)
                  <tr>
                    <td>
                      {{ $user->name }}
                      <div class="text-muted">
                        <small>{{ strtoupper($user->position) }}</small>
                      </div>
                    </td>
                    <td>
                      {{ $user->email }}
                      <div>{{ $user->phone}}</div>
                    </td>
                    <td>
                      <div class="status-pill {{ $user->is_active ? 'green' : 'red' }}"></div> 
                      <small class="text-muted" style="margin-left: 5px; font-weight: 700;">{{ strtoupper($user->status) }}</small>
                    </td>
                    <td>&nbsp;</td>
                    @can ('isAdminGroup')
                      <td>
                        <div class="btn-group mr-1 mb-1">
                          <button aria-expanded="false" aria-haspopup="true" class="btn btn-grey dropdown-toggle" data-toggle="dropdown" id="dropdownMenuButton6" type="button">Actions</button>
                          <div aria-labelledby="dropdownMenuButton6" class="dropdown-menu">
                            <a class="dropdown-item" href="{{ route('admin.users.edit', $user->uid) }}"> {{ __('Edit') }}</a>

                            <a class="dropdown-item" href="javascript:;" onclick="confirm('{{ __("Are you sure you want to proceed?") }}') ? document.getElementById('status-{{$user->uid}}').submit() : ''"> {{ __('Change Status') }}</a>
                            <form id="status-{{$user->uid}}" action="{{ route('admin.users.status', $user->uid) }}" method="POST" style="display: none;">
                              @csrf
                              @method('PUT')
                              <input type="text" value="{{ $user->is_active }}" name="is_live">
                            </form>

                            <a class="dropdown-item text-danger" href="javascript:;" onclick="confirm('{{ __("Are you sure you want to delete?") }}') ? document.getElementById('delete-{{$user->uid}}').submit() : ''"> {{ __('Delete') }}</a>
                            <form id="delete-{{$user->uid}}" action="{{ route('admin.users.destroy', $user->uid) }}" method="POST" style="display: none;">
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
                      <small>Showing {{ $users->firstItem() }} to {{ $users->lastItem() }} of 
                      {{ $users->total() }} records</small>
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
            {{ $users->links() }}
          </div>

        </div>

        </div>
      </div>
     
    </div>
  </div>
</div>

@endsection
