import axios from "axios";

const apiClient = axios.create({
	baseURL: "http://localhost:8000/",
	withCredentials: false,
	headers: {
		Accept: "application/json",
		"Content-Type": "application/json"
	}
});

export default {
	getPizzas(perPage, page) {
		return apiClient.get("/api/pizzas/");
	},
	getPizza(id) {
		return apiClient.get("/events/" + id);
	}
};
