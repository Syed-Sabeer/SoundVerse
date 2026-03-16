import Echo from 'laravel-echo';

window.Pusher = require('pusher-js');

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: process.env.MIX_PUSHER_APP_KEY,
    cluster: process.env.MIX_PUSHER_APP_CLUSTER,
    forceTLS: true,
    authEndpoint: '/broadcasting/auth',
    auth: {
        headers: {
            'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content,
        }
    }
});

const userId = 60;

window.Echo.private(`bpm-channel.${userId}`)
    .listen('bpm-updated', (e) => {
        console.log('✅ Full Event:', e);
        if (e.bpm) {
            console.log('🎵 BPM:', e.bpm);
        } else {
            console.log('⚠️ BPM not found in event data');
        }
    });

