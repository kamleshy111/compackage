<?php
// namespace App\Http\Helpers;

// use Auth;
use App\Models\User;
use App\Models\UserMeta;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;


/**
 * Common function that will used across the site.
 */

function send_success( Array $resp ) {
    return json_encode(["success" => true , 'data' => $resp ]);
    exit;
}

function send_error( Array $resp ) {
    return json_encode(["success" => false , 'data' => $resp ]);
    exit;
}

function getPaginationObject( $collection ) {
    return [
        'total' => $collection->total(),
        'per_page' => $collection->perPage(),
        'current_page' => $collection->currentPage(),
        'last_page' => $collection->lastPage(),
        'from' => $collection->firstItem(),
        'to' => $collection->lastItem()
    ];
}

function get_user_meta( $user_id, $meta_key = '' ) {
    // dd(Auth::User::find());
    // return '';
    if( empty( $user_id ) ) {
        return '';
    }

    if( empty( User::find( $user_id ) ) ) {
        return '';
    }

    $user_meta = '';
    if( ! empty( $meta_key ) ) {
        $user_meta = UserMeta::where('user_id', $user_id)->where('meta_key', $meta_key)->first();
        if( ! empty( $user_meta ) ) {
            return $user_meta->meta_value;
        } else {
            return '';
        }
    } else {
        $user_meta = UserMeta::where('user_id', $user_id)->get()->toArray();
        if( ! empty( $user_meta ) ) {
            return $user_meta;
        } else {
            return '';
        }
    }
    return '';
}

function update_user_meta( $user_id, $meta_key, $meta_value ) {
    if( empty( $user_id ) ) {
        return '';
    }

    if( empty( User::find( $user_id ) ) ) {
        return '';
    }
    
    if( ! empty( $meta_key ) ) {
        $user_meta = UserMeta::where('user_id', $user_id)->where('meta_key', $meta_key)->first();
        if( ! empty( $user_meta ) ) {
            $user_meta->meta_value = $meta_value;
            $user_meta->save();
        } else {
            $user_meta = new UserMeta();
            $user_meta->user_id = $user_id;
            $user_meta->meta_key = $meta_key;
            $user_meta->meta_value = $meta_value;
            $user_meta->save();
        }
    }
    return '';
}

function paperSize( $key = 'a4' ) {
    $PAPER_SIZES = [
        "4a0" => [0, 0, 4767.87, 6740.79],
        "2a0" => [0, 0, 3370.39, 4767.87],
        "a0" => [0, 0, 2383.94, 3370.39],
        "a1" => [0, 0, 1683.78, 2383.94],
        "a2" => [0, 0, 1190.55, 1683.78],
        "a3" => [0, 0, 841.89, 1190.55],
        "a4" => [0, 0, 650.28, 1000.89],
        // "a4" => [0, 0, 595.28, 841.89],
        "a5" => [0, 0, 419.53, 595.28],
        "a6" => [0, 0, 297.64, 419.53],
        "a7" => [0, 0, 209.76, 297.64],
        "a8" => [0, 0, 147.40, 209.76],
        "a9" => [0, 0, 104.88, 147.40],
        "a10" => [0, 0, 73.70, 104.88],
        "b0" => [0, 0, 2834.65, 4008.19],
        "b1" => [0, 0, 2004.09, 2834.65],
        "b2" => [0, 0, 1417.32, 2004.09],
        "b3" => [0, 0, 1000.63, 1417.32],
        "b4" => [0, 0, 708.66, 1000.63],
        "b5" => [0, 0, 498.90, 708.66],
        "b6" => [0, 0, 354.33, 498.90],
        "b7" => [0, 0, 249.45, 354.33],
        "b8" => [0, 0, 175.75, 249.45],
        "b9" => [0, 0, 124.72, 175.75],
        "b10" => [0, 0, 87.87, 124.72],
        "c0" => [0, 0, 2599.37, 3676.54],
        "c1" => [0, 0, 1836.85, 2599.37],
        "c2" => [0, 0, 1298.27, 1836.85],
        "c3" => [0, 0, 918.43, 1298.27],
        "c4" => [0, 0, 649.13, 918.43],
        "c5" => [0, 0, 459.21, 649.13],
        "c6" => [0, 0, 323.15, 459.21],
        "c7" => [0, 0, 229.61, 323.15],
        "c8" => [0, 0, 161.57, 229.61],
        "c9" => [0, 0, 113.39, 161.57],
        "c10" => [0, 0, 79.37, 113.39],
        "ra0" => [0, 0, 2437.80, 3458.27],
        "ra1" => [0, 0, 1729.13, 2437.80],
        "ra2" => [0, 0, 1218.90, 1729.13],
        "ra3" => [0, 0, 864.57, 1218.90],
        "ra4" => [0, 0, 609.45, 864.57],
        "sra0" => [0, 0, 2551.18, 3628.35],
        "sra1" => [0, 0, 1814.17, 2551.18],
        "sra2" => [0, 0, 1275.59, 1814.17],
        "sra3" => [0, 0, 907.09, 1275.59],
        "sra4" => [0, 0, 637.80, 907.09],
        "letter" => [0, 0, 612.00, 792.00],
        "half-letter" => [0, 0, 396.00, 612.00],
        "legal" => [0, 0, 612.00, 1008.00],
        "ledger" => [0, 0, 1224.00, 792.00],
        "tabloid" => [0, 0, 792.00, 1224.00],
        "executive" => [0, 0, 521.86, 756.00],
        "folio" => [0, 0, 612.00, 936.00],
        "commercial #10 envelope" => [0, 0, 684, 297],
        "catalog #10 1/2 envelope" => [0, 0, 648, 864],
        "8.5x11" => [0, 0, 612.00, 792.00],
        "8.5x14" => [0, 0, 612.00, 1008.0],
        "11x17" => [0, 0, 792.00, 1224.00],
    ];

    if( ! empty( $PAPER_SIZES[$key] )  ) {
        return $PAPER_SIZES[$key];
    }
    return $PAPER_SIZES['a4'];
}

function getNameFromNumber($num) {
    $numeric = ($num - 1) % 26;
    $letter = chr(65 + $numeric);
    $num2 = intval(($num - 1) / 26);
    if ($num2 > 0) {
        return getNameFromNumber($num2) . $letter;
    } else {
        return $letter;
    }
}

function pagination_limit() {
    return 10;
}

/**
 * @param   code Error code
 * @param   message Error message
 * @param   data Extra data
 * @return  Error Object
 */
function error( $code = 500, $message = 'Something went wrong', $data = [] ) {
    return json_decode(json_encode([
        'code'      => $code,
        'error'     => true,
        'mssage'    => $message,
        'data'      => $data
    ]), FALSE);
}

/**
 * @param error Array/Object
 * @return boolean
 */
function is_error( $error )
{
    if( is_array( $error ) && isset($error['error']) ) {
        return true;
    } else if( is_object( $error ) && isset($error->error) ) {
        return true;
    }
    return false;
}

/**
 * Get all the from email from one place
 */

function getFromEmails()
{
    return [
        'admin'     => 'info@compackage.com',
        'support'   => 'techadmin@compackage.com'
    ];
}

function rawSql($table, $data) {
    $builder = \DB::table($table);

    $query = \DB::pretend(function() use ($builder, $data)
    {
        return $builder->insert($data);
    });
    
    $bindings = [];
    collect($query[0]['bindings'])->each(function($binding) use (&$bindings)
    {
        $binding = str_replace("'", "\\'", $binding);
        $bindings[] = "'$binding'";
    });

    return \Str::replaceArray('?', $bindings, $query[0]['query']);
}

function get_option($key)
{
    try {
        $option = DB::table('options')->where('option_name', $key)->first();
        return $option->option_value;
    } catch( Exception $ex) {
        return '';
    }
}

function update_option($key, $value)
{
    try {
        DB::table('options')->where('option_name', $key)->update(['option_value' => $value]);
        return true;
    } catch( Exception $ex) {
        return false;
    }
}

/**
 * Remove comma from the number and remove values two decimal
 */
function nf( $number ) {
    $number_without_comma = (float)(str_ireplace(',', '', $number));
    return number_format((float)$number_without_comma, 2, '.', '');
}