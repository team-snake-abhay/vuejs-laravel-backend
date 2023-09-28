<?php
    namespace App\Helpers;

    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Facades\Auth;
    use App\Models\Shop\Category;

    class CategoryHelper {
        
        public static function categoryTreePrint($parentId = 0, $subMark = ''){
            $result = DB::table('categories')->where('parent_cat',$parentId)->get();
            if($result->count() > 0){
                foreach($result as $item){
                    echo '<option value="'.$item->id.'">'.$subMark.$item->name.'</option>';
                    CategoryHelper::categoryTreePrint($item->id,$subMark.'-- ');
                }
            }
        }
    }
