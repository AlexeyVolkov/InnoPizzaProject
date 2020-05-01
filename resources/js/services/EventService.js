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
	getPizzas(sortMethod) {
		return apiClient.get("/api/pizzas/", {
			params: {
				sort: sortMethod
			}
		});
	},
	getPizza(id) {
		return apiClient.get("/api/pizza/", {
			params: {
				id: id
			}
		});
	},
	getCustomer(id) {
		return apiClient.get("/api/customer/" + id);
	},
	addCustomer() {
		return apiClient.post("/api/customer/");
	},
	getOrder(customer_id) {
		return apiClient.get("/api/orders/", {
			params: {
				customer: customer_id,
			}
		});
	},
	updateOrder(data) {
		console.log(data.orderedPizzas);
		return apiClient.put("/api/orders/" + data.order_id, {
			params: {
				ordered_pizzas: data.orderedPizzas,
			}
		});
	},
	addOrder(customer, ordered_pizzas) {
		return apiClient.post("/api/order/", {
			params: {
				customer: customer,
				ordered_pizzas: ordered_pizzas,
			}
		});
	},
};
