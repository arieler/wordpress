(function () {
  // On Customizer Ready
  wp.customize.bind("ready", function () {
    //wp.customize( 'background_color' ).get();
    //wp.customize( 'background_color' ).deactivate();
    //on change
    /*
    wp.customize("background_color", function (setting) {});

    wp.customize.Control;
    wp.customize.Panel;
    wp.customize.Section;

    wp.customize.panel.each(function (panel) {});
    wp.customize.section.each(function (section) {});
    wp.customize.control.each(function (control) {});

    id = wp.customize.control("blogname").section();

    wp.customize.control("blogname").section("nav");

    wp.customize.control("page_on_front").focus();
    */
  });
})();
