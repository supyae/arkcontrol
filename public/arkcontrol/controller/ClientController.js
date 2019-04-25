angular.module('arkControl')
    .controller('ClientCtrl', ['$auth', '$state', '$http', '$rootScope', '$localStorage', '$scope', 'ClientFactory', '$uibModal',
        function ($auth, $state, $http, $rootScope, $localStorage, $scope, ClientFactory, $uibModal) {

            $scope.loading = true;

            $scope.setPage = function () {
                //console.log('c page' + $scope.currentPage);
                $scope.init();
            };

            /** Get all client companies ========== */
            $scope.init = function () {
                $scope.clients = [];
                $scope.totalPages = 0;
                if (!$scope.currentPage) {
                    $scope.currentPage = 1;
                }

                ClientFactory.getClients($scope.currentPage)
                    .then(function successCallBack(response) {

                            console.log(response.data.record);

                            $scope.clients = response.data.record.data;
                            $scope.totalPages = response.data.record.last_page;

                            $scope.loading = false;

                            //////////
                            $scope.totalItems = response.data.record.total;

                            $scope.itemsPerPage = 10;

                            // Pagination Range
                            var pages = [];

                            for (var i = 1; i <= response.data.record.last_page; i++) {
                                pages.push(i);
                            }

                            $scope.range = pages;
                        },
                        function errorCallback(response) {
                            console.log(response);
                        });
            };

            /** Get Client Detail ======== */
            $scope.clientDetail = function (id) {
                $scope.loading = true;
                /** Route to specific template for single page application ===== */
                $state.go('getClient', {'client_id': id}); // with state
            };

            /** Add New Client ======== */
            $scope.saveClient = function (state, id) {
                if ($localStorage.token == null) {
                    $state.go('login');
                } else {
                    $scope.state = state;
                    switch (state) {
                        //show the popup to add new
                        case 'add':
                            var modalInstance = $uibModal.open({
                                animation: true,
                                templateUrl: 'views/client/form.html',
                                controller: 'ConfirmModalCtrl',
                                backdrop: 'static',
                                size: 'lg',
                                resolve: {
                                    data: function () {
                                        return {};
                                    },
                                    mode: function () {
                                        return state; //add
                                    }
                                }
                            });
                            modalInstance.result.then(function (res) {
                                $scope.init();
                            });
                            return modalInstance;
                        case 'edit' :
                            ClientFactory.getClient(id)
                                .then(function successCallBack(response) {
                                        console.log('Client detail');
                                        //console.log(response.data);
                                        $scope.data = angular.copy(response.data.record);
                                        modalInstance = $uibModal.open({ //inside this or use setTimeout(function() { ....},200);
                                            animation: true,
                                            templateUrl: 'views/client/form.html',
                                            controller: 'ConfirmModalCtrl',
                                            backdrop: 'static',
                                            size: 'lg',
                                            resolve: {
                                                data: function () {
                                                    return $scope.data;
                                                },
                                                mode: function () {
                                                    return state; //edit  (update existing)
                                                }
                                            }
                                        });
                                        modalInstance.result.then(function (res) {
                                            $scope.init();
                                        });
                                    },
                                    function errorCallback(response) {
                                        console.log(response);
                                    });
                            return modalInstance;


                    }
                }
            };
        }])
    .controller('ConfirmModalCtrl', ['$uibModalInstance', 'ClientFactory', '$scope', '$http', '$rootScope', '$localStorage', 'mode', 'data',
        function ($uibModalInstance, ClientFactory, $scope, $http, $rootScope, $localStorage, mode, data) {

            $scope.selectors = {};
            $scope.title = mode;

            if (mode === "edit") {
                $scope.data = data;
            }

            getSelectors();

            function getSelectors() {
                $http.get("api/client/selector")
                    .then(function successCallBack(response) {
                        if (!$scope.data) {
                            $scope.data = {};
                            $scope.data.country_id = '';
                            $scope.data.business_id = '';
                            $scope.data.deployment_id = '';
                        }

                        $scope.selectors.countries = [{'id': '', 'name': 'Select'}];
                        $scope.selectors.business = [{'id': '', 'name': 'Select'}];
                        $scope.selectors.deployment = [{'id': '', 'name': 'Select'}];

                        angular.forEach($scope.selectors, function (value, key) {
                            $scope.selectors[key].push(response.data[key]);
                            //array flatten ([1,2], [3]) to ([1,2,3]);
                            $scope.selectors[key] = [].concat.apply([], $scope.selectors[key]);

                        });
                    });
            }

            $scope.cancel = function () {
                $uibModalInstance.dismiss();
            };

            $scope.saveClient = function (state, id) {
                console.log(state);
                if ($localStorage.token == null) {
                    $state.go('login');
                } else {
                    $scope.state = state;
                    switch (state) {
                        case 'add':
                            ClientFactory.storeClient(state, $scope.data)
                                .then(function successCallBack(response) {
                                    $uibModalInstance.close(response.data);

                                }, function errorCallback(error) {
                                    setErrorMessages(error);
                                });
                            break;

                        case 'edit' :
                            ClientFactory.storeClient(state, $scope.data, id)
                                .then(function successCallBack(response) {
                                    $uibModalInstance.close(response.data);

                                }, function errorCallback(error) {
                                    setErrorMessages(error);
                                });
                            break
                    }
                }
            };

            function setErrorMessages(error) {
                console.log(error);
                $scope.errors = error.data.meta.messages;
                $scope.name_ERROR = error.data.meta.messages.name;
                $scope.address_ERROR = error.data.meta.messages.address;
                $scope.contact_person_name_ERROR = error.data.meta.messages.contact_person_name;
                $scope.contact_person_phone_ERROR = error.data.meta.messages.contact_person_phone;
                $scope.contact_person_email_ERROR = error.data.meta.messages.contact_person_email;
                $scope.country_id_ERROR = error.data.meta.messages.country_id ? "You need to choose country" : '';
                $scope.business_id_ERROR = error.data.meta.messages.business_id ? "You need to choose business type" : '';
                $scope.deployment_id_ERROR = error.data.meta.messages.deployment_id ? "You need to choose deployment site" : '';
            }

        }]);