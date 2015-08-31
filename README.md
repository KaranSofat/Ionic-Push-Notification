Firstly Upload Ypur app: ionic upload
=====================================================================================================
Install plugins:

ionic plugin add https://github.com/phonegap-build/PushPlugin.git
ionic add ngCordova
ionic add ionic-service-core
ionic add ionic-service-push
ionic add angular-websocket


===========================================================================================================
If $windows error is come:

ionic config set dev_push true //for only testing in browsers

ionic config set dev_push false //for only testing in mobiles

==========================================================================================================
Andriod Setup:

ionic push --google-api-key your-google-api-key

ionic config set gcm_key <your-gcm-project-number>

==============================================================================================================
Private key is your secret key you will find this under setting in ionic apps: https://apps.ionic.io/app/3f78d153/config/keys
=======================================================================================================================
For more info:
http://docs.ionic.io/docs/push-android-setup
http://devdactic.com/ionic-push-notifications/
