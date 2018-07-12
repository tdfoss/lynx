self.addEventListener('push', function(event) {
    var apiPath = 'browser_pn?endpoint=';
    event.waitUntil(
        registration.pushManager.getSubscription()
        .then(function(subscription) {
            if (!subscription || !subscription.endpoint) {
                throw new Error();
            }
            apiPath = apiPath + encodeURI(subscription.endpoint);

            return fetch(apiPath)
            .then(function(response) {
                if (response.status !== 200){
                    console.log("Problem Occurred:"+response.status);
                    throw new Error();
                }
                return response.json();
            })
            .then(function(data) {
                if (data.status == 0) {
                    console.error('The API returned an error.', data.error.message);
                    throw new Error();
                }

                var title = data.notification.title;
                var message = data.notification.message;
                var icon = data.notification.icon;
                var data = {
                    url: data.notification.url
                };

                return self.registration.showNotification(title, {
                    body: message,
                    icon: icon,
                    data: data
                });

            })
            .catch(function(err) {
                console.log(err);
                return self.registration.showNotification('Notifications', {
                    body: 'There is an upcoming event!',
                    icon: 'images/notification.png',
                    data: {
                        url: "/"
                    }
                });
            });
        })
        );
});

self.addEventListener('notificationclick', function(event) {
    event.notification.close();
    var url = event.notification.data.url;
    event.waitUntil(
        clients.matchAll({
            type: "window"
        })
        .then(function(clientList) {
            for (var i = 0; i < clientList.length; i++) {
                var client = clientList[i];
                if (client.url == '/' && 'focus' in client)
                    return client.focus();
            }
            if (clients.openWindow) {
                return clients.openWindow(url);
            }
        })
        );
});
