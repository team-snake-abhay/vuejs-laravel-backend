<?php
    namespace App\Helpers;

    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Facades\Auth;
    use App\Models\Accounting\AccHead;
    use App\Models\Accounting\Journal;
    use App\Accounting\AccHead as AcHead;
    use App\Accounting\Account;
    use Carbon\Carbon;

    class AccountingHelper {
        public static function addAccountHead(AcHead $head){
            $accHead = new AccHead;
            $accHead->title         = $head->title;
            $accHead->parent_id     = $head->parentId;
            $accHead->description   = $head->description;
            //$accHead->acc_type_id   = $head->accTypeId;
            $accHead->link_user     = isset($head->linkUser) &&  $head->linkUser != 0 ? $head->linkUser : 0;
            $accHead->created_by    = Auth::user() ? Auth::user()->id : 1;
            if($accHead->save()){
                return $accHead;
            }else return false;
        }

        
        public static function accHeadTreePrint($parentId = 0, $subMark = ''){
            $result = DB::table('acc_heads')->where('parent_id',$parentId)->get();
            if($result->count() > 0){
                foreach($result as $item){
                    echo '<option value="'.$item->id.'">'.$subMark.$item->title.'</option>';
                    AccountingHelper::accHeadTreePrint($item->id,$subMark.'-- ');
                }
            }
        }

        public static function accHeadByTitle($title = '', $subMark = ''){
            $parent = DB::table('acc_heads')->where('title','Inventory')->first();//dd($parent);
            $result = DB::table('acc_heads')->where('parent_id',$parent->id)->get();
            if($result->count() > 0){
                foreach($result as $item){
                    echo '<option value="'.$item->id.'">'.$subMark.$item->title.'</option>';
                    AccountingHelper::accHeadByTitle($item->id,$subMark.'-- ');
                }
            }
        }

        public static function journalEntry(Account $account){
            $tr = new Journal();
            $tr->amount         = $account->amount;
            $tr->acc_id         = $account->accId;
            $tr->dr_cr          = $account->drCr;//1-debit, 2-credit
            $tr->tr_date        = $account->trDate;
            $tr->narration      = $account->narration;
            $tr->ref_code       = $account->refCode;
            $tr->status         = $account->status;
            $tr->note           = $account->note;
            $tr->created_by     = Auth::user()->id;
            $tr->save();

            $tr->tr_code = 'JR'.Carbon::now()->format('YmdHis').$tr->id;
            $tr->save();
            return $tr->id;
        }

        public static function ledgerPreviousBalance($account,$date){
            $journal     = new Journal();
            $dr = 0; $cr = 0; $balance = array();
            $ledgerPrevData = $journal->ledgerPreviousBalance($account,$date); //dd($ledgerPrevData);
            foreach ($ledgerPrevData as $keys) {
                if($keys->dr_cr == 1)
                    $dr += $keys->amount;
                else
                    $cr += $keys->amount;
            } //dd($dr,$cr);
            $balance['dr'] = $dr;
            $balance['cr'] = $cr;
            $balance['balance'] = $dr - $cr;
            return $balance;
        }

        public static function findBaseParent($id)
        {
            $query = DB::table('acc_heads')->where('id',$id)->first();
            if($query->parent_id != 0)
                $id = AccountingHelper::findBaseParent($query->parent_id);
            return $id;
        }

        public static function sign( $number ) {
            return ( $number > 0 ) ? 1 : ( ( $number < 0 ) ? -1 : 0 );
        }
    }
