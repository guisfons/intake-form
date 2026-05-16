$(
  ".wpcf7-form-control-wrap input, .wpcf7-form-control-wrap textarea, .wpcf7-form-control-wrap select"
).each((i, element) => {
  let el = $(element);
  const parent = $(el).parent().parent().parent();

  el.focus(() => {
    $(el).addClass("active-field");
    $(parent).addClass("active-field");
  });
  el.blur(() => {
    $(el).removeClass("active-field");
    $(parent).removeClass("active-field");
    //in case the input has error
    if (el.hasClass("wpcf7-not-valid")) {
      parent.addClass("data-not-valid");
    } else {
      parent.removeClass("data-not-valid");
    }
  });
});

const blogSearchInputForm = () => {
  if (document.getElementById("blogSearchInput")) {
    const blogSearhInputParent = $("#blogSearchInput").parent().parent();

    $("#blogSearchInput").focus(() => {
      blogSearhInputParent.addClass("focus");
    });

    $("#blogSearchInput").blur(() => {
      blogSearhInputParent.removeClass("focus");
    });
  }
};

blogSearchInputForm();
