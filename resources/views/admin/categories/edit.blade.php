@extends('admin.layouts.app')

@section('page_title', '| Edit Course Category')

@section('content')
<div class="content-w space_main_content">

  <ul class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="{{ route('dashboard') }}">Dashboard</a>
    </li>
    <li class="breadcrumb-item">
      <a href="{{ route('admin.categories.index') }}">Course Categories</a>
    </li>
    <li class="breadcrumb-item">
      <span>Edit Course Category</span>
    </li>
  </ul>

  <div class="content-i">
    <div class="content-box">
      
      <div class="element-wrapper">
        <div class="element-actions">
          <a class="btn btn-primary btn-sm" href="{{ route('admin.categories.index') }}">
            <span>Go back to list</span>
          </a>
        </div>
        <h6 class="element-header">
          Course Categories
        </h6>
        <div class="element-box">

          <form action="{{ route('admin.categories.update', $category->uid) }}" method="POST">
            @csrf
            @method('PUT')

          <h5 class="form-header">
            Category Form
          </h5>
          <hr class="mb-5">
          
          @include('admin.partials.alert')

          <div class="form-group">
            <label for="category-name"> Category Name: *</label>
            <input class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Enter category name" type="text" value="{{ old('name') ?? $category->name }}" id="category-name" required>
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>

          <div class="form-group">
            <label for="description"> Description <i>(Optional)</i></label>
            <textarea class="form-control" name="description" rows="5" id="description" placeholder="Brief description of the category">{{ old('description') ?? $category->description }}</textarea>
          </div>

          <div class="form-check">
            <label class="form-check-label">
              <input class="form-check-input" name="is_live" {{ $category->is_live ?? old('is_live') ? 'checked' : '' }} type="checkbox"> Make category visible on the website
            </label>
          </div>
          <div class="form-buttons-w">
            <button class="btn btn-primary" type="submit"> Submit</button>
          </div>
        </form>

          

        </div>
      </div>
     
    </div>
  </div>
</div>

@endsection
