<?php

namespace App\Http\Controllers;


use DB;
use App\Models\User;
use App\Models\Industry;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\public\ContactUsNotification;
use App\Mail\ReviewNotification;
use App\Mail\public\ReferAFriendNotification;
use Illuminate\Support\{Facades\Hash, Facades\Validator};

class PublicController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the home page of the application.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $title = 'Total Compensation Statements | Employee Benefit Reports | COMPackage';
        $keywords = 'total compensation statements, total benefit reports, employee benefit reports, total salary reports, software, COMPackage';
        $description = 'Show your employees their total benefits with Total Compensation Statements from COMPackage. Take a virtual tour of our benefits software today.';
        return view('public.home',compact('title','keywords','description'));
    }

    /**
     * Show the contactus page of the application.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function contactus()
    {
        $title = 'Contact us for more information on COMPackage Total Compensation Statements';
        $keywords = 'compackage, contact, information on compensation statements';
        $description = 'COMPackage is here to answer any questions you might have about our software for creating total compensation statements. Contact us for more information and to let us know what you think of our product.';
        return view('public.contact',compact('title','keywords','description'));
    }
    
    public function contactUsStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fullname' => 'required|max:20',
            'businessname' => 'required|max:20',
            'email' => 'required|email|max:50',
            'phone' => 'required|max:20',
            'state' => 'required|max:20',
        ]);

        if($validator->fails()) {
			$error_msg = $validator->errors()->first();
			return response()->json([
                "success" => false,
                "data" =>  [
                    "msg" => $error_msg, 
                    "key" => $validator->errors()->keys()[0]
                ]
            ]);
		}

        $from = config('constants.emails.info');
        $cc = 'saurabhsainidws@gmail.com';
        Mail::to($from)->cc([$cc])->send(new ContactUsNotification($request));
        return send_success(["msg" => "Your message has been sent."]);
    }

    /** Send email and save reviews data */
    public function reviewsStore(Request $request)
    {
       $validator = Validator::make($request->all(), [
        'fullname' => 'required|max:40',
        'email' => 'required|email|max:50',
        ]);
        
        if($validator->fails()) {
			$error_msg = $validator->errors()->first();
			return response()->json([
                "success" => false,
                "data" =>  [
                    "msg" => $error_msg, 
                    "key" => $validator->errors()->keys()[0]
                ]
            ]);
		}
         // Validation pass hone par form data ko database mein save karein
        $review = new Review();
        $review->name = $request->fullname;
        $review->email = $request->email;
        $review->comments = $request->comments;
        
        // Save the review
        $review->save();

        $subject = 'New Feedback from COMPackage?';
        Mail::send('emails.reviews', [
            'fullname' => $request->fullname, 
            'email' => $request->email, 
            'comments' => $request->comments,
            'review'  => $request->review,
        ], function ($message) use ($subject) {
            $message->from('info@compackage.com', 'Joe Blattner, COMPackage')
                    ->to('support@compackage.com')
                    ->subject($subject);
        });
        return send_success(["msg" => "Your message has been sent."]);

    }

    /**
     * Show the stayConnected page of the application.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function stayConnected( Request $request )
    {
        $title = 'Connect with COMPackage Total Compensation Statements | COMPackage';
        $keywords = 'connect, linkedin, twitter, facebook, blog, google plus';
        $description = 'Connect with COMPackage on Google+, LinkedIn, Facebook, and Twitter. Subscribe to our Total Benefit Blog and get news on total employee benefits and compensation.';
        return view('public.stayConnected', compact('title','keywords','description'));
    }
    /**
     * Show the sampleTotalCompensationReport page of the application.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function sampleTotalCompensationReport( Request $request )
    {
        $title = 'Samples of Employee Benefit Statements and Total Compensation Reports | COMPackage';
        $keywords = 'sample of employee benefit reports, samples, examples, employee benefit statements, compensation, total compensation statement software, COMPackage';
        $description = 'View a Sample Employee Benefit Statement – 60 Different Perks and Benefits can be customized with COMPackage total compensation reporting software.';
        return view('public.sampleTotalCompensationReport', compact('title','keywords','description'));
    }
    /**
     * Show the sampleTotalCompensationReportTC page of the application.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function sampleTotalCompensationReportTC( Request $request )
    {
        $title = 'Samples of Employee Benefit Statements and Total Compensation Reports | COMPackage';
        $keywords = 'sample of employee benefit reports, samples, examples, employee benefit statements, compensation, total compensation statement software, COMPackage';
        $description = 'View a Sample Employee Benefit Statement – 60 Different Perks and Benefits can be customized with COMPackage total compensation reporting software.';
        return view('public.sampleTotalCompensationReportTC', compact('title','keywords','description'));
    }
    /**
     * Show the largeBusinessBenefitsSoftware page of the application.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function largeBusinessBenefitsSoftware( Request $request )
    {
        $title = 'Total Compensation Reports for Large Corporations | Employee Compensation Software | COMPackage';
        $keywords = 'compensation software for large companies, employee benefits for human resource departments, total compensation, personalized employee benefit statements';
        $description = 'Are you looking for total compensation software? View a sample employee benefit report and demo. Give your employees a detailed list of benefits, perks and more.';
        return view('public.largeBusinessBenefitsSoftware', compact('title','keywords','description'));
    }
    /**
     * Show the hrConsultantsBenefitsSoftware page of the application.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function hrConsultantsBenefitsSoftware( Request $request )
    {
        $title = 'Employee Benefit Statements for HR Consultants | Total Compensation Statements | COMPackage';
        $keywords = 'employee benefits, total compensation statements, hr firms, human resources, hr consultants, hr consultancies';
        $description = 'HR Consultants can now provide added-value to their services by offering clients employee benefit statements for one low annual price.';
        return view('public.hrConsultantsBenefitsSoftware', compact('title','keywords','description'));
        
    }
    /**
     * Show the benefitsConsultantsSoftware page of the application.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function benefitsConsultantsSoftware( Request $request )
    {
        $title = 'Benefit Statements Software for Benefits Consultants | COMPackage';
        $keywords = 'benefit statements, total rewards, benefits consultants, employee benefits, reports';
        $description = 'Benefits Consultants can now provide added-value to their services by offering clients total benefit statements for one low annual price.';
        return view('public.benefitsConsultantsSoftware', compact('title','keywords','description'));
    }
    /**
     * Show the accountingFirmsBenefitsSoftware page of the application.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function accountingFirmsBenefitsSoftware( Request $request )
    {
        $title = 'Total Compensation Statements for Accounting Firms | COMPackage';
        $keywords = 'benefit statements, compensation statements, total rewards, accounting firms, employee benefits, reports';
        $description = 'Accounting firms can now provide added-value to their services by offering clients total compensation statements for one low annual price.';
        return view('public.accountingFirmsBenefitsSoftware',compact('title','keywords','description'));
    }
    /**
     * Show the smallBusinessBenefitsSoftware page of the application.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function smallBusinessBenefitsSoftware( Request $request )
    {
        $title = 'Total Compensation Reports for Small Companies | Compensation Statement Software | COMPackage';
        $keywords = 'total compensation report, small businesses, employee benefit statements, total compensation, total compensation software, total compensation statements, compensation software';
        $description = 'Are you a small company in need of employee benefit solutions? View a COMPackage sample benefit statement – affordable employee compensation statement software for small businesses.';
        return view('public.smallBusinessBenefitsSoftware', compact('title','keywords','description'));
    }
    /**
     * Show the totalCompensationStatements page of the application.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function totalCompensationStatements( Request $request )
    {
        $title = 'Total Compensation Statements Online';
        $keywords = 'total compensation, solutions, employee benefit software, total compensation software, total compensation statements, compensation software, compensation statement, compackage';
        $description = 'COMPackage provides total compensation reporting software options. Our affordable software allows businesses to better communicate with employees regarding their total compensation. View a free demo today.';
        return view('public.totalCompensationStatements',compact('title','keywords','description'));
    }
    /**
     * Show the insuranceAgenciesBenefitsSoftware page of the application.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function insuranceAgenciesBenefitsSoftware( Request $request )
    {
        $title = 'Total Compensation Reports for Insurance Agencies | Total Compensation Software | COMPackage';
        $keywords = 'total compensation reports, employee benefit statements, insurance agencies, software, total compensation statements, compackage';
        $description = 'COMPackage provides total compensation statement software options for insurance agencies and businesses. View a free demo of our total compensation report today.';
        return view('public.insuranceAgenciesBenefitsSoftware', compact('title','keywords','description'));
    }
    /**
     * Show the siteMap page of the application.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function siteMap( Request $request )
    {
        $title = 'Benefit Statement Software | Total Compensation Reports Sitemap';
        $keywords = 'benefit statement software, total compensation reports, employee benefit statements, employee benefit statement, employee compensation, total compensation statement software';
        $description = 'Learn more about COMPackageâ€™s affordable and easy-to-use benefit statement software by browsing our site today. If youâ€™d like to learn more about total compensation reports, please contact us today.';
        return view('public.siteMap', compact('title','keywords','description'));
    }
    /**
     * Show the privacyPolicy page of the application.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function privacyPolicy( Request $request )
    {
        $title = 'Privacy Policy - COMPackage';
        $keywords = 'benefit statement software, total compensation reports, employee benefit statements, employee benefit statement, employee compensation, total compensation statement software';
        $description = 'Learn more about COMPackageâ€™s affordable and easy-to-use benefit statement software by browsing our site today. If youâ€™d like to learn more about total compensation reports, please contact us today.';
        return view('public.privacyPolicy', compact('title','keywords','description'));
    }
    /**
     * Show the termsConditions page of the application.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function termsConditions( Request $request )
    {
        $title = 'Terms & Conditions - COMPackage';
        $keywords = 'benefit statement software, total compensation reports, employee benefit statements, employee benefit statement, employee compensation, total compensation statement software';
        $description = 'Learn more about COMPackageâ€™s affordable and easy-to-use benefit statement software by browsing our site today. If youâ€™d like to learn more about total compensation reports, please contact us today.';
        return view('public.termsConditions', compact('title','keywords','description'));
    }
    /**
     * Show the Thrityday page of the application.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function Thrityday( Request $request )
    {
        $title = 'Benefit Statement Software | Total Compensation Reports Guarantee';
        $keywords = 'employee benefit statements, employee benefit statement, employee compensation, total compensation statement software, total compensation reports, benefit statement software';
        $description = 'COMPackage offers affordable and easy to use benefit statement software. Learn more about how fast and simple total compensation reports can be to generate';
        return view('public.30day', compact('title','keywords','description'));
    }
    /**
     * Show the ChooseDemo page of the application.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function ChooseDemo( Request $request )
    {
        $title = 'Total Compensation Report - COMPackage';
        $keywords = 'total compensation, employee compensation, compensation report';
        $description = 'Purchase the easy-to-use total compensation report software at COMPackage. Our employee benefit communication software is helping small businesses motivate employees.';
        return view('public.chooseDemo', compact('title','keywords','description'));
    }
    /**
     * Show the compackageOnline page of the application.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function compackageOnline( Request $request )
    {
        $title = 'Total Compensation Report - COMPackage';
        $keywords = 'total compensation, employee compensation, compensation report';
        $description = 'Purchase the easy-to-use total compensation report software at COMPackage. Our employee benefit communication software is helping small businesses motivate employees.';
        return view('public.compackageOnline', compact('title','keywords','description'));
    }
    /**
     * Show the compackageOnlineProfessional page of the application.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function compackageOnlineProfessional( Request $request )
    {
        $title = 'Total Compensation Report - COMPackage';
        $keywords = 'total compensation, employee compensation, compensation report';
        $description = 'Purchase the easy-to-use total compensation report software at COMPackage. Our employee benefit communication software is helping small businesses motivate employees.';
        return view('public.compackageOnlineProfessional', compact('title','keywords','description'));
    }
    /**
     * Show the compackageOnlineProfessional page of the application.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function forgotPassword( Request $request )
    {
        $title = 'Total Compensation Report - COMPackage';
        $keywords = 'total compensation, employee compensation, compensation report';
        $description = 'Purchase the easy-to-use total compensation report software at COMPackage. Our employee benefit communication software is helping small businesses motivate employees.';
        return view('public.forgotPassword', compact('title','keywords','description'));
    }
    /**
     * Show the compackageOnlineProfessional page of the application.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function purchaseLogIn( Request $request )
    {
        $title = 'Total Compensation Report - COMPackage';
        $keywords = 'total compensation, employee compensation, compensation report';
        $description = 'Purchase the easy-to-use total compensation report software at COMPackage. Our employee benefit communication software is helping small businesses motivate employees.';
        return view('public.purchaseLogIn', compact('title','keywords','description'));
    }

    /**
     * Show the reducingEmployeeTurnover page of the application.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function reducingEmployeeTurnover( Request $request )
    {
        $title = 'Reducing the Costs of Employee Turnover | COMPackage';
        $keywords = 'total compensation, compensation statements, employee benefit statements, reports, total compensation statement software';
        $description = 'Employee Turnover Can Pose Significant Costs to Your Company – Find out how to reduce costs by reducing turnover.';
        return view('public.reducingEmployeeTurnover', compact('title','keywords','description'));
    }
    /**
     * Show the employeeYearEndReports page of the application.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function employeeYearEndReports( Request $request )
    {
        $title = 'Year End Reports for Employees | Using Total Compensation Statements as Year End Reports | COMPackage';
        $keywords = 'employee year end reports, employee reviews, employee benefits, total compensation reports';
        $description = 'Ready to do year end reports for employees? Total Compensation Statements can be included in your report to paint an accurate salary and compensation picture.';
        return view('public.employeeYearEndReports', compact('title','keywords','description'));
    }
    /**
     * Show the hiddenEmployeeCompensationPerks page of the application.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function hiddenEmployeeCompensationPerks( Request $request )
    {
        $title = 'Hidden Employee Costs – What Should Be Included in a Total Compensation Statement? | COMPackage';
        $keywords = 'employee benefits, hidden costs, employee perks, compensation';
        $description = 'Does your company provide employees with perks at costs they are often unaware of? Read about some of these hidden costs.';
        return view('public.hiddenEmployeeCompensationPerks', compact('title','keywords','description'));
    }
    /**
     * Show the employeePerformanceReviews page of the application.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function employeePerformanceReviews( Request $request )
    {
        $title = 'Reporting Compensation in Employee Performance Reviews | COMPackage';
        $keywords = 'employee performance reviews, performance appraisals, performance evaluations';
        $description = 'Ready to conduct an employee performance review? Don’t forget to include total compensation statements in your review.';
        return view('public.employeePerformanceReviews', compact('title','keywords','description'));
    }
    /**
     * Show the employeeRecruitment page of the application.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function employeeRecruitment( Request $request )
    {
        $title = 'Compensation Software | Employee Recruitment';
        $keywords = 'compensation software, compensation software, total compensation software, benefit software, employee benefit statement, compensation statement, compensation statements, employee compensation statements';
        $description = 'COMPackage.com offers Total Compensation software. This easy-to-use software shows employees a detailed list of all benefits they receive. Contact us today.';
        return view('public.employeeRecruitment', compact('title','keywords','description'));
    }
    /**
     * Show the benefitStatementGlossary page of the application.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function benefitStatementGlossary( Request $request )
    {
        $title = 'Benefit Statement Glossary';
        $keywords = 'benefit statement, total compensation reports, personalized benefit statements, benefit statement software';
        $description = 'Need to learn more about benefit statements? Visit COMPackage.com today to view our glossary and learn how we make compensation reporting easy.';
        return view('public.benefitStatementGlossary', compact('title','keywords','description'));
    }
    /**
     * Show the benefitSoftwareFaq page of the application.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function benefitSoftwareFaq( Request $request )
    {
        $title = 'Total Compensation - Frequently Asked Questions about Employee Benefits Reports | COMPackage';
        $keywords = 'total compensation benefits, frequently asked questions, employee benefits, human resources, fringe benefits, personalized, statements';
        $description = 'Find answers to your Total Compensation Report questions – What are the benefits of using employee benefit statements? Find out from COMPackage.';
        return view('public.benefitSoftwareFaq', compact('title','keywords','description'));
    }
    /**
     * Show the employeeBenefitResources page of the application.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function employeeBenefitResources( Request $request )
    {
        $title = 'Total Compensation Resources – Tips on Reporting Total Employee Benefits | COMPackage';
        $keywords = 'total compensation resources, tips, tools, information, human resource software, employee benefits';
        $description = 'Find answers to your Total Compensation Report questions. Resources for creating, managing, and communicating to employees about their total compensation.';
        return view('public.employeeBenefitResources', compact('title','keywords','description'));
    }
    /**
     * Show the employeeBenefitResources page of the application.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function Customer( Request $request )
    {
        $title = 'Total Compensation Report - COMPackage';
        $keywords = 'total compensation, employee compensation, compensation report';
        $description = 'Purchase the easy-to-use total compensation report software at COMPackage. Our employee benefit communication software is helping small businesses motivate employees.';
        return view('public.customer', compact('title','keywords','description'));
    }
    /**
     * Show the productReviews page of the application.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function productReviews( Request $request )
    {
        $title = 'Product Reviews for Total Compensation Statements | COMPackage';
        $keywords = 'benefit statement software, total compensation reports, employee benefit statements, employee benefit statement, employee compensation, total compensation statement software';
        $description = 'Read product reviews and testimonials from customers of COMPackage Total Compensation Statements to learn how COMPackage can work for you.';
        return view('public.productReviews', compact('title','keywords','description'));
    }
    /**
     * Show the compensationStatementPricing page of the application.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function compensationStatementPricing( Request $request )
    {
        $user = auth()->user();
        if( $user == null ) {
            $user = new User;
        }

        $intent = $user->createSetupIntent();

        $plans = DB::table('membership_plans')->leftJoin('membership_plan_years', function($join) {
            $join->on('membership_plans.id', '=', 'membership_plan_years.plan_id');
        })->get();
        
        $plansByYear = [];
        foreach( $plans as $plan ) {
            $plansByYear[$plan->name][] = $plan;
        }
        $title = 'Prices of Employee Compensation Statements | Total Compensation Statements Software Pricing | COMPackage';
        $keywords = 'pricing, prices, affordable, employee compensation statements, benefit statements, total compensation, software prices';
        $description = 'Compare prices of employee benefit reports of COMPackage total compensation software for small, mid-size, and large businesses and insurance companies. Our affordable benefit statements provide a communication tool for employers.';
        return view('public.compensationStatementPricing', compact('intent', 'plansByYear', 'title','keywords','description'));
        //return view('public.compensationStatementPricing');
    }
    /**
     * Show the employeeBenefitsCost page of the application.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function employeeBenefitsCost( Request $request )
    {
        $title = 'Total Compensation: How Much Should Employers Spend on Employee Benefits? | COMPackage';
        $keywords = 'employee salaries, benefit costs for employers, total compensation statistics';
        $description = 'Average Salaries and Benefits Statistics: Find out what companies spend on employee total compensation.';
        return view('public.employeeBenefitsCost', compact('title','keywords','description'));
    }
    /**
     * Show the referaFriend page of the application.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function referaFriend()
    {
        $title = 'Employee Compensation Software | Tell a Friend';
        $keywords = 'total compensation statement software, personalized benefit statements, benefit statement, employee compensation software';
        $description = 'Have you benefitted from your employee compensation software? At COMPackage, we appreciate your referrals. Use our form to refer these friends easily.';
        return view('public.referaFriend', compact('title','keywords','description'));
    }
    public function referaFriendStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:50',
            'email2' => 'required|email|max:50',
            'email3' => 'required|email|max:50',
            'email4' => 'required|email|max:50',
            'email5' => 'required|email|max:50',
        ]);

        if($validator->fails()) {
			$error_msg = $validator->errors()->first();
			return response()->json([
                "success" => false,
                "data" =>  [
                    "msg" => $error_msg, 
                    "key" => $validator->errors()->keys()[0]
                ]
            ]);
		}

        $emails = [
            $request->email,
            $request->email2,
            $request->email3,
            $request->email4,
            $request->email5
        ];

        foreach( $emails as $email ) {
            Mail::to($email)->send(new ReferAFriendNotification($request));
        }
        /* 
        Refer a Friend to COMPackage Employee Compensation Statement Software
        Thank you, we really appreciate the referral!
        Joe Blattner
        */
        return send_success(["msg" => "Thank you, we really appreciate the referral!"]);
    }
    /**
     * Show the totalCompensationDemo page of the application.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function totalCompensationDemo()
    {
        $title = 'View Demo of Benefit Statements | Total Compensation Demo | COMPackage';
        $keywords = 'free demo, view a demo, total compensation demo, employee benefit statements demo, total benefits software';
        $description = 'Looking for a free demo of total compensation report software? See how COMPackage can help your company better communicate total salary with employees.';
        return view('public.totalCompensationDemo', compact('title','keywords','description'));
    }
    
    /**
     * Show the aboutus page of the application.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function aboutus()
    {
        $title = 'What is COMPackage? A Total Compensation Solutions Company | COMPackage';
        $keywords = 'compackage, total compensation companies, employee benefit software company, compensation reporting company';
        $description = 'COMPackage delivers easy-to-use and affordable benefit statement software for companies of any size. Our compensation reporting software is #1 in the industry.';
        return view('public.aboutus', compact('title','keywords','description'));
    }



    /**
     * Show the employeeTotalCompensationStatements page of the application.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function employeeTotalCompensationStatements()
    {
        $title = 'What is COMPackage? A Total Compensation Solutions Company | COMPackage';
        $keywords = 'compackage, total compensation companies, employee benefit software company, compensation reporting company';
        $description = 'COMPackage delivers easy-to-use and affordable benefit statement software for companies of any size. Our compensation reporting software is #1 in the industry.';
        return view('public.employeeTotalCompensationStatements', compact('title','keywords','description'));
    }
    /**
     * Show the researchOnImpactTotalCompensationStatements page of the application.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function researchOnImpactTotalCompensationStatements()
    {
        $title = 'Research on the Impact Total Compensation Statements | COMPackage';
        $keywords = 'compackage, total compensation companies, employee benefit software company, compensation reporting company';
        $description = 'COMPackage delivers easy-to-use and affordable benefit statement software for companies of any size. Our compensation reporting software is #1 in the industry.';
        return view('public.researchOnImpactTotalCompensationStatements', compact('title','keywords','description'));
    }
    /**
     * Show the howtoImplementHourlyTotalCompStatements page of the application.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function howtoImplementHourlyTotalCompStatements()
    {
        $title = 'How to Implement Hourly Total Comp Statements | COMPackage';
        $keywords = 'compackage, total compensation companies, employee benefit software company, compensation reporting company';
        $description = 'COMPackage delivers easy-to-use and affordable benefit statement software for companies of any size. Our compensation reporting software is #1 in the industry.';
        return view('public.howtoImplementHourlyTotalCompStatements', compact('title','keywords','description'));
    }

    /**
     * Show the Review page of the application.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function review()
    {
        $title = 'Experience with COMPackage | COMPackage';
        $keywords = 'compackage, total compensation companies, employee benefit software company, compensation reporting company';
        $description = 'COMPackage delivers easy-to-use and affordable benefit statement software for companies of any size. Our compensation reporting software is #1 in the industry.';
        return view('public.review', compact('title','keywords','description'));
    }
    
    /**
     * Show the Review CP page of the application.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function reviewCP()
    {
        $title = 'Review COMPackage | COMPackage';
        $keywords = 'compackage, total compensation companies, employee benefit software company, compensation reporting company';
        $description = 'COMPackage delivers easy-to-use and affordable benefit statement software for companies of any size. Our compensation reporting software is #1 in the industry.';
        return view('public.reviewCP', compact('title','keywords','description'));
    }

    /**
     * Show the Review Feedback page of the application.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function reviewFeedback()
    {
        $title = 'Review Feedback | COMPackage';
        $keywords = 'compackage, total compensation companies, employee benefit software company, compensation reporting company';
        $description = 'COMPackage delivers easy-to-use and affordable benefit statement software for companies of any size. Our compensation reporting software is #1 in the industry.';
        return view('public.reviewFeedback', compact('title','keywords','description'));
    }

    /**
     * Show the Test page of the application.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function whyCompackage()
    {
        $title = 'Why COMPackage vs Other Total Compensation Report Solutions';
        $keywords = 'compackage, total compensation companies, employee benefit software company, compensation reporting company';
        $description = 'COMPackage delivers easy-to-use and affordable benefit statement software for companies of any size. Our compensation reporting software is #1 in the industry.';
        return view('public.whyCompackage', compact('title','keywords','description'));
    }


    /**
     * Show the Test page of the application.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function testPage()
    {
        $title = 'testPage | COMPackage';
        $keywords = 'compackage, total compensation companies, employee benefit software company, compensation reporting company';
        $description = 'COMPackage delivers easy-to-use and affordable benefit statement software for companies of any size. Our compensation reporting software is #1 in the industry.';
        return view('public.testPage', compact('title','keywords','description'));
    }


    /**
     * Show the purchaseform page of the application.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function purchaseForm()
    {
        if( ! empty($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] != "on" ) {
            // return Redirect::to(url('/'), 301); 
            return redirect()->route('purchaseform');
        }

        /** If user is not logged in (or not registered on the site) then, create a blank user instance. */
        $user = auth()->user();
        if( $user == null ) {
            $user = new User;
        }

        $intent = $user->createSetupIntent();
        /*
        $plans = DB::table('membership_plans')->leftJoin('membership_plan_years', function($join) {
            $join->on('membership_plans.id', '=', 'membership_plan_years.plan_id');
        })->orderBy('rec_order', 'asc')->get();
        */
        $plans = DB::table('membership_plans')
        ->leftJoin('membership_plan_years', function ($join) {
            $join->on('membership_plans.id', '=', 'membership_plan_years.plan_id');
        })
        ->orderBy('rec_order', 'asc')
        ->orderBy('membership_plan_years.id', 'asc')
        ->get();

        $plansByYear = [];
        foreach( $plans as $plan ) {
            $plansByYear[$plan->name][] = $plan;
        }
        //dd($plansByYear);
        $industries = Industry::select('id', 'industry')->get();

        $title = 'Buy Total Compensation Statement Software | Employee Benefits Software';
        $keywords = 'total compensation statement software, total compensation statements, benefit statements, benefit statement software, employee benefits software, total compensation report';
        $description = 'Generate your own total compensation statements through COMPackage’s employee benefits software. Learn more about this total compensation statement software solution by contacting us today.';
        return view('public.purchaseform', compact('intent', 'plansByYear', 'title','keywords','description', 'industries'));
    }

    /**
     * Get plans list
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function plansByYear( $by = false )
    {
        $plans = DB::table('membership_plans')->orderBy('rec_order', 'asc')->get()->toArray();
        return send_success(["plans" => $plans]);
    }

    /**
     * Get the plan years by plan id.
     */
    public function yearsByPlan( $plan_id )
    {
        $plans = DB::table('membership_plan_years')->where('plan_id', $plan_id)->get()->toArray();
        return send_success(["plansbyyear" => $plans]);
    }


    
}
