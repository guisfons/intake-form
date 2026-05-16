import { isIe } from "./is-ms";
import cssVars from "css-vars-ponyfill";

if (isIe()) {
  cssVars();
}
