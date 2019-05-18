import $ from 'jquery';
import Header from "./components/Header";

global.$ = global.jQuery = $;

require('assets/scss/entry.scss');
new Header();
