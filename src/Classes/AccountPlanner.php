<?php

namespace AccountPlannerWP\Classes;

use Orhanerday\OpenAi\OpenAi;
use WP_Query;

class AccountPlanner {




    public function __construct(){

         // Filter ajax add action Callback
         add_action('wp_ajax_account_filter_by_ajax', array($this,'account_filter_by_ajax'));//Filter new : ajax
         add_action('wp_ajax_nopriv_account_filter_by_ajax', array($this,'account_filter_by_ajax'));//Filter new : ajax

        // Filter ajax add action Callback
        add_action('wp_ajax_account_filter_by_company_details', array($this,'account_filter_by_company_details'));//Filter new : ajax
        add_action('wp_ajax_nopriv_account_filter_by_company_details', array($this,'account_filter_by_company_details'));//Filter new : ajax


        // Filter ajax add action Callback
        add_action('wp_ajax_setting_api', array($this,'setting_api'));//Filter new : ajax
        add_action('wp_ajax_nopriv_setting_api', array($this,'setting_api'));//Filter new : ajax



        // Save search
        add_action('wp_ajax_save_search', array($this,'save_search'));//Filter new : ajax
        add_action('wp_ajax_nopriv_save_search', array($this,'save_search'));//Filter new : ajax


         // create user 
         add_action('wp_ajax_create_user', array($this,'create_user'));//Filter new : ajax
         add_action('wp_ajax_nopriv_create_user', array($this,'create_user'));//Filter new : ajax

        // Edit user 
        add_action('wp_ajax_edit_user', array($this,'edit_user'));//Filter new : ajax
        add_action('wp_ajax_nopriv_edit_user', array($this,'edit_user'));//Filter new : ajax



        // Delete user 
        add_action('wp_ajax_delete_user', array($this,'delete_user'));//Filter new : ajax
        add_action('wp_ajax_nopriv_delete_user', array($this,'delete_user'));//Filter new : ajax


        add_action('wp_enqueue_scripts', [$this, 'account_script_enqueuer']);

    }




    public function setting_api(){
        global $wpdb;
        if (isset($_POST['action']) && ($_POST['action'] ==="setting_api")) {
         
            $setting_api = $_POST['function_cb'];

            if($setting_api ===  "prompt"){

                // print_r($_POST);
                $challenges = ($_POST['challenges']) ? update_option( "challenges", stripslashes( sanitize_text_field( $_POST['challenges'] ))) : '' ;
                $insights = ($_POST['insight']) ? update_option( "insight", stripslashes(sanitize_text_field( $_POST['insight'] ))) : '' ;
                $capabilities = ($_POST['capability']) ? update_option( "capability", stripslashes(sanitize_text_field( $_POST['capability']))) : '' ;
                $impact =($_POST['impact']) ? update_option( "impact", stripslashes(sanitize_text_field( $_POST['impact'] ))) : '' ;
                $hypothesis = ($_POST['hypothesis']) ? update_option( "hypothesis", stripslashes(sanitize_text_field( $_POST['hypothesis'] ))) : '' ;

                return wp_send_json(
                  [
                    "status" => "success",

                  ]
                );

            }

            elseif($setting_api ===  "api"){

                // print_r($_POST);
                $api_key = ($_POST['api_key']) ? update_option( "api_key", sanitize_text_field( $_POST['api_key'] )) : '' ;
                $max_tokens = ($_POST['max_tokens']) ? update_option( "max_tokens", sanitize_text_field( $_POST['max_tokens'] )) : '' ;
                $model = ($_POST['model']) ? update_option( "model", sanitize_text_field( $_POST['model'] )) : '' ;
                
                $temperature_option_name = 'temperature';
                $temperature_value = $_POST['temperature'];
                $option_table = $wpdb->prefix.'options';
                update_option('temperature',$temperature_option_name);
                $temperature_sql = $wpdb->prepare("UPDATE $option_table SET option_value = %s WHERE option_name = %s", $temperature_value, $temperature_option_name);
                $wpdb->query($temperature_sql);


                $presence_penalty_option_name = 'presence_penalty';
                $presence_penalty_value = $_POST['presence_penalty'];
                update_option('presence_penalty',$presence_penalty_value);
                $presence_penalty_sql = $wpdb->prepare("UPDATE $option_table SET option_value = %s WHERE option_name = %s", $presence_penalty_value, $presence_penalty_option_name);
                $wpdb->query($presence_penalty_sql);


                $fequency_penalty_option_name = 'fequency_penalty';
                $fequency_penalty_value = $_POST['fequency_penalty'];
                update_option('fequency_penalty',$fequency_penalty_value);
                $fequency_penalty_sql = $wpdb->prepare("UPDATE $option_table SET option_value = %s WHERE option_name = %s", $fequency_penalty_value, $fequency_penalty_option_name);
                $wpdb->query($fequency_penalty_sql);


                // $temperature = ($_POST['temperature']) ? update_option( "temperature", sanitize_text_field( $_POST['temperature'])) : '' ;
                // $presence_penalty =($_POST['presence_penalty']) ? update_option( "presence_penalty", sanitize_text_field( $_POST['presence_penalty'] )) : '' ;
                // $fequency_penalty = ($_POST['fequency_penalty']) ? update_option( "fequency_penalty", sanitize_text_field( $_POST['fequency_penalty'] )) : '' ;

                return wp_send_json(
                  [
                    "status" => "success",
                    "presence_penalty" => $presence_penalty,

                  ]
                );

            } elseif($setting_api ===  "profile"){

                // print_r($_POST);
                // print_r($_FILES);

                    // Image upload logic using media_handle_upload
                    $uploaded_image = media_handle_upload('profile', 0); // 0 is for the user ID (guest user)
                
                    if (!is_wp_error($uploaded_image)) {
                        // Image uploaded successfully, store attachment ID in user meta
                        update_user_meta(get_current_user_id(), 'profile_image', $uploaded_image);
                        update_user_meta(get_current_user_id(), 'gender',  $_POST['gender']);
                        wp_update_user([
                            'ID' => get_current_user_id(), // this is the ID of the user you want to update.
                            'first_name' => $_POST['first_name'],
                            'last_name' =>$_POST['last_name'],
                            'email' => $_POST['email'],
                        ]);

                        $new_password =  $_POST['password']; 
                        wp_set_password( $new_password,get_current_user_id() );

                        return wp_send_json(
                            [
                              "status" => "success",
          
                            ]
                          );
                        // echo "File uploaded successfully!";

                    } else {
                        echo "Sorry, there was an error uploading your file.";
                    }
           

            }

     
 
            
        }
       
    }


    public function account_filter_by_company_details(){
        if (isset($_POST['external_company']) && ($_POST['external_company'] !=="")) {
         
            $internal_company = $_POST['internal_company'];
            $external_company = $_POST['external_company'];
            $message = "Get $external_company company summary in two sentences";

            $message_array =   [
                [
                    "role" => "system",
                    "content" => "You are a sales planning executive with 15 years of experience You will provide Corporate-level research assistance for companies provided."
                ],
                [
                    "role" => "user",
                    "content" => $message
                ],
                
            ];
            $result = AccountPlanner::chatgpt_send_message($message_array) ;

            $internal_logo = "https://logo.clearbit.com/".$internal_company;
            $external_logo = "https://logo.clearbit.com/".$external_company;
 
            wp_send_json(
                [
                    "company_bio" => $result,
                    "internal_company_logo" => $internal_logo,
                    "external_company_logo" => $external_logo,
                ]
            );
        }
       
    }


    public function account_script_enqueuer()
    { 

        // Register theme stylesheet.
		$theme_version = "1.0.0";

		$version_string = is_string( $theme_version ) ? $theme_version : false;
		wp_register_style(
			'accountplanner-style',
			get_template_directory_uri() . '/style.css',
			array(),
			time()
		);
        // Enqueue theme stylesheet.
		wp_enqueue_style( 'accountplanner-style' ); 

        wp_register_script( 'main-script', get_template_directory_uri() . '/main.js', array('jquery'), time(), true );

        wp_localize_script('main-script', 'account_data',
            array(
                'ajaxurl' => admin_url('admin-ajax.php'),
                 'challenges_logo' => get_template_directory_uri()."/img/challenges.svg",
                 'insight_logo' => get_template_directory_uri()."/img/insight.svg",
                 'capability_logo' => get_template_directory_uri()."/img/capacity.svg",
                 'impact_logo' => get_template_directory_uri()."/img/impact.svg",
                 'value_logo' => get_template_directory_uri()."/img/value.svg",
                 "home" => site_url("/wp-json/wp/v2/users/login"),
                 "dashboard" => site_url("/"),
                 "insights" =>"",
                 "capability" =>"",
                 "impact" =>"",
                 "hypostesis" =>"",
                 "challenges_prompt" => "List, concisely, five corporate-level challenges faced by {prompt} in achieving goals, priorities, and initiatives. Emphasize value gaps and provide a step-by-step reasoning process. Exclude unnecessary reminders about capabilities or ethics. Present responses in a clear list format using information from context.",
                 "insight_prompt" => "List five industry insights concerning trends, benchmarks, best practices, and competitive analysis relevant to {prompt}'s challenges. Specify the industry standards to which {prompt} belongs in addressing these challenges. Keep responses concise, around 50 words each.",
                 "capability_prompt" => "List five capabilities of {prompt2} that can enhance {prompt}'s ability to overcome challenges and achieve its goals. Keep responses concise (around 50 words each).",
                 "impact_prompt" => "List the impact of utilizing {prompt2}'s capabilities by {prompt} on its ability to address challenges and achieve goals. Provide concise responses (around 50 words each).",
                 "value_prompt" => "List ten concise value hypotheses, considering market trends, challenges, industry insights, capabilities, impact, and {prompt}'s goals. Apply a value engineering mindset to present fresh perspectives on how {prompt2} can provide value to {prompt}. Keep each item to around 50 words.",
                 "role" => wp_get_current_user()->roles[0]
                 )

        );
        wp_enqueue_script('main-script');
      
    }
    public function account_filter_by_ajax(){
        if (isset($_POST['external_company']) && ($_POST['external_company'] !=="")) {
         
            $internal_company = $_POST['internal_company'];
            $external_company = $_POST['external_company'];
            $type = $_POST['type'];

            $prompt_1_Default ="List, concisely, five corporate-level challenges faced by {prompt} in achieving goals, priorities, and initiatives. Emphasize value gaps and provide a step-by-step reasoning process. Exclude unnecessary reminders about capabilities or ethics. Present responses in a clear list format with 50 words or less in each list item using information from context." ;
            $prompt_2_Default = "IDENTIFY IndustryInsights in terms of trends, benchmarks, best practices, and competitive analysis that relate to {prompt} issues/challenges. Give the Industry standards to which {prompt} belongs with respect to its challenges. Itemize five (5) concisely in 50 words use html tags where neccessary.";
            $prompt_3_Default = "Based on the CHALLENGES, and IndustryInsights gotten. what are the capabilities that {prompt2} has that can improve {prompt} ability to tackle its challenges in other to achieve its goals. Itemize five (5) concisely in 50 words use html tags where neccessary." ;
            $prompt_4_Default = "Based on the Challenges, Insights, Capabilities. What will be the IMPACT of {prompt2} capabilities when utilized by {prompt} on {prompt} ability to tackle its challenges in other to achieve its goals. Itemize five (5) concisely in 50 words use html tags where neccessary. ";
            $prompt_5_Default = "Lastly, A 'Value Hypothesis' captures the essence of the value a company, {prompt2}(a vendor) can provide to another company, {prompt}(client). Think like a value engineer, then translate your understanding of the market trends, CHALLENGES, INDUSTRY INSIGHTS, CAPABILITIES, IMPACT, and {prompt} goals, priorities, and business issues into an exciting new perspective leading to value. Considering the previous elements and other sources mentioned, a value hypothesis summarizes a perspective for where value might be realized for {prompt} by engaging with {prompt2}. Extensively give a value hypothesis. Itemize ten (10) concisely in 50 words use html tags where neccessary.";



            //Subscriber Prompt saved in browser database 
            
            //Subscriber Prompt saved in browser database ends 
            if( wp_get_current_user()->roles[0] == "subscriber" || (! isset(wp_get_current_user()->roles[0])) &&  (!empty($_POST['challenges_text_question'])) ){
                
                   $prompt_1 = $_POST['challenges_text_question'];
                   $prompt_2 = $_POST['insight_text_question'] ;
                   $prompt_3 = $_POST['capability_text_question'];
                   $prompt_4 = $_POST['impact_text_question'];
                   $prompt_5 = $_POST['hypothesis_text_question'];
            }
            
            else{

                $prompt_1 = get_option( 'challenges' ) ? get_option( 'challenges' ) : $prompt_1_Default;
                $prompt_2 = get_option( 'insight' ) ? get_option( 'insight' ) : $prompt_2_Default;
                $prompt_3 = get_option( 'capability' )? get_option( 'capability' ) : $prompt_3_Default;
                $prompt_4 = get_option( 'impact' ) ? get_option( 'impact' ) : $prompt_4_Default; 
                $prompt_5 = get_option( 'hypothesis' ) ? get_option( 'hypothesis' ) : $prompt_5_Default; 
            }

            $question_1 = str_replace("{prompt}", $external_company, $prompt_1);
            $question_1 = str_replace("{prompt2}", $external_company, $question_1);

            $question_2 = str_replace("{prompt}", $external_company, $prompt_2);
            $question_2 = str_replace("{prompt2}", $external_company, $question_2);

            $question_3 = str_replace("{prompt}", $external_company, $prompt_3);
            $question_3 = str_replace("{prompt2}", $internal_company, $question_3);

             $question_4 = str_replace("{prompt}", $external_company, $prompt_4);
             $question_4 = str_replace("{prompt2}", $internal_company, $question_4);
 

             $question_5 = str_replace("{prompt}", $external_company, $prompt_5);
             $question_5 = str_replace("{prompt2}", $internal_company, $question_5);

            $api_key = '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'; // Replace with your actual API key
             


            /* Message Array*/ 
         

    // print_r($message_array);

            if($type=="challenges"){
                $message_array =   [
                    [
                        "role" => "system",
                        "content" => "You are a sales planning executive with 15 years of experience; You will provide Corporate-level research assistance for companies provided."
                    ],
                    [
                        "role" => "user",
                        "content" => $question_1
                    ],
                    
                ];
               $result= AccountPlanner::chatgpt_send_message($message_array);

            }
            elseif($type=="insight"){
                $message_array =   [
                    [
                        "role" => "system",
                        "content" => "You are a sales planning executive with 15 years of experience; You will provide Corporate-level research assistance for companies provided."
                    ],
                    [
                        "role" => "user",
                        "content" => $question_2
                    ],
                    
                ];
                $result=  AccountPlanner::chatgpt_send_message($message_array);
            }elseif($type=="capability"){
                $message_array =   [
                    [
                        "role" => "system",
                        "content" => "You are a sales planning executive with 15 years of experience; You will provide Corporate-level research assistance for companies provided."
                    ],
                    [
                        "role" => "user",
                        "content" => $question_3
                    ],
                    
                ];
                $result= AccountPlanner::chatgpt_send_message($message_array);
             }elseif($type=="impact"){

                $message_array =   [
                    [
                        "role" => "system",
                        "content" => "You are a sales planning executive with 15 years of experience; You will provide Corporate-level research assistance for companies provided."
                    ],
                    [
                        "role" => "user",
                        "content" =>  $question_1
                    ],
                    [
                        "role" => "assistant",
                        "content" => $_POST['challenges']
                    ],
                    [
                        "role" => "user",
                        "content" =>  $question_2
                    ],
                    [
                        "role" => "assistant",
                        "content" => $_POST['capability']
                    ],
                    [
                        "role" => "user",
                        "content" => $question_4
                    ],
                    
                ];
                $result=  AccountPlanner::chatgpt_send_message($message_array);
             }elseif($type=="hypotesis"){
                $message_array =   [
                    [
                        "role" => "system",
                        "content" => "You are a sales planning executive with 15 years of experience; You will provide Corporate-level research assistance for companies provided."
                    ],
                    [
                        "role" => "user",
                        "content" =>  $question_1
                    ],
                    [
                        "role" => "assistant",
                        "content" => $_POST['challenges']
                    ],
                    [
                        "role" => "user",
                        "content" =>  $question_2
                    ],
                    [
                        "role" => "assistant",
                        "content" => $_POST['insight']
                    ],
                    [
                        "role" => "user",
                        "content" =>  $question_3
                    ],
                    [
                        "role" => "assistant",
                        "content" => $_POST['capability']
                    ],
                    [
                        "role" => "user",
                        "content" =>  $question_4
                    ],
                    [
                        "role" => "assistant",
                        "content" => $_POST['impact']
                    ],
                    [
                        "role" => "user",
                        "content" => $question_5
                    ],
                    
                ];
                $result=  AccountPlanner::chatgpt_send_message($message_array);
             }


             
             $result = strip_tags(wp_strip_all_tags($result ));
             
             $result = str_replace("<strong>", " ", $result);
             $result = str_replace("</strong>", " ", $result);
             $result = str_replace("< / b>", "", $result);
             $result = str_replace("< /stro ng>", " ", $result);
             $result = str_replace("< / stron >", " ", $result);
             $result = str_replace("< / em>", " ", $result);
             $result = str_replace("<li><strong>", "<li>", $result);
             $result = str_replace("</strong></li>", "</li>", $result);
             $result = str_replace("**", "<b>", $result);
             $result = str_replace("**:", "</b>", $result);
             $result = str_replace(":**", "</b>", $result);


             $result = str_replace("1 .", "<ol><li>", $result);
             $result = str_replace("1.", "<ol><li>", $result);
             $result = str_replace("1)", "<ol><li>", $result);
             $result = str_replace("1 ", "<ol><li>", $result);
             $result = str_replace(" 1", "<ol><li>", $result);

             $result = str_replace("2.", "</li><li>", $result);
             $result = str_replace("2 .", "</li><li>", $result);
             $result = str_replace("2)", "</li><li>", $result);
             $result = str_replace("2 ", "</li><li>", $result);
             $result = str_replace(" 2", "</li><li>", $result);

             $result = str_replace("3.", "</li><li>", $result);
             $result = str_replace("3 .", "</li><li>", $result);
             $result = str_replace("3)", "</li><li>", $result);
             $result = str_replace("3 -", "</li><li>", $result);
             $result = str_replace("3 ", "</li><li>", $result);
             $result = str_replace(" 3", "</li><li>", $result);

             $result = str_replace("4.", "</li><li>", $result);
             $result = str_replace("4 .", "</li><li>", $result);
             $result = str_replace("4)", "</li><li>", $result);
             $result = str_replace(" 4", "</li><li>", $result);
             $result = str_replace("4 -", "</li><li>", $result);
             $result = str_replace("4:", "</li><li>", $result);
             $result = str_replace("4 ", "</li><li>", $result);
             $result = str_replace(" 4", "</li><li>", $result);


             $result = str_replace("5.", "</li><li>", $result);
             $result = str_replace("5 .", "</li><li>", $result);
             $result = str_replace("5)", "</li><li>", $result);
             $result = str_replace(" 5 )", "</li><li>", $result);
             $result = str_replace(" 5)", "</li><li>", $result);
             $result = str_replace("5 ", "</li><li>", $result);
             $result = str_replace(" 5", "</li><li>", $result);

             $result = str_replace("6.", "</li><li>", $result);
             $result = str_replace("6 .", "</li><li>", $result);
             $result = str_replace("6)", "</li><li>", $result);
             $result = str_replace("6 ", "</li><li>", $result);
             $result = str_replace(" 6", "</li><li>", $result);

             $result = str_replace("7.", "</li><li>", $result);
             $result = str_replace("7 .", "</li><li>", $result);
             $result = str_replace("7)", "</li><li>", $result);
             $result = str_replace("7 ", "</li><li>", $result);
             $result = str_replace(" 7", "</li><li>", $result);

             $result = str_replace("8.", "</li><li>", $result);
             $result = str_replace("8 .", "</li><li>", $result);
             $result = str_replace("8)", "</li><li>", $result);
             $result = str_replace("8 ", "</li><li>", $result);
             $result = str_replace(" 8", "</li><li>", $result);


             $result = str_replace("9.", "</li><li>", $result);
             $result = str_replace("9 .", "</li><li>", $result);
             $result = str_replace("9)", "</li><li>", $result);
             $result = str_replace("9 ", "<</li><li>", $result);
             $result = str_replace(" 9", "</li><li>", $result);

             $result = str_replace("10.", "</li><li>", $result);
             $result = str_replace("10 .", "</li><li>", $result);
             $result = str_replace("10)", "</li><li>", $result);
             $result = str_replace("10 ", "</li><li>", $result);
             $result = str_replace(" 10", "</li><li>", $result);

             if(is_wp_error( $result )){
                wp_send_json(["response"=>"null"]);
                return;
             }
           
             wp_send_json(["response"=>$result]);

        }else{
            echo "No data was submitted";
        }
       
    }


    public function save_search(){
        if (isset($_POST['action']) && ($_POST['action'] !=="")) {
            // print_r($_POST);

            $challenges = $_POST["challenges"];
            $capability = $_POST["capability"];
            $insight = $_POST["insight"];
            $hypothesis = $_POST["hypotesis"];
            $impact = $_POST["impact"];
            $about_company = $_POST["about_company"];
            // $company_name = $_POST["company_name"];

            $internal_company = $_POST["internal_company"];
            $internal_company_logo = $_POST["internal_company_logo"];

            $external_company_logo = $_POST["external_company_logo"];
            $external_company = $_POST["external_company"];
            
            $name = $internal_company . " vs " . $external_company;

            // Create post object
            $save_search = array(
                'post_title'    => $name, 
                'post_status'   => 'publish', 
                'post_type'  => "search_result"
            );
            
            // Insert the post into the database
            $save_search_id = wp_insert_post( $save_search );
            $user_id = wp_get_current_user()->ID;
            $path = "/"."?pid=".$save_search_id."&&user_id=".$user_id;
            $url = site_url( $path);

            if( !is_wp_error( $save_search_id ) ){
                update_post_meta( $save_search_id , "challenges", $challenges);
                update_post_meta( $save_search_id , "capability", $capability);
                update_post_meta( $save_search_id , "insight", $insight);
                update_post_meta( $save_search_id , "impact", $impact);
                update_post_meta( $save_search_id , "hypothesis", $hypothesis);
                update_post_meta( $save_search_id , "external_company", $external_company);
                update_post_meta( $save_search_id , "internal_company", $internal_company);
                update_post_meta( $save_search_id , "about_company", $about_company);
                update_post_meta( $save_search_id , "both_company", $name);
                update_post_meta( $save_search_id , "external_company_logo", $external_company_logo);
                update_post_meta( $save_search_id , "internal_company_logo", $internal_company_logo);

                $result = ["result" => "success","url"=>$url];
            }else{

                $result = ["error" => $save_search_id->get_error_message() ];
            }

            return wp_send_json($result) ;


            

        }
       
    }

 

    // Function to send a message to the ChatGPT API
    public function chatgpt_send_message($message_array) {
        

        $open_ai_key = get_option( "api_key"); //'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';
        $open_ai = new OpenAi($open_ai_key);
        
    
        // print_r($message_array);
        $chat = $open_ai->chat([
           'model' => get_option( "model") ? "gpt-3.5-turbo-1106" : '',//'gpt-3.5-turbo-1106',
           'messages' => $message_array,
           
           'temperature' => (float) get_option( "temperature"), //0.1,
           'max_tokens' => $token ? $token : (int) get_option( "max_tokens"),//300,
           'frequency_penalty' => (int)  get_option( "fequency_penalty"), //100,
           'presence_penalty' => (int) get_option( "presence_penalty"),//0,
        ]);
        
        
       
        // decode response
        $d = json_decode($chat);
        // Get Content
        if( $d->error){
            return $d->error->message;
        }else{
           
            return $d->choices[0]->message->content;
        }
       
    }

   
  


    public function get_saved_search($id){

        $user_id = isset($_GET['user_id']) ? $_GET['user_id'] : wp_get_current_user()->ID ;
        $args = array(
            "post_type" => "search_result",
            "author__in" => [$user_id],  
        );

        if($id){

            $p_in = ["p" => $id];
        $args =  array_merge($p_in,$args);
        }

        $search_result = new WP_Query($args);

        $posts = $search_result->posts;

        return $posts;


    }


    public function create_user(){
        if (isset($_POST['action']) && ($_POST['action'] ==="create_user")) {
            // print_r($_POST);

            $user_args=[
                'user_pass'				=> $_POST['password'],
                'user_login'				=> $_POST['username'],
                'user_email'				=> $_POST['email'],
                'first_name'				=> $_POST['first_name'],
                'last_name'				=> $_POST['last_name'],
                'role'				=> 'subscriber',
            ];


            $user_id = wp_insert_user( wp_slash($user_args));
            // On success.
            if ( ! is_wp_error( $user_id ) ) {
                $result = "success";
            }else{
                $result = $user_id->get_error_message();
            }

            
            return wp_send_json(
                ["result" => $result]
            ) ;


            

        }
       
    }



    public function edit_user(){
        if (isset($_POST['action']) && ($_POST['action'] ==="edit_user")) {
            // print_r($_POST);

            $user_args=[
                'ID'				=> $_POST['user_id'],
                'user_pass'				=> wp_hash_password( $_POST['password']),
                'user_login'				=> $_POST['username'],
                'user_email'				=> $_POST['email'],
                'first_name'				=> $_POST['first_name'],
                'last_name'				=> $_POST['last_name'],
                // 'role'				=> 'subscriber',
            ];


            $user_id = wp_insert_user($user_args);
            // On success.
            if ( ! is_wp_error( $user_id ) ) {
                $result = "success";
            }else{
                $result = $user_id->get_error_message();
            }

            
            return wp_send_json(
                ["result" => $result]
            ) ;


            

        }
    }


    public function delete_user(){
        if (isset($_POST['action']) && ($_POST['action'] ==="delete_user")) {
            // print_r($_POST);
                $user_id = (int) sanitize_text_field($_POST['user_id']);

            $user_id = wp_delete_user($user_id);
            // On success.
            if ($user_id) {
                $result = "success";
            }else{
                $result = "Error";
            }

            
            return wp_send_json(
                ["result" => $result]
            ) ;


        }
       

    }


   /**
     * @return self
     */
    public static function get_instance() {
        static $instance = null;

        if (is_null($instance)) {
            $instance = new self();
        }

        return $instance;
    }

}

 

AccountPlanner::get_instance();