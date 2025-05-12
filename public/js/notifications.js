function fetchNotifications() {
    fetch('/notifications/unread')
        .then(response => response.json())
        .then(data => {
            updateNotificationBadge(data.count);
            updateNotificationList(data.notifications);
        })
        .catch(error => console.error('Error:', error));
}

function updateNotificationBadge(count) {
    const badge = document.getElementById('notification-badge');
    if (badge) {
        badge.textContent = count;
        badge.style.display = count > 0 ? 'block' : 'none';
    }
}

function updateNotificationList(notifications) {
    const container = document.getElementById('notification-list');
    if (container) {
        container.innerHTML = '';
        notifications.forEach(notification => {
            const data = JSON.parse(notification.data);
            const item = document.createElement('div');
            item.className = 'notification-item';
            item.innerHTML = `
                <div class="notification-content">
                    <h6>${data.title}</h6>
                    <p>${data.message}</p>
                    <small>${new Date(notification.created_at).toLocaleString()}</small>
                </div>
            `;
            container.appendChild(item);
        });
    }
}

// Check for new notifications every 30 seconds
setInterval(fetchNotifications, 30000);
// Initial fetch
document.addEventListener('DOMContentLoaded', fetchNotifications);