define([
        'uiComponent',
        'jquery',
        'mage/url'
    ],
    function(Component, $, url) {
        'use strict';

        return Component.extend({
            initialize: function() {
                this._super();
                console.log(url);
                var self = this;
                $(document).on('change', "[name='postcode']", function() {
                    var postcode = this.value;
                    $.ajax({
                        url: 'http://localhost/magento4.1/zipcode/index/index',
                        data: { pincode: $("[name='postcode']").val() },
                        type: 'post',
                        cache: false,
                        dataType: 'json',
                        success: function(res) {
                            //console.log('Response comes from Controller');
                            var mydata = null;
                            //to check pincode exist or not
                            if (res.json == mydata) {
                                $("[name='city']").val(res.jsondata[0]);
                                //console.log(res.jsondata);
                                $("[name='region_id']").find("option:selected").text(res.jsondata[1]);
                            } else {
                                alert(res.json);
                                $("[name='city']").val("");
                                $("[name='region_id']").find("option:selected").text("");
                            }                       
                        }
                    });
                });
            },
            transfer: function(){
                console.log(url.build) ;
            }
        });
    }
);