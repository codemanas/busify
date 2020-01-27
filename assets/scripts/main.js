jQuery(function ($) {
  var dom = {};
  var CM_Busify = {
    init: function () {
      this._preloader();

      this._cacheDOM();

      this._listeners();
    },

    /**
     * Site Preloader Init
     */
    _preloader: function () {
      $(window).load(function () {
        $('.preloader').fadeOut('slow', function () {
          $(this).remove();
        });
      });
    },
    _cacheDOM: function () {
      dom.$headerElement = $('header#masthead');
      dom.$mainNav = $('.main-navigation');
      dom.$mainNavBurger = $('.navigation-toggler-icon');
      this.$searchIconMenu = $('.menu-item-search');
      this.$searchIconMenuClse = $('#busify-close-btn'); //Ajax Pagination

      this.$loadMoreButton = $('#busify-ajax-load-more');
      dom.$paginationDiv = $('.busify-pagination');
      dom.$paginationType = busify_options.ajaxButtonType;
    },
    _listeners: function () {
      if (busify_options.sticky_header.enable) {
        $(window).on('scroll', this.stickyHeader);
        this.stickyHeader();
      }

      $(window).on('scroll', this.scrollToTopShow);
      $('.busify-scroll').on('click', this.scrollToTop.bind(this)); //Menu

      dom.$mainNavBurger.on('click', this.toggleNav);

      if (!busify_options.menu_settings.disable_search) {
        this.$searchIconMenu.on('click', this.openSearch.bind(this));
        this.$searchIconMenuClse.on('click', this.closeSearch.bind(this));
      }

      dom.$mainNav.on('click', '.sub-menu-toggle', this.expandMobileChildrenMenu.bind(this)); //Ajax load more btn

      if (dom.$paginationType === "load-more") {
        this.$loadMoreButton.on('click', this.ajaxLoadMorePosts.bind(this));
      } //Mobile Sizing


      $(window).on('resize', this.mobileBinaries.bind(this));
      this.mobileBinaries();
    },
    mobileBinaries: function () {
      var that = $(window);
      var sticky_header = busify_options.sticky_header; //Sticky Header

      if (sticky_header.enable) {
        if (sticky_header.disable_mobile) {
          if (this.loadDocumentWidth(767)) {
            that.on('scroll', this.stickyHeader);
          } else {
            that.off('scroll', this.stickyHeader);
          }
        }
      } //Mobile Menu


      if (this.loadDocumentWidth(767, true)) {
        $('.site-header').removeClass('busify-right-logo busify-left-logo busify-center-logo');
      }
    },

    /**
     * Listen Width Size of the Document when needed
     */
    loadDocumentWidth: function (width, defaultValue) {
      if (defaultValue) {
        defaultValue = $(window).width() <= width;
      } else {
        defaultValue = $(window).width() >= width;
      }

      return defaultValue;
    },

    /**
     * Expand child menus in mobile view
     *
     * @param event
     */
    expandMobileChildrenMenu: function (event) {
      // console.log($parentListItem);
      if (this.loadDocumentWidth(767, true)) {
        $el = $(event.currentTarget);
        $el.find('i').toggleClass('fa-caret-down fa-caret-up');
        $parentItem = $el.parent();
        $parentItem.find('> ul.sub-menu').toggleClass('mobile-show-sub-menu');
      }
    },

    /**
     * Sticky Header Script
     */
    stickyHeader: function () {
      var headerHeight = $(dom.$headerElement).outerHeight(); // Detect scroll position

      var scrollPosition = $(window).scrollTop();

      if (scrollPosition > headerHeight) {
        $(dom.$headerElement).addClass('sticky-header');
      } else {
        $(dom.$headerElement).removeClass('sticky-header');
      }
    },

    /**
     * Scroll to top script
     */
    scrollToTopShow: function () {
      var scrollTop = $('.busify-scrolltop');

      if ($(scrollTop).length > 0) {
        if ($(window).scrollTop() > 50) {
          $('.busify-scrolltop:hidden').stop(true, true).fadeIn();
        } else {
          $(scrollTop).stop(true, true).fadeOut();
        }
      }
    },
    scrollToTop: function (e) {
      e.preventDefault();

      if ($('.busify-scrolltop').length > 0) {
        $("html,body").animate({
          scrollTop: $("#page").offset().top
        }, "1000");
      }

      return false;
    },
    //Main Navigation menu
    toggleNav: function (e) {
      e.preventDefault();
      var that = dom.$mainNavBurger;
      $(that).toggleClass("toggle-active");
      $(dom.$mainNav).toggleClass("toggle-active");
      return false;
    },

    /**
     * Ajax Load more posts script
     */
    ajaxLoadMorePosts: function () {
      var that = this.$loadMoreButton; // Get current page number from the button.

      var current_page = $(that).data('current-page');
      that.data('current-page', ++current_page);
      var filter = $(that).data('filter');
      var postData = {
        'action': 'busify_load_more_posts',
        'page': current_page,
        'filter': filter
      };
      var locales = busify_options.ajaxLoadMoreLocales;
      $.ajax({
        url: busify_options.ajaxurl,
        data: postData,
        type: 'POST',
        context: this,
        beforeSend: function () {
          if (dom.$paginationType === "load-more") {
            $(that).text(locales.loading);
          }
        },
        success: function (response) {
          if (true === response.success) {
            var responseData = response.data;

            if (dom.$paginationType === "load-more") {
              $(that).text(locales.load_more);
              $(dom.$paginationDiv).prev().after(responseData.post_html);

              if (current_page >= parseInt(responseData.max_page)) {
                $(that).hide();
              }
            }
          }
        },
        error: function () {
          console.log(locales.error);
        }
      });
    },

    /**
     * Open up search overlay
     */
    openSearch: function (e) {
      e.preventDefault();
      $(this).hide();
      $('#busify-search-overlay').fadeIn();
    },

    /**
     * Close search overlay
     */
    closeSearch: function (e) {
      e.preventDefault();
      $('#busify-search-overlay').fadeOut();
      $(this).show();
    }
  };
  CM_Busify.init();
});
/**
 * File skip-link-focus-fix.js.
 *
 * Helps with accessibility for keyboard only users.
 *
 * This is the source file for what is minified in the twentytwenty_skip_link_focus_fix() PHP function.
 *
 * Learn more: https://git.io/vWdr2
 */
(function () {
  var isIe = /(trident|msie)/i.test(navigator.userAgent);

  if (isIe && document.getElementById && window.addEventListener) {
    window.addEventListener('hashchange', function () {
      var id = location.hash.substring(1),
          element;

      if (!/^[A-z0-9_-]+$/.test(id)) {
        return;
      }

      element = document.getElementById(id);

      if (element) {
        if (!/^(?:a|select|input|button|textarea)$/i.test(element.tagName)) {
          element.tabIndex = -1;
        }

        element.focus();
      }
    }, false);
  }
})();