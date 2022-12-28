(function () {
  wp.customize.bind("ready", function () {
    jQuery("#hide-controls").on("click", function (e) {
      e.preventDefault();
      console.log("hide controls");
    });

    // Add listener for the "background_color" control.
    wp.customize("background_color", function (setting) {});
  });
})();
