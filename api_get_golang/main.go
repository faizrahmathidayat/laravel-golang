package main

import (
    "log"
    "net/http"
    "api_get_golang/config"
    routers "api_get_golang/router"

    "github.com/gorilla/mux"
    _ "github.com/jinzhu/gorm/dialects/mysql"
)

func main() {
    config.InitDB()
    log.Println("Starting the HTTP server on port 9080")
    router := mux.NewRouter().StrictSlash(true)
    routers.InitaliseHandlers(router)
    log.Fatal(http.ListenAndServe(":9080", router))
}
