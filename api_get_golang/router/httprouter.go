package router

import (
    "api_get_golang/controller"

    "github.com/gorilla/mux"
)

func InitaliseHandlers(router *mux.Router) {
    router.HandleFunc("/customers",
        controller.GetAllCustomer).Methods("GET")
    router.HandleFunc("/customers/{id}",
        controller.GetCustomerByID).Methods("GET")
}