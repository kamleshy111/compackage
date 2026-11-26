<?php

namespace App\Console\Commands;
use Carbon\Carbon;
use App\Models\Option;
use App\Models\Sales\Sales;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use App\Mail\WeeklyDemoReport;
use App\Models\Admin\DemoInquiry;
use Illuminate\Support\Facades\Mail;



class DemoEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'usersdemo:weekly-demo-report';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'weekly demo report';

    /**
     * Execute the console command.
     *
     * @return int
     */
    
    public function handle()
    {
        try {
            // Retrieve the option value from the Option model
            DemoInquiry::whereIn('became_order', [2, 0])->where('deleted', 0) ->whereDate('created_at', Carbon::now()->subDays(7))->each(function($demo) {
            //DemoInquiry::where('became_order', [2, 0])->whereDate('created_at', Carbon::now()->subDays(7))->each(function($demo) {
                $emailContent   = Option::where('option_name', 'week1')->value('option_value');
                $subject        = Option::where('option_name', 'subject_week1')->value('option_value');
                // Replace placeholders with actual values
                $firstname      = $demo->firstname; 
                $lastname       = $demo->lastname; 
                if(!empty($demo->email))
                {
                    $useremail       = $demo->email; 
                    $emailContent = str_replace('{First_Name}', $firstname, $emailContent);
                    $emailContent = str_replace('{Last_Name}', $lastname, $emailContent);
                    $emailContent = str_replace('{User_Email}', $useremail, $emailContent);
                    $emailContent = str_replace('<br>', '', $emailContent);
                    $emailContent = str_replace('{linebreak}', '<br>', $emailContent);
                    
                    if (!empty($emailContent) && !empty($subject)) {
                        Mail::send('emails.weekly_demo_report', ['content' => $emailContent, 'firstname' => $firstname], function ($message) use ($subject, $useremail){
                            $message->from('info@compackage.com', 'Joe Blattner, COMPackage')
                                    ->replyTo('jblattner@compackage.com')
                                    ->to([$useremail, 'vermadilipjpr@gmail.com'])
                                    ->subject($subject);
                        });
                        
                        $this->info('Weekly demo report email sent successfully.');
                    } else {
                        $this->error('Failed to send weekly demo report email: Email content is empty.');
                    }
                }
            });

            //DemoInquiry::where('became_order', [2, 0])->whereDate('created_at', Carbon::now()->subDays(14))->each(function($demo) {
            DemoInquiry::whereIn('became_order', [2, 0])->where('deleted', 0) ->whereDate('created_at', Carbon::now()->subDays(14))->each(function($demo) {
                $emailContent   = Option::where('option_name', 'week2')->value('option_value');
                $subject        = Option::where('option_name', 'subject_week2')->value('option_value');
                $firstname      = $demo->firstname; 
                $lastname       = $demo->lastname; 
                if(!empty($demo->email))
                {
                    $useremail       = $demo->email; 
                    $emailContent = str_replace('{First_Name}', $firstname, $emailContent);
                    $emailContent = str_replace('{Last_Name}', $lastname, $emailContent);
                    $emailContent = str_replace('{User_Email}', $useremail, $emailContent);
                    $emailContent = str_replace('<br>', '', $emailContent);
                    $emailContent = str_replace('{linebreak}', '<br>', $emailContent);
                    if (!empty($emailContent) && !empty($subject)) {
                        Mail::send('emails.weekly_demo_report', ['content' => $emailContent, 'firstname' => $firstname], function ($message) use ($subject, $useremail){
                            $message->from('info@compackage.com', 'Joe Blattner, COMPackage')
                                    ->replyTo('jblattner@compackage.com')
                                    ->to([$useremail, 'vermadilipjpr@gmail.com'])
                                    ->subject($subject);
                        });
                        $this->info('Weekly demo report email sent successfully.');
                    } else {
                        $this->error('Failed to send weekly demo report email: Email content is empty.');
                    }
                }
            });
            
            //DemoInquiry::where('became_order', [2, 0])->whereDate('created_at', Carbon::now()->subDays(21))->each(function($demo) {
            DemoInquiry::whereIn('became_order', [2, 0])->where('deleted', 0) ->whereDate('created_at', Carbon::now()->subDays(21))->each(function($demo) {
                $emailContent   = Option::where('option_name', 'week3')->value('option_value');
                $subject        = Option::where('option_name', 'subject_week3')->value('option_value');
                $firstname      = $demo->firstname; 
                $lastname       = $demo->lastname; 
                if(!empty($demo->email))
                {
                    $useremail       = $demo->email; 
                    $emailContent = str_replace('{First_Name}', $firstname, $emailContent);
                    $emailContent = str_replace('{Last_Name}', $lastname, $emailContent);
                    $emailContent = str_replace('{User_Email}', $useremail, $emailContent);
                    $emailContent = str_replace('<br>', '', $emailContent);
                    $emailContent = str_replace('{linebreak}', '<br>', $emailContent);
                    if (!empty($emailContent) && !empty($subject)) {
                        Mail::send('emails.weekly_demo_report', ['content' => $emailContent, 'firstname' => $firstname], function ($message) use ($subject, $useremail){
                            $message->from('info@compackage.com', 'Joe Blattner, COMPackage')
                                    ->replyTo('jblattner@compackage.com')
                                    ->to([$useremail, 'vermadilipjpr@gmail.com'])
                                    ->subject($subject);
                        });
                        $this->info('Weekly demo report email sent successfully.');
                    } else {
                        $this->error('Failed to send weekly demo report email: Email content is empty.');
                    }
                }
            });

            //DemoInquiry::where('became_order', [2, 0])->whereDate('created_at', Carbon::now()->subDays(28))->each(function($demo) {
            DemoInquiry::whereIn('became_order', [2, 0])->where('deleted', 0) ->whereDate('created_at', Carbon::now()->subDays(28))->each(function($demo) {
                $emailContent   = Option::where('option_name', 'week4')->value('option_value');
                $subject        = Option::where('option_name', 'subject_week4')->value('option_value');
                $firstname      = $demo->firstname; 
                $lastname       = $demo->lastname; 
                if(!empty($demo->email))
                {
                    $useremail       = $demo->email; 
                    $emailContent = str_replace('{First_Name}', $firstname, $emailContent);
                    $emailContent = str_replace('{Last_Name}', $lastname, $emailContent);
                    $emailContent = str_replace('{User_Email}', $useremail, $emailContent);
                    $emailContent = str_replace('<br>', '', $emailContent);
                    $emailContent = str_replace('{linebreak}', '<br>', $emailContent);
                    if (!empty($emailContent) && !empty($subject)) {
                        Mail::send('emails.weekly_demo_report', ['content' => $emailContent, 'firstname' => $firstname], function ($message) use ($subject, $useremail){
                            $message->from('info@compackage.com', 'Joe Blattner, COMPackage')
                                    ->replyTo('jblattner@compackage.com')
                                    ->to([$useremail, 'vermadilipjpr@gmail.com'])
                                    ->subject($subject);
                        });
                        $this->info('Weekly demo report email sent successfully.');
                    } else {
                        $this->error('Failed to send weekly demo report email: Email content is empty.');
                    }
                }
            });

        } catch (\Exception $e) {
            // Log any exceptions that occur during email sending
            Log::error('Error sending weekly demo report email: ' . $e->getMessage());
            $this->error('Failed to send weekly demo report email: ' . $e->getMessage());
        }
    }
}
