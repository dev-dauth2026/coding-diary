import './bootstrap';
import './echo';

// Get the authenticated user ID and role from the meta tags in the Blade layout

const userId = document.head.querySelector('meta[name="user-id"]').content;
const userRole = document.head.querySelector('meta[name="user-role"]').content;

if (!userId || !userRole) {
    alert('User ID or Role not found in meta tags.');
}else {
    let channel = userRole === 'admin' ? `App.Models.Admin.${userId}` : `App.Models.User.${userId}`;

    Echo.private(channel)
        .notification((notification) => {
            // Delay alert slightly to ensure content is ready
            setTimeout(() => {
                showNotificationAlert(notification.sender_name); // Show notification alert

            }, 100);

            // Example: Update unread message count in the UI
            const unreadCountElement = document.getElementById('unread-count');
            if (unreadCountElement) {
                unreadCountElement.textContent = parseInt(unreadCountElement.textContent) + 1;
            }
        });
}

// Function to display the notification alert
function showNotificationAlert(message) {
    const alertBox = document.getElementById('notification-alert');
    const messageBox = document.getElementById('notification-message');
    messageBox.textContent = `New Message from ${message}`;

    // Show the alert
    alertBox.classList.add('show');

    // Hide the alert after 5 seconds
    setTimeout(() => {
        alertBox.classList.remove('show');
    }, 5000);
}
