jQuery(document).ready(function ($) {
  console.log("Jquery Ready");

  $(".nav-tab").on("click", function (e) {
    let $this = $(this);
    $this.addClass("nav-tab-active");
    $this.siblings().removeClass("nav-tab-active");

    let $tab = $(".wp-tab#" + $this.attr("id"));
    $tab.addClass("wp-tab-visible");
    $tab.siblings().removeClass("wp-tab-visible");
  });

  /* START Setup Selectors Values on INIT */

  //MESSAGES
  $.ajax({
    url: ajax_object.ajax_url,
    type: "GET",
    dataType: "json",
    data: {
      action: "messages",
    },
  })
    .done(function (data) {
      console.log("success");
      console.log(data);
    })
    .fail(function (data) {
      console.log("error");
    });

  //LISTS
  $.ajax({
    url: ajax_object.ajax_url,
    type: "GET",
    dataType: "json",
    data: {
      action: "contact_lists",
    },
  })
    .done(function (data) {
      console.log("success");
      console.log(data);
    })
    .fail(function (data) {
      console.log("error");
    });

  //CONTACTS
  $.ajax({
    url: ajax_object.ajax_url,
    type: "GET",
    dataType: "json",
    data: {
      action: "contacts",
    },
  })
    .done(function (data) {
      console.log("success");
      console.log(data);
    })
    .fail(function (data) {
      console.log("error");
    });

  //CONFIG
  $.ajax({
    url: ajax_object.ajax_url,
    type: "GET",
    dataType: "json",
    data: {
      action: "",
    },
  })
    .done(function (data) {
      console.log("success");
      console.log(data);
    })
    .fail(function (data) {
      console.log("error");
    });

  /* END Setup Selector Values on INIT */

  //Submit Buttons
  const $setup_btn = $("#setup-action");
  const $messages_sending_btn = $("#messages-sending-action");
  const $messages_btn = $("#messages-action");
  const $contacts_btn = $("#contacts-action");
  const $contacts_lists_btn = $("#contacts-lists-action");
  const $scheduling_btn = $("#scheduling-action");

  //Setup Form Submit
  $setup_btn.on("click", function (e) {
    e.preventDefault();
    const $panel = $("#setup-action");

    console.log("Setup action");
  });

  //Message Sending Form Submit
  $messages_sending_btn.on("click", function (e) {
    e.preventDefault();
    const $panel = $("#messages-sending-action");

    console.log("Message sending action");
  });

  $("#bulk-action-selector-top").on("change", function (e) {
    e.preventDefault();
    let selected = $(this).find("option:selected");
    console.log(selected.val());
  });

  //Message Sending Form Submit
  $messages_btn.on("click", function (e) {
    e.preventDefault();
    const $panel = $("#messages-action");

    let prom = $.ajax({
      url: ajax_object.ajax_url,
      type: "GET",
      dataType: "json",
      data: {
        action: "",
        message: "",
      },
    });

    prom
      .done(function (data) {
        console.log("success");
      })
      .fail(function (data) {
        console.log("error");
      });

    console.log("Messages");
  });

  //Message Form Submit
  $contacts_btn.on("click", function (e) {
    e.preventDefault();
    const $panel = $("#contacts-action");

    let prom = $.ajax({
      url: ajax_object.ajax_url,
      data: {
        action: "",
        contact: "",
      },
    });

    prom
      .done(function (data) {
        console.log("success");
      })
      .fail(function (data) {
        console.log("error");
      });

    console.log("Contacts");
  });

  //Contacts Form Submit
  $contacts_lists_btn.on("click", function (e) {
    e.preventDefault();
    const $panel = $("#contacts-lists-action");

    let prom = $.ajax({
      url: ajax_object.ajax_url,
      data: {
        action: "",
        contact: "",
      },
    });

    prom
      .done(function (data) {
        console.log("success");
      })
      .fail(function (data) {
        console.log("error");
      });

    console.log("Contacts lists");
  });

  //Scheduling Form Submit
  $scheduling_btn.on("click", function (e) {
    e.preventDefault();
    const $panel = $("#scheduling-action");

    let prom = $.ajax({
      url: ajax_object.ajax_url,
      data: {
        action: "",
        contact: "",
      },
    });
    prom
      .done(function (data) {
        console.log("success");
      })
      .fail(function (data) {
        console.log("error");
      });

    console.log("Scheduling");
  });

  $("[name=sending_date").datepicker();

  //Setup Forms On Change Selectors
  $("#message-action-selector").on("change", function (e) {
    e.preventDefault();

    const $panel = $("#scheduling-action");

    let id = $(this).val();
    console.log(id);

    let prom = $.ajax({
      url: ajax_object.ajax_url,
      data: {
        action: "message",
        message: id,
      },
    });
    prom
      .done(function (data) {
        console.log("success");
      })
      .fail(function (data) {
        console.log("error");
      });
  });
});
