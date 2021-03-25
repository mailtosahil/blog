/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");

window.Vue = require("vue");

import VueRouter from "vue-router";
import VueAxios from "vue-axios";
import Toasted from "vue-toasted";
import axios from "axios";
import { routes } from "./routes";

import {
    required,
    digits,
    email,
    max,
    regex,
    min
} from "vee-validate/dist/rules";
import {
    ValidationObserver,
    ValidationProvider,
    setInteractionMode,
    extend
} from "vee-validate";

Vue.use(VueRouter);
Vue.use(VueAxios, axios);
Vue.use(Toasted, {
    theme: "bubble",
    position: "top-right",
    duration: 3000
});
import Vuetify from "vuetify";
import "vuetify/dist/vuetify.min.css";
Vue.use(Vuetify);

setInteractionMode("eager");

extend("digits", {
    ...digits,
    message: "{_field_} needs to be {length} digits. ({_value_})"
});

extend("required", {
    ...required,
    message: "{_field_} can not be empty"
});

extend("max", {
    ...max,
    message: "{_field_} may not be greater than {length} characters"
});

extend("min", {
    ...min,
    message: "{_field_} may not be less than {length} characters"
});

extend("regex", {
    ...regex,
    message: "{_field_} {_value_} does not match {regex}"
});

extend("email", {
    ...email,
    message: "Email must be valid"
});
Vue.component("ValidationProvider", ValidationProvider);
Vue.component("ValidationObserver", ValidationObserver);
Vue.component("z-dashboard", require("./components/dashboard.vue").default);

const router = new VueRouter({
    mode: "history",
    routes: routes
});
let userData = window.authUser;
router.beforeEach((to, from, next) => {
    if (userData) {
        next();
    } else {
        window.location.href = "/login";
    }
    return;
});
const app = new Vue({
    el: "#app",
    router: router,
    vuetify: new Vuetify()
    //render: h => h(App)
});
