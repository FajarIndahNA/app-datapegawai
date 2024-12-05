


<!-- Main Sidebar Container -->
<div class="wrapper">
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="" class="brand-link">
        {{-- @php
         $words = explode(' ', $setting->nama_perusahaan);
         $word = '';
         foreach ($words as $w) {
          $word .= $w[0]; 
         }
        @endphp
        <span>{{$word}}</span> --}}
        <span class="brand-text font-weight-light" style="justify-content: center;
        align-items: center; display: flex;"><b>PT Biis Griya Nadi</b></span>
  </a>

    <!-- Sidebar -->
    <div class="sidebar pb-0 mb-0 d-flex">
      <nav class="mt-0">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false" >
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{route('pegawai.index')}}" class="nav-link">
              <i class="nav-icon fas fa-solid fa-user-plus"></i>
              <p>
                Data Pegawai
              </p>
            </a>
          </li>
         
        </ul>
      </nav>

    </div>
</aside>
</div>