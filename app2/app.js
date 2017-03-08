/**
 * Created by Julius Alvarado on 3/7/2017.
 */
(function () {
    var app = angular.module('app', []);

    app.factory('jDataService', ['$http',
        function ($http) {
            var baseUrl = 'services';

            return {
                getCountries: $http.get(baseUrl+'/getCountries.php')
            }
        }
    ]);

    app.controller('CountryCtrl', ['jDataService',
        function (jDataService) {
            var vm = this;
            vm.countries = '';

            jDataService.getCountries.then(function (res) {
                vm.countries = res.data;
                console.log(res.data);
            })
        }
    ]);
}());