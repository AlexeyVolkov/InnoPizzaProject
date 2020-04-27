import EventService from "../../services/EventService.js";

export const namespaced = true;

export const state = {
	pizzas: [],
	pizzasTotal: 0,
	event: {}
};
export const mutations = {
	ADD_EVENT(state, event) {
		state.pizzas.push(event);
	},
	SET_EVENTS(state, pizzas) {
		state.pizzas = pizzas;
	},
	SET_EVENT(state, event) {
		state.event = event;
	}
};
export const actions = {
	fetchPizzas({ commit, dispatch }) {
		EventService.getPizzas()
			.then(response => {
				commit("SET_EVENTS", response.data);
			})
			.catch(error => {
				const notification = {
					type: "error",
					message: error.message
				};
				dispatch("notification/add", notification, { root: true });
			});
	}
};
export const getters = {
	catLength: state => {
		return state.categories.length;
	},
	getEventById: state => id => {
		return state.pizzas.find(pizza => id === pizza.id);
	}
};
