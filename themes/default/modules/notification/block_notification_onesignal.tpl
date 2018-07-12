<!-- BEGIN: main -->
<link rel="manifest" href="/themes/default/js/onesignal/manifest.json" />
<script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>
<script>
    var OneSignal = window.OneSignal || [];
    OneSignal.push(function() {
        OneSignal.init({
            appId : "086cd0a2-9a7a-428b-baa1-3c979d183fa0",
            autoRegister : false,
            notifyButton : {
                enable : true,
            },
            showCredit : false,
            promptOptions : {
                /* actionMessage limited to 90 characters */
                actionMessage : "Bạn cần cho phép hoạt động này để nhận được thông báo nhanh từ hệ thống",
                /* acceptButtonText limited to 15 characters */
                acceptButtonText : "CHO PHÉP",
                /* cancelButtonText limited to 15 characters */
                cancelButtonText : "KHÔNG, CẢM ƠN"
            }
        });
        
        OneSignal.showHttpPrompt();
        
        OneSignal.on('subscriptionChange', function(isSubscribed) {
            if (isSubscribed) {
                OneSignal.getUserId(function(userId) {
                    $.ajax({
                        type : 'POST',
                        url : '{MAIN_URL}&nocache=' + new Date().getTime(),
                        data : 'savePlayer=1&playerID=' + userId,
                        success : function(data) {
                            //
                        }
                    });
                });
            }
        });
    });
</script>
<!-- END: main -->