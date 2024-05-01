<?php
    
namespace App\Services;
use MailchimpMarketing\ApiClient;

class Newsletter
{
    public function subscribe(string $email, string $list=null)
    {
        $list ??= config('services.mailchimp.lists.subscribers');
        // $mailchimp = new ApiClient();
        
        // $mailchimp->setConfig([
        //     'apiKey' => config('services.mailchimp.key'),
        //     'server' => 'us18'
        // ]);
        
        // return $mailchimp->lists->addListMember('9da31f5c2d', [
        // return $mailchimp->lists->addListMember(config('services.mailchimp.lists.subscribers'), [
        // return $mailchimp->lists->addListMember($list, [
        return $this->client()->lists->addListMember($list, [
            'email_address' => $email,
            'status' => 'subscribed'
        ]);
    }
    
    public function client()
    {
        // $mailchimp = new ApiClient();
        
        // return $mailchimp->setConfig([
        return (new ApiClient())->setConfig([
            'apiKey' => config('services.mailchimp.key'),
            'server' => 'us18'
        ]);
    }
}