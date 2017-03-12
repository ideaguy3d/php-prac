/**
 * Created by Julius Alvarado on 3/11/2017.
 */
(function () {
    var app = angular.module('app', []);
    app.factory('jNoteDb', ['$http',
        function ($http) {
            var noteDbServicePath = 'services/note-db-ser.php?';
            var updateNotes = function (data) {
                return $http.get(noteDbServicePath + 'email=' + data.email + '&content=' + data.content);
            };
            var getNotes = function (data) {
                console.log('jha - getNotes invoked');
                return $http.get(noteDbServicePath + 'notes=fetch&email=' + data.email);
            };
            return {
                updateNotes: updateNotes,
                getNotes: getNotes
            }
        }
    ]);
    app.controller('CoreCtrl', ['$scope', 'jNoteDb', CoreCtrlClass]);

    function CoreCtrlClass($scope, jNoteDb) {
        var vm = this;
        vm.notes = '';
        vm.data = {
            content: 'empty',
            email: 'user2@mail.com'
        };
        //-- watch the text area in real time
        $scope.$watch(angular.bind(vm, function () {
            return vm.notes;
        }), function (newVal, oldVal) {
            vm.data.content = newVal;
            jNoteDb.updateNotes(vm.data);
        });
        activate();
        function activate() {
            jNoteDb.getNotes(vm.data).then(function (res) {
                if (vm.notes == '') {
                    vm.notes = res.data;
                }
            });
        }
    }
}());


//