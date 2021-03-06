<h2 class="ste-my-0 ste-leading-none ste-text-2xl ste-text-gray-700 ste-font-bold ste-tracking-wide">
	<?php _e( 'Modules', 'pepy-addons-for-elementor' ); ?>
</h2>

<div class="ste-mt-5">
    <form action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="POST">
        <div class="ste-flex ste-flex-wrap ste--mx-2">
			<?php foreach ( $modules as $key => $module ) : ?>
                <div class="ste-my-2 ste-w-full md:ste-w-1/2 lg:ste-w-1/3 xl:ste-w-1/4">
                    <div class="ste-mx-2">
                        // modules here
                    </div>
                </div>
			<?php endforeach; ?>
        </div>
        <input type="hidden" name="action" value="pepy_module_activation">

        <div class="ste-mt-5">
            <button type="submit"
                    class="ste-bg-green-500 ste-text-md ste-text-white ste-py-2 ste-pl-4 ste-pr-6 ste-rounded ste-border-0 ste-shadow-xl hover:ste-shadow-lg ste-cursor-pointer ste-uppercase">
                <span class="ste-flex ste-items-center">
                    <span class="dashicons dashicons-yes"></span>
	                <span class="ste-leading-normal ste-ml-2"><?php _e( 'Save', 'pepy-addons-for-elementor' ); ?></span>
                </span>
            </button>
        </div>
    </form>
</div>
