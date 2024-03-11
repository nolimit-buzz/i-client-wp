<?php

namespace src\Classes;

class AccountPlanner {

    public string $challenges = "";
    public string $insights = "";
    public string $capability = "";
    public string $impact = "";
    public string $hypotesis = "";


    public function __construct(){

        // Filter ajax add action Callback
        add_action('wp_ajax_account_filter_by_ajax', array($this,'account_filter_by_ajax'));//Filter new : ajax
        add_action('wp_ajax_nopriv_account_filter_by_ajax', array($this,'account_filter_by_ajax'));//Filter new : ajax

        // Filter ajax add action Callback
        add_action('wp_ajax_account_filter_by_ajax2', array($this,'account_filter_by_ajax2'));//Filter new : ajax
        add_action('wp_ajax_nopriv_account_filter_by_ajax2', array($this,'account_filter_by_ajax2'));//Filter new : ajax

        // Filter ajax add action Callback
        add_action('wp_ajax_account_filter_by_ajax3', array($this,'account_filter_by_ajax3'));//Filter new : ajax
        add_action('wp_ajax_nopriv_account_filter_by_ajax3', array($this,'account_filter_by_ajax3'));//Filter new : ajax

        // Filter ajax add action Callback
        add_action('wp_ajax_account_filter_by_ajax4', array($this,'account_filter_by_ajax4'));//Filter new : ajax
        add_action('wp_ajax_nopriv_account_filter_by_ajax4', array($this,'account_filter_by_ajax4'));//Filter new : ajax

        // Filter ajax add action Callback
        add_action('wp_ajax_account_filter_by_ajax5', array($this,'account_filter_by_ajax5'));//Filter new : ajax
        add_action('wp_ajax_nopriv_account_filter_by_ajax5', array($this,'account_filter_by_ajax5'));//Filter new : ajax


         // Filter ajax add action Callback
         add_action('wp_ajax_account_filter_by_company_details', array($this,'account_filter_by_company_details'));//Filter new : ajax
         add_action('wp_ajax_nopriv_account_filter_by_company_details', array($this,'account_filter_by_company_details'));//Filter new : ajax


        
        add_action('wp_enqueue_scripts', [$this, 'account_script_enqueuer']);

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
			$version_string
		);
        // Enqueue theme stylesheet.
		wp_enqueue_style( 'accountplanner-style' ); 

        wp_enqueue_script( 'main-script', get_template_directory_uri() . '/main.js', array('jquery'), time(), true );

        wp_localize_script('main-script', 'account_data',
            array(
                'ajaxurl' => admin_url('admin-ajax.php'),
                'last_message' => [],
                'internal_company_logo' => "",
                'internal_company_name' => "",
                'external_company_logo' => "",
                'external_company_name' => "",
                'about_external' => "",
                
                )
        );
        wp_enqueue_script('main-script');
      
    }

    public function account_filter_by_company_details(){
        if (isset($_POST['external_company']) && ($_POST['external_company'] !=="")) {
         
            $internal_company = $_POST['internal_company'];
            $external_company = $_POST['external_company'];
            $message = "Return the official ".$internal_company." and ".$external_company." company website url respectively in a JSON using internal_company and external_company key. Also include ".$external_company." company summary in a external_company_bio key. JSON format should be {internal_company:value,external_company:value,external_company_bio:value} ";
 
            wp_send_json(AccountPlanner::chatgpt_send_message($message,""));
        }
       
    }


    public function account_filter_by_ajax(){
        if (isset($_POST['external_company']) && ($_POST['external_company'] !=="")) {
         
            $internal_company = $_POST['internal_company'];
            $external_company = $_POST['external_company'];

            $prompt_1 ="You are a sales planning executive with 15 years of experience; provide Corporate-level challenges 
            that {prompt} is facing in activating their goals, priorities, and initiatives. You know the intricacies of 
            these fields. I want you to reason step-by-step to Identify and itemize the most critical challenges faced 
            by {prompt} showing their value gaps, summarize and itemize them concisely in 100 words use html tags where neccessary." ;
            $question_1 = str_replace("{prompt}", $external_company, $prompt_1);


            $prompt_2 = "IDENTIFY industry trends, benchmarks, best practices, competitive analysis,  use cases, and strategic recommendations that relate to business issues/challenges. Give the Industry standards to which {prompt} belongs with respect to its challenges in just 100 words. ITEMIZE the answer in HTML format list";
            $question_2 = str_replace("{prompt}", $external_company, $prompt_2);


            $prompt_3 = "Based on the CHALLENGES, and IndustryInsights gotten. what are the capabilities that {prompt2} has that can improve {prompt} ability to tackle its challenges in other to achieve 
            its goals in another 100 words? ITEMIZE the answer. Furthermore, what will be the IMPACT of {prompt2} capabilities when utilized by {prompt} on {prompt} ability to tackle its challenges in other to achieve 
            its goals in another 100 words? ITEMIZE the answer in HTML format list and all open sub list must be closed apropriately. " ;
            
            $question_3 = str_replace("{prompt}", $external_company, $prompt_3);
            $question_3 = str_replace("{prompt2}", $internal_company, $question_3);




            $prompt_4 = "Based on the Challenges, Insights, Capabilities. What will be the IMPACT of {prompt2} capabilities when utilized by {prompt} on {prompt} ability to tackle its challenges in other to achieve its goals in 100 words. ITEMIZE the answer in HTML format list items and all open list must be closed";
            $question_4 = str_replace("{prompt}", $external_company, $prompt_4);
            $question_4 = str_replace("{prompt2}", $internal_company, $question_4);



            $prompt_5 = "Lastly, A 'Value Hypothesis' captures the essence of the value a company, {prompt2}(a vendor) can provide to another company, {prompt}(client). Think like a value 
            engineer, then translate your understanding of the market trends, CHALLENGES, INDUSTRY INSIGHTS, CAPABILITIES, IMPACT, 
            and {prompt} goals, priorities, and business issues into an exciting new perspective leading to value. 
            Considering the previous elements and other sources mentioned, a value hypothesis summarizes a perspective 
            for where value might be realized for {prompt} by engaging with {prompt2}. Extensively give a value hypothesis. use html tags where neccessay
            ";
            
            $question_5 = str_replace("{prompt}", $external_company, $prompt_5);
            $question_5 = str_replace("{prompt2}", $internal_company, $question_5);


            echo $challenges = AccountPlanner::chatgpt_send_message($question_1);
            echo  $insights = AccountPlanner::chatgpt_send_message($question_2);
            echo $capability = AccountPlanner::chatgpt_send_message($question_3);
            echo $impact = AccountPlanner::chatgpt_send_message($question_4);
            echo  $hypotesis = AccountPlanner::chatgpt_send_message($question_5);




        }
       
    }


    public function account_filter_by_ajax2(){
        if (isset($_POST['last_message']) && ($_POST['last_message'] !== "")) {
         
            $internal_company = $_POST['internal_company'];
            $external_company = $_POST['external_company'];
            $last_message = $_POST['last_message'];

            $prompt_2 = "IDENTIFY industry trends, benchmarks, best practices, competitive analysis,  use cases, and strategic recommendations that relate to business issues/challenges. Give the Industry standards to which {prompt} belongs with respect to its challenges in just 100 words. ITEMIZE the answer in HTML format list";
         
            $question_2 = str_replace("{prompt}", $external_company, $prompt_2);

            echo  $insights = AccountPlanner::chatgpt_send_message($question_2,$last_message);
        
        }
       
    }

    public function account_filter_by_ajax3(){
        if (isset($_POST['last_message']) && ($_POST['last_message'] !=="")) {
         
            $internal_company = $_POST['internal_company'];
            $external_company = $_POST['external_company'];
            $last_message = $_POST['last_message'];

            $prompt_3 = "Based on the CHALLENGES, and IndustryInsights gotten. what are the capabilities that {prompt2} has that can improve {prompt} ability to tackle its challenges in other to achieve 
            its goals in another 100 words? ITEMIZE the answer. Furthermore, what will be the IMPACT of {prompt2} capabilities when utilized by {prompt} on {prompt} ability to tackle its challenges in other to achieve 
            its goals in another 100 words? ITEMIZE the answer in HTML format list and all open sub list must be closed apropriately. " ;
            
            $question_3 = str_replace("{prompt}", $external_company, $prompt_3);
            $question_3 = str_replace("{prompt2}", $internal_company, $question_3);

            echo $capability = AccountPlanner::chatgpt_send_message($question_3,$last_message);
         
        }
       
    }

    public function account_filter_by_ajax4(){
        if (isset($_POST['last_message']) && ($_POST['last_message'] !=="")) {
         
            $internal_company = $_POST['internal_company'];
            $external_company = $_POST['external_company'];
            $last_message = $_POST['last_message'];

            $prompt_4 = "Based on the Challenges, Insights, Capabilities. What will be the IMPACT of {prompt2} capabilities when utilized by {prompt} on {prompt} ability to tackle its challenges in other to achieve its goals in 100 words. ITEMIZE the answer in HTML format list items and all open list must be closed";
            $question_4 = str_replace("{prompt}", $external_company, $prompt_4);
            $question_4 = str_replace("{prompt2}", $internal_company, $question_4);

            echo $impact = AccountPlanner::chatgpt_send_message($question_4,$last_message);
            
        }
       
    }

    public function account_filter_by_ajax5(){
        if (isset($_POST['last_message']) && ($_POST['last_message'] !=="")) {
         
            $internal_company = $_POST['internal_company'];
            $external_company = $_POST['external_company'];
            $last_message = $_POST['last_message'];

            $prompt_5 = "Lastly, A 'Value Hypothesis' captures the essence of the value a company, {prompt2}(a vendor) can provide to another company, {prompt}(client). Think like a value 
            engineer, then translate your understanding of the market trends, CHALLENGES, INDUSTRY INSIGHTS, CAPABILITIES, IMPACT, 
            and {prompt} goals, priorities, and business issues into an exciting new perspective leading to value. 
            Considering the previous elements and other sources mentioned, a value hypothesis summarizes a perspective 
            for where value might be realized for {prompt} by engaging with {prompt2}. Extensively give a value hypothesis. use html tags where neccessay
            ";
            
            $question_5 = str_replace("{prompt}", $external_company, $prompt_5);
            $question_5 = str_replace("{prompt2}", $internal_company, $question_5);

            echo  $hypotesis = AccountPlanner::chatgpt_send_message($question_5,$last_message);
            
        }
       
    }

    // Function to send a message to the ChatGPT API
    public function chatgpt_send_message($question) {

        $api_key = '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'; // Replace with your actual API key
        $url = 'https://api.openai.com/v1/chat/completions';
        
        $data = [];

        // if($last_message){
        //     foreach ($last_message as $key => $message) {
        //         $data['messages'][] = ['role' => 'assistant', 'content' => $message];
        //     }
        // }

        $data = array(
            'max_tokens' => 3500, // Adjust this based on your needs
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                ['role' => 'user', 'content' => $question]
              ],
            "temperature" => 0.7
        );

        $data = json_encode($data);

        $args = array(
            'headers' => array(
                'Content-Type' => 'application/json',
                'Authorization' => "Bearer $api_key",
            ),
            'body' => $data,
            'timeout' => 90, // Set the timeout to 10 seconds
            
        );

        $response = wp_remote_post($url, $args);

        if (is_wp_error($response)) {
            return 'Error: ' . $response->get_error_message();
        } else {
            $body = wp_remote_retrieve_body($response);
            
            $data = json_decode($body, true);
            // echo '<pre>';
            // print_r($data);
            // echo '</pre>';

           return $res = $data['choices'][0]['message']['content'];
            
        
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