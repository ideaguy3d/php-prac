/**
 * Created by Julius Alvarado on 3/11/2017.
 */
(function () {
    var app = angular.module('app', []);
    app.factory('jNoteDb', ['$http',
        function ($http) {
            var updateNoteDb = function (data) {
                $http.get('services/note-db-ser.php?email='+data.email+'&content='+data.content)
                    .then(function (res) {
                        console.log(res);
                    });
            };
            return {
                updateNoteDb: updateNoteDb
            }
        }
    ]);
    app.controller('CoreCtrl', ['$scope', 'jNoteDb',
        function ($scope, jNoteDb) {
            var vm = this;
            vm.notes = '';
            $scope.$watch(angular.bind(vm, function () {
                return vm.notes;
            }), function (newVal, oldVal) {
                jNoteDb.updateNoteDb({
                    content: newVal,
                    email: 'user1@mail.com'
                });
            });
        }
    ])
}());


//