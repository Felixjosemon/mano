<?php
/* validate verify token needed for setting up web hook */ 
if (isset(['hub_verify_token'])) { 
    if (['hub_verify_token'] === '1234') {
        echo ['hub_challenge'];
        return;
    } else {
        echo 'Invalid Verify Token';
        return;
    }
}
/* receive and send messages */
 = json_decode(file_get_contents('php://input'), true);
if (isset(['entry'][0]['messaging'][0]['sender']['id'])) {
     = ['entry'][0]['messaging'][0]['sender']['id']; //sender facebook id
     = ['entry'][0]['messaging'][0]['message']['text']; //text that user sent
     = 'https://graph.facebook.com/v2.6/me/messages?access_token=EAACZCBHTxqYQBAKcj3K3MnHngLX5U0QJiclTYtDB52kxpek7Lot5nNl3W7Dqp8ya77QiGPNzPNTOexqASATMr2l3vDaPPNtuQRaNBGWMsnOZB8xo8QfboOkeqaFTlZApaUBdtLdPvyW2w98LCPlYVkPwfmDde0wD5KQHH9JOgZDZD';
    /*initialize curl*/
     = curl_init();
    /*prepare response*/
     = '{
    
recipient:{
        id: . $sender . 
        },
        message:{
            text:You
said
 . $message . 

        }
    }';
    /* curl setting to send a json post data */
    curl_setopt(, CURLOPT_POST, 1);
    curl_setopt(, CURLOPT_POSTFIELDS, );
    curl_setopt(, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    if (!empty()) {
         = curl_exec(); // user will get the message
    }
}
?>

