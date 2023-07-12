<main>
    <title>Sign In page</title>
    <!-- Section -->
    <section class="vh-lg-100 mt-5 mt-lg-0 bg-soft d-flex align-items-center">
        <div class="container">
            
            <div wire:ignore.self class="row justify-content-center form-bg-image"
                data-background-lg="/assets/img/illustrations/signin.svg">
                <div class="col-12 d-flex align-items-center justify-content-center">
                    <div class="bg-white shadow-soft border rounded border-light p-4 p-lg-5 w-100 fmxw-500">
                        <div class="text-center text-md-center mb-4 mt-md-0">
                            <h1 class="mb-3 h3">مرحبا مجددا </h1>
                            <p class="mb-0"> 
                            

                            </p>
                        </div>
                        <form wire:submit.prevent="login" action="#" class="mt-4" method="POST">
                            <!-- Form -->
                            <div class="form-group mb-4">
                                <label for="email">البريد الألكتروني </label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><svg
                                            class="icon icon-xs text-gray-600" fill="currentColor" viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z">
                                            </path>
                                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                                        </svg></span>
                                    <input wire:model="email" type="email" class="form-control"
                                        placeholder="admin@hotmail.com" id="email" autofocus required>
                                </div>
                                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div wire:key="form" class="invalid-feedback"> <?php echo e($message); ?> </div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <!-- End of Form -->
                            <div class="form-group">
                                <!-- Form -->
                                <div class="form-group mb-4">
                                    <label for="password">كلمة المرور</label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon2"><svg
                                                class="icon icon-xs text-gray-600" fill="currentColor"
                                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                    d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                                                    clip-rule="evenodd"></path>
                                            </svg></span>
                                        <input wire:model.lazy="password" type="password" placeholder="كلمة المرور"
                                            class="form-control" id="password" required>
                                    </div>
                                    <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"> <?php echo e($message); ?> </div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                             
                            <div class="d-grid">
                                <button type="submit" class="btn btn-gray-800">تســجيل الدخول </button>
                            </div>
                        </form>
                        <div class="mt-3 mb-4 text-center">
                        </div>
                    
                    
                    </div>
                </div>
            </div>
        </div>
    </section>
</main><?php /**PATH D:\github\Amman-app-backend\resources\views/livewire/auth/login.blade.php ENDPATH**/ ?>