/*=============================================================================================
===============================================================================================
Name            :   BREEZER | HOLIDAYS
Overview        :   Complete 360 Solution for Holidays Division
Created By      :   Purvesh Bhavsar
Created date    :   02-March-2020
Version         :   v1.0
Developed By    :   Purvesh Bhavsar & Avinash Choudhary
===============================================================================================
===============================================================================================*/

var app = angular.module("holidaysApp", []);

app.directive("testDirect", function() {
  return {
    template: "This is the test"
  };
});

app.directive("travelOption", function($compile) {
  return {
    restrict: "E",
    replace: true,
    templateUrl: "test.html",
    scope: {
      optOptionNum: "@optOptionNum"
    },
    controller: "holidays_controller",
    link: function(scope, element, attributes) {
      // remove option
      scope.removetraveloption = function() {
        alert("Remove Clicked");

        var myIndex,
          siblings = element.parent().children(),
          numSiblings = siblings.length;

        console.log("---- sibling -----");
        //console.log(siblings);

        console.log("---- num of sibling -----");
        //console.log(numSiblings);

        scope.$$nextSibling.optOptionNum = scope.$$nextSibling.optOptionNum - 1;

        element.remove();

        console.log("---- after remove scope -----");
        //console.log(scope);

        //console.log(siblings[0].attributes["opt-option-num"].value);

        siblings[0].attributes["opt-option-num"].value = "Purvesh";
        scope.test_ftn();
      };
    }
  };
});

app.controller("holidays_controller", ($scope, $compile, $http, $window) => {
  $scope.option_list = [1];

  console.log($scope.option_list.length);

  console.log($scope.option_list);

  $scope.add_travel_option = function() {
    $scope.text = $scope.option_list.length + 1;
    //$scope.text++;
    $scope.option_list.push($scope.text);
    $scope.option_list = $scope.option_list;
    $scope.safeApply();
    console.log($scope.option_list);
    var compiledeHTML = $compile(
      "<travel-option opt-option-num='" + $scope.text + "'></travel-option>"
    )($scope);
    $("#travel_opt_list_body").append(compiledeHTML);
  };

  $scope.test_ftn = function() {
    var num_sib = $("div.opt_body").siblings().length;
    alert(num_sib);
    var sib = $("div.opt_body").siblings();

    //console.log($compile);

    $scope.option_list.splice(1, 1);

    $scope.safeApply();

    console.log($scope.option_list);
  };

  $scope.safeApply = function(fn) {
    var phase = this.$root.$$phase;
    if (phase == "$apply" || phase == "$digest") {
      if (fn && typeof fn === "function") {
        fn();
      }
    } else {
      this.$apply(fn);
    }
  };

  $scope.reset_opt_list = function() {};
});

/* 
var myApp = angular.module('myApp', []);

function MainCtrl($scope) {
  $scope.count = 0;
}

//Directive that returns an element which adds buttons on click which show an alert on click
myApp.directive("addbuttonsbutton", function () {
  return {
    restrict: "E",
    template: "<button addbuttons>Click to add buttons</button>"
  }
});

//Directive for adding buttons on click that show an alert on click
myApp.directive("addbuttons", function ($compile) {
  return function (scope, element, attrs) {
    element.bind("click", function () {
      scope.count++;
      angular.element(document.getElementById('space-for-buttons')).append($compile("<div><button class='btn btn-default' data-alert=" + scope.count + ">Show alert #" + scope.count + "</button></div>")(scope));
    });
  };
});

//Directive for showing an alert on click
myApp.directive("alert", function () {
  return function (scope, element, attrs) {
    element.bind("click", function () {
      console.log(attrs);
      alert("This is alert #" + attrs.alert);
    });
  };
});
 */

/* 
(function (angular) {
  'use strict';
  angular.module('docsTemplateUrlDirective', [])
    .controller('Controller', ['$scope', '$compile', function ($scope, $compile) {

      $scope.showdiv = function () {
        var compiledeHTML = $compile("<div my-Customer></div>")($scope);
        $("#d").append(compiledeHTML);
      };
    }])
    .directive('myCustomer', function () {
      return {
        templateUrl: 'my-customer.html'
      };
    });
})(window.angular); */
