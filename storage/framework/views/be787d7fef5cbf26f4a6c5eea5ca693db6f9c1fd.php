

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
    <div class="d-block mb-4 mb-md-0">
       
        <h2 class="h4">Users List</h2>
     
    </div>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="#" class="btn btn-sm btn-gray-800 d-inline-flex align-items-center">
            <svg class="icon icon-xs me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6">
                </path>
            </svg>
            New User
        </a>
      
    </div>
</div>


<div class="card card-body shadow border-0 table-wrapper table-responsive">
   
    <table class="table user-table table-hover align-items-center" id="usersTable">
        <thead>
            <tr>
                
                <th class="border-bottom">Name</th>
                <th class="border-bottom"> User Type </th>
                <th class="border-bottom">Phone Number</th>
                <th class="border-bottom">ID/Passport</th>

                <th class="border-bottom">Status</th>
                <th class="border-bottom">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $clients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
            
                <td>
                    <a href="#" class="d-flex align-items-center">
                        <img src="../assets/img/team/profile-picture-1.jpg" class="avatar rounded-circle me-3"
                            alt="Avatar">
                        <div class="d-block">
                            <span class="fw-bold"><?php echo e($client->name); ?></span>
                            <div class="small text-gray"><?php echo e($client->email); ?></div>
                        </div>
                    </a>
                </td>
                <td><span class="fw-normal"><?php echo e($client->customer_type); ?></span></td>
                <td><span class="fw-normal d-flex align-items-center"><?php echo e($client->country_code.$client->phone); ?></span></td>
                <td><span class="fw-normal d-flex align-items-center"><?php echo e($client->nationalty_number); ?></span></td>

                <?php if(
                    $client->active==1
                ): ?>
                                    <td><span class="fw-normal text-success">Active</span></td>
                <?php else: ?>
                    <td><span class="fw-normal text-danger">Inactive</span></td>

                <?php endif; ?>
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
                            <a class="dropdown-item d-flex align-items-center" href="<?php echo e(route('view_user', ['id' => $client->id])); ?>">
                                <span class="fas fa-user-shield me-2"></span>
                                View Details
                            </a>
                            <a class="dropdown-item d-flex align-items-center" href="<?php echo e(route('edit_user', ['id' => $client->id])); ?>">
                                <span class="fas fa-user-edit me-2"></span>
                                Edit user
                            </a>
                            <a class="dropdown-item text-danger d-flex align-items-center"   href="<?php echo e(route('delete_user', ['id' => $client->id])); ?>">
                                <span class="fas fa-user-times me-2"></span>
                                Delete user
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



<script>
  $(document).ready(function() {
    $('#usersTable').DataTable();
  });
</script>

<?php /**PATH D:\github\Amman-app-backend\resources\views/livewire/users.blade.php ENDPATH**/ ?>