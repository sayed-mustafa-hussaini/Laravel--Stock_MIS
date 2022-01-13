<?php
   
    namespace App\Http;

    use Composer\DependencyResolver\Request;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Foundation\Http\FormRequest;
    use App\Http\Controllers\Controller;

    use App\Models\Stocks;
    use App\Models\Goods;
    use App\Models\Bills;
    use App\Models\Payments;
    use App\Models\Loan;
    use App\Models\Purchases;
    use App\Models\User;
    use App\Models\ActivityLog;

    
    class Helpers{

        public static function getGoodsQuantity($id)
        {
            $data_id=Goods::select('id')->where('category_id',$id)->get();
            $goods=0;
            foreach ($data_id as $key => $item) {
                $goods_quantity=DB::table('stocks')->where('goods_id',$item->id)->sum('quantity_goods');
                $goods+=$goods_quantity;
            }
            return $goods;
        }
        public static function BillNum()
        {
            $billNo=Bills::select(DB::raw('MAX(bill_num)as max'))->get();
            $bill=$billNo[0]->max;
            return $bill+1;
        }

        // Loan and Payment Helper
        public static function getPayments($id)
        {   
            $data=Payments::where('loan_id',$id)->sum('pay_quantity');
            return $data;
        }

        public static function purchasePayments($purhcase_id)
        {   
            $loans=Loan::Where('purchase_id',$purhcase_id)->select('id')->where('loans.status','گرفته')->get();
            if(!empty($loans[0])){
                $loan_id=$loans[0]->id;
                $data=Payments::where('loan_id',$loan_id)->sum('pay_quantity');
            }else{
                $data=0;
            }
            return $data;
        }

        public static function billPayments($bill_id)
        {   
            $loans=Loan::Where('bill_id',$bill_id)->select('id')->where('loans.status','داده')->get();
            if(!empty($loans[0])){
                $loan_id=$loans[0]->id;
                $data=Payments::where('loan_id',$loan_id)->sum('pay_quantity');
            }else{
                $data=0;
            }
            return $data;
        }


        // Activity Log
        public static function addActivityLog($activity)
        {
            $activityLog=new ActivityLog();
            $activityLog->user_id =Auth()->id();
            $activityLog->activity_description =htmlentities($activity);
            $activityLog->ip_address =request()->ip();
            $activityLog->user_agent =request()->header('user-agent');
            $activityLog->save();
        }



        
    }