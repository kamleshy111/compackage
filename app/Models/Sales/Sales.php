<?php

namespace App\Models\Sales;

use App\Models\User;
use App\Models\MembershipPlans;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sales extends Model
{
    use HasFactory;

    protected $casts = [
        'created_at'  => 'date:m/d/Y H:i:s A',
        'signup_date'  => 'date:m/d/Y H:i:s A',
    ];

    /**
     * Get the user that owns the Sales
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Get the transactions associated with the Sales
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function transactions(): HasOne
    {
        return $this->hasOne(SalesTransactions::class);
    }

    /**
     * Get the transactionsStatus associated with the Sales
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function transactionsStatus(): HasOne
    {
        return $this->hasOne(SalesTransactionsStatus::class);
    }

    public function plans(): HasOne
    {
        return $this->hasOne(MembershipPlans::class, 'id', 'plan_id');
    }
}

/*

u.email,
u.first_name as FirstName,
u.last_name as LastName,
u.username as UserName,
u.PhoneExt as PhoneExt,
u.user_id as UserID,

ci.CompanyName as Company,
ci.Telephone,
ci.Industry,
ci.ReportsLeft,
ci.ReportsPackage + ci.ReportsAdditional - ci.ReportsLeft AS ReportsProcessed,
ci.ReportsExpire,
ci.SignUpDate,
ci.Testing,
ci.AFLAC,

Transactions.ID,
Transactions.Refunded,
Transactions.AFLACSales,
Transactions.AFLACPhone,
Transactions.AFLACEmail,
Transactions.TrxID,
Transactions.Description,
Transactions.Amount,
Transactions.Credits,
Transactions.DateTime,
Transactions.LastFourDigits,
Transactions.IP,
Month(SignUpDate) AS SignUpMonth,
Year(SignUpDate) AS SignUpYear,
DATEDIFF(YEAR, CAST(SignUpDate as DATETIME), GETDATE()) as TotalYears,
'web' AS type,
Transactions.PackageLength,
Transactions.subscription_id,
Transactions.became_partner
    FROM 
        web_User AS u
    LEFT OUTER JOIN
        web_CompanyUser AS cu ON cu.user_id = u.user_id
    LEFT OUTER JOIN 
        web_CompanyInfo AS ci ON ci.ID = cu.company_id
    LEFT OUTER JOIN Transactions ON Transactions.UserID = u.user_id 
WHERE (Transactions.UserID = u.user_id) AND Transactions.Type = 'web' AND ci.ParentCompanyID = 0 AND 

*/
