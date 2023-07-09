<nav id="sidebarMenu" class="sidebar d-lg-block bg-gray-800 text-white collapse" data-simplebar>
  <div class="sidebar-inner px-2 pt-3">
    <div class="user-card d-flex d-md-none align-items-center justify-content-between justify-content-md-center pb-4">
      <div class="d-flex align-items-center">
        <div class="avatar-lg me-4">
          <img src="/assets/img/team/profile-picture-3.jpg" class="card-img-top rounded-circle border-white"
            alt="Bonnie Green">
        </div>
        <div class="d-block">
          <h2 class="h5 mb-3">Hi</h2>
          <a href="/login" class="btn btn-secondary btn-sm d-inline-flex align-items-center">
            <svg class="icon icon-xxs me-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
              xmlns="http://www.w3.org/2000/svg">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
            </svg>
            Sign Out
          </a>
        </div>
      </div>
      <div class="collapse-close d-md-none">
        <a href="#sidebarMenu" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu"
          aria-expanded="true" aria-label="Toggle navigation">
          <svg class="icon icon-xs" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd"
              d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
              clip-rule="evenodd"></path>
          </svg>
        </a>
      </div>
    </div>
    <ul class="nav flex-column pt-3 pt-md-0">
      <li class="nav-item">
        <a href="/dashboard" class="nav-link d-flex align-items-center">
          <span class="sidebar-icon me-3">
            <img src="/assets/img/brand/light.svg" height="20" width="20" alt="Volt Logo">
          </span>
          <span class="mt-1 ms-1 sidebar-text">
            امــــــــــــان
          </span>
        </a>
      </li>
      <?php
      $userId = auth()->id();
      $response = $permission->checkPermission($userId, 'dashboard','Show');
     
  ?>
  
  <?php if($response->getStatusCode() === 200): ?>
      <li class="nav-item <?php echo e(Request::segment(1) == 'dashboard' ? 'active' : ''); ?>">
        <a href="/dashboard" class="nav-link">
          <span class="sidebar-icon"> <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 20 20"
              xmlns="http://www.w3.org/2000/svg">
              <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path>
              <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path>
            </svg></span></span>
          <span class="sidebar-text">لوحة التحكم</span>
        </a>
      </li>
      

      <?php endif; ?>
      <?php
      $response = $permission->checkPermission($userId, 'client_page','Show');
     
      ?>
  
  <?php if($response->getStatusCode() === 200): ?>
      <li class="nav-item <?php echo e(request()->routeIs('view_user', 'edit_user','users') ? 'active' : ''); ?>">
        <a href="<?php echo e(route('users')); ?>" class="nav-link">
          <span class="sidebar-icon"> <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path d="M10 0C4.486 0 0 4.486 0 10v8h20v-8c0-5.514-4.486-10-10-10zm0 2c3.682 0 6.82 2.493 7.75 6H2.25C3.18 4.493 6.318 2 10 2zm0 16c-3.86 0-7-3.14-7-7a6.99 6.99 0 014.547-6.57A5.954 5.954 0 0010 2c3.86 0 7 3.14 7 7 0 1.657-.568 3.172-1.516 4.375A6.99 6.99 0 0110 18z"/>
          </svg>
          </span></span>
          <span class="sidebar-text">الــعــملاء</span>
        </a>
      </li>
      <?php endif; ?>
      <?php
      $response = $permission->checkPermission($userId, 'subsicription','Show');
     
      ?>
  
  <?php if($response->getStatusCode() === 200): ?>
      <li class="nav-item <?php echo e(request()->routeIs('view_subsicription','details_subsicription') ? 'active' : ''); ?>" >
        <a href="<?php echo e(route('view_subsicription')); ?>" class="nav-link">

          <span>
            <span class="sidebar-icon"><svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
              <path d="M4 3a2 2 0 100 4h12a2 2 0 100-4H4z"></path>
              <path fill-rule="evenodd" d="M3 8h14v7a2 2 0 01-2 2H5a2 2 0 01-2-2V8zm5 3a1 1 0 011-1h2a1 1 0 110 2H9a1 1 0 01-1-1z" clip-rule="evenodd"></path>
            </svg></span>
            <span class="sidebar-text"> الأشتــــراكات</span>
          </span>
      </a>
       
      </li>
    <?php endif; ?>
      <?php
      $response = $permission->checkPermission($userId, 'properties','Show');
     
      ?>
  
  <?php if($response->getStatusCode() === 200): ?>
      <li class="nav-item <?php echo e(request()->routeIs('all_property', 'properties_edit','properties_view') ? 'active' : ''); ?>" >
        <a href="<?php echo e(route('all_property')); ?>" class="nav-link">

          <span>
            <span class="sidebar-icon"><svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                  d="M2 5a2 2 0 012-2h8a2 2 0 012 2v10a2 2 0 002 2H4a2 2 0 01-2-2V5zm3 1h6v4H5V6zm6 6H5v2h6v-2z"
                  clip-rule="evenodd"></path>
                <path d="M15 7h1a2 2 0 012 2v5.5a1.5 1.5 0 01-3 0V7z"></path>
              </svg></span>
            <span class="sidebar-text"> العقــــارات</span>
          </span>
      </a>
       
      </li>
    <?php endif; ?>
    <?php
      $response = $permission->checkPermission($userId, 'banner_Page','Show');
     
      ?>
  
  <?php if($response->getStatusCode() === 200): ?>
      <li class="nav-item">
        <a class="nav-link d-flex justify-content-between align-items-center" href="#" role="button"
            onclick="toggleSubMenu('submenu-app')">
            <span>
                <span class="sidebar-icon">
                    <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M5 4a3 3 0 00-3 3v6a3 3 0 003 3h10a3 3 0 003-3V7a3 3 0 00-3-3H5zm-1 9v-1h5v2H5a1 1 0 01-1-1zm7 1h4a1 1 0 001-1v-1h-5v2zm0-4h5V8h-5v2zM9 8H4v2h5V8z"
                            clip-rule="evenodd"></path>
                    </svg>
                </span>
                <span class="sidebar-text">معـــرض الصور</span>
            </span>
            <span class="link-arrow">
              <svg class="icon icon-sm" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" d="M12.707 14.707a1 1 0 010-1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L10.414 10l3.293 3.293a1 1 0 01-1.414 1.414z" clip-rule="evenodd"></path>
              </svg>
          </span>
        </a>
        <div class="multi-level collapse <?php echo e(Request::segment(1) == 'Banner' ? 'show' : ''); ?>" id="submenu-app">
            <ul class="flex-column nav">
              <?php
              $response = $permission->checkPermission($userId, 'banner_Page','add_banner');
             
              ?>
          
          <?php if($response->getStatusCode() === 200): ?>
                <li class="nav-item <?php echo e(Request::segment(2) == 'add' ? 'active' : ''); ?>">
                    <a class="nav-link" href="<?php echo e(route('add_new_banner')); ?>">
                        <span class="sidebar-text">أضافة</span>
                    </a>
                </li>
                <?php endif; ?>
                <?php
                $response = $permission->checkPermission($userId, 'banner_Page','view_banner');
               
                ?>
            
            <?php if($response->getStatusCode() === 200): ?>
                <li class="nav-item <?php echo e((Request::segment(2) == 'view' && Request::segment(1) == 'Banner') ? 'active' : ''); ?>">
                    <a class="nav-link" href="<?php echo e(route('view_banner')); ?>">
                        <span class="sidebar-text">مشاهدة</span>
                    </a>
                </li>
                <?php endif; ?>
                <?php
                $response = $permission->checkPermission($userId, 'banner_Page','edit_banner');
               
                ?>
            
            <?php if($response->getStatusCode() === 200): ?>
                <li class="nav-item <?php echo e(Request::segment(2) == 'edit' && Request::segment(1)=='Banner'  ? 'active' : ''); ?>">
                    <a class="nav-link" href="<?php echo e(route('edit_banner')); ?>">
                        <span class="sidebar-text">تعديل</span>
                    </a>
                </li>
                <?php endif; ?>
            </ul>
        </div>
    </li>
    <?php endif; ?>
    <?php
      $response = $permission->checkPermission($userId, 'contract_page','Show');
     
      ?>
  
  <?php if($response->getStatusCode() === 200): ?>
    <li class="nav-item">
      <a class="nav-link d-flex justify-content-between align-items-center" href="#" role="button"
          onclick="toggleSubMenu('submenu-app2')">
          <span>
              <span class="sidebar-icon">
                <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd"
                    d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                    clip-rule="evenodd"></path>
                </svg>
              </span>
              <span class="sidebar-text">العــقود</span>
          </span>
          <span class="link-arrow">
            <svg class="icon icon-sm" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M12.707 14.707a1 1 0 010-1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L10.414 10l3.293 3.293a1 1 0 01-1.414 1.414z" clip-rule="evenodd"></path>
            </svg>
        </span>
      </a>
      <div class="multi-level collapse <?php echo e(Request::segment(1) == 'Contract' ? 'show' : ''); ?>" id="submenu-app2">
          <ul class="flex-column nav">
          
              <?php
              $response = $permission->checkPermission($userId, 'contract_page','view_all_contract');
             
              ?>
          
          <?php if($response->getStatusCode() === 200): ?>
              <li class="nav-item <?php echo e((Request::segment(2) == 'view' && Request::segment(1) == 'Contract') ? 'active' : ''); ?>">
                <a class="nav-link" href="<?php echo e(route('view_contract')); ?>">
                      <span class="sidebar-text">جميع العقود</span>
                  </a>
              </li>
              <?php endif; ?>
              <?php
              $response = $permission->checkPermission($userId, 'contract_page','view_check_request');
             
              ?>
          
          <?php if($response->getStatusCode() === 200): ?>
              <li   class="nav-item <?php echo e((Request::segment(2)== "request" && Request::segment(1) == 'Contract') ? 'active' : ''); ?>">
                  <a class="nav-link" href="<?php echo e(route('check.request')); ?>">
                      <span class="sidebar-text"> الفحص القضائي</span>
                  </a>
              </li>
              <?php endif; ?>
          </ul>
      </div>
     
  </li>
<?php endif; ?>
<?php
      $response = $permission->checkPermission($userId, 'order_page','Show');
     
      ?>
  
  <?php if($response->getStatusCode() === 200): ?>
  <li class="nav-item">
    <a class="nav-link d-flex justify-content-between align-items-center" href="#" role="button"
        onclick="toggleSubMenu('submenu-app3')">
        <span>
          <span class="sidebar-icon">
            <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" d="M12 1.586l-4 4v12.828l4-4V1.586zM3.707 3.293A1 1 0 002 4v10a1 1 0 00.293.707L6 18.414V5.586L3.707 3.293zM17.707 5.293L14 1.586v12.828l2.293 2.293A1 1 0 0018 16V6a1 1 0 00-.293-.707z" clip-rule="evenodd"></path>
            </svg>
          </span>
            <span class="sidebar-text">الطلبات</span>
        </span>
        <span class="link-arrow">
          <svg class="icon icon-sm" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" d="M12.707 14.707a1 1 0 010-1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L10.414 10l3.293 3.293a1 1 0 01-1.414 1.414z" clip-rule="evenodd"></path>
          </svg>
      </span>
    </a>
    <div class="multi-level collapse <?php echo e(Request::segment(1) == 'order' ? 'show' : ''); ?> " id="submenu-app3">
      <ul class="flex-column nav">
        <?php
        $response = $permission->checkPermission($userId, 'order_page','view_maintenance_order');
       
        ?>
    
    <?php if($response->getStatusCode() === 200): ?>
          <li class="nav-item <?php echo e((Request::segment(2) == 'view' && Request::segment(1) == 'order' && Request::segment(3)== "maintenance") ? 'active' : ''); ?>">
            <a class="nav-link" href="<?php echo e(route('view_maintenance_order')); ?>">
                  <span class="sidebar-text"> طلبــات الصيانة</span>
              </a>
          </li>
          <?php endif; ?>
          <?php
      $response = $permission->checkPermission($userId, 'order_page','view_general_order');
     
      ?>
  
  <?php if($response->getStatusCode() === 200): ?>
          <li   class="nav-item <?php echo e((Request::segment(2)== "view" && Request::segment(1) == 'order' && Request::segment(3)== "General") ? 'active' : ''); ?>">
              <a class="nav-link" href="<?php echo e(route('view_general_order')); ?>">
                  <span class="sidebar-text">  الطلبــات العامة</span>
              </a>
          </li>
          <?php endif; ?>
      </ul>
  </div>
   
</li>
<?php endif; ?>
<?php
$response = $permission->checkPermission($userId, 'admin_page','Show');

?>

<?php if($response->getStatusCode() === 200): ?>
       <li class="nav-item <?php echo e(Request::segment(1) == 'transactions' ? 'active' : ''); ?>">
        <a href="<?php echo e(route('view_admin')); ?>" class="nav-link">
          <span class="sidebar-icon"><svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 20 20"
              xmlns="http://www.w3.org/2000/svg">
              <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z"></path>
              <path fill-rule="evenodd"
                d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z"
                clip-rule="evenodd"></path>
            </svg></span>
          <span class="sidebar-text">المسؤوليــن </span>
        </a>
      </li>
      <?php endif; ?>
          
    </ul>
  </div>
</nav>
<script>
  function toggleSubMenu(id) {
    const submenu = document.getElementById(id);
    submenu.classList.toggle('show');
}

</script><?php /**PATH D:\github\Amman-app-backend\resources\views/layouts/sidenav.blade.php ENDPATH**/ ?>