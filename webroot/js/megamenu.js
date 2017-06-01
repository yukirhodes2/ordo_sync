/**!
 MegaMenu
 Activate MegaMenu only for desktop (> 980px)

 Script based on accessible-megamenu.js — https://github.com/adobe-accessibility/Accessible-Mega-Menu

 /!\ Alsacreations changed 1 line on the main code from accessibleMegaMenu.js:
 --> l.752/753: we replaced ==> .on("mouseover.accessible-megamenu", $.proxy(_mouseOverHandler, this)) `
                by ==> .on("click.accessible-megamenu", $.proxy(_mouseOverHandler, this))
                to open the menu only on click and not on mousehover.

 @contributors: Jennifer Noesser
 @date-created: 2016-11-21
 */

(function($) {

  // Only for desktop > 981px
  if (window.matchMedia("(min-width: 981px)").matches) {

    $(document).ready(function () {

      // initialize the megamenu
      $(".js-accessible-navigation").accessibleMegaMenu({
        /* prefix for generated unique id attributes, which are required
           to indicate aria-owns, aria-controls and aria-labelledby */
        uuidPrefix: "accessible-megamenu",

        /* css class used to define the megamenu styling */
        menuClass: "navigation-list",

        /* css class for a top-level navigation item in the megamenu */
        topNavItemClass: "navigation-list-item",

        /* css class for a megamenu panel */
        panelClass: "mega-navigation",

        /* css class for a group of items within a megamenu panel */
        panelGroupClass: "mega-navigation-col",

        /* css class for the hover state */
        hoverClass: "hover",

        /* css class for the focus state */
        focusClass: "focus",

        /* css class for the open state */
        openClass: "open"
      });

      // hack so that the megamenu doesn't show flash of css animation after the page loads.
      setTimeout(function () {
        $('body').removeClass('init');
      }, 500);

    });
  }

})(jQuery);
