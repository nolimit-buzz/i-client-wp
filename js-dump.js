(function($){

    /* Hide register form*/ 
    $(".register-room").hide();

    /* Menu trigger */ 
   $("#menu-trigger").click(function(){
    $(".body-container .nav").fadeToggle();
   });

    /* For login  */ 

   $(".register-login-btn").click(function(){

    $(".register-login-btn").removeClass("active");
    $(this).toggleClass("active");

   });

   $("#login-btn").click(function(){
        $(".register-room").hide();
        $(".login-room").fadeToggle();

   });

    /* For register  */ 

   $("#register-btn").click(function(){
        $(".login-room").hide();
        $(".register-room").fadeToggle();
   });


    /* Popup notif*/    
    setInterval(function(){
        jQuery("p.popup-notif").fadeToggle(1200);
    },2000);
    /* */

    $(".pclose").click(function(){
        $(this).parent().parent().hide();
    });



    /*
    * Chat GPT API
    *
    */ 

  $(document).ready(function(){

    $(".popup-process").hide();

        $(".search-btn").click(function(){



            var internal_company = $("input[name='internal_company']").val();
            var external_company = $("input[name='external_company']").val();


            if(internal_company=== "" || external_company ===""){//IF
                alert('Company name is required'); 

            }else{

                /* Processing popup */
                $(".popup-process").css({"display":"flex"});

                console.log("internal_company",internal_company);
                console.log("external_company",external_company);

            

               

                $.ajax({
                    url: account_data.ajaxurl, // AJAX handler
                    data: company_data,
                    type: "POST",
                    success: function (res) {
                        console.log('The Company',res);
                        res = JSON.parse(res);
                        console.log('Internal Company',res.internal_company);
                        console.log('External Company',res.external_company);
                        console.log('External Company Bio',res.external_company_bio);

                        account_data.external_company_logo = "https://logo.clearbit.com/"+res.internal_company;
                        account_data.external_company_name = $("input[name='external_company']").val();
                        account_data.about_external = res.external_company_bio;

                        account_data.internal_company_name = $("input[name='internal_company']").val();
                        account_data.internal_company_logo = "https://logo.clearbit.com/"+res.external_company;


                        /* Load Content */
                        /* Customer Name & Bio */
                        $(".cname.external-company-name").html(account_data.external_company_name);
                        $("p#about-company-content").html(account_data.about_external);

                        $(".notif-status").append("<p class='notif-item'> The customer company Summary have just been generated &#x2713;</p>");


                    },
                    error: function (error) {
                        console.log('error',error);
                    },
                });
            


                /* AJAX For CHATGPT Content generation */ 
                const data = {
                    action: "account_filter_by_ajax",
                    "internal_company":internal_company,
                    "external_company":external_company
                };

                $.ajax({
                url: account_data.ajaxurl, // AJAX handler
                data: data,
                type: "POST",
                success: function (last_message) {
                    /**/ 
                  
                    console.log('First Response',last_message);

                    account_data.last_message[0] = last_message;

                    $("#challenges-content").html(account_data.last_message[0]);
                    $(".notif-status").append("<p class='notif-item'> The customer company <b>challenges</b> have just been generated &#x2713;</p>");


                    const data = {
                        action: "account_filter_by_ajax2",
                        "internal_company":internal_company,
                        "external_company":external_company,
                        "last_message":last_message,
                    };
                    
                    $.ajax({
                    url: account_data.ajaxurl, // AJAX handler
                    data: data,
                    type: "POST",
                    success: function (last_message) {
                        
                       
                        /**/ 
                        console.log('Second Response',last_message);
                        account_data.last_message[1] = last_message;

                        $("div#insights-content").html(account_data.last_message[1]);
                        $(".notif-status").append("<p class='notif-item'> The customer company <b>insights</b> have just been generated &#x2713;</p>");

                        const data = {
                            action: "account_filter_by_ajax3",
                            "internal_company":internal_company,
                            "external_company":external_company,
                            "last_message":last_message
                        };

                        $.ajax({
                            url: account_data.ajaxurl, // AJAX handler
                            data: data,
                            type: "POST",
                            success: function (last_message) {
                                /**/ 
                               
                                console.log('Response 3',last_message);
                                account_data.last_message[2] = last_message;

                                $("div#capability-content").html(account_data.last_message[2]);
                                $(".notif-status").append("<p class='notif-item'> The customer company <b>capability</b> have just been generated &#x2713;</p>");
        
                                const data = {
                                    action: "account_filter_by_ajax4",
                                    "internal_company":internal_company,
                                    "external_company":external_company,
                                    "last_message":last_message
                                };

                                $.ajax({
                                    url: account_data.ajaxurl, // AJAX handler
                                    data: data,
                                    type: "POST",
                                    success: function (last_message) {
                                        
                                            /**/ 
                                         
                                            console.log('Response 4',last_message);
                                            account_data.last_message[3] = last_message;

                                            $("div#impact-content").html(account_data.last_message[3]);
                                            $(".notif-status").append("<p class='notif-item'> The company <b>impact</b> have just been generated &#x2713;</p>");
        
                                            const data = {
                                                action: "account_filter_by_ajax5",
                                                "internal_company":internal_company,
                                                "external_company":external_company,
                                                "last_message":last_message
                                            };

                                            $.ajax({
                                                url: account_data.ajaxurl, // AJAX handler
                                                data: data,
                                                type: "POST",
                                                success: function (last_message) {
                                                  
        
                                                    console.log('Response 5',last_message);
                                                    account_data.last_message[4] = last_message;

                                                    $("div#hypotesis-content").html(account_data.last_message[4]);
                                                    $(".notif-status").append("<p class='notif-item'> The <b>value hypotesis</b> have just been generated &#x2713;</p>");
                                                    $(".popup-process").hide();
                                                },
                                                error: function (error) {
                                                    console.log('error',error);
                                                },
                                            });
                                            /**/ 

                                    },
                                    error: function (error) {
                                        console.log('error',error);
                                    },
                                });
                                /**/ 


                            },
                            error: function (error) {
                            console.log('error',error);
                            },
                        });
                        /**/ 
                    },
                    error: function (error) {
                        console.log('error',error);
                    },
                    });
                    /**/ 
                
                },
                error: function (error) {
                    console.log('error',error);
                },
                });


            }//IF ENDS


        });

 

  });


  





})(jQuery)