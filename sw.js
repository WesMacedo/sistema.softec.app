const CACHE_NAME = 'softec-pwa-v2'; // Subimos a versão para limpar o cache antigo

// Deixe a lista vazia ou apenas com assets estáticos (ex: ícones, css)
const urlsToCache = [
    '/images/icon.svg'
];

// 1. Instalação
self.addEventListener('install', event => {
    event.waitUntil(
        caches.open(CACHE_NAME)
            .then(cache => {
                return cache.addAll(urlsToCache);
            })
    );
    self.skipWaiting();
});

// 2. Ativação (Limpa caches antigos e assume o controle imediato)
self.addEventListener('activate', event => {
    event.waitUntil(
        caches.keys().then(cacheNames => {
            return Promise.all(
                cacheNames.map(cacheName => {
                    if (cacheName !== CACHE_NAME) {
                        return caches.delete(cacheName);
                    }
                })
            );
        }).then(() => {
            return self.clients.claim();
        })
    );
});

// 3. Estratégia de Rede Primeiro, com fallback para o Cache
self.addEventListener('fetch', event => {
    if (!event.request.url.startsWith('http')) {
        return;
    }

    // Para páginas HTML/Requisições normais: Tenta a rede primeiro. Se falhar (offline), usa o cache.
    event.respondWith(
        fetch(event.request)
            .then(response => {
                return response;
            })
            .catch(() => {
                return caches.match(event.request);
            })
    );
});