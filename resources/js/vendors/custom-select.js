import "select2";

//Start - Initializing select2
$(".select select ").each((i, select) => {
  let $select = $(select);
  let parent = $select.parent();
  let parent2 = $select.parent().parent();

  $select
    .select2({
      dropdownParent: $(parent),
    })
    .data("select2")
    .$dropdown.addClass("custom-select-styles");

  $select.on("select2:open", function (e) {
    $(parent2).addClass("active");
    $(parent2).parent().addClass("active-field");
  });

  $select.on("select2:close", function (e) {
    $(parent2).removeClass("active");
    $(parent2).parent().removeClass("active-field");
  });
});
//End - Initializing select2
