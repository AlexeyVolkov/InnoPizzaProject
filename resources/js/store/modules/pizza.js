import EventService from "../../services/EventService.js";

export const namespaced = true;

export const state = {
	pizzas: [],
	sizes: [],
	toppings: [],
	pizza: {}
};
export const mutations = {
	SET_PIZZAS(state, data) {
		state.pizzas = data.pizzas;
		state.sizes = data.sizes;
		state.toppings = data.toppings;
	},
	SET_PIZZA(state, pizza) {
		state.pizza = pizza;
	}
};
export const actions = {
	fetchManyPizzas({ commit, dispatch }, sort) {
		EventService.getPizzas(sort)
			.then(response => {
				commit("SET_PIZZAS", response.data);
			})
			.catch(error => {
				const notification = {
					type: "error",
					message: error.message
				};
				dispatch("notification/add", notification, { root: true });
			});
	},
	fetchOnePizza({ commit, dispatch }, id) {
		EventService.getPizza(id)
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
