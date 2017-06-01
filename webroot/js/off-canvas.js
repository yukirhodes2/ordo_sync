/**!
 Menu Off Canvas (for mobile < 979px)

 To open the main navigation (off canvas) from the left side and switch the main website content to the right side (off canvas).

 @contributors: Jennifer Noesser / Rodolphe Rimelé
 @date-created: 2016-11-21
 */

(function($) {

  $.menuBurger = function(el, options) {

    // Default settings values
    var defaults = {
      // Burger button to open/close the navigation
      burgerButton: '.js-menuburger',

      // Apply to the burger button, when it's actove
      classButtonActive: 'is-active',

      // Apply to the menu, when it's opened
      classMenuActive: 'is-opened',

      // The off canvas menu you want to open. Ex: data-target=".navigation"
      target: '.navigation',

      // Apply to the website content, when the menu is opened
      classOffCanvasActive: 'is-active',

      // The part of the website content you want to switch to the right side (off canvas). Ex: data-selector-off-canvas=".js-content-off-canvas"
      selectorOffCanvas: '.js-content-off-canvas',

      // px, should match ($medium-screen) (scss)
      mobileMaxWidth: 980
    };

    var plugin = this;

    plugin.settings = {};

    var $element = $(el),
      element = el;

    // Plugin initialization
    plugin.init = function() {
      plugin.settings = $.extend({}, defaults, options);
      updateSettingsFromHTMLData();
      registerEvents();
    };

    // Reads plugin settings from HTML data-* attributes (camelCase)
    var updateSettingsFromHTMLData = function() {
      var data = $element.data();
      for (var dat in data) plugin.settings[dat] = data[dat];
    };

    // Set event handlers on HTML elements (private method)
    var registerEvents = function() {
      $element.off('click.menuburger').on('click.menuburger', plugin.toggleMenu);
      $(window).off('resize.menuburger').on('resize.menuburger', plugin.resetMenu);
    };

    // Plugin toggle Menu on/off (public method)
    plugin.toggleMenu = function() {
      if (window.matchMedia("(max-width: "+plugin.settings.mobileMaxWidth+"px)").matches) {
        $(plugin.settings.burgerButton).toggleClass(plugin.settings.classButtonActive);
        $(plugin.settings.target).toggleClass(plugin.settings.classMenuActive);
        $(plugin.settings.selectorOffCanvas).toggleClass(plugin.settings.classOffCanvasActive);
      }
    };

    // Disable off canvas when in desktop
    plugin.resetMenu = function() {
      if (!window.matchMedia("(max-width: "+plugin.settings.mobileMaxWidth+"px)").matches) {
        $(plugin.settings.burgerButton).removeClass(plugin.settings.classButtonActive);
        $(plugin.settings.target).removeClass(plugin.settings.classMenuActive);
        $(plugin.settings.selectorOffCanvas).removeClass(plugin.settings.classOffCanvasActive);
      }
    };

    // Initialization
    plugin.init();

  };

  $.fn.menuBurger = function(options) {

    return this.each(function() {
      if (undefined === $(this).data('menuBurger')) {
        var plugin = new $.menuBurger(this, options);
        $(this).data('menuBurger', plugin);
      }
    });

  };

  $(document).ready(function() {
    // Launch plugin on target element
    $('.js-menuburger').menuBurger();

    // Visual hack to avoid CSS3 animation on window resize
    var resizeTimer;
    $(window).on('resize', function(e) {
      if (window.matchMedia("(max-width: 980px").matches) {

        // Hide .js-accessible-navigation on <980px and during window resize
        $('.js-accessible-navigation').hide();

        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(function() {

          // Show .js-accessible-navigation when resize is done
          $('.js-accessible-navigation').show();

        }, 50);
      }
    });

  });


})(jQuery);
