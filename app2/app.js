/**
 * Created by Julius Alvarado on 3/7/2017.
 */
(function () {
    var app = angular.module('app', ['ngRoute']);

    app.factory('jDataService', ['$http',
        function ($http) {
            var baseUrl = 'services';

            return {
                getCountries: $http.get(baseUrl+'/getCountries.php'),
                getStates: function(countryCode){
                    return $http.get(baseUrl+'/getStates.php?countryCode='+
                        encodeURIComponent(countryCode));
                }
            }
        }
    ]);

    app.config(function($routeProvider){
        $routeProvider.when('/states/:countryCode', {
            templateUrl: 'state.view.html',
            controller: function($routeParams, jDataService){
                var vm = this;
                vm.newState = '';
                vm.params = $routeParams;

                jDataService.getStates(vm.params.countryCode || '')
                    .then(function(res){
                        vm.states = res.data;
                    }
                );

                vm.addStateTo = function(){
                    if(!vm.states) vm.states = [];
                    vm.states.push({name: vm.newState});
                    vm.newState = '';
                }
            },
            controllerAs: 'stateCtrl'
        });
    });

    app.controller('CountryCtrl', ['jDataService',
        function (jDataService) {
            var vm = this;
            vm.countries = '';

            jDataService.getCountries.then(function (res) {
                vm.countries = res.data;
            });
        }
    ]);

    app.controller('StateCtrl', [
        function() {
            var vm = this;

            vm.addStateTo = function(country) {
                if(!country.states) {
                    country.states = [];
                }

                country.states.push({name: vm.newState});
                vm.newState = '';
            }
        }
    ]);
}());