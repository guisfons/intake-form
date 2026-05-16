$(".wpcf7-file").each(function (i) {
  const $this = $(this);
  let id = $this.attr("id");

  if (typeof id === "undefined") {
    id = "upload-field-" + i;
    $this.attr("id", id);
  }

  $this.parent().addClass("is-file");
  $this.after(
    `<label tabindex="0" for="${id}"><strong class="btn">Choose a file</strong><span>No file chosen</span></label>`
  );

  const $label = $this.next();

  $this.on("change", function () {
    if (this.files) {
      if ((this.files.length = 1)) {
        $label.find("span").html(this.files[0].name);
      } else {
        $label.find("span").html(`${this.files.length} files selected`);
      }
    }
  });
});
