
(function(){
    var defaultForm = {
        name: "",
        phone: "",
        email: "",
        business_name: "",
        message: ""
    };

    angular.module("vector", [
        "ui.utils.masks"
    ]).controller("vector.controller", function($scope, $http){
            var _self = this;
            this.form = Object.assign({}, defaultForm);

            this.submit = function ($event){
                // TODO - form validation
                $event.preventDefault();

                $http.post("/api/contact", _self.form)
                    .then(function(res){
                        swal("Inquiry Sent!", "You'll hear back from us shortly!", "success");
                        _self.form = Object.assign({}, defaultForm);
                    }, function(err){
                        console.log(err);
                        switch(err.status){
                            case 400: return swal(err.data.msg, '', 'warning');
                            case 500: return swal("Oops.. something went wrong", '', 'error');
                        }
                    });
            }
        })
})();