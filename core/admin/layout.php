<div class="ste-m-0 pepy-main <?php echo esc_attr( implode( ' ', $wrapper_class ) ); ?>">
    <div class="ste-pt-10 ste-mt-5 ste-mb-10">

        <div class="ste-container ste-mx-auto">

                <div class="ste-text-left">
                    <h1 class="ste-block ste-leading-normal ste-my-0"><span class="ste-font-light">Bem-vindo ao </span> LucraPage$<span style="font-size: 20px; font-weight: 300;">beta </span></h1>
                    <div class="ste-font-medium ste-text-lg ste-text-gray-600">Elementos para otimizar a conversão</div>
                </div>
            
       </div>

    </div>

	<?php do_action( PEPY_EXTRA_HOOK_PREFIX . 'before_panel_action' ); ?>

	<?php do_action( PEPY_EXTRA_HOOK_PREFIX . 'panel_action' ); ?>

	<?php do_action( PEPY_EXTRA_HOOK_PREFIX . 'after_panel_action' ); ?>

    <div class="ste-container ste-mx-auto ste-my-10">
        <div class="ste-flex ste-justify-center">
            <div class="ste-text-gray-400 ste-text-sm ste-font-medium ste-uppercase">
		        <?php printf( __( 'Version %s', 'pepy-addons-for-elementor' ), PEPY_EXTRA_VERSION ); ?>
            </div>
        </div>
    </div>
</div>
