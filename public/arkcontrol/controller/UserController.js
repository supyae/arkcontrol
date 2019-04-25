angular.module('arkControl')
    .controller('UserCtrl', function ($auth, $state, $http, $rootScope, $scope, $localStorage) {
        $scope.loginError = false;
        $scope.loginErrorText = '';

        this.login = function () {

            $scope.authenticated = false;

            /****************** Login Feature ****************************/
            var credentials = {
                userid: this.userid,
                password: this.password
            };
            console.log('login controller');
            console.log(credentials);

            $auth.login(credentials).then(function (response) {
                // //go to server side for authentication;
                /****** Main For Http Header Authorization ********/
                console.log(response.data.record.token);
                if (response.data && response.data.record.token) {
                    $localStorage.token = response.data.record.token;
                }
                return $http.get('api/user/authenticated');

            }, function (error) {
                $scope.loginError = true;
                $scope.loginErrorText = "Invalid User";
                $scope.authenticated = false;

            })
                .then(function (response) {
                    var user = JSON.stringify(response.data.record);

                    $scope.token = $localStorage.token;

                    $rootScope.authenticated = true;

                    $rootScope.currentUser = response.data.record;

                    $scope.currentUser = response.data.record;
                    // console.log('current scope user');
                    // console.log($scope.currentUser);

                    $state.go('/');

                });
        };


        /****************** Logout Feature ****************************/

        $scope.logout = function () {
            $http.post('api/user/logout')
                .then(function successCallBack(response) {

                    // Flip authenticated to false so that we no longer
                    // show UI elements dependant on the user being logged in
                    $rootScope.authenticated = false;

                    // Remove the current user info from rootScope
                    $rootScope.currentUser = null;

                    delete $localStorage.currentUser;
                    delete $localStorage.token;
                    $http.defaults.headers.common.Authorization = '';

                    $state.go('login');

                }, function errorCallback(error) {
                    console.log(error);
                });

        };

    });