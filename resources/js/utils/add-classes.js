import { $win, $doc, $body } from "./globals";
import classNames from "./constant-names";
import { isMobile } from "./is-mobile";
import { isIe } from "./is-ms";

$doc.on("ready", () => {
  $body.addClass(isMobile ? classNames.IsTouch : classNames.NoTouch);
  $body.addClass(isIe() ? classNames.IsIE : "");
});

$win.on("load", () => $body.addClass(classNames.PageLoaded));

$win.on("scroll load orientationchange", () => {
  $body.toggleClass(classNames.IsScrolled, $win.scrollTop() > 0);
});
