package controller

import (
    "encoding/json"
    "net/http"
    dbconfig "api_get_golang/config"
    "api_get_golang/entity"

    "github.com/gorilla/mux"
)

func GetAllCustomer(w http.ResponseWriter, r *http.Request) {
    var customers []entity.Customer
    dbconfig.Connector.Preload("FamilyList").Find(&customers)
    w.Header().Set("Content-Type", "application/json")
    w.WriteHeader(http.StatusOK)
    json.NewEncoder(w).Encode(customers)
}

func GetCustomerByID(w http.ResponseWriter, r *http.Request) {
    vars := mux.Vars(r)
    key := vars["id"]

    var customer entity.Customer
    dbconfig.Connector.Preload("FamilyList").First(&customer, key)
    w.Header().Set("Content-Type", "application/json")
    json.NewEncoder(w).Encode(customer)
}