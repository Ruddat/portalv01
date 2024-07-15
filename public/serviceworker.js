self.addEventListener('install', (event) => {
    console.log('Service Worker installiert');
});

self.addEventListener('fetch', (event) => {
    event.respondWith(fetch(event.request));
});

self.addEventListener('activate', (event) => {
    console.log('Service Worker aktiviert');
});
