var GoogleMap = (function() {
    var instance = null;

    function Constructor() {
        var map = new google.maps.Map(document.getElementById("map"), myOptions);
        this.getMap = function() {
            return map;
        }
    }

    return new function() {
        this.getInstance = function() {
            if (instance == null) {
                instance = new Constructor();
                instance.constructor = null;
            }
            return instance;
        }
    }
})();

var map = GoogleMap.getInstance();