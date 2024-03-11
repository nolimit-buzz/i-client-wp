<?php 

$prompt_1_Default ="List, concisely, five corporate-level challenges faced by {prompt} in achieving goals, priorities, and initiatives. Emphasize value gaps and provide a step-by-step reasoning process. Exclude unnecessary reminders about capabilities or ethics. Present responses in a clear list format with 50 words or less in each list item using information from context." ;
$prompt_2_Default = "IDENTIFY IndustryInsights in terms of trends, benchmarks, best practices, and competitive analysis that relate to {prompt} issues/challenges. Give the Industry standards to which {prompt} belongs with respect to its challenges. Itemize five (5) concisely in 50 words use html tags where neccessary.";
$prompt_3_Default = "Based on the CHALLENGES, and IndustryInsights gotten. what are the capabilities that {prompt2} has that can improve {prompt} ability to tackle its challenges in other to achieve its goals. Itemize five (5) concisely in 50 words use html tags where neccessary." ;
$prompt_4_Default = "Based on the Challenges, Insights, Capabilities. What will be the IMPACT of {prompt2} capabilities when utilized by {prompt} on {prompt} ability to tackle its challenges in other to achieve its goals. Itemize five (5) concisely in 50 words use html tags where neccessary. ";
$prompt_5_Default = "Lastly, A 'Value Hypothesis' captures the essence of the value a company, {prompt2}(a vendor) can provide to another company, {prompt}(client). Think like a value engineer, then translate your understanding of the market trends, CHALLENGES, INDUSTRY INSIGHTS, CAPABILITIES, IMPACT, and {prompt} goals, priorities, and business issues into an exciting new perspective leading to value. Considering the previous elements and other sources mentioned, a value hypothesis summarizes a perspective for where value might be realized for {prompt} by engaging with {prompt2}. Extensively give a value hypothesis. Itemize ten (10) concisely in 50 words use html tags where neccessary.";


?>


<div class="tab-content prompt">



        <div class="prompt-header">
            <div>PROMPTS 
                <code id="reset_prompt" style="padding: 5px 15px;
                background: #ff00001a;
                border-radius: 15px;
                text-align: center;
                cursor: pointer;
                margin-left: 20px;">  Reset Prompt &#8635;  </code>
                <div style="    margin-top: 15px; color: #5e5c5c;">  NB: After reset, you need to save the prompt.</div>

            </div>
        </div>


        <div class="prompt-cards">

            <div class="prompt-card">
             <div class="prompt-label">Challenges</div>
                <div  class="prompt-content"  name="challenges" contenteditable='true'><?php echo get_option( 'challenges' ) ?:  $prompt_1_Default  ?></div>
            </div>


            <div class="prompt-card">
              <div class="prompt-label">Insights</div>
                <div  class="prompt-content"  name="insight" contenteditable='true'><?php echo get_option( 'insight' )  ?:  $prompt_2_Default ?></div>
            </div>


            <div class="prompt-card">
               <div class="prompt-label">Capabilities</div>
                <div  class="prompt-content"  name="capability" contenteditable='true'><?php echo get_option( 'capability' ) ?:  $prompt_3_Default  ?></div>
            </div>

            <div class="prompt-card">
               <div class="prompt-label">Impact</div>
                <div  class="prompt-content"  name="impact" contenteditable='true'><?php echo get_option( 'impact' )  ?:  $prompt_4_Default ?></div>
            </div>

            <div class="prompt-card">
               <div class="prompt-label">Value Hypothesis</div>
                <div  class="prompt-content"  name="hypotesis" contenteditable='true'><?php echo get_option( 'hypothesis' ) ?:  $prompt_5_Default ?></div>
            </div>
            <div class="prompt-card last">
               <div class="prompt-label">NB: Tokens are used in the prompt</div>
                <div  class="prompt-content"  name="tokens" >  <code>{prompt}</code> token used in each prompt above represent 'first company' and token <code>{prompt1}</code> represent 'second company'. Feel free </div>
            </div>
        </div>

 

</div>
       