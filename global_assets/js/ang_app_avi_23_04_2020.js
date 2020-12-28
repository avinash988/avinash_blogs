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

app.directive("travelOption", ($compile, $parse) => {
  return {
    restrict: "E",
    replace: true,
    templateUrl: "templates/travel_option.html",
    scope: {
      optOptionNum: "@optOptionNum"
    },
    controller: "holidays_controller",
    link: (scope, element, attributes) => {
      // remove travel option
      scope.removetraveloption = () => {
        element.remove();
      };

      // add origin destination travel option
      scope.add_org_des_option = () => {
        angular
          .element(element[0])
          .append(
            $compile(
              "<org-dest-option opt-option-num='" +
                scope.optOptionNum +
                "'></org-dest-option>"
            )(scope)
          );
      };
    }
  };
});

// directive for origin and destination under travel option tab
app.directive("orgDestOption", $compile => {
  return {
    require: "^travelOption",
    //require: "^?div.org_dest_body",
    restrict: "E",
    replace: true,
    templateUrl: "templates/origin_destination.html",
    scope: true,
    controller: "holidays_controller",
    link: (scope, element, attr) => {
      scope.remove_org_des_option = () => {
        element.remove();
      };
    }
  };
});

// contact details add more
app.directive("contactDetailsMobile", $compile => {
  return {
    restrict: "E",
    replace: true,
    templateUrl: "templates/contact_details_mobile.html",
    scope: {},
    controller: "holidays_controller",
    link: (scope, element, attributes) => {
      // remove travel option
      scope.remove_mobile_number = () => {
        element.remove();
      };
    }
  };
});

// contact TELEPHONE NUMBER add more
app.directive("contactDetailsTel", $compile => {
  return {
    restrict: "E",
    replace: true,
    templateUrl: "templates/contact_details_tel.html",
    scope: {},
    controller: "holidays_controller",
    link: (scope, element, attributes) => {
      // remove travel option
      scope.remove_tel_number = () => {
        element.remove();
      };
    }
  };
});

// contact TELEPHONE NUMBER add more
app.directive("contactDetailsEmail", $compile => {
  return {
    restrict: "E",
    replace: true,
    templateUrl: "templates/contact_details_email.html",
    scope: {},
    controller: "holidays_controller",
    link: (scope, element, attributes) => {
      // remove travel option
      scope.remove_email = () => {
        element.remove();
      };
    }
  };
});

app.controller("holidays_controller", ($scope, $compile, $http, $window) => {
  /*======================================================== 
            Add Travel Option start here 
    =======================================================*/

  $scope.base_url = $("#base_url").val();

  //$scope.travel_option_list = [];

  $scope.load = () => {
    $scope.travel_option_list = [1];
  };

  $scope.option_list = [];
  $scope.opt_c = 1;

  //console.log($scope.travel_option_list);

  $scope.add_travel_option = () => {
    $scope.text = $scope.travel_option_list.length + 1;
    $scope.opt_c++;
    $scope.option_list.push($scope.opt_c);
    $scope.travel_option_list.push($scope.text);

    console.log($scope.travel_option_list);
    console.log($scope.opt_c);

    var compiledeHTML = $compile(
      "<travel-option opt-option-num='" + $scope.opt_c + "'></travel-option>"
    )($scope);

    $("#travel_opt_list_body:last").append(compiledeHTML);
  };

  /*======================================================== 
            Add Travel Option END here 
    =======================================================*/

  /*======================================================== 
            INLINE ORIGIN DESTINATION start here 
    =======================================================*/

  $scope.add_mobile = () => {
    var compiledeHTML = $compile(
      "<contact-details-mobile></contact-details-mobile>"
    )($scope);

    $(".mobile_num_body").append(compiledeHTML);
  };

  $scope.add_tel = () => {
    var compiledeHTML = $compile("<contact-details-tel></contact-details-tel>")(
      $scope
    );

    $(".tel_num_body").after(compiledeHTML);
  };

  $scope.add_email = () => {
    var compiledeHTML = $compile(
      "<contact-details-email></contact-details-email>"
    )($scope);

    $(".email_contact_body").after(compiledeHTML);
  };

  /*======================================================== 
            INLINE ORIGIN DESTINATION start here 
    =======================================================*/

    $scope.service_list = [
                            { name:'Hotels' }, 
                            { name:'Flights'}, 
                            { name:'Sightseeing & Activities' }, 
                            { name:'Car Services' }, 
                            { name:'Meal Plan' },
                            { name:'Airport Transfer' },
                            { name:'Visa Services' },
                            { name:'Train Services' },
                            { name:'Reason for Travel' },
                            { name:'Guide Services' },
                            { name:'Cruise Services' }
                           ];

    $scope.formData = {};
    $scope.formData1 = {};

      // first stage process form
      $scope.processForm = function() {

        var services = [];
            angular.forEach($scope.service_list, function (value, key) {
                if ($scope.service_list[key].selected == $scope.service_list[key].name) {
                    services.push($scope.service_list[key].selected);
                }
            });

            // SHOW THE SELECTED ITEMS IN THE EXPRESSION.
            if (services.length > 0)
                $scope.the_selected_services = services.toString();
            else
                $scope.the_selected_services = 'Please choose an option';


        $http({
              method      : 'POST',
              url         : $scope.base_url + "leads/first_stage_form_submit/",
              data        : {
                              selected_list: $scope.the_selected_services,
                              data: $scope.formData,
                              details: $scope.formData1
                            },
              dataType    : 'json',
              headers     : { 'Content-Type': 'application/x-www-form-urlencoded' }  // set the headers so angular passing info as form data (not request payload)
          })
              .then(function(response) 
              {
                var case_no = response.data.case_no;
                console.log('result == '+response.data.case_no)
                window.location = 'leads/second_form/'+case_no;
              });
      };


      // second stage process form
      $scope.secondForm = function() {

        $http({
              method      : 'POST',
              url         : $scope.base_url + "leads/second_stage_form_submit/",
              data        : {
                              data: $scope.formData
                            },
              dataType    : 'json',
              headers     : { 'Content-Type': 'application/x-www-form-urlencoded' }  // set the headers so angular passing info as form data (not request payload)
          })
              .then(function(data) {

                  console.log(data);
              
              });
      };


      // third stage process form
      $scope.thirdForm = function() {

        $http({
              method      : 'POST',
              url         : $scope.base_url + "leads/third_stage_form_submit/",
              data        : {
                              data: $scope.formData
                            },
              dataType    : 'json',
              headers     : { 'Content-Type': 'application/x-www-form-urlencoded' }  // set the headers so angular passing info as form data (not request payload)
          })
              .then(function(data) {

                  console.log(data);
              
              });
      };



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
