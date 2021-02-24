/*
 * ReadMore Element JS file
 */

class StaxReadMoreHandlerClass extends elementorModules.frontend.handlers.Base {
    getDefaultSettings() {
        return {
            selectors: {
                toggle: '.stx-read-more-toggle',
                container: '.pepy-read-more-editor',
            },
        };
    }

    getDefaultElements() {
        const selectors = this.getSettings( 'selectors' );
        return {
            $toggle: this.$element.find( selectors.toggle ),
            $container: this.$element.find( selectors.container ),
        };
    }

    bindEvents() {
        this.elements.$toggle.on( 'click', this.onToggleClick.bind( this ) );
    }

    onToggleClick( event ) {
        event.preventDefault();

        this.elements.$container.toggleClass('stx-read-more-open')
    }
}

jQuery( window ).on( 'elementor/frontend/init', () => {
    const addHandler = ( $element ) => {
        elementorFrontend.elementsHandler.addHandler( StaxReadMoreHandlerClass, {
            $element,
        } );
    };

    elementorFrontend.hooks.addAction( 'frontend/element_ready/pepy-el-read-more.default', addHandler );
} );
