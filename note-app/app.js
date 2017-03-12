/**
 * Created by Julius Alvarado on 3/11/2017.
 */
(function(){
    var app = angular.module('app', []);
    app.factory('jNoteDb', ['$http',
        function($http) {
            var updateNoteDb = function(data) {
                $http({
                    method: 'POST',
                    url: 'services/note-db-ser.php',
                    data: data}
                );
            };
            return {
                updateNoteDb: updateNoteDb
            }
        }
    ]);
    app.controller('CoreCtrl', ['$scope', 'jNoteDb',
        function($scope, jNoteDb) {
            var vm = this;
            vm.notes = '';
            $scope.$watch(angular.bind(vm, function() {
                return vm.notes;
            }), function(newVal, oldVal) {
                jNoteDb.updateNoteDb({content: newVal});
            });
        }
    ])
}());


//