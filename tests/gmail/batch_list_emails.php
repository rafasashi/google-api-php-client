        
        $optParams = [];
        $optParams['maxResults'] = 5;
        $optParams['labelIds'] = 'INBOX'; // Only show messages in Inbox
        $optParams['q'] = 'subject:hello'; // search for hello in subject

        $messages = $service->users_messages->listUsersMessages($email_id,$optParams);

        $list = $messages->getMessages();

            $client->setUseBatch(true);

            $batch = new Google_Http_Batch($client);                

            foreach($list as $message_data){

                $message_id = $message_data->getId();

                $optParams = array('format' => 'full');

                $request = $service->users_messages->get($email_id,$message_id,$optParams);

                $batch->add($request, $message_id);                 
            }

            $results = $batch->execute();
