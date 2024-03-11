(function($){


    
    /* Create User */

    $(".add-user").click(function(){
        $("section.popup-process.create_user").css({"display":"flex"});

        $(".pclose").click(function(){
            $(this).parent().parent().hide();
        });
    
    });
    
     /* Edit User */

     $("span.control.edit_user").click(function(){
        $("section.popup-process.edit_user").css({"display":"flex"});

            //user_id
            $("section.popup-process.edit_user .profile-card input[name='user_id']").val($(this).siblings("span.user_id").html());

            //username
            $("section.popup-process.edit_user .profile-card input[name='username']").val($(this).parent().parent().find("span.username").html());

            //first_name
            $("section.popup-process.edit_user .profile-card input[name='first_name']").val($(this).parent().parent().find("span.firstname").html());

            //lastname
            $("section.popup-process.edit_user .profile-card input[name='last_name']").val($(this).parent().parent().find("span.lastname").html());

            //email
            $("section.popup-process.edit_user .profile-card input[name='email']").val($(this).parent().parent().find("span.email").html());


        $(".pclose").click(function(){
            $(this).parent().parent().hide();
        });
    
    });


    
    /* End user */ 


    function containsQueryParam(paramName) {
        const url = new URL(window.location.href);
      
        return url.searchParams.has(paramName);
      }

    if(containsQueryParam("pid")){
        $(".results-container").show();
        $(".no-result-container").hide();
        jQuery(".conclusion-controls .control-item").eq(0).hide();
        jQuery(".conclusion-controls .control-item").eq(1).hide();
        $(".about-company").show();
        $(".result-logo img").show();


    }else{
        $(".results-container").hide();
        $(".no-result-container").show();
        jQuery(".conclusion-controls .control-item").eq(0).show();
        jQuery(".conclusion-controls .control-item").eq(1).show();
        $(".about-company").hide();

    }



    // Register
    $(".register-room").hide();

    setInterval(function(){
        jQuery(".loading").fadeToggle(1200);
    },2000);


    // Menu Trigger
   $("#menu-trigger").click(function(){
    $(".body-container .nav").fadeToggle();
   });


   $(".register-login-btn").click(function(){

    $(".register-login-btn").removeClass("active");
    $(this).toggleClass("active");

   });

   $("#login-btn").click(function(){
        $(".register-room").hide();
        $(".login-room").fadeToggle();

   });

   $("#register-btn").click(function(){
        $(".login-room").hide();
        $(".register-room").fadeToggle();
   });


   $(".save-btn").show();
   
   $(".save-btn").attr("action","prompt");


   $(".tab-content").hide();
   $(".tab-content").eq(0).show();

   $(".save-btn.profile").show();

   $(".s-nav-item").each(function(a,b){
        $(this).click(function(){
            $(".s-nav-item").removeClass("active");
            $(this).addClass("active");
            console.log("index",$(this).index() ); 
            $(".tab-content").hide();
            var idx =$(this).index() - 1;
            $(".tab-content").eq(idx).show();
            if(idx===0){
                $(".save-btn").show();
                $(".save-btn").attr("action","prompt");
                $(".save-btn").show();

            }else if(idx===1){ //profile
                $(".save-btn").attr("action","profile");
                $(".save-btn").hide();


            }else if(idx===2){ //user section
                $(".save-btn").attr("action","");
                $(".save-btn").hide();


            }else if(idx===3){ //api section
                $(".save-btn").attr("action","api");
                $(".save-btn").show();


            }
        });
   });


    /*
    * Chat GPT API
    *
    */ 

  $(document).ready(function(){


        // Default Prompt
        setTimeout(function(){
            
        challenges_text_question = localStorage.getItem("challenges_text_question");
        impact_text_question = localStorage.getItem("impact_text_question");
        insight_text_question = localStorage.getItem("insight_text_question");
        hypothesis_text_question = localStorage.getItem("hypothesis_text_question");
        capability_text_question = localStorage.getItem("capability_text_question");
        
        
            if(challenges_text_question==null){
                  $("div[name='challenges']").html(account_data.challenges_prompt);
            }  
            if(impact_text_question==null){
                 $("div[name='impact']").html(account_data.impact_prompt);

            }  if(insight_text_question==null){
                 $("div[name='insight']").html(account_data.insight_prompt);
            }   
            if( hypothesis_text_question==null){
                 $("div[name='hypotesis']").html(account_data.value_prompt);
            }  
            
            if(capability_text_question==null ){
                 $("div[name='capability']").html(account_data.capability_prompt);
            }
            
        },2000);
            
            

        // On  reset prompt
        $("#reset_prompt").click(function(){
            
            $("div[name='challenges']").html(account_data.challenges_prompt);
            $("div[name='impact']").html(account_data.impact_prompt);
            $("div[name='insight']").html(account_data.insight_prompt);
            $("div[name='hypotesis']").html(account_data.value_prompt);
            $("div[name='capability']").html(account_data.capability_prompt);
            
        });

    /* Trigger CHAT GPT Query */
        $(".search-btn").click(function(){

            var internal_company = $("input[name='internal_company']").val();
            var external_company = $("input[name='external_company']").val();
            if( (internal_company == "")  || (external_company == "") ){
                alert("You need to enter company names");
                return;
            }

            $(".results-container").show();
            $(".no-result-container").hide();

            // Loading
            $("#about-company-content").html("<div style='height:30px;background:#0693e326;border-radius:25px'><div class='loading'>Generating...</div></div>");
            $("#challenges-content").html("<div style='height:30px;background:#0693e326;border-radius:25px'><div class='loading'>Generating...</div></div>");
            $("#insight-content").html("<div style='height:30px;background:#0693e326;border-radius:25px'><div class='loading'>Generating...</div></div>");
            $("#capability-content").html("<div style='height:30px;background:#0693e326;border-radius:25px'><div class='loading'>Generating...</div></div>");
            $("#impact-content").html("<div style='height:30px;background:#0693e326;border-radius:25px'><div class='loading'>Generating...</div></div>");
            $("#hypotesis-content").html("<div style='height:30px;background:#0693e326;border-radius:25px'><div class='loading'>Generating...</div></div>");


            setTimeout(function(){
                company();
            },200);

            setTimeout(function(){
                chat1();
            },500);

            setTimeout(function(){
                chat2();
            },1000);
            setTimeout(function(){
                chat3();
            },10500);
            setTimeout(function(){
                chat4();
            },18500);
            setTimeout(function(){
                chat5();
            },23000);


        });


       // On Setting Saved 
        $(".save-btn,.save-btn.profile").click(function(){

            $action = $(this).attr("action");
            console.log("$action",$action);
         
            // setTimeout(function(){
                setting_api();
            // },200);

            
        });


         // On  Saved search
         $("#save_search").click(function(){
            $(this).hide();

            console.log("Saving");
            setTimeout(function(){
                save_search();
            },200);

            
        });

        function save_search(){

            
                /* AJAX For save_search api generation */ 
                var challenges = $("#challenges-content").html();
                var insight = $("#insight-content").html();
                var capability = $("#capability-content").html();
                var impact = $("#impact-content").html();
                var hypotesis = $("#hypotesis-content").html();
                var about_company = $("#about-company-content").html();
    
                var internal_company = $("input[name='internal_company']").val();
                var external_company = $("input[name='external_company']").val();
                var internal_company_logo = $("img.internal-company-logo").attr('src');
                var external_company_logo = $("img.external-company-logo").attr('src');
                


                const data = {
                    action: "save_search",
                  "challenges" : challenges,
                  "insight" : insight,
                  "capability" : capability,
                  "impact" : impact,
                  "hypotesis" : hypotesis,
                  "internal_company":internal_company,
                  "external_company":external_company,
                  "about_company":about_company,
                  "internal_company_logo" :internal_company_logo,
                  "external_company_logo" :external_company_logo

                };
                $.ajax({
                    url: account_data.ajaxurl, // AJAX handler
                    data: data,
                    type: "POST",
                    success: function (res) {
                        console.log('Save search',res);

                        if(res.result === "success"){
                            $(".report-url").show();
                            $(".report-url").html("<b>Share URL: </b> "+res.url);
                            alert("Your search setting has been saved");
                            // location.reload();

                        }
                    
                    },
                    error: function (error) {
                        console.log('error',error);
                    },
                });

 
        
        }

        function setting_api(){

                
            if( $(".save-btn").attr("action")  === "api"){
                /* AJAX For setting api generation */ 
                var api_key = $("input[name='key']").val();
                var max_tokens = $("input[name='max_tokens']").val();
                var model = $("select[name='model']").val();
                var temperature = $("input[name='temperature']").val();
                var presence_penalty = $("input[name='presence_penalty']").val();
                var fequency_penalty = $("input[name='fequency_penalty']").val();


                const company_data = {
                    action: "setting_api",
                    "function_cb": "api",
                    "api_key":api_key,
                    "model":model,
                    "max_tokens":max_tokens,
                    "temperature":temperature,
                    "presence_penalty":presence_penalty,
                    "fequency_penalty":fequency_penalty,
                };
                
                $.ajax({
                    url: account_data.ajaxurl, // AJAX handler
                    data: company_data,
                    type: "POST",
                    success: function (res) {
                        console.log('Prompt',res);

                        if(res.status === "success"){
                            alert("Your API setting has been saved");
                            // location.reload();

                        }
                    
                    },
                    error: function (error) {
                        console.log('error',error);
                    },
                });


            }else if( $(".save-btn").attr("action")  === "prompt"){
                
                if(account_data.role =="subscriber"  || (account_data.role === null) ){
                    /* AJAX For setting api generation */ 
                    var challenges = $("div[name='challenges']").html();
                    var impact = $("div[name='impact']").html();
                    var insight = $("div[name='insight']").html();
                    var hypotesis = $("div[name='hypotesis']").html();
                    var capability = $("div[name='capability']").html();
                    
                            
                    localStorage.setItem("challenges_text_question", challenges);
                    localStorage.setItem("impact_text_question", impact);
                    localStorage.setItem("insight_text_question", insight);
                    localStorage.setItem("hypothesis_text_question", hypotesis);
                    localStorage.setItem("capability_text_question", capability); 
                     alert("Your Prompt has been saved");
                }
                
                else{
                    /* AJAX For setting api generation */ 
                    var challenges = $("div[name='challenges']").html();
                    var impact = $("div[name='impact']").html();
                    var insight = $("div[name='insight']").html();
                    var hypotesis = $("div[name='hypotesis']").html();
                    var capability = $("div[name='capability']").html();
    
                    const company_data = {
                    action: "setting_api",
                    "function_cb": "prompt",
                    "challenges":challenges,
                    "impact":impact,
                    "insight":insight,
                    "capability":capability,
                    "hypothesis":hypotesis,
                    };
                    $.ajax({
                    url: account_data.ajaxurl, // AJAX handler
                    data: company_data,
                    type: "POST",
                    success: function (res) {
                        console.log('Prompt',res);
    
                        if(res.status === "success"){
                            alert("Your Prompt has been saved");
                            //location.reload();
    
                        }
                        
                    },
                    error: function (error) {
                        console.log('error',error);
                    },
                    });
                
                
                }
            }else if( ($(".save-btn").attr("action")  === "profile") || $(".save-btn.profile").attr("action")  === "profile"){
                /* AJAX For setting api generation */ 
                var form = $("#profile_form");
                console.log("profile submitted");
                form.submit();

            } else{
                console.log("No setting was submitted");
            }
            
            
        
        }

        function company(){

            $("#about-company-content").html("<div style='height:30px;background:#0693e326;border-radius:25px'><div class='loading'>Generating...</div></div>");

             /* AJAX For company details generation */ 
             var internal_company = $("input[name='internal_company']").val();
             var external_company = $("input[name='external_company']").val();

             const company_data = {
                action: "account_filter_by_company_details",
                "internal_company":internal_company,
                "external_company":external_company
            };
            $.ajax({
                url: account_data.ajaxurl, // AJAX handler
                data: company_data,
                type: "POST",
                success: function (res) {
                    console.log('The Company',res);
                    $(".about-company").show();

                  
                    if(validURL(internal_company) && validURL(external_company) ){
                        /* load default images */
                        $("img.external-company-logo").attr("src",res.external_company_logo);
                        $("img.internal-company-logo").attr("src",res.internal_company_logo);
                        jQuery(".result-logo").attr("style","");
                         $(".result-logo img").show();
                    }
                    else{
                        $(".result-logo img").show();
                        // testing for just challenges + others can stested later
                        jQuery(".challenges_logo").attr("style",`background:url(${account_data.challenges_logo})`);
                        jQuery(".insight_logo").attr("style",`background:url(${account_data.insight_logo})`);
                        jQuery(".capability_logo").attr("style",`background:url(${account_data.capability_logo})`);
                        jQuery(".impact_logo").attr("style",`background:url(${account_data.impact_logo})`);
                        jQuery(".value_logo").attr("style",`background:url(${account_data.value_logo})`);

                        $(".result-logo img").hide();

                    }

                    /* Load Content */
                    /* Customer Name & Bio */
                    external_company = external_company.charAt(0).toUpperCase() + external_company.slice(1);
                    internal_company = internal_company.charAt(0).toUpperCase() + internal_company.slice(1);
                    
                    $(".cname.external-company-name").html(external_company);
                    $(".cname.internal-company-name").html(internal_company);
                    $(".cname.both-company-name").html(internal_company +" VS "+ external_company);
                    $(".cname.external-company-name").eq(0).html(external_company+"<div class='h4 section-title'> Customer's Company Brief </div> ");

                    // $(".cname.internal-company-name").html(res.internal_company_logo);
                    
                    $("p#about-company-content").html(res.company_bio);



                },
                error: function (error) {
                    console.log('error',error);
                },
            });
        
        }


        function validURL(str) {
            var pattern = new RegExp('^(https?:\\/\\/)?'+ // protocol
              '((([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.)+[a-z]{2,}|'+ // domain name
              '((\\d{1,3}\\.){3}\\d{1,3}))'+ // OR ip (v4) address
              '(\\:\\d+)?(\\/[-a-z\\d%_.~+]*)*'+ // port and path
              '(\\?[;&a-z\\d%_.~+=-]*)?'+ // query string
              '(\\#[-a-z\\d_]*)?$','i'); // fragment locator
            return !!pattern.test(str);
          }

        function chat1(){

            var internal_company = $("input[name='internal_company']").val();
            var external_company = $("input[name='external_company']").val();
 
            console.log("internal_company",internal_company);
            console.log("external_company",external_company);

    if( ( account_data.role =="subscriber") || (account_data.role === null) ){
        challenges_text_question = localStorage.getItem("challenges_text_question");
        impact_text_question = localStorage.getItem("impact_text_question");
        insight_text_question = localStorage.getItem("insight_text_question");
        hypothesis_text_question = localStorage.getItem("hypothesis_text_question");
        capability_text_question = localStorage.getItem("capability_text_question");
        
        var data = {
            action: "account_filter_by_ajax",
            "internal_company":internal_company,
            "external_company":external_company,
            "type":"challenges",
            "challenges_text_question":challenges_text_question,
            "impact_text_question":impact_text_question,
            "insight_text_question":insight_text_question,
            "hypothesis_text_question":hypothesis_text_question,
            "capability_text_question":capability_text_question,
        };
        
    }else{
    
        var data = {
            action: "account_filter_by_ajax",
            "internal_company":internal_company,
            "external_company":external_company,
            "type":"challenges",
        };
    }

            
            $.ajax({
            url: account_data.ajaxurl, // AJAX handler
            data: data,
            type: "POST",
            success: function (result) {
                console.log('challengesResponse',result);
                if(result.response === null){
                    chat1();
                }else{
                   account_data.challenges = result.response;
                   var pretext = "<p class='pre-text'>Presenting your comprehensive report on the top 5 challenges identified through meticulous company research. This report encapsulates key insights, providing a meaningful overview of the critical hurdles impacting the organization's strategic landscape.</p>";

                    $("#challenges-content").html(pretext+result.response)
                }
                
             
            },
            error: function (error) {
                console.log('error',error);
            },
            });
        }

        function chat2(){

            var internal_company = $("input[name='internal_company']").val();
            var external_company = $("input[name='external_company']").val();
 
            console.log("internal_company",internal_company);
            console.log("external_company",external_company);

        if( ( account_data.role =="subscriber") || (account_data.role === null) ){
            challenges_text_question = localStorage.getItem("challenges_text_question");
            impact_text_question = localStorage.getItem("impact_text_question");
            insight_text_question = localStorage.getItem("insight_text_question");
            hypothesis_text_question = localStorage.getItem("hypothesis_text_question");
            capability_text_question = localStorage.getItem("capability_text_question");
            
        
            var data = {
                action: "account_filter_by_ajax",
                "internal_company":internal_company,
                "external_company":external_company,
                "type":"insight",
                "challenges_text_question":challenges_text_question,
                "impact_text_question":impact_text_question,
                "insight_text_question":insight_text_question,
                "hypothesis_text_question":hypothesis_text_question,
                "capability_text_question":capability_text_question,
            };
        }else{
        
            var data = {
                action: "account_filter_by_ajax",
                "internal_company":internal_company,
                "external_company":external_company,
                "type":"insight",
            };
        }
            
            $.ajax({
            url: account_data.ajaxurl, // AJAX handler
            data: data,
            type: "POST",
            success: function (result) {
                console.log('insightResponse',result);

                if(result.response === null){
                    chat2();
                }else{
                   account_data.insights = result.response;   
                   var pretext = "<p class='pre-text'>Presenting your comprehensive industry insights report for the aforementioned company. This report delves into key facets, offering a professional and nuanced perspective on the industry landscape, providing valuable insights for strategic decision-making.</p>";

                    $("#insight-content").html(pretext+result.response)
                }
             
            },
            error: function (error) {
                console.log('error',error);
            },
            });
        }
        function chat3(){

            var internal_company = $("input[name='internal_company']").val();
            var external_company = $("input[name='external_company']").val();
 
            console.log("internal_company",internal_company);
            console.log("external_company",external_company);

        if( ( account_data.role =="subscriber") || (account_data.role === null) ){
            challenges_text_question = localStorage.getItem("challenges_text_question");
            impact_text_question = localStorage.getItem("impact_text_question");
            insight_text_question = localStorage.getItem("insight_text_question");
            hypothesis_text_question = localStorage.getItem("hypothesis_text_question");
            capability_text_question = localStorage.getItem("capability_text_question");
        
            var data = {
                action: "account_filter_by_ajax",
                "internal_company":internal_company,
                "external_company":external_company,
                "challenges" : account_data.challenges,
                "type":"capability",
                "challenges_text_question":challenges_text_question,
                "impact_text_question":impact_text_question,
                "insight_text_question":insight_text_question,
                "hypothesis_text_question":hypothesis_text_question,
                "capability_text_question":capability_text_question,
            };
            
        }else{
            
            var data = {
                action: "account_filter_by_ajax",
                "internal_company":internal_company,
                "external_company":external_company,
                "challenges" : account_data.challenges,
                "type":"capability"
            };
            
        }
            
            
            $.ajax({
            url: account_data.ajaxurl, // AJAX handler
            data: data,
            type: "POST",
            success: function (result) {
                console.log('capabilityResponse',result);

                if(result.response === null){
                    chat3();
                }else{

                   account_data.capability = result.response;
                   var pretext = "<p class='pre-text'>Presenting your capabilities report, meticulously derived from research on the client company above, outlining your organization's strengths in addressing challenges. This report offers a professional assessment, showcasing the strategic competencies that position your company to effectively navigate and overcome identified challenges.</p>";

                    $("#capability-content").html(pretext + result.response)
                }
             
            },
            error: function (error) {
                console.log('error',error);
            },
            });
        }

        function chat4(){
 
            var internal_company = $("input[name='internal_company']").val();
            var external_company = $("input[name='external_company']").val();
 
            console.log("internal_company",internal_company);
            console.log("external_company",external_company);

        if( ( account_data.role =="subscriber") ||  (account_data.role === null)  ){
            challenges_text_question = localStorage.getItem("challenges_text_question");
            impact_text_question = localStorage.getItem("impact_text_question");
            insight_text_question = localStorage.getItem("insight_text_question");
            hypothesis_text_question = localStorage.getItem("hypothesis_text_question");
            capability_text_question = localStorage.getItem("capability_text_question");
            
            var data = {
                action: "account_filter_by_ajax",
                "internal_company":internal_company,
                "external_company":external_company,
                "challenges" : account_data.challenges,
                "capability" : account_data.capability,
                "type":"impact",
                "challenges_text_question":challenges_text_question,
                "impact_text_question":impact_text_question,
                "insight_text_question":insight_text_question,
                "hypothesis_text_question":hypothesis_text_question,
                "capability_text_question":capability_text_question,
            };
            
        }else{
        
            var data = {
                    action: "account_filter_by_ajax",
                    "internal_company":internal_company,
                    "external_company":external_company,
                    "challenges" : account_data.challenges,
                    "capability" : account_data.capability,
                    "type":"impact"
            };
        }
            
            
            $.ajax({
            url: account_data.ajaxurl, // AJAX handler
            data: data,
            type: "POST",
            success: function (result) {
                console.log('impactResponse',result);

                if(result.response === null){
                    chat4();
                }else{
                   account_data.impact = result.response;
                   var pretext = "<p class='pre-text'>Presenting your impact assessment report, detailing the prospective outcomes resulting from the application of your company's capabilities in addressing the aforementioned challenges. This comprehensive report provides a professional analysis, outlining the positive effects and strategic advantages that engagement with your capabilities can yield.</p>";

                    $("#impact-content").html(pretext + result.response)
                }
            },
            error: function (error) {
                console.log('error',error);
            },
            });
        }

        function chat5(){
            
            var internal_company = $("input[name='internal_company']").val();
            var external_company = $("input[name='external_company']").val();
 
            console.log("internal_company",internal_company);
            console.log("external_company",external_company);


        if( ( account_data.role =="subscriber") ||  (account_data.role === null) ){
            challenges_text_question = localStorage.getItem("challenges_text_question");
            impact_text_question = localStorage.getItem("impact_text_question");
            insight_text_question = localStorage.getItem("insight_text_question");
            hypothesis_text_question = localStorage.getItem("hypothesis_text_question");
            capability_text_question = localStorage.getItem("capability_text_question");
        
            var data = {
                action: "account_filter_by_ajax",
                "internal_company":internal_company,
                "external_company":external_company,
                "challenges" : account_data.challenges,
                "impact" : account_data.impact,
                "insight" : account_data.insights,
                "capability" : account_data.capability,
                "type":"hypotesis",
                "challenges_text_question":challenges_text_question,
                "impact_text_question":impact_text_question,
                "insight_text_question":insight_text_question,
                "hypothesis_text_question":hypothesis_text_question,
                "capability_text_question":capability_text_question,
            };
        }else{
            var data = {
                action: "account_filter_by_ajax",
                "internal_company":internal_company,
                "external_company":external_company,
                "challenges" : account_data.challenges,
                "impact" : account_data.impact,
                "insight" : account_data.insights,
                "capability" : account_data.capability,
                "type":"hypotesis",
              
            };
        }
            
            
            $.ajax({
            url: account_data.ajaxurl, // AJAX handler
            data: data,
            type: "POST",
            success: function (result) {
                console.log('hypotesisResponse',result);

                if(result.response === null){
                    chat5();
                }else{
                    var pretext = "<p class='pre-text'>Presenting your Value Hypothesis Report, meticulously crafted from a synthesis of challenges, industry insights, capabilities, and impact gleaned from the comprehensive analysis. This report distills actionable strategies, providing a meaningful roadmap for navigating challenges and fostering sustained value creation.</p>";
                    $("#hypotesis-content").html(pretext+result.response)
                }
             
            },
            error: function (error) {
                console.log('error',error);
            },
            });
        }
 

        $("#profile_form").on("submit",function(event) {
            var user_image = $("input[name='profile']");

                    event.preventDefault();
            
                    console.log('Uploading . . . ');
            
                    // Get the files from the input
                    var formData =  new FormData(this);

                    // // Send the data.
                
                    $.ajax({
                        url: account_data.ajaxurl, // AJAX handler
                        data: formData,
                        enctype: 'multipart/form-data',
                        processData: false, contentType: false, cache: false,
                        type: "POST",
                        success: function (res) {
                            console.log('Profile',res);
    
                            if(res.status === "success"){
                                alert("Your profile setting has been saved");
                                location.reload();
    
                            }else{
                                alert("All field are required");

                            }
                        
                        },
                        error: function (error) {
                            console.log('error',error);
                        },
                    });
                
            
        });


        $("#create_user").on("submit",function(event) {
         

                    event.preventDefault();
            
                    console.log('Creating user . . . ');
            
                    // Get the files from the input
                    var formData =  new FormData(this);

                    // // Send the data.
                
                    $.ajax({
                        url: account_data.ajaxurl, // AJAX handler
                        data: formData,
                        // enctype: 'multipart/form-data',
                        processData: false, contentType: false, cache: false,
                        type: "POST",
                        success: function (res) {
                            console.log('Profile',res);
    
                            if(res.result === "success"){
                                alert("User has been created");
                                location.reload();
    
                            }else{
                                alert(res.result);
                            }
                        
                        },
                        error: function (error) {
                            console.log('error',error);
                        },
                    });
                
            
        });



        $("#edit_user").on("submit",function(event) {
         

            event.preventDefault();
    
            console.log('Updating user . . . ');
    
            // Get the files from the input
            var formData =  new FormData(this);

            // // Send the data.
        
            $.ajax({
                url: account_data.ajaxurl, // AJAX handler
                data: formData,
                // enctype: 'multipart/form-data',
                processData: false, contentType: false, cache: false,
                type: "POST",
                success: function (res) {
                    console.log('Profile',res);

                    if(res.result === "success"){
                        alert("User has been created");
                        location.reload();

                    }else{
                        alert(res.result);
                    }
                
                },
                error: function (error) {
                    console.log('error',error);
                },
            });
        
    
        });



        $(".delete_user").on("click",function(event) {
         

            event.preventDefault();
    
            console.log('deleting user . . . ');
    
         
            // // Send the data.
        
            $.ajax({
                url: account_data.ajaxurl, // AJAX handler
                data: {
                    "action": "delete_user",
                    "user_id" : $(this).siblings("span.user_id").html(),
                },
                // enctype: 'multipart/form-data',
                // processData: false, contentType: false, cache: false,
                type: "POST",
                success: function (res) {
                    console.log('deleted',res);

                    if(res.result === "success"){
                        alert("User has been deleteds");
                        location.reload();

                    }else{
                        alert(res.result);
                    }
                
                },
                error: function (error) {
                    console.log('error',error);
                },
            });
        
    
        });



        $("#login_user").on("submit",function(event) {
         

            event.preventDefault();
    
            console.log('Creating user . . . ');
    
            // Get the files from the input
            var formData =  new FormData(this);

            // // Send the data.
        
            $.ajax({
                url: account_data.home, // AJAX handler
                data: formData,
                // enctype: 'multipart/form-data',
                processData: false, contentType: false, cache: false,
                type: "POST",
                success: function (res) {
                //    console.log('res',res);

                    if(res.result === "success"){
                         window.location.href = account_data.dashboard;

                        // console.log('success',res);

                    }else{
                        $(".login-error").show();
                        $(".login-error").html(res.result);
                    }
                
                },
                error: function (error) {
                    $("login-error").show().html(error);
                    // console.log('error',error);
                },
            });
        
    
        });



        $("#register_user").on("submit",function(event) {
         

            event.preventDefault();
    
            console.log('Creating user . . . ');
    
            // Get the files from the input
            var formData =  new FormData(this);

            // // Send the data.
        
            $.ajax({
                url: account_data.ajaxurl, // AJAX handler
                data: formData,
                // enctype: 'multipart/form-data',
                processData: false, contentType: false, cache: false,
                type: "POST",
                success: function (res) {
                //    console.log('res',res);

                    if(res.result === "success"){
                                     
                    // location.reload();
                        // console.log('success',res);
                        $(".register-error").show();
                        $(".register-error").html(res.result+ ": you can now login.");
                        $("input[type='email']").val('');
                        $("input[type='password']").val('');
                        $("input[type='text']").val('');
                        // $("input.register-btn").attr("disabled",true);


                    }else{
                        $(".register-error").show();
                        $(".register-error").html(res.result);
                    }
                
                },
                error: function (error) {
                    $("login-error").show().html(error);
                    // console.log('error',error);
                },
            });
        
    
        });


   //Save Subscriber  or guest prompt to browser
        if( (account_data.role ==="subscriber")  || (account_data.role ===null) ) {
             $("div[name='challenges']").html(localStorage.getItem("challenges_text_question"));
             $("div[name='impact']").html(localStorage.getItem("impact_text_question"));
             $("div[name='insight']").html(localStorage.getItem("insight_text_question"));
             $("div[name='hypotesis']").html(localStorage.getItem("challenges_text_question"));
             $("div[name='capability']").html(localStorage.getItem("capability_text_question"));
        }






  });


  





})(jQuery)