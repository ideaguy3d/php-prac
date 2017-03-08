/**
 * Created by Julius Alvarado on 3/7/2017.
 */
(function(){
    var app = angular.module('app', []);

    app.controller ('CountryCtrl', [function(){
        var vm = this;

        vm.countries = [
            {
                name: 'Germany',
                code: 'de',
                states: [{ name: 'Bavaria'}, {name: 'Berlin'}]
            },
            {
                name: 'United States',
                code: 'us',
                states: [{ name: 'California'}, {name: 'Maryland'}]
            },
            {
                name: 'Luxembourg',
                code: 'lu'
            }];


    }]);
}());