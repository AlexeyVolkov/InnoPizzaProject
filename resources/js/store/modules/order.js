import EventService from "../../services/EventService.js";

export const namespaced = true;

export const state = {
	order: {},
	orderedPizzas: [],
	customer: {},
};
export const mutations = {
	SET_ORDER(state, order) {
		state.order = order;
	},
	ADD_ORDERED_PIZZA(state, ordered_pizza) {
		state.orderedPizzas.push(ordered_pizza);
	},
	SET_CUSTOMER(state, data) {
		state.customer = data.customer;
		localStorage.customer_id = data.customer.id;
	},
};
export const actions = {
	addOrderedPizza({ commit, dispatch }, ordered_pizza) {
		commit('ADD_ORDERED_PIZZA', ordered_pizza);
	},
	getCustomer({ commit, dispatch }, id) {
		EventService.getCustomer(id)
			.then(response => {
				commit("SET_CUSTOMER", response.data);
			})
			.catch(error => {
				const notification = {
					type: "error",
					message: error.message
				};
				dispatch("notification/add", notification, { root: true });
			});
	},
	addCustomer({ commit, dispatch }) {
		EventService.addCustomer()
			.then(response => {
				commit("SET_CUSTOMER", response.data);
			})
			.catch(error => {
				const notification = {
					type: "error",
					message: error.message
				};
				dispatch("notification/add", notification, { root: true });
			});
	},
	addOrder({ commit, dispatch }) {
		EventService.addOrder(state.customer, state.orderedPizzas)
			.then(response => {
				commit("SET_ORDER", response.data);
			})
			.catch(error => {
				const notification = {
					type: "error",
					message: error.message
				};
				dispatch("notification/add", notification, { root: true });
			});
	},
};
export const getters = {
	pizzasTotal: state => {
		return state.pizzas.length;
	},
	getPizzaById: state => id => {
		return state.pizzas.find(pizza => id === pizza.id);
	}
};
