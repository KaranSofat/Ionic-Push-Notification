// Ionic Starter App

// angular.module is a global place for creating, registering and retrieving Angular modules
// 'starter' is the name of this angular module example (also set in a <body> attribute in index.html)
// the 2nd parameter is an array of 'requires'
angular.module('starter', ['ionic', 'ngCordova', 'ionic.service.core', 'ionic.service.push'])

.run(function($ionicPlatform,$ionicUser, $ionicPush,$rootScope,$http,$window, $stateParams) {
  $ionicPlatform.ready(function() {
    // Hide the accessory bar by default (remove this to show the accessory bar above the keyboard
    // for form inputs)
    if(window.cordova && window.cordova.plugins.Keyboard) {
      cordova.plugins.Keyboard.hideKeyboardAccessoryBar(true);
    }
    if(window.StatusBar) {
      StatusBar.styleDefault();
    }
    
  
    var user = $ionicUser.get();
     if(!user.user_id) {
     // Set your user_id here, or generate a random one.
     user.user_id = $ionicUser.generateGUID();
     };
     
     
     // Identify your user with the Ionic User Service
     $ionicUser.identify(user).then(function(){
     //$scope.identified = true;
     //alert('User ID ' + user.user_id);
     //alert("here");
     $ionicPush.register({
      canShowAlert: true, //Can pushes show an alert on your screen?
      canSetBadge: true, //Can pushes update app icon badges?
      canPlaySound: true, //Can notifications play a sound?
      canRunActionsOnWake: true, //Can run actions outside the app,
      onNotification: function(notification,event) {
      if(notification.foreground === false){
         alert(notification.payload.path);
    //put here your logic to go in any state
  }
  else
  {
  alert("a");
  }
  
     /* if(notification.foreground) {
        //do something for the case where user is using the app.
       // $popup('A notification just arrived');
      } else {
        //do something for the case where user is not using the app.
       // $location.path('/tab/somepage');
      }*/
      
    
    
      
      
        // Handle new push notifications here
        // console.log(notification);
        return true;
      }
     });
     });
    
    
    
  });
})

.config(['$ionicAppProvider', function($ionicAppProvider) {
  $ionicAppProvider.identify({
    app_id: '3f78d153',
    api_key: '97453ff616474314318a3df7dc498a4dbf6b16797e346c16',
    dev_push: false
  });
}])

.controller('PushCtrl', function($scope, $rootScope, $ionicUser, $ionicPush) {

  $rootScope.$on('$cordovaPush:tokenReceived', function(event, data) {
    alert('Success: ' + data.token);
    console.log('Got token: ' , data.token, data.platform);
    $scope.token = data.token;
  });

  $scope.identifyUser = function() {
    var user = $ionicUser.get();

    if (!user.user_id) {
      user.user_id = $ionicUser.generateGUID();
    }

    angular.extend(user, {
      name: 'My Name',
      bio: 'I am awesome'
    });

    $ionicUser.identify(user).then(function() {
      $scope.identified = true;
      console.log('name: ' + user.name + "--- Id: " + user.user_id);
    });
  };

  $scope.pushRegister = function() {
    $ionicPush.register({
      canShowAlert: true,
      canSetBadge: true,
      canPlaySound: true,
      canRunActionsOnWake: true,
      onNotification: function(notification) {
        // handle your stuff
        return true;
      }
    });
  };
});
