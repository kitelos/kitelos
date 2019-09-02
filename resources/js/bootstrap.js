
window._ = require('lodash');
window.auth = null

try {
    window.$ = window.jQuery = require('jquery');
} catch (e) {}

window.purify = o => JSON.parse(JSON.stringify(o))