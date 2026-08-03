const CACHE_NAME = 'softec-pwa-v1';
const urlsToCache = [
    '/'
];

// 1. Instalação: Cacheia os arquivos iniciais e força a ativação imediata
self.addEventListener('install', event => {
    event.waitUntil(
        caches.open(CACHE_NAME)
            .then(cache => {
                return cache.addAll(urlsToCache);
            })
    );
    self.skipWaiting(); // Pula a espera e ativa na hora
});

// 2. Ativação: Limpa caches antigos e assume o controle de todas as abas abertas
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
            return self.clients.claim(); // Reivindica o controle imediato (resolve o erro da 1ª visita)
        })
    );
});

// 3. Interceptação de requisições segura
self.addEventListener('fetch', event => {
    // Ignora requisições que não sejam HTTP ou HTTPS (evita erros em extensões e Safari)
    if (!event.request.url.startsWith('http')) {
        return;
    }

    event.respondWith(
        caches.match(event.request)
            .then(response => {
                // Retorna do cache se existir, senão busca na rede com tratamento de erro
                if (response) {
                    return response;
                }
                return fetch(event.request).catch(() => {
                    // Opcional: Se cair a rede e não tiver cache, você pode retornar algo customizado aqui
                });
            })
    );
});