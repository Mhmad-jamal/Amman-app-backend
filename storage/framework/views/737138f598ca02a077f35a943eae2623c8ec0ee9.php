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
        <title>Edit user</title>
        <div>
            <br>
            <form action="<?php echo e(route('properties_update')); ?>" method="POST">
<?php echo csrf_field(); ?>
            <div class="row">
                <div class="col-12 ">
                    <div class="card card-body border-0 shadow mb-4">
                        <h2 class="h5 mb-4">Property Details</h2>
                        <input  type="hidden" value="<?php echo e($property->id); ?>" name="id">
                        <input  type="hidden" value="<?php echo e($property->owner_id); ?>" name="owner_id">

                        <div class="row">
                                <div class="col-md-3 mb-3">
                                    <div class="form-group">
                                        <label for="section">Section <span class="text-danger">*</span></label>
                                        <select  class="form-select mb-0" id="section" name="section">
                                            <option value="Sale"
                                                <?php echo e($property->section == 'Sale' ? 'selected' : ''); ?>>Sale</option>
                                            <option value="Rent"
                                                <?php echo e($property->section == 'Rent' ? 'selected' : ''); ?>>Rent</option>
                                        </select>
                                        <?php if($errors->has('section')): ?>
                                            <span class="text-danger"><?php echo e($errors->first('section')); ?></span>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="form-group">
                                        <label for="sub_section">Sub Section <span class="text-danger">*</span></label>
                                        <select class="form-select mb-0" id="sub_section" name="sub_section">
                                            <option value="Apartments" <?php echo $property->sub_section === 'Apartments' ? 'selected' : ''; ?>>Apartments</option>
                                            <option value="Villa - Palace" <?php echo $property->sub_section === 'Villa - Palace' ? 'selected' : ''; ?>>Villa - Palace</option>
                                            <option value="Townhouses" <?php echo $property->sub_section === 'Townhouses' ? 'selected' : ''; ?>>Townhouses</option>
                                            <option value="Lands" <?php echo $property->sub_section === 'Lands' ? 'selected' : ''; ?>>Lands</option>
                                            <option value="Commercial" <?php echo $property->sub_section === 'Commercial' ? 'selected' : ''; ?>>Commercial</option>
                                            <option value="Farms & Chalets" <?php echo $property->sub_section === 'Farms & Chalets' ? 'selected' : ''; ?>>Farms & Chalets</option>
                                            <option value="Whole Building" <?php echo $property->sub_section === 'Whole Building' ? 'selected' : ''; ?>>Whole Building</option>
                                            <option value="Foreign Real Estate" <?php echo $property->sub_section === 'Foreign Real Estate' ? 'selected' : ''; ?>>Foreign Real Estate</option>
                                          </select>
                                          
                                        <?php if($errors->has('sub_section')): ?>
                                            <span class="text-danger"><?php echo e($errors->first('sub_section')); ?></span>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="form-group">
                                        <label for="room_number">Room number <span class="text-danger">*</span></label>
                                        <select  name="room_number" class="form-select mb-0">
                                            <option value="1" <?php echo e($property->room_number == '1' ? 'selected' : ''); ?>>1</option>
                                            <option value="2" <?php echo e($property->room_number == '2' ? 'selected' : ''); ?>>2</option>
                                            <option value="3" <?php echo e($property->room_number == '3' ? 'selected' : ''); ?>>3</option>
                                            <option value="4" <?php echo e($property->room_number == '4' ? 'selected' : ''); ?>>4</option>
                                            <option value="5" <?php echo e($property->room_number == '5' ? 'selected' : ''); ?>>5</option>
                                            <option value="6+" <?php echo e($property->room_number == '6+' ? 'selected' : ''); ?>>6+</option>
                                            <option value="Studio" <?php echo e($property->room_number == 'Studio' ? 'selected' : ''); ?>>Studio</option>
                                        </select>
                                        
                                        <?php if($errors->has('room_number')): ?>
                                            <span class="text-danger"><?php echo e($errors->first('room_number')); ?></span>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="form-group">
                                        <label for="bath_number">Bath number <span class="text-danger">*</span></label>
                                        <select  name="bath_number" class="form-select mb-0">
                                            <option value="One" <?php echo e($property->bath_number == 'One' ? 'selected' : ''); ?>>One</option>

                                            <option value="2" <?php echo e($property->bath_number == '2' ? 'selected' : ''); ?>>2</option>
                                            <option value="3" <?php echo e($property->bath_number == '3' ? 'selected' : ''); ?>>3</option>
                                            <option value="4" <?php echo e($property->bath_number == '4' ? 'selected' : ''); ?>>4</option>
                                            <option value="5+" <?php echo e($property->bath_number == '5+' ? 'selected' : ''); ?>>5+</option>
                                        </select>
                                        
                                        <?php if($errors->has('bath_number')): ?>
                                            <span class="text-danger"><?php echo e($errors->first('bath_number')); ?></span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                                <div class="row">
                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="building_area">Building area <span
                                                    class="text-danger">*</span></label>
                                                    <input  class="form-control" name="building_area" id="building_area"
                                                    value="<?php echo e($property->building_area); ?>" type="text">
                                                                                                      
                                            <?php if($errors->has('building_area')): ?>
                                                <span class="text-danger"><?php echo e($errors->first('building_area')); ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="floor">Floor <span class="text-danger">*</span></label>
                                            <select  class="form-select mb-0" id="floor" name="floor">
                                                <option value="Basement" <?php echo e($property->floor == 'Basement' ? 'selected' : ''); ?>>Basement</option>
                                                <option value="Ground Floor" <?php echo e($property->floor == 'Ground Floor' ? 'selected' : ''); ?>>Ground Floor</option>
                                                <option value="First Floor" <?php echo e($property->floor == 'First Floor' ? 'selected' : ''); ?>>First Floor</option>
                                                <option value="Second Floor" <?php echo e($property->floor == 'Second Floor' ? 'selected' : ''); ?>>Second Floor</option>
                                                <option value="Third Floor" <?php echo e($property->floor == 'Third Floor' ? 'selected' : ''); ?>>Third Floor</option>
                                                <option value="Fourth Floor" <?php echo e($property->floor == 'Fourth Floor' ? 'selected' : ''); ?>>Fourth Floor</option>
                                                <option value="Fifth Floor" <?php echo e($property->floor == 'Fifth Floor' ? 'selected' : ''); ?>>Fifth Floor</option>
                                            </select>
                                            
                                            
                                            <?php if($errors->has('floor')): ?>
                                                <span class="text-danger"><?php echo e($errors->first('floor')); ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="construction_age">Construction age <span
                                                    class="text-danger">*</span></label>
                                                    <select  class="form-select mb-0" id="construction_age" name="construction_age">
                                                        <option value="0-11 months" <?php echo e($property->construction_age == '0-11 months' ? 'selected' : ''); ?>>0-11 months</option>
                                                        <option value="1-5 years" <?php echo e($property->construction_age == '1-5 years' ? 'selected' : ''); ?>>1-5 years</option>
                                                        <option value="6-9 years" <?php echo e($property->construction_age == '6-9 years' ? 'selected' : ''); ?>>6-9 years</option>
                                                        <option value="10-19 years" <?php echo e($property->construction_age == '10-19 years' ? 'selected' : ''); ?>>10-19 years</option>
                                                        <option value="20+ years" <?php echo e($property->construction_age == '20+ years' ? 'selected' : ''); ?>>20+ years</option>
                                                        <option value="Under Construction" <?php echo e($property->construction_age == 'Under Construction' ? 'selected' : ''); ?>>Under Construction</option>
                                                    </select>
                                            <?php if($errors->has('construction_age')): ?>
                                                <span
                                                    class="text-danger"><?php echo e($errors->first('construction_age')); ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="furnished">Furnished <span class="text-danger">*</span></label>
                                            <select  name="furnished" class="form-select mb-0">
                                                <option value="Furnished" <?php echo e($property->furnished == 'Furnished' ? 'selected' : ''); ?>>Furnished</option>
                                                <option value="Semi Furnished" <?php echo e($property->furnished == 'Semi Furnished' ? 'selected' : ''); ?>>Semi Furnished</option>
                                                <option value="Unfurnished" <?php echo e($property->furnished == 'Unfurnished' ? 'selected' : ''); ?>>Unfurnished</option>
                                            </select>
                                            
                                            <?php if($errors->has('furnished')): ?>
                                                <span class="text-danger"><?php echo e($errors->first('furnished')); ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3 mb-3">
                                        <label for="status">Status <span class="text-danger">*</span></label>
                                        <select  class="form-select mb-0" id="status" name="status">
                                            <option value="0" <?php echo e($property->status == '0' ? 'selected' : ''); ?>>
                                                Draft</option>
                                            <option value="1" <?php echo e($property->status == '1' ? 'selected' : ''); ?>>
                                                Publish</option>
                                            <option value="2" <?php echo e($property->status == '2' ? 'selected' : ''); ?>>
                                                Cancel</option>
                                        </select>
                                        <?php if($errors->has('status')): ?>
                                            <span class="text-danger"><?php echo e($errors->first('status')); ?></span>
                                        <?php endif; ?>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="ad_title">Ad title <span class="text-danger">*</span></label>
                                            <input  class="form-control" id="ad_title" name="ad_title"
                                                type="text" value="<?php echo e($property->ad_title); ?>">
                                            <?php if($errors->has('ad_title')): ?>
                                                <span class="text-danger"><?php echo e($errors->first('ad_title')); ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="electric_bill">Electric bill <span
                                                    class="text-danger">*</span></label>
                                            <input  class="form-control" id="electric_bill" name="electric_bill"
                                                type="text" value="<?php echo e($property->electric_bill); ?>">
                                            <?php if($errors->has('electric_bill')): ?>
                                                <span class="text-danger"><?php echo e($errors->first('electric_bill')); ?></span>
                                            <?php endif; ?>
                                        </div>
                                      
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        
                                        <div class="form-group">
                                            <label for="water_bill">Water bill <span
                                                    class="text-danger">*</span></label>
                                            <input  class="form-control" id="water_bill" name="water_bill"
                                                type="text" value="<?php echo e($property->water_bill); ?>">
                                            <?php if($errors->has('water_bill')): ?>
                                                <span class="text-danger"><?php echo e($errors->first('water_bill')); ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label for="ad_details">Ad details <span class="text-danger">*</span></label>
                                            <textarea class="form-control" id="ad_details" name="ad_details" rows="1" oninput="autoResize(this)"><?php echo e($property->ad_details); ?></textarea>
                                            <?php if($errors->has('ad_details')): ?>
                                                <span class="text-danger"><?php echo e($errors->first('ad_details')); ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label for="address">Address <span class="text-danger">*</span></label>
                                            <input  class="form-control" id="address" name="address" type="text"
                                                value="<?php echo e($property->address); ?>">
                                            <?php if($errors->has('address')): ?>
                                                <span class="text-danger"><?php echo e($errors->first('address')); ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                    <?php
                                    $images = json_decode($property->image, true);
                                    ?>
                                
                                <div class="row">
                                    <?php $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $imagePath): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="col-md-3">
                                        <img src="<?php echo e(asset('storage/' . $imagePath)); ?>" alt="Image">
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                
                                </div>
                           
                                
                                <div class="form-group">
                                    <label for="features">Features</label>
                                    <br>
                                    <?php
                                    $features = [
                                        'Air Conditioning',
                                        'Central Air Conditioning',
                                        'Heating',
                                        'Balcony',
                                        'Maid Room',
                                        'Laundry Room',
                                        'Built in Wardrobes',
                                        'Private Pool',
                                        'Double Glazed Windows',
                                        'Jacuzzi',
                                        'Installed Kitchen',
                                        'Electric Shutters',
                                        'Underfloor Heating',
                                        'Washing Machine',
                                        'Dishwasher',
                                        'Microwave',
                                        'Oven',
                                        'Refrigerator'
                                    ];
                                    ?>
                                
                                    <?php $__currentLoopData = $features; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $feature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($index % 4 === 0): ?>
                                            <div class="row">
                                        <?php endif; ?>
                                        <div class="col-md-3">
                                            <label style="margin-left: 10px">
                                                <input type="checkbox" name="features[]" value="<?php echo e($feature); ?>"
                                                <?php echo e(in_array($feature, json_decode($property->features, true)) ? 'checked' : ''); ?>>
                                                <?php echo e($feature); ?>

                                            </label>
                                        </div>
                                        <?php if(($index + 1) % 4 === 0 || $index === count($features) - 1): ?>
                                            </div>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                              
                                <div class="row">
                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label for="price">Price <span class="text-danger">*</span></label>
                                            <input  class="form-control" id="price" name="price" type="text"
                                                value="<?php echo e($property->price); ?>">
                                            <?php if($errors->has('price')): ?>
                                                <span class="text-danger"><?php echo e($errors->first('price')); ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <button type="submit" class="btn btn-gray-800 mt-2 animate-up-2">Save
                                        All</button>
                                </div>
                            </form>
                        </div>

                        <br>
                        <br>

                    </div>


                </div>
                <script>
                    function autoResize(textarea) {
                        textarea.style.height = 'auto';
                        textarea.style.height = textarea.scrollHeight + 'px';
                    }
                    autoResize(document.getElementById('ad_details'));
                </script>




                
                <?php echo $__env->make('layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </main>

 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald8bdefe537b868c30952851c478827a760077823)): ?>
<?php $component = $__componentOriginald8bdefe537b868c30952851c478827a760077823; ?>
<?php unset($__componentOriginald8bdefe537b868c30952851c478827a760077823); ?>
<?php endif; ?>
<?php /**PATH D:\github\Amman-app-backend\resources\views/property/edit.blade.php ENDPATH**/ ?>