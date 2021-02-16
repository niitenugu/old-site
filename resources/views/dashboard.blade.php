@extends('admin.layouts.app')

@section('page_title', '| Admin Dashboard')

@section('content')
<div class="content-w">
  <div class="content-i">
    <div class="content-box">

      @if ($currentScholarship)

        @include('admin.commons._scholarship_statistics')

      @endif

      <h6 class="element-header mb-3">
        Summary
      </h6>

      <div class="element-content" style="margin-bottom: 100px;">
          <div class="row">
            <div class="col-sm-4 col-xxxl-3">
              <a class="element-box el-tablo" href="#">
                <div class="label">
                  Total Categories
                </div>
                <div class="value">
                  {{ $totalCategories }}
                </div>
              </a>
            </div>
            <div class="col-sm-4 col-xxxl-3">
              <a class="element-box el-tablo" href="#">
                <div class="label">
                  Total Courses
                </div>
                <div class="value">
                  {{ $totalCourses }}
                </div>
              </a>
            </div>
            <div class="col-sm-4 col-xxxl-3">
              <a class="element-box el-tablo" href="#">
                <div class="label">
                  Total Users
                </div>
                <div class="value">
                  {{ $totalUsers }}
                </div>
              </a>
            </div>
          </div>
        </div>

        <div style="margin-bottom: 300px;">&nbsp;</div>
     
    </div>
  </div>
</div>
@endsection
