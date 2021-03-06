(function() {
    var as = angular.module('myApp.controllers', []);
    as.controller('AppCtrl', function($scope, $rootScope, $http, i18n, $location) {
        $scope.language = function() {
            return i18n.language;
        };
        $scope.setLanguage = function(lang) {
            i18n.setLanguage(lang);
        };
        $scope.activeWhen = function(value) {
            return value ? 'active' : '';
        };

        $scope.path = function() {
            return $location.url();
        };

        $rootScope.appUrl = "http://127.0.0.1:8000/api/v1";

    });

    as.controller('UserListCtrl', function($scope, $rootScope, $http, $location) {
        var load = function() {
            console.log('call load()...');
            $http.get($rootScope.appUrl + '/user')
                    .success(function(data, status, headers, config) {
                        $scope.users = data.data;
                        angular.copy($scope.users, $scope.copy);
                    });
        }

        load();

        $scope.addUser = function() {
            console.log('call addUser');
            $location.path("/new");
        }

    });

    as.controller('NewUserCtrl', function($scope, $rootScope, $http, $location) {

        $scope.users = {};
        $scope.saveUser = function() {
            console.log('call saveUser');

            // check to make sure the form is completely valid
            if ($scope.userForm.$valid) {
                console.log('call userForm is Valid');

                $http.post($rootScope.appUrl + '/user', $scope.user)
                        .success(function(data, status, headers, config) {

                            if (!data.errors) {
                                console.log('success...');
                                $scope.messages = 'Your Registration has been sent!';
                            }else{

                                angular.forEach(data.errors,function(errors,index){
                                    alert(index);

                                    $scope.error_messages = 'There appears to be an issue with your ' + index;
                                })
                            }

                            // $location.path('/users');
                        })
                        .error(function(data, status, headers, config) {
                             console.log('error...');
                        });
            }

        };
    });

}());