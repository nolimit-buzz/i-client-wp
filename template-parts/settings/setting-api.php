<div class="tab-content api">
        <div class="prompt-header">
            <div>PROMPTS</div>
        </div>


        <div class="api-cards">

            <div class="api-card"> 
                <span class="api-label">API KEY</span>
                <input type="text" name="key" value="<?php echo get_option("api_key") ; ?>" placeholder="SK....... GR">
            </div>
            <div class="api-card"> 
                <span class="api-label">MAX TOKENS</span>
                <input type="text" name="max_tokens" value="<?php echo get_option("max_tokens") ; ?>" placeholder="300">
            </div>
            <div class="api-card"> 
                <span class="api-label">MODEL </span>
            <select  name="model">
                <option value="gpt-4" <?php echo selected( get_option("model"), "gpt-4") ; ?>>  gpt-4	 </option>
                <option <?php echo selected( get_option("model"), "gpt-3.5-turbo") ; ?> value="gpt-3.5-turbo"> gpt-3.5-turbo </option>

                <option <?php echo selected( get_option("model"), "gpt-3.5-turbo-1106") ; ?> value="gpt-3.5-turbo-1106">  gpt-3.5-turbo-1106	 </option>

            </select>

        </div>
            <div class="api-card"> 
                <span class="api-label">TEMPERATURE</span>
                <input type="text" name="temperature" value="<?php echo get_option("temperature") ; ?>" placeholder="SK....... GR">
            </div>
            <div class="api-card"> 
                <span class="api-label">PRESENCE PENALTY</span>
                <input type="text" name="presence_penalty" value="<?php echo get_option("presence_penalty") ; ?>" placeholder="0.1">
            </div>
            <div class="api-card"> 
                <span class="api-label">FREQUENCY PENALTY</span>
                <input type="text" name="fequency_penalty" value="<?php echo get_option("fequency_penalty") ; ?>"   placeholder="100">
            </div>
       
        </div>

</div>
 


       