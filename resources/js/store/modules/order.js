import EventService from "../../services/EventService.js";

export const namespaced = true;

export const state = {
	order: {},
	orderedPizzasToServer: [],
	orderedPizzasToShow: [],
	customer: {},
};
export const mutations = {
	SET_ORDER(state, data) {
		state.order = data.order;
	},
	ADD_ORDERED_PIZZA(state, ordered_pizza) {
		// add unique values
		if (-1 === state.orderedPizzasToServer.indexOf(ordered_pizza)) {
			state.orderedPizzasToServer.push(ordered_pizza);
		}
	},
	SET_ORDERED_PIZZAS(state, data) {
		if (data.ordered_pizzas.length > 0) {
			state.orderedPizzasToShow = data.ordered_pizzas;
		}
	},
	SET_CUSTOMER(state, data) {
		state.customer = data.customer;
		localStorage.setItem('customer_id', data.customer.id);
	},
};
export const actions = {
	addOrderedPizza({ commit, dispatch }, ordered_pizza) {
		commit('ADD_ORDERED_PIZZA', ordered_pizza);
	},
	updateOrder({ commit, dispatch }, data) {
		console.log(data.orderedPizzas);
		EventService.updateOrder(data)
			.then(response => {
				commit("SET_ORDER", response.data);
				commit("SET_ORDERED_PIZZAS", response.data);
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
				commit("SET_ORDER", response.data);
				commit("SET_ORDERED_PIZZAS", response.data);
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
