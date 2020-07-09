<?php

//print_r($_POST) ;

extract($_POST);






if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['recaptcha_response'])) {

    // Build POST request:
    $recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
    $recaptcha_secret = '6LfgxK4ZAAAAAJaPRLZ5lWDSTc1EzkTVTc2XkOaI';
    $recaptcha_response = $_POST['recaptcha_response'];

    // Make and decode POST request:
    $recaptcha = file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response);
    $recaptcha = json_decode($recaptcha);

    // Take action based on the score returned:
    if ($recaptcha->score >= 0.5) {
       
       
                
                $email_recipients = "clezz5593@gmail.com,footballworld.india@gmail.com";
                
                $email_web ='footballworld.india@gmail.com';
                $visitors_email_field = $email;
                
                $email_subject = "New Form submission";
                
               
                $client_response ="
                Hi ,
                
                You have a new Enquiry 
                
                Name: $name
                Phone Number : $phoneNumber
                Email : $email
                Subject : $message
                
                
                Regards,
                Football World Website
                
                ";
               
               
                  /* Response mail */
                 $headers = "From:  $email_web \r\n";
                  @mail(/*to*/$email_recipients, $email_subject, $client_response, $headers);
                  
               
               /***************************** End of Client Mail***********************************/
               
                //Update the following auto-response to the user
                $auto_response_subj = "Thanks for contacting us";
                $auto_response ="
                Hi $name ,
                
                Thanks for contacting us. We will get back to you soon!
                
                Regards
                Football World India
                
                ";
                
                /*optional settings. better leave it as is for the first time*/
                $email_from = 'footballworld.india@gmail.com'; /*From address for the emails*/
                $thank_you_url = 'footballworld.india@gmail.com';/*URL to redirect to, after successful form submission*/
                
                
            /* Response mail */
                 $headers = "From: $email_from \r\n";
                  @mail(/*to*/$email, $auto_response_subj, $auto_response,$headers);
                  
                  
                  
            
      
            
            
            
            
            
            
                  
                
                
                
                echo json_encode(['success'=> true]);

       
       
       
       
       
    } else {
        
         echo json_encode(['success'=> false]);
        
    }

}











?>