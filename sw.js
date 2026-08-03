const CACHE_NAME = 'softec-pwa-v2';

// Lista de assets estáticos essenciais para cache
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

// 4. Ouvinte de Notificações Push (Essencial para o iOS/Android exibirem o alerta)
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
        icon: '/images/icon.svg',
        badge: '/images/icon.svg',
        data: { url: data.url || '/' }
    };

    event.waitUntil(
        self.registration.showNotification(title, options)
    );
});

// 5. Ação ao clicar na notificação (Abre o app/página ao tocar)
self.addEventListener('notificationclick', event => {
    event.notification.close();

    event.waitUntil(
        clients.matchAll({ type: 'window', includeUncontrolled: true }).then(windowClients => {
            for (let i = 0; i < windowClients.length; i++) {
                let client = windowClients[i];
                if (client.url === event.notification.data.url && 'focus' in client) {
                    return client.focus();
                }
            }
            if (clients.openWindow) {
                return clients.openWindow(event.notification.data.url);
            }
        })
    );
});