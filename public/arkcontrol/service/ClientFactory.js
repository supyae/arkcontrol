angular.module('arkControl')
    .factory('ClientFactory', ['$http', '$uibModal', function ($http, $uibModal, $scope) {

        return {
            getClients: function (pageNum) {
                return $http.get('api/client/all?page=' + pageNum);
            },
            getClient: function (id) {
                return $http.get('api/client/get/' + id);
            },
            storeClient: function (state, data, id) {
                var apiurl = "";
                var type = "";
                switch (state) {
                    case 'add' :
                        apiurl = "api/client/create";
                        type = "POST";
                        break;
                    case 'edit' :
                        apiurl = "api/client/update/" + id;
                        type = "PUT";
                }

                return $http({
                    method: type,
                    url: apiurl,
                    data: data
                });
            }
        }
    }]);