<?php if (isset($component)) { $__componentOriginald8bdefe537b868c30952851c478827a760077823 = $component; } ?>
<?php $component = App\View\Components\Layouts\Base::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('layouts.base'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Layouts\Base::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <?php echo $__env->make('layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    
    <?php echo $__env->make('layouts.sidenav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <main class="content">
        
        <?php echo $__env->make('layouts.topbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <title>View user</title>
        <div>
          <br>
            <div class="row">
                <div class="col-12 ">
                    <div class="card card-body border-0 shadow mb-4">
                        <h2 class="h5 mb-4">General information</h2>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div>
                                        <label for="first_name"> Name</label>
                                        <input disabled value="<?php echo e($user->name); ?>" class="form-control" id="first_name" type="text"
                                            placeholder="Enter your first name" required>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="form-group">
                                        <label for="country_code">Country code</label>
                                        <input class="form-control" id="country_code" value="<?php echo e($user->country_code); ?>" type="number"
                                        disabled  placeholder="+12-345 678 910">
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="form-group">
                                        <label for="phone">Phone</label>
                                        <input class="form-control" id="phone" value="<?php echo e($user->phone); ?>" type="number"
                                        disabled   placeholder="+12-345 678 910">
                                    </div>
                                </div>
                            </div>
                        
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input  class="form-control" id="email" value="<?php echo e($user->email); ?>" type="email"
                                            placeholder="name@company.com" disabled>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="ID">ID/Passport</label>
                                        <input class="form-control" disabled id="ID" type="text" value="<?php echo e($user->nationalty_number); ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="customer_type">Customer type</label>
                                        <select disabled class="form-select mb-0" id="customer_type">
                                    
                                        <option value="owner"<?php echo e(($user->customer_type=="owner")?"selected":""); ?>>owner</option>
                                        <option value="user" <?php echo e(($user->customer_type=="user")?"selected":""); ?>>user</option>
                             
                            
                            </select> </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select disabled class="form-select mb-0" id="status" name="status">
                                    
                                            <option value="0"<?php echo e(($user->active=="0")?"selected":""); ?>>Inactive</option>
                                            <option value="1" <?php echo e(($user->active=="1")?"selected":""); ?>>Active</option>
                                 
                                
                                </select>                                     </div>
                                </div>
                               
                            </div>
                          
                           
                    
                    </div>
                    <?php if($user->customer_type=="owner"): ?>
                    <div class="card card-body shadow border-0 table-wrapper table-responsive">
                        <h2 class="h5 mb-4"> User property</h2>

                        <table class="table user-table table-hover align-items-center" id="propertytable">
                            <thead>
                                <tr>
                                    
                                    <th class="border-bottom">Id</th>
                                    <th class="border-bottom"> Section </th>
                                    <th class="border-bottom">sub section </th>
                                    <th class="border-bottom">Room number</th>
                    
                                    <th class="border-bottom">bath number</th>
                                    <th class="border-bottom">building area</th>
                                    <th class="border-bottom">floor </th>
                                    <th class="border-bottom">construction age </th>
                                    <th class="border-bottom">furnished </th>
                                    <th class="border-bottom">features </th>
                                    <th class="border-bottom">ad title </th>
                                    <th class="border-bottom">ad details </th>
                                    <th class="border-bottom">address </th>
                                    <th class="border-bottom">status </th>
                                    <th class="border-bottom">Price </th>

                                    <th class="border-bottom">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $properties; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $property): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                
                                    <td>
                                      <?php echo e($property->id); ?>

                                    </td>
                                    <td><span class="fw-normal"> <?php echo e($property->section); ?></span></td>
                                    <td><span class="fw-normal d-flex align-items-center"><?php echo e($property->sub_section); ?></span></td>
                                    <td><span class="fw-normal d-flex align-items-center"></span> <?php echo e($property->room_number); ?></td>
                    
                                                        <td><span class="fw-normal d-flex align-items-center"><?php echo e($property->bath_number); ?></span></td>
                                                        <td><span class="fw-normal d-flex align-items-center"><?php echo e($property->building_area); ?></span></td>

                                                        <td><span class="fw-normal d-flex align-items-center"><?php echo e($property->floor); ?></span></td>
                                                        <td><span class="fw-normal d-flex align-items-center"><?php echo e($property->construction_age); ?></span></td>
                                                        <td><span class="fw-normal d-flex align-items-center"><?php echo e($property->furnished); ?></span></td>
                                                        <td>
                                                            <span class="fw-normal d-flex align-items-center">
                                                              <?php 
                                                             /*    foreach ($property->features as $key => $value) {
                                                                  if ($value == 1) {
                                                                    echo $key . ', ';
                                                                  }
                                                                } */
                                                              ?>
                                                            </span>
                                                          </td>                                                        <td><span class="fw-normal d-flex align-items-center"><?php echo e($property->ad_title); ?></span></td>
                                                        <td>
                                                            <span class="fw-normal d-flex align-items-center text-truncate"><?php echo e($property->ad_details); ?></span>
                                                          </td>

                                                          <td><span class="fw-normal d-flex align-items-center"><?php echo e($property->address); ?></span></td>
                                                          <?php if($property->status==1): ?>
                                                          <td><span class="fw-normal d-flex align-items-center text-success">Active</span></td>

                                                              
                                                          <?php elseif($property->status==0): ?>
                                                          <td><span class="fw-normal d-flex align-items-center text-warining">Draft</span></td>

                                                          <?php else: ?>
                                                          <td><span class="fw-normal d-flex align-items-center text-danger ">Delete</span></td>

                                                          <?php endif; ?>

                                                          <td><span class="fw-normal d-flex align-items-center"><?php echo e($property->price); ?></span></td>



                                    <td>
                    
                                        <div class="btn-group">
                                            <button class="btn btn-link text-dark dropdown-toggle dropdown-toggle-split m-0 p-0"
                                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <svg class="icon icon-xs" fill="currentColor" viewBox="0 0 20 20"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z">
                                                    </path>
                                                </svg>
                                                <span class="visually-hidden">Toggle Dropdown</span>
                                            </button>
                                            <div class="dropdown-menu dashboard-dropdown dropdown-menu-start mt-2 py-1">
                                                <a class="dropdown-item d-flex align-items-center" href="<?php echo e(route('properties_view', ['id' => $property->id])); ?>">
                                                    <span class="fas fa-box "></span>
                                                    View Details
                                                </a>
                                                <a class="dropdown-item d-flex align-items-center" href="<?php echo e(route('properties_edit', ['id' => $property->id])); ?>">
                                                    <span class="fas fa-edit"></span>
                                                    Edit Property
                                                </a>
                                                <a class="dropdown-item text-danger d-flex align-items-center"   >
                                                    <span class="fas fa-trash-alt"></span>
                                                    Delete Property
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <!-- Display other client details -->
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                        
                    <?php endif; ?>
                    <br>
                    <br>
                  
                </div>
              
        
        </div>

        <script>
            $(document).ready(function() {
              $('#propertytable').DataTable();
            });
          </script>

        
        
        <?php echo $__env->make('layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </main>

 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald8bdefe537b868c30952851c478827a760077823)): ?>
<?php $component = $__componentOriginald8bdefe537b868c30952851c478827a760077823; ?>
<?php unset($__componentOriginald8bdefe537b868c30952851c478827a760077823); ?>
<?php endif; ?>
<?php /**PATH D:\github\Amman-app-backend\resources\views/view-user.blade.php ENDPATH**/ ?>