import EventService from "../../services/EventService.js";

export const namespaced = true;

export const state = {
	order: {},
	orderedPizzasToServer: [],
	orderedPizzasToShow: [],
	orderedPizzas: [],
	customer: {},
};
export const mutations = {
	SET_ORDER(state, order) {
		state.order = order;
	},
	SET_ORDERED_PIZZAS(state, orderedPizzas) {
		state.orderedPizzas = orderedPizzas
	},
	SET_CUSTOMER(state, data) {
		state.customer = data.customer;
		localStorage.setItem('customer_id', data.customer.id);
	},
};
export const actions = {
	addOrderedPizza({ commit, dispatch }, data) {
		// append
		EventService.addOrderedPizza(data)
			.then(response => {
				commit("SET_ORDER", response.data.order);
				commit("SET_ORDERED_PIZZAS", response.data.ordered_pizzas);
			})
			.catch(error => {
				const notification = {
					type: "error",
					message: error.message
				};
				dispatch("notification/add", notification, { root: true });
			});
	},
	updateOrder({ commit, dispatch }, data) {
		EventService.updateOrder(data)
			.then(response => {
				commit("SET_ORDER", response.data.order);
				commit("SET_ORDERED_PIZZAS", response.data.ordered_pizzas);
			})
			.catch(error => {
				const notification = {
					type: "error",
					message: error.message
				};
				dispatch("notification/add", notification, { root: true });
			});
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
	getOrder({ commit, dispatch }, customer_id) {
		EventService.getOrder(customer_id)
			.then(response => {
				commit("SET_ORDER", response.data.order);
				commit("SET_ORDERED_PIZZAS", response.data.ordered_pizzas);
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
