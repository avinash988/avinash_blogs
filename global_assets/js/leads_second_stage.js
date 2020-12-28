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

app.controller("holidays_controller", ($scope, $compile, $http, $window) => {

    // onload 
    $scope.load = function () {
        $scope.base_url = $scope.base_url;

        $scope.contact_details_list = [{ "mobile": [{}] }, { "tel": [{}] }, { "email": [{}] }];

        $scope.mobile_numbers = [];
        $scope.tel_numbers = [];
        $scope.email_ids = [];
        $scope.tra_opt = [];

        $scope.airport_transfer_list = [{ "airport": [{}] }];

        $scope.travel_from = [];
        $scope.travel_to = [];
        $scope.round = [];


        // Add Travel Option

        $scope.users = [{ "my": [{}] }];
        // $scope.users1 = [{ "my1": [{}] }];

        $scope.formData = {};

        $scope.from = [];
        $scope.destination = [];
        $scope.num_nights = [];

        $scope.service_list = [];

        //$scope.service_master();
    }

    /*======================================================== 
              Add Travel Option start here 
      =======================================================*/



    $scope.add_option = () => {
        var newUser = {};
        $scope.users[0].my.push(newUser);
    }

    $scope.remove_option = (sr, ind) => {
        var index = $scope.users[0].my.indexOf(sr);
        $scope.users[0].my.splice(index, 1);
    };

    /*======================================================== 
              Add Travel Option END here 
      =======================================================*/

    /*======================================================== 
              INLINE ORIGIN DESTINATION start here 
      =======================================================*/

    $scope.add_mobile = () => {

        var newUser = {};
        $scope.contact_details_list[0].mobile.push(newUser);
        console.log($scope.contact_details_list);
    };


    $scope.remove_mobile_number = (sr, ind) => {
        var index = $scope.contact_details_list[0].mobile.indexOf(sr);
        $scope.contact_details_list[0].mobile.splice(index, 1);

        $scope.mobile_numbers.splice(ind, 1);
    };

    $scope.add_tel = () => {
        var newUser = {};
        $scope.contact_details_list[1].tel.push(newUser);
    };

    $scope.remove_tel_number = (sr, ind) => {
        var index = $scope.contact_details_list[1].tel.indexOf(sr);
        $scope.contact_details_list[1].tel.splice(index, 1);

        $scope.tel_numbers.splice(ind, 1);
    };

    $scope.add_email = () => {
        var newUser = {};
        $scope.contact_details_list[2].email.push(newUser);
    };

    $scope.remove_email = (sr, ind) => {
        var index = $scope.contact_details_list[2].email.indexOf(sr);
        $scope.contact_details_list[2].email.splice(index, 1);
        $scope.email_ids.splice(ind, 1);
    };

    $scope.add_airport = () => {
        var newUser = {};
        $scope.airport_transfer_list[0].airport.push(newUser);
        console.log($scope.airport_transfer_list);
    };

    $scope.remove_airport = (sr, ind) => {
        var index = $scope.airport_transfer_list[0].airport.indexOf(sr);
        $scope.airport_transfer_list[0].airport.splice(index, 1);
        $scope.airport.splice(ind, 1);
    };



    /*======================================================== 
              INLINE ORIGIN DESTINATION start here 
      =======================================================*/


    $scope.formData = {};


    // second stage process form
    $scope.secondForm = function () {

        console.log($scope.formData);

        $http({
            method: 'POST',
            url: $scope.base_url + "leads/second_stage_form_submit/",
            data: {
                test_fields: $scope.formData
            },
            dataType: 'json',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' }  // set the headers so angular passing info as form data (not request payload)
        })
            .then(function (response) {
                var case_no = response.data.case_no;
                console.log('result == ' + response.data.case_no);
                swal({
                    title: "Congratulation!",
                    text: "Your Form submit successfull!",
                    type: "success"
                }).then(function () {
                    window.location = $scope.base_url + 'leads/third_form/' + case_no;
                });

            });
    };


    // third stage process form
    $scope.thirdForm = function () {

        $http({
            method: 'POST',
            url: $scope.base_url + "leads/third_stage_form_submit/",
            data: {
                data: $scope.formData
            },
            dataType: 'json',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' }  // set the headers so angular passing info as form data (not request payload)
        })
            .then(function (response) {
                var case_no = response.data.case_no;
                console.log('result == ' + response.data.case_no);
                // window.location.href = $scope.base_url+'leads';
                swal({
                    title: "Congratulation!",
                    text: "Your Form submit successfull!",
                    type: "success"
                }).then(function () {
                    window.location = $scope.base_url + 'leads';
                    // window.location = $scope.base_url+'leads/create_leads/email_test/'+case_no;
                });

            });
    };

    $scope.service_master = () => {
        $http({
            method: 'POST',
            async: true,
            url: $scope.base_url + "leads/get_service_list/",
            data: {

            },
            dataType: 'json',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
        }).then(function (response) {
            $scope.service_list = response.data;

            console.log($scope.service_list);

        });
    }


});
