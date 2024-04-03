<?php

namespace App\Http\Models\Backend;

use Illuminate\Database\Eloquent\Model;

class Winning extends Model
{
    protected $table = 'winnings';
    public $timestamps = true;

    const PAGE_SIZE = 10;

    public function product() {
    	return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public static function generateWinNumber( $arr, $nums, $set = null )
    {
        $set = $set ?? [];
        if ( $nums == count( $set ) ) {
            asort( $set );

            return $set;
        }

        $randomIndex = mt_rand( 0, count( $arr ) - 1 );
        $set[]       = $arr[ $randomIndex ];
        unset( $arr[ $randomIndex ] );

        return self::generateWinNumber( array_values( $arr ), $nums, $set );
    }
}
