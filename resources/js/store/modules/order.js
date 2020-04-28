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
	SET_CUSTOMER(state, customer) {
		state.customer = customer;
	},
};
export const actions = {
	addOrderedPizza({ commit, dispatch }, ordered_pizza) {
		commit('ADD_ORDERED_PIZZA', ordered_pizza);
	},
	getCustomer({ commit, dispatch }) {
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
			// finished here
			.then(response => {
				commit("SET_PIZZA", response.data);
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
