const staticBroco = "Brocoland"
const assets = [
    "/",
    "/brocoli/index.php",
    "/css/login.css",
    "/img/logo.svg"
]

self.addEventListener("install", installEvent => {
    installEvent.waitUntil(
        caches.open(staticBroco).then(cache => {
            cache.addAll(assets)
        })
    )
})

self.addEventListener("fetch", fetchEvent => {
    fetchEvent.respondWidth(
        caches.match(fetchEvent.request).then(res => {
            return res || fetch(fetchEvent.request)
        })
    )
})