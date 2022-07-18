const container = document.querySelector(".bg-image")
const spaces = [
    {
        name: "name",
        image: "img/logo 72x72.png"
    }
]


if ("serviceWorker" in navigator) {
    window.addEventListener("load", () => {
        this.navigator.serviceWorker
            .register("serviceWorker.js")
            .then(res => console.log("Service Worker Registrado"))
            .catch(err => console.log("Service Worker no registrado"))
    })
}