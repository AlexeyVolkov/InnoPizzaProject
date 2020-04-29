import Vue from "vue";
import Vuex from "vuex";
import * as pizzaApi from "../store/modules/pizza.js";
import * as orderApi from "../store/modules/order.js";
import * as notification from "../store/modules/notification.js";

Vue.use(Vuex);

export default new Vuex.Store({
	modules: {
		pizzaApi,
		orderApi,
		notification
	}
});
