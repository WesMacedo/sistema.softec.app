const CACHE_NAME = 'sistema-pwa-v1';
const urlsToCache = [
  './',
  // Adicione aqui caminhos de CSS/JS essenciais do seu template
];

// Instalação do Service Worker
self.addEventListener('install', event => {
  event.waitUntil(
    caches.open(CACHE_NAME).then(cache => {
      return cache.addAll(urlsToCache);
    })
  );
});

// Resposta de requisições / Cache
self.addEventListener('fetch', event => {
  event.respondWith(
    caches.match(event.request).then(response => {
      return response || fetch(event.request);
    })
  );
});