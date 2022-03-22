define([], function() {
    'use strict';

    return function(){
        return{
            title: 'view model'
        }
    }
    
});
//console.log("requiredjs op");

// AMD Module Function
// define(function() {
//     'use strict';
//     return function () {
//         console.log("I'm requirejs AMD Module Function");
//     }
// });

//arguments passing 
// define(function() {
//     'use strict';
//     return function (data) {
//         console.log("I'm requirejs AMD Module Function",data);
//     }
// });

//div
// define(function() {
//     'use strict';
//     return function (element) {
//         console.log(element);
//     }
// });

// DOM targetting
// define(function(element) {
//     'use strict';
//     return function (data) {
//         console.log(element);
//     }
// });

//Dependency
// define(['jquery'], function($) {
//     'use strict';
//     //below function will return value from module
//     return function (data,element) {
//         //console.log(element);
//         $.getJSON(data.base_url + 'rest/V1/directory/currency', function(result){
//             element.innerText = JSON.stringify(result, null, 2);       });
//     }
// });