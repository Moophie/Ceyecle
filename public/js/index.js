if (device_key.length == 0) {
    const notif_permission = confirm('Do you want to allow Ceyecle to send notifications?');

    if (notif_permission == true) {
        var firebaseConfig = {
            apiKey: "AIzaSyBof_7d27cEczJNHt1NMlQcdDSOmzPycEY",
            authDomain: "ceyecle-7ecca.firebaseapp.com",
            projectId: "ceyecle-7ecca",
            storageBucket: "ceyecle-7ecca.appspot.com",
            messagingSenderId: "899643117549",
            appId: "1:899643117549:web:9e17f990258f76f0ba21e4"
        };

        firebase.initializeApp(firebaseConfig);
        const messaging = firebase.messaging();

        startFCM();
        function startFCM() {
            messaging
                .requestPermission()
                .then(function () {
                    return messaging.getToken()
                })
                .then(function (response) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: '/store-token',
                        type: 'POST',
                        data: {
                            token: response
                        },
                        dataType: 'JSON',
                        success: function (response) {
                        },
                        error: function (error) {
                            alert(error);
                        },
                    });

                }).catch(function (error) {
                    alert(error);
                });
        }

        messaging.onMessage(function (payload) {
            const title = payload.notification.title;
            const options = {
                body: payload.notification.body,
                icon: payload.notification.icon,
            };
            new Notification(title, options);
        });
    }
}

