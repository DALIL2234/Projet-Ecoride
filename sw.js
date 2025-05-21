const CACHE_NAME = 'ecoride-cache-v1';
const URLS_TO_CACHE = [
  '/index.html',
  '/login.html',
  '/register.html',
  '/dashboard.html',
  '/covoiturages.html',
  '/detail-covoiturage.html',
  '/employe.html',
  '/admin.html',
  '/mentions-legales.html',
  '/manifest.json'
];

self.addEventListener('install', function (e) {
  console.log('[EcoRide SW] Install');
  e.waitUntil(
    caches.open(CACHE_NAME).then(cache => {
      console.log('[EcoRide SW] Caching files');
      return cache.addAll(URLS_TO_CACHE);
    })
  );
});

self.addEventListener('fetch', function (e) {
  e.respondWith(
    caches.match(e.request).then(function (response) {
      return response || fetch(e.request).catch(() =>
        caches.match('/index.html')
      );
    })
  );
});

// (optionnel) gestion du nettoyage des anciens caches
self.addEventListener('activate', function (e) {
  e.waitUntil(
    caches.keys().then(cacheNames => {
      return Promise.all(
        cacheNames
          .filter(name => name !== CACHE_NAME)
          .map(name => caches.delete(name))
      );
    })
  );
});
