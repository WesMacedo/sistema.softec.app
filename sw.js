const CACHE_NAME = 'softec-pwa-v3';

// 1. Atualizado: Adicionados assets essenciais para que o layout carregue mesmo offline
const urlsToCache = [
    '/',
    '/auth/login',
    '/dash',
    '/assets/css/dashlite9b70.css?ver=3.3.0',
    '/assets/css/theme9b70.css?ver=3.3.0',
    '/assets/js/bundle9b70.js?ver=3.3.0',
    '/assets/js/scripts9b70.js?ver=3.3.0',
    '/images/favicon.png',
    '/images/logo.png'
];

// 1. Instalação
self.addEventListener('install', event => {
    event.waitUntil(
        caches.open(CACHE_NAME)
            .then(cache => {
                return cache.addAll(urlsToCache);
            })
            .catch(err => console.log('Erro ao fazer cache inicial:', err))
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

// 3. Estratégia de Rede Primeiro, com salvamento dinâmico em cache (Network First + Cache Fallback)
self.addEventListener('fetch', event => {
    const requestUrl = new URL(event.request.url);

    // Ignora requisições que não sejam HTTP/HTTPS (ex: extensões do browser, chrome-extension)
    if (!requestUrl.protocol.startsWith('http')) {
        return;
    }

    // IGNORA requisições POST, AJAX de autenticação, API ou rotas dinâmicas sensíveis.
    // O cache NUNCA deve interceptar POST/PUT/DELETE, pois quebra o envio de formulários e login.
    if (event.request.method !== 'GET') {
        return;
    }

    event.respondWith(
        fetch(event.request)
            .then(networkResponse => {
                // Se a resposta da rede for válida, clonamos e guardamos no cache dinamicamente
                if (networkResponse && networkResponse.status === 200) {
                    const responseToCache = networkResponse.clone();
                    caches.open(CACHE_NAME).then(cache => {
                        cache.put(event.request, responseToCache);
                    });
                }
                return networkResponse;
            })
            .catch(() => {
                // Se falhou a rede (offline), busca no cache
                return caches.match(event.request).then(cachedResponse => {
                    if (cachedResponse) {
                        return cachedResponse;
                    }
                    // Opcional: Se for uma página HTML e estiver totalmente offline sem cache, 
                    // você poderia retornar uma view de "Sem Conexão" personalizada aqui.
                });
            })
    );
});

// 4. Ouvinte de Notificações Push 
self.addEventListener('push', event => {
    let data = {};
    
    if (event.data) {
        try {
            data = event.data.json();
        } catch (e) {
            data = { titulo: 'Nova Notificação', corpo: event.data.text() };
        }
    }

    const title = data.titulo || 'Softec';
    const options = {
        body: data.corpo || 'Você recebeu uma nova atualização.',
        icon: '/images/favicon.png', // Atualizado para usar o PNG padrão
        badge: '/images/favicon.png',
        data: { url: data.url || '/dash' }
    };

    event.waitUntil(
        self.registration.showNotification(title, options)
    );
});

// 5. Ação ao clicar na notificação 
self.addEventListener('notificationclick', event => {
    event.notification.close();
    const targetUrl = event.notification.data.url || '/dash';

    event.waitUntil(
        clients.matchAll({ type: 'window', includeUncontrolled: true }).then(windowClients => {
            for (let i = 0; i < windowClients.length; i++) {
                let client = windowClients[i];
                // Se já houver uma aba aberta com o sistema, apenas dá foco nela
                if ('focus' in client) {
                    client.navigate(targetUrl);
                    return client.focus();
                }
            }
            if (clients.openWindow) {
                return clients.openWindow(targetUrl);
            }
        })
    );
});