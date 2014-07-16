<?php

class MailTracker extends Eloquent
{
  // defining the name of the table
  protected $table = 'mail_tracker';

  /**
   * This is the public function to send the email. 
   * Rest of the internal activities will be handled by this function.
   * 
   * @param email address to send the email $mail_to_address
   * @param email address to from which we want to send the email $mail_from_address
   * @param email subject $mail_subject
   * @param email body content (typically a view) $mail_body
   * @param the name which will come in the to field $mail_to_name
   * @param the name which will come in from field $mail_from_name
   */
  public function sendMail ($mail_to_address, $mail_from_address, $mail_subject, 
      $mail_body, $mail_to_name = null, $mail_from_name = null)
  {
    // adding the entry to the table
    $mail_id = $this->addMailTrackerEntry($mail_to_address, $mail_from_address, 
        $mail_subject, $mail_body, $mail_to_name, $mail_from_name);
    
    // sending the email after the entry is made to the table
    $this->triggerMail($mail_id);
  }

  /**
   * This function will add an entry in the Mail tracker table about the email which is being sent.
   * This function will return the mail_id which is being added into the table. This is an internal 
   * function which is called by the public function. After send mail the status and send time is
   * getting updated.
   * 
   * @param email address to send the email $mail_to_address
   * @param email address to from which we want to send the email $mail_from_address
   * @param email subject $mail_subject
   * @param email body content (typically a view) $mail_body
   * @param the name which will come in the to field $mail_to_name
   * @param the name which will come in from field $mail_from_name
   */
  protected function addMailTrackerEntry ($mail_to_address, $mail_from_address, 
      $mail_subject, $mail_body, $mail_to_name, $mail_from_name)
  {
    $row_data = array(
        'mail_to_address' => $mail_to_address,
        'mail_to_name' => ($mail_to_name == null) ? $mail_to_address : $mail_to_name,
        'mail_from_address' => $mail_from_address,
        'mail_from_name' => ($mail_from_name == null) ? $mail_from_address : $mail_from_name,
        'mail_subject' => $mail_subject,
        'mail_body' => $mail_body,
        'mail_created' => time()
    );
    
    return DB::table($this->table)->insertGetId($row_data);
  }

  /**
   * This function will udate the sent time of the email and status.
   * This is an internal function and it is being called by the public function.
   * @param unknown $mail_id
   */
  protected function updateMailStatus ($mail_id)
  {
    DB::table($this->table)->where('mail_id', $mail_id)->update(
        array(
            'mail_sent' => time(),
            'mail_status' => 1
        ));
  }

  protected function triggerMail ($mail_id)
  {
    $mail_row = DB::table($this->table)->where('mail_id', $mail_id)->first();
    // setting the server, port and encryption
    $transport = Swift_SmtpTransport::newInstance('smtp.gmail.com', 465, 'ssl')->setUsername(
        'amitavroy@gmail.com')->setPassword('2ISrQfDqajRq1-de400d');
    
    // creating the Swift_Mailer instance and pass the config settings
    $mailer = Swift_Mailer::newInstance($transport);
    
    // configuring the Swift mail instance with all details
    $message = Swift_Message::newInstance($mail_row->mail_subject)->setFrom(
        array(
            $mail_row->mail_from_address => $mail_row->mail_from_name
        ))
      ->setTo(
        array(
            'amitav.roy@focalworks.in' => 'Amitav Office'
        ))
      ->setBody($mail_row->mail_body, 'text/html');
    
    try
    {
      $mailer->send($message);
      
      // once the mail has been sent, updating the mail status
      $this->updateMailStatus($mail_id);
    } catch (Exception $e)
    {
      die('Error sending email. ' . $e);
    }
  }
}