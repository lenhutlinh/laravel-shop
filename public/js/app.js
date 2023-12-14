import './bootstrap';

import Alpine from 'alpinejs';
import Echo from 'laravel-echo';

window.Alpine = Alpine;

Alpine.start();

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: process.env.MIX_PUSHER_APP_KEY,
    cluster: process.env.MIX_PUSHER_APP_CLUSTER,
    encrypted: true,
});

window.Echo.channel('sendMessageToUser')
    .listen('SenMessageUser', (event) => {
        console.log('send-message-user:', event);
        // Xử lý dữ liệu từ sự kiện ở đây
    });