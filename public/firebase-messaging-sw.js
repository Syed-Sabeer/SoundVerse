importScripts('https://www.gstatic.com/firebasejs/12.1.0/firebase-app-compat.js');
importScripts('https://www.gstatic.com/firebasejs/12.1.0/firebase-messaging-compat.js');

firebase.initializeApp({
    apiKey: "AIzaSyBDe3dasO5dohhxYWuTUV3TwXTDmPDgm0M",
    authDomain: "tether-heart-c65f9.firebaseapp.com",
    projectId: "tether-heart-c65f9",
    storageBucket: "tether-heart-c65f9.appspot.com",
    messagingSenderId: "499343412634",
    appId: "1:499343412634:web:4c66e08a5a777bc9257e23",
    measurementId: "G-HCVFHMVHNX"
});

const messaging = firebase.messaging();

messaging.onBackgroundMessage((payload) => {
    console.log('[firebase-messaging-sw.js] Received background message ', payload);
    const notificationTitle = payload.notification.title;
    const notificationOptions = {
        body: payload.notification.body,
        icon: payload.notification.icon || '/favicon.ico'
    };

    self.registration.showNotification(notificationTitle, notificationOptions);
});
