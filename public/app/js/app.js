(function() {

    var
            httpHeaders,
            message,
            as = angular.module('myApp', ['myApp.filters', 'myApp.services', 'myApp.directives', 'myApp.controllers']);

    as.value('version', '1.0.7');

    as.config(function($routeProvider, $httpProvider) {
        $routeProvider
                .when('/users', {templateUrl: 'partials/users.html', controller: 'UserListCtrl'})
                .when('/new', {templateUrl: 'partials/new.html', controller: 'NewUserCtrl'})
                .otherwise({redirectTo: '/'});

    });

    as.config(function($httpProvider) {


        $httpProvider.responseInterceptors.push(
                function($q) {
                    console.log('call response interceptor and set message...');
                    var setMessage = function(response) {

                        if (response.data.message) {
                            message = {
                                text: response.data.message.text,
                                type: response.data.message.type,
                                show: true
                            };
                        }
                    };
                    return function(promise) {
                        return promise.then(

                                        function(response) {
                                            setMessage(response);
                                            return response;
                                        },

                                                function(response) {
                                                    setMessage(response);
                                                    return $q.reject(response);
                                                }
                                        );
                                    };
                        });
                       
            });

        }());
