<div class="top-bar color-scheme-bright"> {{-- Add: color-scheme-transparent --}}
  <div class="logo-w menu-size">
    <a class="logo" href="{{ route('dashboard') }}">
      <div class="logo-element"></div>
      <div class="logo-label">
        {{ config('app.name') }}
      </div>
    </a>
  </div>
  
  
  <div class="top-menu-controls">
    {{-- <div class="messages-notifications os-dropdown-trigger os-dropdown-position-left">
      <i class="os-icon os-icon-bell"></i>
      <div class="new-messages-count">
        12
      </div>
      <div class="os-dropdown light message-list">
        <ul>
          <li>
            <a href="#">
              <div class="user-avatar-w">
                <img alt="" src="{{ asset('admin_assets/img/avatar1.jpg') }}">
              </div>
              <div class="message-content">
                <h6 class="message-from">
                  John Mayers
                </h6>
                <h6 class="message-title">
                  Account Update
                </h6>
              </div>
            </a>
          </li>
          <li>
            <a href="#">
              <div class="user-avatar-w">
                <img alt="" src="{{ asset('admin_assets/img/avatar2.jpg') }}">
              </div>
              <div class="message-content">
                <h6 class="message-from">
                  Phil Jones
                </h6>
                <h6 class="message-title">
                  Secutiry Updates
                </h6>
              </div>
            </a>
          </li>
          <li>
            <a href="#">
              <div class="user-avatar-w">
                <img alt="" src="{{ asset('admin_assets/img/avatar3.jpg') }}">
              </div>
              <div class="message-content">
                <h6 class="message-from">
                  Bekky Simpson
                </h6>
                <h6 class="message-title">
                  Vacation Rentals
                </h6>
              </div>
            </a>
          </li>
          <li>
            <a href="#">
              <div class="user-avatar-w">
                <img alt="" src="{{ asset('admin_assets/img/avatar4.jpg') }}">
              </div>
              <div class="message-content">
                <h6 class="message-from">
                  Alice Priskon
                </h6>
                <h6 class="message-title">
                  Payment Confirmation
                </h6>
              </div>
            </a>
          </li>
        </ul>
      </div>
    </div> --}}
   
    <div class="logged-user-w">
      <div class="logged-user-i">
        <div class="avatar-w">
          <img alt="" src="{{ auth()->user()->photo }}">
        </div>
        <div class="logged-user-menu color-style-bright">
          <div class="logged-user-avatar-info">
            <div class="avatar-w">
              <img alt="" src="{{ auth()->user()->photo }}">
            </div>
            <div class="logged-user-info-w">
              <div class="logged-user-name">
                {{ auth()->user()->name }}
              </div>
              <div class="logged-user-role">
                {{ auth()->user()->position }}
              </div>
            </div>
          </div>
          <div class="bg-icon">
            <i class="os-icon os-icon-wallet-loaded"></i>
          </div>
          <ul>
            <li>
              <a href="#"><i class="os-icon os-icon-user-male-circle2"></i><span>Profile Details</span></a>
            </li>
            <li>
              <a href="javascript:;" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="os-icon os-icon-signs-11"></i><span>Logout</span></a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
              </form>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
