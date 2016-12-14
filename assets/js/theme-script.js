(function($){
	"use strict";

	CherryJsCore.utilites.namespace('theme_script');
	CherryJsCore.theme_script = {
		init: function () {
			// Document ready event check
			if( CherryJsCore.status.is_ready ){
				this.document_ready_render();
			}else{
				CherryJsCore.variable.$document.on( 'ready', this.document_ready_render.bind( this ) );
			}

			// Windows load event check
			if( CherryJsCore.status.on_load ){
				this.window_load_render();
			}else{
				CherryJsCore.variable.$window.on( 'load', this.window_load_render.bind( this ) );
			}
		},

		document_ready_render: function () {
			this.smart_slider_init( this );
			this.swiper_carousel_init( this );
			this.post_formats_custom_init( this );
			this.navbar_init( this );
			this.subscribe_init( this );
			this.main_menu( this, $( '.main-navigation' ) );
			this.to_top_init( this );
			this.mobile_menu( this );
			this.sticky_toc_init( this );
			this.scrollspy_init( this );
		},

		window_load_render: function () {
			this.page_preloader_init( this );
		},

		debounce: function( callback, threshold ) {
			var _timeout;

			return function _debounced( $jqEvent ) {
				function _delayed() {
					callback();
					timeout = null;
				}

				if ( _timeout ) {
					clearTimeout( _timeout );
				}

				_timeout = setTimeout( _delayed, threshold );
			};
		},

		smart_slider_init: function( self ) {
			$( '.cherry-smartslider' ).each( function() {
				var slider = $(this),
					sliderId = slider.data('id'),
					sliderWidth = slider.data('width'),
					sliderHeight = slider.data('height'),
					sliderOrientation = slider.data('orientation'),
					slideDistance = slider.data('slide-distance'),
					slideDuration = slider.data('slide-duration'),
					sliderFade = slider.data('slide-fade'),
					sliderNavigation = slider.data('navigation'),
					sliderFadeNavigation = slider.data('fade-navigation'),
					sliderPagination = slider.data('pagination'),
					sliderAutoplay = slider.data('autoplay'),
					sliderAutoplayDelay = slider.data('autoplay-delay'),
					sliderFullScreen = slider.data('fullscreen'),
					sliderShuffle = slider.data('shuffle'),
					sliderLoop = slider.data('loop'),
					sliderThumbnailsArrows = slider.data('thumbnails-arrows'),
					sliderThumbnailsPosition = slider.data('thumbnails-position'),
					sliderThumbnailsWidth = slider.data('thumbnails-width'),
					sliderThumbnailsHeight = slider.data('thumbnails-height'),
					sliderVisibleSize = slider.data('visible-size'),
					sliderForceSize = slider.data('force-size');

				if ( $('.smart-slider__items', '#' + sliderId ).length > 0 ) {
					$( '#' + sliderId ).sliderPro( {
						width: sliderWidth,
						height: sliderHeight,
						visibleSize: sliderVisibleSize,
						forceSize: sliderForceSize,
						orientation: sliderOrientation,
						slideDistance: slideDistance,
						slideAnimationDuration: slideDuration,
						fade: sliderFade,
						arrows: sliderNavigation,
						fadeArrows: sliderFadeNavigation,
						buttons: sliderPagination,
						autoplay: sliderAutoplay,
						autoplayDelay: sliderAutoplayDelay,
						fullScreen: sliderFullScreen,
						shuffle: sliderShuffle,
						loop: sliderLoop,
						waitForLayers: false,
						thumbnailArrows: sliderThumbnailsArrows,
						thumbnailsPosition: sliderThumbnailsPosition,
						thumbnailWidth: sliderThumbnailsWidth,
						thumbnailHeight: sliderThumbnailsHeight,
						init: function() {
							$( this ).resize();
						},
						sliderResize: function( event ) {

							var thisSlider = $( '#' + sliderId ),
								slides = $( '.sp-slide', thisSlider );

								slides.each( function() {

									if ( $( '.sp-title', this ).width() > $( this ).width() ) {
										$( this ).addClass( 'text-wrapped' );
									}

								} );
						},
						breakpoints: {
							992: {
								height: parseFloat( sliderHeight ) * 0.75
							},
							768: {
								height: parseFloat( sliderHeight ) * 0.5
							}
						}
					} );
				}
			});//each end
		},

		swiper_carousel_init: function ( self ) {

			// Enable swiper carousels
			jQuery('.cherry-carousel').each( function() {
				var swiper = null,
					uniqId = jQuery(this).data('uniq-id'),
					slidesPerView = parseFloat( jQuery(this).data('slides-per-view') ),
					slidesPerGroup = parseFloat( jQuery(this).data('slides-per-group') ),
					slidesPerColumn = parseFloat( jQuery(this).data('slides-per-column') ),
					spaceBetweenSlides = parseFloat( jQuery(this).data('space-between-slides') ),
					durationSpeed = parseFloat( jQuery(this).data('duration-speed') ),
					swiperLoop = jQuery(this).data('swiper-loop'),
					freeMode = jQuery(this).data('free-mode'),
					grabCursor = jQuery(this).data('grab-cursor'),
					mouseWheel = jQuery(this).data('mouse-wheel'),
					breakpointsSettings = {
						1200: {
							slidesPerView: Math.floor( slidesPerView * 0.75 ),
							spaceBetween: Math.floor( spaceBetweenSlides * 0.75 )
						},
						992: {
							slidesPerView: Math.floor( slidesPerView * 0.5 ),
							spaceBetween: Math.floor( spaceBetweenSlides * 0.5 )
						},
						769: {
							slidesPerView: ( 0 !== Math.floor( slidesPerView * 0.25 ) ) ? Math.floor( slidesPerView * 0.25 ) : 1
						}
					};

					if ( 1 == slidesPerView ) {
						breakpointsSettings = {}
					}

				var swiper = new Swiper( '#' + uniqId, {
						slidesPerView: slidesPerView,
						slidesPerGroup: slidesPerGroup,
						slidesPerColumn: slidesPerColumn,
						spaceBetween: spaceBetweenSlides,
						speed: durationSpeed,
						loop: swiperLoop,
						freeMode: freeMode,
						grabCursor: grabCursor,
						mousewheelControl: mouseWheel,
						paginationClickable: true,
						nextButton: '#' + uniqId + '-next',
						prevButton: '#' + uniqId + '-prev',
						pagination: '#' + uniqId + '-pagination',
						onInit: function(){
							$( '#' + uniqId + '-next' ).css({ 'display': 'block' });
							$( '#' + uniqId + '-prev' ).css({ 'display': 'block' });
						},
						breakpoints: breakpointsSettings
					}
				);
			});
		},

		post_formats_custom_init: function ( self ) {
			CherryJsCore.variable.$document.on( 'cherry-post-formats-custom-init', function( event ) {

				if ( 'slider' !== event.object ) {
					return;
				}

				var uniqId = '#' + event.item.attr( 'id' ),
					swiper = new Swiper( uniqId, {
						pagination: uniqId + ' .swiper-pagination',
						paginationClickable: true,
						nextButton: uniqId + ' .swiper-button-next',
						prevButton: uniqId + ' .swiper-button-prev',
						spaceBetween: 30,
						onInit: function(){
							$( uniqId + ' .swiper-button-next' ).css( { 'display': 'block' } );
							$( uniqId + ' .swiper-button-prev' ).css( { 'display': 'block' } );
						}
					} );

				event.item.data( 'initalized', true );
			});

			var items = [];

			$('.mini-gallery .post-thumbnail__link').on('click', function(event) {
				event.preventDefault();

				$(this).parents('.mini-gallery').find('.post-gallery__slides > a[href]').each(function() {
					items.push({
						src: $(this).attr('href'),
						type: 'image'
					});
				});

				$.magnificPopup.open({
					items: items,
					gallery: {
						enabled: true
					}
				});
			});
		},

		navbar_init: function ( self ) {

			$( window ).load( function() {

				var $navbar = $( '.header-container' );

				if ( ! $.isFunction( jQuery.fn.stickUp ) || ! $navbar.length || ! cherry.sticky_header ) {
					return !1;
				}

				$navbar.stickUp({
					correctionSelector: '#wpadminbar',
					listenSelector: '.listenSelector',
					pseudo: true,
					active: true
				});

				CherryJsCore.variable.$document.trigger( 'scroll.stickUp' );
			});
		},

		sticky_toc_init: function() {

			$( window ).load( function() {

				var $toc = $( '.docs-wrapper .toc' );

				if ( ! $.isFunction( jQuery.fn.stickUp ) || ! $toc.length || cherry.sticky_header ) {
					return !1;
				}

				$toc.stickUp({
					correctionSelector: '#wpadminbar',
					pseudo: true,
					active: true
				});

				CherryJsCore.variable.$document.trigger( 'scroll.stickUp' );
			});
		},

		scrollspy_init: function() {
			var $toc = $( '.docs-wrapper .toc' );

			if ( ! $.isFunction( jQuery.fn.scrollspy ) || ! $toc.length ) {
				return !1;
			}

			$( 'body' ).scrollspy({ target: '.toc' })
		},

		subscribe_init: function( self ) {

			CherryJsCore.variable.$document.on( 'click', '.subscribe-block__submit', function( event ){

				event.preventDefault();

				var $this       = $(this),
					form       = $this.parents( 'form' ),
					nonce      = form.find( 'input[name="nonce"]' ).val(),
					mail_input = form.find( 'input[name="subscribe-mail"]' ),
					mail       = mail_input.val(),
					error      = form.find( '.subscribe-block__error' ),
					success    = form.find( '.subscribe-block__success' ),
					hidden     = 'hidden';

				if ( '' === mail ) {
					mail_input.addClass( 'error' );
					return !1;
				}

				if ( $this.hasClass( 'processing' ) ) {
					return !1;
				}

				$this.addClass( 'processing' );
				error.empty();

				if ( ! error.hasClass( hidden ) ) {
					error.addClass( hidden );
				}

				if ( ! success.hasClass( hidden ) ) {
					success.addClass( hidden );
				}

				$.ajax({
					url: cherry.ajaxurl,
					type: 'post',
					dataType: 'json',
					data: {
						action: 'cherry_subscribe',
						mail: mail,
						nonce: nonce
					},
					error: function() {
						$this.removeClass( 'processing' );
					}
				}).done( function( response ) {

					$this.removeClass( 'processing' );

					if ( true === response.success ) {
						success.removeClass( hidden );
						mail_input.val('');
						return 1;
					}

					error.removeClass( hidden ).html( response.data.message );
					return !1;

				});

			});

		},

		main_menu: function ( self, $mainNavigation ) {

			var transitionend = 'transitionend oTransitionEnd webkitTransitionEnd',
				moreMenuContent = '&middot;&middot;&middot;',
				imgurl = '',
				srcset = '',
				hasimg = false,
				hasicon = false,
				hasprop = Object.prototype.hasOwnProperty,
				$menuToggle = $( '.menu-toggle[aria-controls="main-menu"]', $mainNavigation ),
				liWithChildren = 'li.menu-item-has-children, li.page_item_has_children',
				$body = $( 'body' ),
				$parentNode,
				menuItem,
				subMenu,
				index = -1;

			function hideSubMenu( menuItem, $event ) {
				var subMenus = menuItem.find('.sub-menu');

				menuItem
					.removeData( 'index' )
					.removeClass( 'menu-hover' );

				subMenus.addClass( 'in-transition' );

				subMenus
					.one( transitionend, function() {
						subMenus.removeClass( 'in-transition' );
					} );
			}

			function handleMenuItemHover( $event ) {
				menuItem = $( $event.target ).parents( '.menu-item' );
				subMenu = menuItem.children( '.sub-menu' ).first();

				var subMenus = menuItem.find( '.sub-menu' );

				if ( ! menuItem.hasClass( 'menu-item-has-children' ) ) {
					menuItem = $event.target.tagName === 'LI' ?
						$( $event.target ) :
						$( $event.target ).parents().filter( '.menu-item' );
				}

				switch( $event.type ) {
					case 'mouseenter':
					case 'mouseover':
						if ( 0 < subMenu.length ) {
							var maxWidth = $body.outerWidth( true ),
								subMenuOffset = subMenu.offset().left + subMenu.outerWidth( true );
							menuItem.addClass( 'menu-hover' );
							subMenus.addClass( 'in-transition' );
							if ( maxWidth <= subMenuOffset ) {
								subMenu.addClass( 'left-side' );
								subMenu.find( '.sub-menu' ).addClass( 'left-side' );
							} else if ( 0 > subMenu.offset().left ) {
								subMenu.removeClass( 'left-side' );
								subMenu.find( '.sub-menu' ).removeClass( 'left-side' );
							}
							subMenus
								.one( transitionend, function() {
									subMenus.removeClass( 'in-transition' );
								} );
						}
					break;
					case 'mouseleave':
						hideSubMenu( menuItem, $event );
					break;
				}
			}

			CherryJsCore.variable.$window.on( 'orientationchange resize', function() {
				if ( $( 'html' ).hasClass( 'mobile-menu-active' ) ) {
					return;
				}
				$mainNavigation.find( '.menu-item' ).removeClass( 'menu-hover' );
				$mainNavigation.find( '.sub-menu.left-side' ).removeClass( 'left-side' );
			} );

			$( liWithChildren ).hoverIntent( {
				over: function() {},
				out: function() {},
				timeout: 300,
				selector: '.menu-item'
			} );

			$mainNavigation.on( 'mouseenter mouseover mouseleave', '.menu-item', handleMenuItemHover );

			function doubleClickMenu( $jqEvent ) {
				$parentNode = $( this );

				if ( $( 'html' ).hasClass( 'mobile-menu-active' ) ) {
					return true;
				}

				var menuIndex = $parentNode.index();

				if ( menuIndex !== parseInt( $parentNode.data( 'index' ), 10 ) ) {
					$jqEvent.preventDefault();
				}

				$parentNode.data( 'index', menuIndex );
			}

			// Check if touch events supported
			if ( 'ontouchend' in window ) {

				// Attach event listener for double click
				$( liWithChildren, $mainNavigation )
					.on( 'click', doubleClickMenu );

				// Reset index on touchend event
				CherryJsCore.variable.$document.on( 'touchend', function( $jqEvent ) {
					if ( ! $( 'html' ).hasClass( 'mobile-menu-active' ) ) {
						$parentNode = $( $jqEvent.target ).parents().filter( '.menu-item:first' );

						if ( $parentNode.hasClass( 'menu-hover' ) === false ) {
							hideSubMenu( $parentNode, $jqEvent );

							index = $parentNode.data( 'index' );

							if ( index ) {
								$parentNode.data( 'index', parseInt( index, 10 ) - 1 );
							}
						}
					}
				} );
			}

			$menuToggle.on( 'click', function( $event ) {
				$event.preventDefault();
				$mainNavigation.toggleClass( 'toggled' );
			});
		},

		mobile_menu: function( self ) {
			var $mainNavigation = $( '.main-navigation' ),
				$menuToggle = $( '.menu-toggle[aria-controls="main-menu"]' );

			$mainNavigation
				.find( 'li.menu-item-has-children > .menu-link-wrapper > a' )
				.on( 'touchstart', function() {
					$( this ).attr( 'data-offset', $( '.menu', $mainNavigation ).get(0).scrollTop );
				} )
				.on( 'touchend', function() {
					var $anchor = $( this ),
						offset = $anchor.attr( 'data-offset' );
					if ( offset == $( '.menu', $mainNavigation ).get(0).scrollTop &&
						 $( 'html' ).hasClass( 'mobile-menu-active' ) &&
						 $anchor.attr( 'href' ) ) {
						window.location = $anchor.attr( 'href' );
					}
				} )
				.after( '<span class="sub-menu-toggle"></span>' );

			/**
			 * Debounce the function call
			 *
			 * @param  {number}   threshold The delay.
			 * @param  {Function} callback  The function.
			 */
			function debounce( threshold, callback ) {
				var timeout;

				return function debounced( $event ) {
					function delayed() {
						callback.call( this, $event );
						timeout = null;
					}

					if ( timeout ) {
						clearTimeout( timeout );
					}

					timeout = setTimeout( delayed, threshold );
				};
			}

			/**
			 * Resize event handler.
			 *
			 * @param {jqEvent} jQuery event.
			 */
			function resizeHandler( $event ) {
				var $window = CherryJsCore.variable.$window,
					width = $window.outerWidth( true );

				if ( 768 <= width ) {
					$mainNavigation.removeClass( 'mobile-menu' );
				} else {
					$mainNavigation.addClass( 'mobile-menu' );
				}
			}

			/**
			 * Toggle sub-menus.
			 *
			 * @param  {jqEvent} $event jQuery event.
			 */
			function toggleSubMenuHandler( $event ) {
				var $subMenu = $( this ),
					offset = $subMenu.attr( 'data-offset' );
				if ( offset == $( '.menu', $mainNavigation ).get(0).scrollTop ) {
					$event.preventDefault();

					$subMenu.toggleClass( 'active' );
					$subMenu.parents().filter( 'li:first' ).toggleClass( 'sub-menu-open' );
				}
			}

			/**
			 * Toggle menu.
			 *
			 * @param  {jqEvent} $event jQuery event.
			 */
			function toggleMenuHandler( $event ) {
				var $toggle = $( this );

				if ( ! $event.isDefaultPrevented() ) {
					$event.preventDefault();
				}

				setTimeout( function() {
					if ( ! $mainNavigation.hasClass( 'animate' ) ) {
						$mainNavigation.addClass( 'animate' );
					}
					$mainNavigation.toggleClass( 'show' );
					$( 'html' ).toggleClass( 'mobile-menu-active' );
				}, 10 );

				$menuToggle.toggleClass( 'toggled' );
				$menuToggle.attr( 'aria-expanded', ! $menuToggle.hasClass( 'toggled' ) );

				if ( $toggle.hasClass( 'active' ) ) {
					$toggle.removeClass( 'active' );
					$mainNavigation.find( '.sub-menu-open' ).removeClass( 'sub-menu-open' );
				}
			}

			resizeHandler();
			CherryJsCore.variable.$window.on( 'resize orientationchange', debounce( 500, resizeHandler ) );
			$( '.sub-menu-toggle', $mainNavigation )
				.on( 'touchstart', function() {
					$( this ).attr( 'data-offset', $( '.menu', $mainNavigation ).get(0).scrollTop );
				} )
				.on( 'touchend', toggleSubMenuHandler );
			$menuToggle.on( 'click', toggleMenuHandler );
		},

		page_preloader_init: function ( self ) {

			if ( $( '.page-preloader-cover' )[0] ) {
				$( '.page-preloader-cover' ).delay( 500 ).fadeTo( 500, 0, function() {
					$( this ).remove();
				});
			}
		},

		to_top_init: function ( self ) {
			if ( $.isFunction( jQuery.fn.UItoTop ) ) {
				$().UItoTop({
					text: cherry.labels.totop_button,
					scrollSpeed: 600
				});
			}
		}
	}
	CherryJsCore.theme_script.init();
}(jQuery));
